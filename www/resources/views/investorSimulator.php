<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Market Game</title>
</head>

<body>
<div class="container mt-5">
    <h1 class="mb-4">Игра фондовый рынок</h1>
    <div id="game-interface">
        <p id="balance-info"></p>
        <h3>Цены на акции:</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Компания</th>
                <th>Цена</th>
            </tr>
            </thead>
            <tbody id="stock-prices"></tbody>
        </table>
        <h3>Действия:</h3>
        <div class="form-group">
            <label for="action-select">Выбери действие:</label>
            <select class="form-control" id="action-select">
                <option value="buy">Купить</option>
                <option value="sell">Продать</option>
                <option value="enough">Достаточно</option>
            </select>
        </div>
        <div class="form-group">
            <label for="company-select">Выберете компанию:</label>
            <select class="form-control" id="company-select">
                <option value="APPLE">Apple</option>
                <option value="GOOGLE">Google</option>
                <option value="TESLA">Tesla</option>
            </select>
        </div>
        <div class="form-group">
            <label for="shares-input">Введите кол-во акций:</label>
            <input type="number" class="form-control" id="shares-input" placeholder="Акции">
        </div>
        <button id="submit-button" class="btn btn-primary">Принять</button>
    </div>
</div>

<script>
    let balance = 1000;
    let stock_price = { "APPLE": 150, "GOOGLE": 200, "TESLA": 250 };
    let inventory = { "APPLE": 0, "GOOGLE": 0, "TESLA": 0 };

    function updateBalanceInfo() {
        document.getElementById("balance-info").textContent = "Твой баланс: $" + balance;
        let totalShares = 0;
        for (let stock in inventory) {
            totalShares += inventory[stock];
        }
        document.getElementById("balance-info").textContent += " У тебя " + totalShares + " акций.";
    }
    function updateStockPrices() {
        let stockPricesTable = document.getElementById("stock-prices");
        stockPricesTable.innerHTML = "";
        for (let stock in stock_price) {
            let row = stockPricesTable.insertRow();
            let companyCell = row.insertCell(0);
            let priceCell = row.insertCell(1);
            let quantityCell = row.insertCell(2);
            companyCell.textContent = stock;
            priceCell.textContent = stock_price[stock];
            quantityCell.textContent = inventory[stock];
        }

        // Отобразить новые цены акций
        let tableRows = stockPricesTable.getElementsByTagName("tr");
        for (let i = 1; i < tableRows.length; i++) {
            let priceCell = tableRows[i].getElementsByTagName("td")[1];
            let stock = tableRows[i].getElementsByTagName("td")[0].textContent;
            priceCell.textContent = stock_price[stock];
        }
    }

    function buyStock() {
        let selectedCompany = document.getElementById("company-select").value;
        let selectedShares = parseInt(document.getElementById("shares-input").value);

        if (isNaN(selectedShares) || selectedShares <= 0) {
            alert("Пожалуйста введите допустимое кол-во акций.");
            return;
        }

        let price = stock_price[selectedCompany];
        let maxShares = Math.floor(balance / price);

        if (selectedShares <= maxShares) {
            balance -= selectedShares * price;
            inventory[selectedCompany] += selectedShares;
            alert("Вы купили " + selectedShares + " акций компании " + selectedCompany + " по цене $" + price + " за акцию.");
        } else {
            alert("У вас недостаточно средств для покупки такого количества акций.");
        }

        updateBalanceInfo();

        // Проверить, достигнута ли победа
        if (balance >= 15000) {
            alert("Поздравляем! Вы победили в игре фондовый рынок!");
            document.getElementById("game-interface").style.display = "none";
        }
    }

    function sellStock() {
        let selectedCompany = document.getElementById("company-select").value;
        let selectedShares = parseInt(document.getElementById("shares-input").value);

        if (isNaN(selectedShares) || selectedShares <= 0) {
            alert("Пожалуйста, введите корректное количество акций.");
            return;
        }

        if (selectedShares <= inventory[selectedCompany]) {
            let price = stock_price[selectedCompany];
            balance += selectedShares * price;
            inventory[selectedCompany] -= selectedShares;
            alert("Вы продали " + selectedShares + " акций компании " + selectedCompany + " по цене $" + price + " за акцию.");
        } else {
            alert("У вас недостаточно акций для продажи.");
        }

        updateBalanceInfo();

        // Проверить, достигнута ли победа
        if (balance >= 10000) {
            alert("Поздравляем! Вы победили в игре фондовый рынок!");
            document.getElementById("game-interface").style.display = "none";
        }
    }

    function updateUI() {
        updateBalanceInfo();
        updateStockQuantities();
    }

    function updateStockQuantities() {
        let stockPricesTable = document.getElementById("stock-prices");
        let tableRows = stockPricesTable.getElementsByTagName("tr");
        for (let i = 1; i < tableRows.length; i++) {
            let quantityCell = tableRows[i].getElementsByTagName("td")[2];
            let stock = tableRows[i].getElementsByTagName("td")[0].textContent;
            quantityCell.textContent = inventory[stock];
        }
    }

    function simulateStockChanges() {
        for (let stock in stock_price) {
            let change = Math.random() < 0.55 ? Math.random() * 6 + 1 : Math.random() * -6 - 1;
            let price = stock_price[stock];
            price += Math.floor(price * change / 100);
            stock_price[stock] = price;
        }
    }



    function submitAction() {
        let selectedAction = document.getElementById("action-select").value;

        if (selectedAction === "buy") {
            buyStock();
        } else if (selectedAction === "sell") {
            sellStock();
        } else if (selectedAction === "enough") {
            enoughAction();
        }
    }

    function enoughAction() {
        alert("Спасибо за игру!");
        document.getElementById("game-interface").style.display = "none";
    }

    function startGame() {
        updateStockPrices();
        updateUI();

        document.getElementById("submit-button").addEventListener("click", submitAction);

        setInterval(() => {
            simulateStockChanges();
            updateStockPrices();
            updateUI();
        }, 3000);
    }

    startGame();

</script>
</body>

</html>
<?php require_once 'footer.php'; ?>
