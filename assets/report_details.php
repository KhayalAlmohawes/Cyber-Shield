<?php
include "db_connect.php";

$cid = intval($_GET['cid']);

$details = $conn->query("
    SELECT FullName, ReportedStatus, FailureStatus 
    FROM result 
    JOIN members ON members.MemberId = result.MemberId
    WHERE CampaignId = $cid
");

echo "<p style='color:white; font-size:18px;'>Records found: {$details->num_rows}</p>";

if ($details->num_rows == 0) {
    echo "<p style='text-align:center; padding:20px;'>⛔There is no data for this campaign</p>";
    exit;
}

echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
<tr style='background:#0A2540; color:white;'>
    <th>Employee</th>
    <th>Status</th>
</tr>";

while ($row = $details->fetch_assoc()):
    $status = "Ignored ❔";

    if ($row['FailureStatus'] == 1) $status = "Clicked ❌";
    if ($row['ReportedStatus'] == 1) $status = "Reported 🟢";

    echo "<tr>
            <td>{$row['FullName']}</td>
            <td>$status</td>
          </tr>";
endwhile;

echo "</table>";
?>
