<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Игра "Что стоит дороже?"</title>
    <style>
        .container {
            max-width: 800px;
        }

        .correct-answer {
            color: green;
        }

        .wrong-answer {
            color: red;
        }
    </style>
</head>

<body>
<div class="container mt-5">
    <h1 class="mb-4">Игра "Что стоит дороже?"</h1>
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title" id="question"></h5>
            <div id="options-container"></div>
            <p id="answer-message" class="mt-3"></p>
            <p id="score-message"></p>
            <button id="start-button" class="btn btn-primary">Начать игру</button>
        </div>
    </div>
</div>

<script>
    const items = {
        "Банан": 20,
        "Яблоко": 15,
        "Ручка": 30,
        "Книга": 150,
        "Телефон": 20000,
        "Планшет": 27000,
        "Ноутбук": 40000,
        "Компьютер": 100000,
    };

    let score = 0;
    let attemptsLeft = 15;
    let correctAnswer = "";

    function getTwoRandomItems() {
        let itemsList = Object.keys(items);
        let firstItem = itemsList[Math.floor(Math.random() * itemsList.length)];
        let secondItem = itemsList[Math.floor(Math.random() * itemsList.length)];
        while (secondItem === firstItem) {
            secondItem = itemsList[Math.floor(Math.random() * itemsList.length)];
        }
        return [firstItem, secondItem];
    }

    function updateScore() {
        document.getElementById("score-message").textContent = `Ваш счёт: ${score} | Попыток осталось: ${attemptsLeft}`;
    }

    function checkAnswer(selectedItem) {
        if (selectedItem === correctAnswer) {
            score++;
            document.getElementById("answer-message").style.color = "green";
            document.getElementById("answer-message").textContent = "Правильно!";
        } else {
            document.getElementById("answer-message").style.color = "red";
            document.getElementById("answer-message").textContent = `Неправильно. Правильный ответ: ${correctAnswer}`;
        }

        attemptsLeft--;
        updateScore();

        if (attemptsLeft === 0) {
            if (score < 10) {
                document.getElementById("question").textContent = "Игра окончена. Ваши попытки закончились.";
            } else {
                document.getElementById("question").textContent = "Игра окончена. Поздравляю, вы победили!";
            }
            document.getElementById("options-container").innerHTML = "";
            document.getElementById("start-button").style.display = "inline-block";
            document.getElementById("score-message").textContent = `Итоговый счет: ${score}`;
        } else {
            let [item1, item2] = getTwoRandomItems();
            document.getElementById("question").textContent = `Что стоит дороже? ${item1} или ${item2}`;

            let optionsContainer = document.getElementById("options-container");
            optionsContainer.innerHTML = "";

            let button1 = document.createElement("button");
            button1.className = "btn btn-primary mr-2";
            button1.textContent = item1;
            button1.addEventListener("click", function () {
                checkAnswer(item1);
            });
            optionsContainer.appendChild(button1);

            let button2 = document.createElement("button");
            button2.className = "btn btn-primary";
            button2.textContent = item2;
            button2.addEventListener("click", function () {
                checkAnswer(item2);
            });
            optionsContainer.appendChild(button2);

            correctAnswer = items[item1] > items[item2] ? item1 : item2;
        }
    }


    function startGame() {
        score = 0;
        attemptsLeft = 16;
        document.getElementById("start-button").style.display = "none";
        document.getElementById("score-message").textContent = "";
        checkAnswer(null);

    }

    document.getElementById("start-button").addEventListener("click", startGame);
</script>
</body>

</html>
<?php require_once 'footer.php'; ?>
