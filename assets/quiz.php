<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Phishing Awareness Quiz</title>

<style>
body {
    font-family: "Poppins", Arial, sans-serif;
    background: linear-gradient(135deg, #010824, #021939);
    margin: 0;
    padding: 0;
    color: white;
}

.quiz-container {
    width: 90%;
    max-width: 500px;
    margin: 70px auto;
    background: #ffffff17;
    padding: 35px;
    border-radius: 20px;
    backdrop-filter: blur(10px);
    box-shadow: 0 0 12px rgba(0,0,0,0.5);
    border: 1px solid rgba(255,255,255,0.1);
}

.quiz-container h2 {
    text-align: center;
    color: #2ECFC5;
    margin-bottom: 20px;
    font-size: 26px;
    font-weight: 600;
}

.quiz-container h3 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #fff;
}

.answer {
    padding: 15px;
    margin: 12px 0;
    background: #ffffff25;
    color: #eee;
    border-radius: 15px;
    cursor: pointer;
    border: 1px solid rgba(255,255,255,0.1);
    transition: .2s;
}

.answer:hover {
    background: #35A2E6;
    color: white;
}

.correct {
    background: #2ECFC5 !important;
    color: #000 !important;
}

.wrong {
    background: #ff5858 !important;
    color: #000 !important;
}

.reason {
    margin-top: 10px;
    background: #ffffff10;
    padding: 12px;
    border-radius: 12px;
    color: #ccc;
    font-size: 15px;
    border: 1px solid rgba(255,255,255,0.1);
}

button {
    margin-top: 20px;
    padding: 12px 20px;
    background: #35A2E6;
    border: none;
    color: white;
    border-radius: 12px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
    font-weight: 600;
    transition: .2s;
}

button:hover {
    background: #2ECFC5;
}

#resultBox {
    text-align: center;
}

#resultBox h2 {
    color: #2ECFC5;
}

#result-text {
    font-size: 22px;
    margin: 15px 0;
}

</style>
 <!-- css -->
 <link rel="stylesheet" href="style.css">
</head>
<body>



<div class="quiz-container">
    <h2>Phishing Awareness Quiz</h2>
    <div id="question-box"></div>
    <button id="next-btn">Next</button>
    <a href="Awareness Library.html">
        <button>Back to Awareness</button>
    </a>
</div>

<div class="quiz-container" id="resultBox" style="display:none;">
    <h2>Your Score</h2>
    <p id="result-text"></p>
    <a href="Awareness Library.html">
        <button>Back to Awareness</button>
    </a>
</div>

<script>

const quizData = [
    { q: "What should you always check when receiving an unknown email?",
      answers: ["The design","The emojis","The sender’s email address","The colors"],
      correct: 2,
      reason: "Phishers copy official emails but change small details in the address."
    },
    { q: "A message says: “Urgent! Update your password NOW!” What does this indicate?",
      answers: ["Normal message","Newsletter","Fear-based phishing","System alert"],
      correct: 2,
      reason: "Hackers use urgency to make you panic and click."
    },
    { q: "You receive a shortened link (bit.ly). What should you do?",
      answers: ["Click it","Ignore it","Report it","Open it in new tab"],
      correct: 2,
      reason: "Shortened links can hide dangerous URLs."
    },
    { q: "How to verify an email from IT Support?",
      answers: ["Reply","Click the link","Contact IT directly","Open attachment"],
      correct: 2,
      reason: "Phishers pretend to be IT. Always verify through official channels."
    },
    { q: "Which action is a red flag in an email?",
      answers: ["Greeting","Asking for password","Company logo","Friendly tone"],
      correct: 1,
      reason: "No real team will ever ask for your credentials."
    },
    { q: "Hover link shows different URL than text. This means:",
      answers: ["Safe link","Normal","Suspicious","Browser bug"],
      correct: 2,
      reason: "Phishing emails hide malicious links behind normal text."
    },
    { q: "Email has grammar mistakes. This indicates:",
      answers: ["Trusted","Phishing","Official","Urgent"],
      correct: 1,
      reason: "Most phishing messages are poorly written."
    },
    { q: "You won a free phone! What should you do?",
      answers: ["Click link","Reply","Delete/report","Share with friends"],
      correct: 2,
      reason: "Fake rewards are a common phishing trick."
    },
    { q: "Bank email asks to confirm your card via link. What do you do?",
      answers: ["Click it","Ignore","Visit bank manually","Reply"],
      correct: 2,
      reason: "Banks never ask verification through external links."
    },
    { q: "Attachment from unknown sender. Safest action?",
      answers: ["Open it","Scan it","Ignore","Do not open"],
      correct: 3,
      reason: "Unknown attachments may contain malware."
    }
];

let current = 0;
let score = 0;

const questionBox = document.getElementById("question-box");
const nextBtn = document.getElementById("next-btn");
const resultBox = document.getElementById("resultBox");

function loadQuestion() {
    const q = quizData[current];
    questionBox.innerHTML = `
        <h3>${q.q}</h3>
        ${q.answers
            .map((a, i) => `<div class='answer' onclick='checkAnswer(${i})'>${a}</div>`)
            .join("")}
        <div id="reasonBox"></div>
    `;
}

loadQuestion();

function checkAnswer(i) {
    const q = quizData[current];
    const answers = document.querySelectorAll(".answer");

    answers.forEach((el, index) => {
        if (index === q.correct) el.classList.add("correct");
        if (index === i && i !== q.correct) el.classList.add("wrong");
        el.style.pointerEvents = "none";
    });

    if (i === q.correct) score++;

    document.getElementById("reasonBox").innerHTML =
        `<p class='reason'><b>Why?</b> ${q.reason}</p>`;
}

nextBtn.onclick = () => {
    if (current < quizData.length - 1) {
        current++;
        loadQuestion();
    } else {
        showResult();
    }
};

function showResult() {
    document.querySelector(".quiz-container").style.display = "none";
    resultBox.style.display = "block";
    document.getElementById("result-text").innerHTML =
        `You scored <b>${score} / 10</b>`;
}
</script>

</body>
</html>
