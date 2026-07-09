<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'db_connect.php';

if (!isset($_GET["campaign"])) {
    die("❌ No campaign selected");
}

$campaignId = intval($_GET["campaign"]);


$getTemp = $conn->query("SELECT TemplateId FROM campaigns WHERE CampaignId=$campaignId");
if (!$getTemp || $getTemp->num_rows == 0) {
    die("❌ Campaign not found.");
}

$templateId = $getTemp->fetch_assoc()["TemplateId"];


$tempQ = $conn->query("
    SELECT TemplateBody, TemplateName
    FROM templates
    WHERE TemplateId = $templateId
");
if (!$tempQ || $tempQ->num_rows == 0) {
    die("❌ Template not found.");
}

$template = $tempQ->fetch_assoc();
$emailBody = $template["TemplateBody"];  
$emailSubject = $template["TemplateName"];


$users = $conn->query("
    SELECT MemberId, FullName, EmailAddres
    FROM members
    WHERE DepartmentId = (SELECT TargetDepartmentId FROM campaigns WHERE CampaignId=$campaignId)
");

if (!$users || $users->num_rows == 0) {
    die("⚠️ No users in this department!");
}




$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;

    $mail->Username = "cybershield.platform@gmail.com"; 
    $mail->Password = "jcymbiaqbuqcnnul";               

    $mail->SMTPSecure = "tls";
    $mail->Port = 587;

    $mail->setFrom("cybershield.platform@gmail.com", "CyberShield Simulation");
    $mail->isHTML(true);

    echo "<h3>📤 Sending emails...<br><br></h3>";


    

    while ($row = $users->fetch_assoc()) {

        $userId = $row['MemberId'];
        $email  = $row['EmailAddres'];
        $name   = $row['FullName'];



        $trackLink = "http://localhost/cyber_shield/coop_project/assets/track.php?cid={$campaignId}&mid={$userId}";

        $finalBody = str_replace("{{TRACK_LINK}}", $trackLink, $emailBody);


        $mail->clearAllRecipients();
        $mail->addAddress($email, $name);

        $mail->Subject = $emailSubject;
        $mail->Body    = $finalBody;

        if ($mail->send()) {

            echo "📩 Sent to: {$email}<br>";

            $conn->query("
    INSERT INTO result (CampaignId, MemberId, ReportedStatus, FailureStatus)
    VALUES ($campaignId, $userId, 0, 0)
");;
        } else {
            echo "❌ Failed to send: {$email}<br>";
        }
    }

    echo "<br><br>🎉 All mails processed successfully!";
} catch (Exception $e) {
    echo "❗️ ERROR: {$mail->ErrorInfo}";
}
