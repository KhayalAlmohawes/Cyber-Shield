<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";

$cid = intval($_GET['cid'] ?? 0);
$mid = intval($_GET['mid'] ?? 0);

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "db_connect.php";

// استلام القيم
$cid = intval($_GET['cid'] ?? ($_GET['c'] ?? 0));
$mid = intval($_GET['mid'] ?? ($_GET['u'] ?? 0));

if ($cid <= 0 || $mid <= 0) {
    die("<br><b>Invalid tracking link. cid or mid <= 0</b>");
}

// تحقق من وجود سجل سابق
$checkQuery = "SELECT * FROM result WHERE CampaignId = $cid AND MemberId = $mid";
$check = $conn->query($checkQuery);

if (!$check) {
    die("<br><b>SQL CHECK ERROR:</b> " . $conn->error . "<br>Query: $checkQuery");
}

// if ($check->num_rows == 0) {
    if (true) {
    // أول مرة يفشل → ينقص 30
    $conn->query("
        UPDATE members 
        SET AwarenessLevel = GREATEST(AwarenessLevel - 30, 0) 
        WHERE MemberId = $mid
    ");

    // INSERT أول مرة
    $insertQuery = "
        INSERT INTO result (CampaignId, MemberId, FailureStatus, ReportedStatus, Time)
        VALUES ($cid, $mid, 1, 0, CURRENT_TIMESTAMP)
    ";

    $insert = $conn->query($insertQuery);

    if (!$insert) {
        die("<br><b>SQL INSERT ERROR:</b> " . $conn->error . "<br>Query: $insertQuery");
    }

} else {

    // يوجد سجل → UPDATE فقط
    $updateQuery = "
        UPDATE result 
        SET FailureStatus = 1, ReportedStatus = 0, Time = CURRENT_TIMESTAMP
        WHERE CampaignId = $cid AND MemberId = $mid
    ";

    $update = $conn->query($updateQuery);

    if (!$update) {
        die("<br><b>SQL UPDATE ERROR:</b> " . $conn->error . "<br>Query: $updateQuery");
    }
}

// رسالة للموظف
echo "
<h1 style='text-align:center; margin-top:80px; font-family:Arial'>
⚠️ This was a phishing simulation.<br><br>
Your action has been recorded.
</h1>
";
?>
