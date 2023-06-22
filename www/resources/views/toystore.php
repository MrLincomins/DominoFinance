<?php
require_once 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Магазин игрушек</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            margin-top: 50px;
        }

        #game-container {
            margin-top: 50px;
        }

        #actions {
            margin-bottom: 20px;
        }

        #message-container {
            margin-bottom: 20px;
        }

        #catalog-container,
        #inventory-container {
            display: none;
        }

        #catalog-container h2,
        #inventory-container h2 {
            margin-bottom: 10px;
        }

        #toy-list,
        #inventory-list {
            list-style: none;
            padding: 0;
        }

        #toy-list li,
        #inventory-list li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<h1>Магазин игрушек</h1>

<div id="game-container">
    <div id="actions">
        <button id="buy-button">Купить игрушку</button>
        <button id="sell-button">Продать игрушку</button>
        <button id="inventory-button">Показать инвентарь</button>
        <button id="exit-button">Выйти из магазина</button>
    </div>

    <div id="message-container">
        <p id="message"></p>
    </div>

    <div id="catalog-container">
        <h2>Каталог игрушек</h2>
        <ul id="toy-list"></ul>
    </div>

    <div id="inventory-container">
        <h2>Инвентарь игрока</h2>
        <ul id="inventory-list"></ul>
    </div>
</div>

<script src="resources/js/toystore.js"></script>
</body>
</html>
<?php
require_once 'footer.php';
?>
