<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Игра по финансовой грамотности</title>
</head>
<body>
<div class="container mt-5">
    <h1>Финансовая грамотность</h1>
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="card-title" id="question"></h5>
            <div id="options-container"></div>
            <p id="answer-message" class="mt-3"></p>
            <button id="start-button" class="btn btn-primary">Начать игру</button>
            <button id="show-answers-button" class="btn btn-secondary" style="display: none;">Показать ответы</button>
            <p id="answer-summary" class="mt-3"></p>
        </div>
    </div>
</div>
</html>

<script src="resources/js/points.js"></script>
<script>
    let puzzles = [
        {
            question: "Сколько надо отложить каждый месяц, чтобы за год накопить 12,000 рублей?",
            options: ["500 рублей", "750 рублей", "1,000 рублей"],
            answer: "1,000 рублей",
            hint: "12,000 рублей / 12 месяцев = 1,000 рублей"
        },
        {
            question: "Что такое кредитная история и как она влияет на заем?",
            options: ["Кредитная история - это список ваших доходов и расходов, который показывает банкам, на что вы тратите свои деньги", "Кредитная история - это список всех денег, которые вы должны организациям и компаниям", "Кредитная история - это запись о том, как вы ранее платили по кредитам"],
            answer: "Кредитная история - это запись о том, как вы ранее платили по кредитам",
            hint: "Кредитная история обычно хранится в банках и отражает вашу кредитную историю - сколько вы взяли в кредит, сколько платили и насколько своевременно."
        },
        {
            question: "На что следует обращать внимание при выборе кредитной карты?",
            options: ["Процентная ставка, льготный период, наградные баллы", "Только процентная ставка", "Только льготный период"],
            answer: "Процентная ставка, льготный период, наградные баллы",
            hint: "Кредитная карта - это инструмент, который может быть очень полезным, но также может налагать некоторые дополнительные расходы. Выбирая карту, убедитесь, что вы обращаете внимание на такие факторы, как процентная ставка, льготный период, возможность получения наградных баллов или возврата денег и дополнительные услуги."
        },
        {
            question: "Что такое процентная ставка?",
            options: ["Количество денег, которое вы зарабатываете в год", "Дополнительные деньги, которые вы получаете при инвестировании", "Процент от суммы, которую вы должны вернуть, когда берете в долг"],
            answer: "Процент от суммы, которую вы должны вернуть, когда берете в долг",
            hint: "Процентная ставка - это процент от суммы, которую вы занимаете и должны вернуть с процентами"
        },
        {
            question: "Что такое бюджет?",
            options: ["Список того, что вы хотите купить", "Полный список ваших денежных средств", "Список того, что вы должны кому-то заплатить"],
            answer: "Полный список ваших денежных средств",
            hint: "Бюджет - это список ваших доходов и расходов, который помогает планировать, на что вы тратите свои деньги"
        },
        {
            question: "Какой процент налога с продаж берется в вашем штате?",
            options: ["5%", "7%", "10%"],
            answer: "7%",
            hint: "Посмотрите налоговую ставку в вашем местном правительстве или в Интернете"
        },
        {
            question: "Что такое акции?",
            options: ["Банкноты, которые выдаются при вкладе в банку", "Часть собственности компании", "Деньги, которые вы зарабатываете, инвестируя в бизнес"],
            answer: "Часть собственности компании",
            hint: "Акции - это доли в собственности компаний, которые торгуются на биржах. Купив акцию, вы приобретаете долю в компании."
        }
    ];

    let used_puzzles = [];
    let correct_answers = 0;

    function select_puzzle() {
        let available_puzzles = puzzles.filter(x => !used_puzzles.includes(x));
        if (available_puzzles.length === 0) {
            used_puzzles = [];
            available_puzzles = puzzles;
            correct_answers = 0;
        }
        let puzzle = available_puzzles[Math.floor(Math.random() * available_puzzles.length)];
        used_puzzles.push(puzzle);
        return puzzle;
    }

    function check_answer(selected_option) {
        let current_puzzle = used_puzzles[used_puzzles.length - 1];
        if (selected_option === current_puzzle.answer) {
            correct_answers++;
            document.getElementById("answer-message").classList.remove("text-danger");
            document.getElementById("answer-message").classList.add("text-success");
            document.getElementById("answer-message").innerHTML = "Верно!";
        } else {
            document.getElementById("answer-message").classList.remove("text-success");
            document.getElementById("answer-message").classList.add("text-danger");
            document.getElementById("answer-message").innerHTML = "Неправильно!";
        }

        if (used_puzzles.length === puzzles.length) {
            document.getElementById("answer-summary").innerHTML = "Игра окончена! Количество правильных ответов: " + correct_answers + "/" + puzzles.length;
            document.getElementById("options-container").style.display = "none";
            document.getElementById("show-answers-button").style.display = "inline-block";
        } else {
            setTimeout(show_next_puzzle, 2000);
        }
    }
    function show_next_puzzle() {
        let puzzle = select_puzzle();
        document.getElementById("question").innerHTML = puzzle.question;
        let optionsContainer = document.getElementById("options-container");
        optionsContainer.innerHTML = "";

        for (let i = 0; i < puzzle.options.length; i++) {
            let option = puzzle.options[i];
            let button = document.createElement("button");
            button.className = "btn btn-primary mr-2";
            button.textContent = option;
            button.addEventListener("click", function () {
                check_answer(option);
            });
            optionsContainer.appendChild(button);
        }

        document.getElementById("answer-message").innerHTML = "";
    }

    function start_game() {
        document.getElementById("start-button").style.display = "none";
        show_next_puzzle();
    }

    function show_answers() {
        let answerSummary = document.getElementById("answer-summary")
        answerSummary.innerHTML = "Правильные ответы:<br>";
        for (let i = 0; i < puzzles.length; i++) {
            let puzzle = puzzles[i];
            answerSummary.innerHTML += "<strong>" + puzzle.question + "</strong>: " + puzzle.answer + "<br>";
        }
    }

    document.getElementById("start-button").addEventListener("click", start_game);
    document.getElementById("show-answers-button").addEventListener("click", show_answers);
</script>
<?php require_once 'footer.php'; ?>

