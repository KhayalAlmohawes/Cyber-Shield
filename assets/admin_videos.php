<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Awareness Videos | Cyber Shield</title>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #010824;
            font-family: "Poppins", sans-serif;
            color: white;
            padding: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 35px;
            font-weight: 700;
        }

        .video-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .video-card {
            background: #021939;
            border-radius: 16px;
            padding: 15px;
            transition: 0.3s;
            cursor: pointer;
        }

        .video-card:hover {
            transform: translateY(-5px);
            background: #032455;
        }

        .video-thumb {
            width: 100%;
            height: 160px;
            background-color: #091f43;
            border-radius: 12px;
            object-fit: cover;
        }

        .video-card h3 {
            margin-top: 12px;
            font-size: 20px;
        }

        .video-card p {
            opacity: 0.8;
            font-size: 14px;
        }

        .play-btn {
            margin-top: 10px;
            display: inline-block;
            padding: 8px 18px;
            background: #2ECFC5;
            color: black;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .play-btn:hover {
            background: #1faea6;
        }
       .back-icon-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border: 1.5px solid rgba(255,255,255,0.28);
    border-radius: 50%;
    margin-right: 14px;
    cursor: pointer;
    transition: 0.25s;
}

.back-icon-btn:hover {
    border-color: rgba(255,255,255,0.55);
    transform: translateX(-3px);
}

.back-icon {
    width: 18px;
    height: 18px;
} 
    </style>
</head>

<body>
 <div class="navbar">

<img class="logo" src="imge\Group 4.svg"alt="logo"width="20px">
<ul class="nav-item">
<li class="link" >
<a href="index.php">Home</a>  
</li>
<li class="link">
<a href="signuppage.php">join us</a>  
</li>
<a href="Administrator.php" class="back-icon-btn">
    <svg class="back-icon" viewBox="0 0 24 24">
        <path d="M9 6l6 6-6 6" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>
</div><!-- nav close -->
<h1>Admin Awareness Videos</h1>
<div class="video-grid"> 
    
    <!-- Video 1 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin111.jpg">
        <h3>Information Security Awareness Employee Training</h3>
        <p>Protect Your Company's Data and Reputation.</p>
        <a href="admin_video_player.php?v=1" class="play-btn">Play</a>
    </div>

    <!-- Video 2 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin22.jpg">
        <h3>Cybersecurity Threats</h3>
        <p>How to protect yourself and your business.</p>
        <a href="admin_video_player.php?v=2" class="play-btn">Play</a>
    </div>

    <!-- Video 3 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin33.jpg">
        <h3>How Top Companies Protect Data</h3>
        <p>Learn elite data protection strategies.</p>
        <a href="admin_video_player.php?v=3" class="play-btn">Play</a>
    </div>

    <!-- Video 4 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin444.jpg">
        <h3>What is Phishing?</h3>
        <p>Learn how this attack works and how to avoid it.</p>
        <a href="admin_video_player.php?v=4" class="play-btn">Play</a>
    </div>

    <!-- Video 5 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin55.jpg">
        <h3>Things That WILL Protect Your Company</h3>
        <p>Strong ways to defend against cyber attacks.</p>
        <a href="admin_video_player.php?v=5" class="play-btn">Play</a>
    </div>

    <!-- Video 6 -->
    <div class="video-card">
        <img class="video-thumb" src="imge/imgeAdmin6.jpg">
        <h3>How to Protect Your Business from Cyber Threats</h3>
        <p>FULL version training from SolutionsFromShawn.</p>
        <a href="admin_video_player.php?v=6" class="play-btn">Play</a>
    </div>

</div>

</body>
</html>