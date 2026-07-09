<?php
    
    $id = isset($_GET['v']) ? intval($_GET['v']) : 1;

   $videos = [
    1 => "videoAdimn1.mp4",
    2 => "videoAdimn2.mp4",
    3 => "videoAdimn3.mp4",
    4 => "videoAdimn4.mp4",
    5 => "videoAdimn5.mp4",
    6 => "videoAdimn6.mp4"
];
    $titles = [
        1 => "Information Security Awareness for Admins",
        2 => "Cybersecurity Threats & How to Protect Your Business",
        3 => "How Top Companies Protect Their Data",
        4 => "What is Phishing? Learn How This Attack Works",
        5 => "Things That Will Protect Your Company from Cyber Attacks",
        6 => "How to Protect Your Business from Cyber Threats"
    ];

    if (!isset($videos[$id])) {
        $id = 1;
    }

     $videoPath = "videos/" . $videos[$id];
    $title = $titles[$id];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $title; ?></title>

<style>
    body {
        background: #010824;
        color: white;
        font-family: "Poppins", sans-serif;
        text-align: center;
        padding: 25px;
    }

    h1 {
        margin-bottom: 25px;
        font-size: 28px;
        color: #3CE1E9;
    }

    video {
        width: 80%;
        max-width: 900px;
        border-radius: 12px;
        margin-top: 20px;
        outline: 2px solid #3CE1E9;
    }

    .back-btn {
        margin-top: 25px;
        padding: 10px 18px;
        background: #3CE1E9;
        color: #010824;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        border: none;
    }
</style>

</head>
<body>

<h1><?php echo $title; ?></h1>

<video controls>
    <source src="<?php echo $videoPath; ?>" type="video/mp4">
</video>

<br><br>

<a href="admin_videos.php" class="back-btn">⬅️ Back to Admin Videos</a>

</body>
</html>