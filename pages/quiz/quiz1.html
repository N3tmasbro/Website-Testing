<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect jika belum login
    exit();
}

$username = $_SESSION['name']; // Ambil username dari sesi

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
        <h2 class="text-center">Let's Start the Quiz</h2>

        <div id="quiz-section">
            <div id="quiz" class="mt-4">
                <h4 id="question">Loading question...</h4>
                <ul id="options" class="list-unstyled"></ul>
            </div>
            <button id="next-btn" class="btn btn-primary mt-3" onclick="nextQuestion()">Next</button>
        </div>

        <div id="result-section" class="d-none">
            <h3>Quiz Finished!</h3>
            <p>Your Score: <span id="score"></span></p>
            <a href="leaderboard.php" class="btn btn-success">View Leaderboard</a>
        </div>
    </div>

    <script>
        const questions = [
            {
                question: "What is 2 + 2?",
                options: ["3", "4", "5", "6"],
                correct: "4"
            },
            {
                question: "What is the capital of France?",
                options: ["Berlin", "Madrid", "Paris", "Rome"],
                correct: "Paris"
            }
        ];

        let currentQuestion = 0;
        let score = 0;

        const questionElement = document.getElementById("question");
        const optionsElement = document.getElementById("options");
        const scoreElement = document.getElementById("score");
        const quizSection = document.getElementById("quiz-section");
        const resultSection = document.getElementById("result-section");

        function loadQuestion() {
            questionElement.textContent = questions[currentQuestion].question;
            optionsElement.innerHTML = "";

            questions[currentQuestion].options.forEach(option => {
                const li = document.createElement("li");
                li.innerHTML = `<button class="btn btn-outline-primary" onclick="selectOption('${option}')">${option}</button>`;
                optionsElement.appendChild(li);
            });
        }

        function selectOption(answer) {
            if (answer === questions[currentQuestion].correct) {
                score++;
            }
            nextQuestion();
        }

        function nextQuestion() {
            currentQuestion++;
            if (currentQuestion < questions.length) {
                loadQuestion();
            } else {
                finishQuiz();
            }
        }

        function finishQuiz() {
            quizSection.classList.add("d-none");
            resultSection.classList.remove("d-none");
            scoreElement.textContent = score;

            // Kirim skor ke server
            fetch('simpan_skor.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ score: score })
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }

        loadQuestion();
    </script>
</body>
</html>
