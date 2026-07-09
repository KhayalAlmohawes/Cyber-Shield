<?php
    // رقم الفيديو
    $id = isset($_GET['v']) ? intval($_GET['v']) : 1;

    // أسماء الفيديوهات كما في جهازك
    $videos = [
        1 => "video1 Phishing.mp4",
        2 => "video2 Passwords.mp4",
        3 => "video3 Smishing.mp4",
        4 => "video4 Ransomeware.mp4",
        5 => "video5 Safe Browsing.mp4",
        6 => "video6 Email red flags.mp4"
    ];

    // عناوين الفيديوهات
    $titles = [
        1 => "How Phishing Works",
        2 => "Password Security Tips",
        3 => "Smishing Awareness",
        4 => "Ransomware Explained",
        5 => "Safe Browsing Online",
        6 => "Email Red Flags"
    ];

    // إذا الرقم غلط
    if (!isset($videos[$id])) {
        $id = 1;
    }

    // مسار الفيديو
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
    h1 { margin-bottom: 25px; font-size: 28px; }

    video {
        width: 80%;
        max-width: 900px;
        border-radius: 12px;
        margin-top: 20px;
    }

    .back-btn {
        margin-top: 20px;
        padding: 10px 18px;
        background: #2ECFC5;
        color: black;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
    }
</style>

</head>
<body>

<h1><?php echo $title; ?></h1>

<video controls>
    <source src="<?php echo $videoPath; ?>" type="video/mp4">
</video>

<br><br>

<a href="awareness_videos.php" class="back-btn">⬅ Back to Videos</a>

</body>
</html>
