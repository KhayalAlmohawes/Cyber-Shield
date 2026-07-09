<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// استلام القيم من الفورم
$subject     = $_POST['subject'] ?? '';
$description = $_POST['description'] ?? '';
$sender      = $_POST['sender'] ?? '';
$emailLink   = $_POST['email_link'] ?? ''; // الرابط الجديد
$screenshot  = '';

// استخراج cid و mid من رابط الإيميل الملصوق
$params = [];
parse_str(parse_url($emailLink, PHP_URL_QUERY), $params);

$cid = intval($params['cid'] ?? 0);
$memberId = intval($params['mid'] ?? $_SESSION['user_id']); // fallback إذا الرابط ناقص

// حماية من الروابط الخاطئة
if ($cid <= 0) {
    die("<h2>❌ ERROR: Invalid or missing CampaignId in the email link.</h2>");
}

// رفع صورة/ملف screenshot إن وجد
if (!empty($_FILES['screenshot']['name'])) {

    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileName   = time() . "_" . basename($_FILES["screenshot"]["name"]);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES["screenshot"]["tmp_name"], $targetPath)) {
        $screenshot = $fileName;
    }
}

// 🔵 1) حفظ البلاغ في جدول reports
$stmt = $conn->prepare("
    INSERT INTO reports (MemberId, Subject, Description, Screenshot, Sender, EmailLink)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param("isssss", $memberId, $subject, $description, $screenshot, $sender, $emailLink);

if (!$stmt->execute()) {
    die("<h2>❌ Failed to save report: " . $conn->error . "</h2>");
}

// 🔵 2) التحقق إذا سبق وبلّغ عن هذه الحملة
$checkReport = $conn->query("
    SELECT * FROM result 
    WHERE CampaignId = $cid 
    AND MemberId = $memberId 
    AND ReportedStatus = 1
");

// 🔥 3) إذا أول بلاغ لهذه الحملة → أعطه +10
if ($checkReport->num_rows == 0) {

    // زيادة الوعي
    $conn->query("
        UPDATE members 
        SET AwarenessLevel = AwarenessLevel + 10
        WHERE MemberId = $memberId
    ");

    // تسجيل البلاغ في جدول result
    $conn->query("
        INSERT INTO result (CampaignId, MemberId, FailureStatus, ReportedStatus, Time)
        VALUES ($cid, $memberId, 0, 1, NOW())
    ");
}

// 🔵 4) رسالة نجاح + تحويل
echo "<script>alert('✔️ Report submitted successfully!'); window.location='employee.php';</script>";
exit;

?>
