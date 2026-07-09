<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>report</title>
   <link rel="stylesheet" href="style.css">
<style>  .back-icon-btn {
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
.message-form{margin-top: 66px;}
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
<

<a href="Employee.php" class="back-icon-btn">
    <svg class="back-icon" viewBox="0 0 24 24">
        <path d="M9 6l6 6-6 6" stroke="white" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</a>

</div><!-- nav close -->
  <form action="report_message.php" method="POST" enctype="multipart/form-data" class="message-form">
  <h4>If you received a suspicious email or SMS, please report it below.<hr> </h4>

  <label class="message-lable" for="type">Message Type</label>
  <select id="type" name="subject" class="select-box" required>
    <option value="" disabled selected>Select type</option>
    
    <option value="Email">Email</option>
  </select>

  <label class="message-lable" for="content">Message Content</label>
  <input type="text" id="content" name="description" placeholder="Message content" required>

  <label class="message-lable" for="sender">Sender Number / Address</label>
  <input type="text" id="sender" name="sender" placeholder="Sender Number or Address" required>

  <label class="message-lable" for="email_link">Phishing Email Link</label>
  <input type="text" id="email_link" name="email_link" 
         placeholder="Paste the suspicious email link here" required>

  <label class="message-lable" for="attachment">Attachment (optional)</label>
  <input type="file" id="attachment" name="screenshot" accept=".png,.jpg,.jpeg,.pdf,.eml" />

  <button type="submit" class="SUBMIT-REPORT">SUBMIT REPORT</button>
</form>

</body>
</html>