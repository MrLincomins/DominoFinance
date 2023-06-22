<?php require_once 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Бизнесменщик</title>
    <style>
        .popup-content {
            text-align: center;
        }
        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
        .modal-backdrop {
            background: none !important;
        }
    </style>
</head>
<body>
<div class="container jumbotron" >
    <h1>Бизнесменщик</h1>

    <div>
        <button class="btn btn-primary" id="createCompanyBtn" data-toggle="tooltip" data-placement="top" title="Создать компанию">Создать компанию</button>
        <button class="btn btn-danger" id="upgradeBtn" data-toggle="modal" data-target="#upgradePopup">Улучшить компанию</button>
        <button class="btn btn-danger" id="entertainmentBtn" data-toggle="modal" data-target="#entertainmentPopup">Развлечения</button>
        <button class="btn btn-success" id="buyCompanyBtn" data-toggle="tooltip" data-placement="top" title="Купить новую компанию">Купить новую компанию 50000$</button>
        <button class="btn btn-dark" id="exitBtn" data-toggle="tooltip" data-placement="top" title="Выход">Выход</button>
    </div>

    <div class="modal" id="upgradePopup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Выберите улучшение:</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-default" id="upgradeWorkersBtn">Улучшить работников <span id="upgradeWorkersPrice">$1000</span></button>
                    <button class="btn btn-default" id="upgradeManagementBtn">Улучшить менеджмент <span id="upgradeManagementPrice">$1500</span></button>
                    <button class="btn btn-default" id="upgradeProductBtn">Улучшить продукт <span id="upgradeProductPrice">$2000</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="entertainmentPopup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Выберите развлечение:</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Делает тебя <b>немного</b> счастливым" id="visitBtn">Сходить в гости <span id="visitPrice">$250</span></button>
                    <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Даёт <b>нормально</b> счастья" id="bathhouseBtn">Сходить к девочкам в баню <span id="bathhousePrice">$600</span></button>
                    <button class="btn btn-default" type="button" data-toggle="tooltip" data-placement="top" title="Даёт <b>много</b> счастья" id="snakeGameBtn">Поиграть в змейку <span id="snakeGamePrice">$1000</span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="purchasePopup">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Поздравляем!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    Вы успешно приобрели новую компанию!
                    Игра пройдена!!
                </div>
            </div>
        </div>
    </div>
    <div id="balance"></div>
    <div id="income"></div>
    <div id="happiness"></div>
    <div id="level"></div>
</div>
<script>

    let balance = 5000;
    let income = 0;
    let company_quality = 1;
    let workersLevel = 1;
    let managementLevel = 1;
    let productLevel = 1;
    let happiness = 450;
    let level = 0;

    document.getElementById('exitBtn').addEventListener('click', function () {
        alert('До свидания!');
        clearInterval(gameLoop);
        window.location.href = '/';
    });

    document.getElementById('createCompanyBtn').addEventListener('click', function () {
        createCompany();
    });

    document.getElementById('upgradeBtn').addEventListener('click', function () {
        document.getElementById('upgradePopup').style.display = 'block';
    });

    document.getElementById('upgradeWorkersBtn').addEventListener('click', function () {
        upgradeWorkers();
    });

    document.getElementById('upgradeManagementBtn').addEventListener('click', function () {
        upgradeManagement();
    });

    document.getElementById('upgradeProductBtn').addEventListener('click', function () {
        upgradeProduct();
    });

    document.getElementById('entertainmentBtn').addEventListener('click', function () {
        document.getElementById('entertainmentPopup').style.display = 'block';
    });

    document.getElementById('bathhouseBtn').addEventListener('click', function () {
        goBathhouse();
    });

    document.getElementById('visitBtn').addEventListener('click', function () {
        goVisit();
    });

    document.getElementById('snakeGameBtn').addEventListener('click', function () {
        playSnakeGame();
    });

    document.getElementById('buyCompanyBtn').addEventListener('click', function () {
        buyCompany();
    });


    function updateDisplay() {
        let word;
        if (500 < happiness && happiness < 800) {
            word = ' хорошее';
        }
        if (800 < happiness) {
            word = ' отличное';
        }
        if (200 < happiness && happiness < 500) {
            word = ' нормальное';
        }
        if (0 < happiness && happiness < 200) {
            word = ' ужасное';
        }
        document.getElementById('balance').textContent = 'Баланс: $' + balance;
        document.getElementById('income').textContent = 'Ежемесячный доход: $' + income;
        document.getElementById('happiness').innerHTML = 'Настроение: <b>' + word + '</b> ' + happiness;
        document.getElementById('level').textContent = 'Уровень компании: ' + level;
        document.getElementById('visitPrice').textContent = '$1000';
        document.getElementById('bathhousePrice').textContent = '$2000';
        document.getElementById('snakeGamePrice').textContent = '$4000';
    }


    function createCompany() {
        alert('Компания успешно создана!');
        balance = 5000;
        income = 30;
        company_quality = 1;
        workersLevel = 1;
        managementLevel = 1;
        productLevel = 1;
        happiness -= Math.floor(Math.random() * 10) + 1;  // Уменьшаем настроение
        level = 0;
        updateDisplay();
    }



    function upgradeWorkers() {
        if (balance >= 1000 && workersLevel < 5) {
            balance -= 1000;
            income += 20;
            workersLevel++;
            company_quality *= 1.2;
            updateDisplay();
            document.getElementById('upgradePopup').style.display = 'none';
            alert('Работники улучшены! Уровень дохода увеличен на 20.');
        } else {
            alert('Недостаточно средств или достигнут максимальный уровень улучшения работников!');
        }
    }

        function upgradeManagement() {
            if (balance >= 1500 && managementLevel < 5) {
                balance -= 1500;
                income += 30;
                managementLevel++;
                company_quality *= 1.3;
                updateDisplay();
                document.getElementById('upgradePopup').style.display = 'none';
                alert('Менеджмент улучшен! Уровень дохода увеличен на 20.');
            } else {
                alert('Недостаточно средств или достигнут максимальный уровень улучшения менеджмента!');
            }
        }

        function upgradeProduct() {
            if (balance >= 2000 && productLevel < 5) {
                balance -= 2000;
                income += 40;
                productLevel++;
                company_quality *= 1.4;
                updateDisplay();
                document.getElementById('upgradePopup').style.display = 'none';
                alert('Продукт улучшен! Уровень дохода увеличен на 20.');
            } else {
                alert('Недостаточно средств или достигнут максимальный уровень улучшения продукта!');
            }
        }

    function goBathhouse() {
        if (balance >= 2000) {
            balance -= 2000;
            happiness += 400;
            updateDisplay();
            document.getElementById('entertainmentPopup').style.display = 'none';
        } else {
            alert('Недостаточно средств для посещения бани!');
        }
    }

    function goVisit() {
        if (balance >= 1000) {
            balance -= 1000;
            happiness += 200;
            updateDisplay();
            document.getElementById('entertainmentPopup').style.display = 'none';
        } else {
            alert('Недостаточно средств для посещения!');
        }
    }

    function playSnakeGame() {
        if (balance >= 4000) {
            balance -= 4000;
            happiness += 600;
            updateDisplay();
            document.getElementById('entertainmentPopup').style.display = 'none';
        } else {
            alert('Недостаточно средств для игры в змейку!');
        }
    }

        function buyCompany() {
            if (balance >= 50000) {
                balance -= 50000;
                income += 100;
                level++;
                updateDisplay();
                alert('Новая компания куплена!');
                document.getElementById('purchasePopup').style.display = 'block';
                sendPoints(100);
                setTimeout(function() {
                    document.getElementById('purchasePopup').style.display = 'none';
                }, 8000);  // Окно исчезнет через 2 секунды
            }
        }

        let gameLoop = setInterval(function () {
            balance += income;
            happiness -= Math.floor(Math.random() * 10) + 1;
            updateDisplay();
            if (balance < 0 || happiness < 0) {
                clearInterval(gameLoop);
                alert('Игра окончена!');
            }
        }, 1000);
    document.querySelectorAll('[data-dismiss="modal"]').forEach(function (element) {
        element.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
        });
    });
    document.querySelector('.loading-overlay').style.display = 'none';
    function removeModalOpenClass() {
        document.body.classList.remove('modal-open');
    }


    function hideModal() {
        document.querySelectorAll('.modal-backdrop').forEach(function (element) {
            element.classList.remove('show');
        });
        removeModalOpenClass();
    }


    document.querySelectorAll('[data-dismiss="modal"]').forEach(function (element) {
        element.addEventListener('click', function () {
            this.closest('.modal').style.display = 'none';
            hideModal();
        });
    });

</script>
<script src="resources/js/points.js"></script>
</body>
</html>
<?php require_once 'footer.php'; ?>
