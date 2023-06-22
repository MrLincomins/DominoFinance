<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Финансовая грамотность для детей - Финансовый словарь</title>
    <style>
        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-input {
            margin-bottom: 10px;
        }
        .column-wrapper {
            display: flex;
        }
        .column {
            flex: 1;
        }
        .category-filter {
            cursor: pointer;
            font-weight: bold;
        }

        .jumbotron {
            background-position: left top, right top;
        }

    </style>
</head>

<body>
<div class="container">
    <div class="jumbotron text-center mt-4" style="background-image: url('resources/photo/test.jpg')">
    <h1 class="text-center display-4 mt-6">Финансовый словарь</h1>
    <input type="text" class="form-control search-input" id="searchInput" placeholder="Поиск термина...">
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="column-wrapper">
                <div class="column">
                    <ul class="list-group" id="financeList">
                        <li class="list-group-item" data-toggle="collapse" data-target="#term1">
                            <div>
                                <strong>Термин 1:</strong> Клиринг
                            </div>
                            <div>
                                <span class="badge badge-primary">Финансы</span>
                            </div>
                        </li>
                        <div id="term1" class="collapse">
                            <div class="card card-body">
                                Клиринг - это процесс проверки и подтверждения финансовых транзакций между участниками рынка. В ходе клиринга
                                происходит расчет и согласование обязательств сторон, а также обеспечение исполнения сделок.
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="column">
                    <ul class="list-group" id="macroList">
                        <li class="list-group-item" data-toggle="collapse" data-target="#term2">
                            <div>
                                <strong>Термин 2:</strong> Инфляция
                            </div>
                            <div>
                                <span class="badge badge-primary">Макроэкономика</span>
                            </div>
                        </li>
                        <div id="term2" class="collapse">
                            <div class="card card-body">
                                Инфляция - это устойчивое и продолжительное увеличение уровня цен на товары и услуги в экономике. Инфляция
                                снижает покупательную способность денег и может негативно сказываться на экономической стабильности.
                            </div>
                        </div>
                        <li class="list-group-item" data-toggle="collapse" data-target="#term5">
                            <div>
                                <strong>Термин 5:</strong> Государственный долг
                            </div>
                            <div>
                                <span class="badge badge-primary">Макроэкономика</span>
                            </div>
                        </li>
                        <div id="term5" class="collapse">
                            <div class="card card-body">
                                Государственный долг - это совокупная сумма денежных обязательств государства перед кредиторами. Государство
                                может занимать деньги для финансирования бюджетного дефицита или реализации экономических программ.
                            </div>
                        </div>
                    </ul>
                </div>
                <div class="column">
                    <ul class="list-group" id="instrumentList">
                        <li class="list-group-item" data-toggle="collapse" data-target="#term3">
                            <div>
                                <strong>Термин 3:</strong> Инвестиции
                            </div>
                            <div>
                                <span class="badge badge-primary">Финансовые инструменты</span>
                            </div>
                        </li>
                        <div id="term3" class="collapse">
                            <div class="card card-body">
                                Инвестиции - это вложение денежных или иных активов в определенные проекты, акции, недвижимость или другие
                                объекты с целью получения прибыли в будущем. Инвестиции позволяют увеличивать капитал и обеспечивать
                                финансовую стабильность.
                            </div>
                        </div>
                        <li class="list-group-item" data-toggle="collapse" data-target="#term4">
                            <div>
                                <strong>Термин 4:</strong> Кредит
                            </div>
                            <div>
                                <span class="badge badge-primary">Финансовые инструменты</span>
                            </div>
                        </li>
                        <div id="term4" class="collapse">
                            <div class="card card-body">
                                Кредит - это денежное обязательство, которое одно лицо (кредитор) предоставляет другому лицу (заемщику) с
                                условием возврата в дальнейшем с уплатой процентов или других платежей. Кредиты используются для
                                финансирования покупок или инвестиций.
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Функция для фильтрации терминов по введенному тексту в поле поиска
    function filterTerms() {
        var searchInput = document.getElementById('searchInput');
        var filter = searchInput.value.toLowerCase();

        var financeItems = document.querySelectorAll('#financeList .list-group-item');
        var macroItems = document.querySelectorAll('#macroList .list-group-item');
        var instrumentItems = document.querySelectorAll('#instrumentList .list-group-item');

        for (var i = 0; i < financeItems.length; i++) {
            var term = financeItems[i].querySelector('strong').textContent.toLowerCase();

            if (term.includes(filter)) {
                financeItems[i].style.display = '';
            } else {
                financeItems[i].style.display = 'none';
            }
        }

        for (var i = 0; i < macroItems.length; i++) {
            var term = macroItems[i].querySelector('strong').textContent.toLowerCase();

            if (term.includes(filter)) {
                macroItems[i].style.display = '';
            } else {
                macroItems[i].style.display = 'none';
            }
        }

        for (var i = 0; i < instrumentItems.length; i++) {
            var term = instrumentItems[i].querySelector('strong').textContent.toLowerCase();

            if (term.includes(filter)) {
                instrumentItems[i].style.display = '';
            } else {
                instrumentItems[i].style.display = 'none';
            }
        }
    }

    // Функция для сортировки терминов по микротемам
    function filterByCategory(category) {
        var financeItems = document.querySelectorAll('#financeList .list-group-item');
        var macroItems = document.querySelectorAll('#macroList .list-group-item');
        var instrumentItems = document.querySelectorAll('#instrumentList .list-group-item');

        for (var i = 0; i < financeItems.length; i++) {
            var term = financeItems[i].querySelector('span').textContent.toLowerCase();

            if (term === category.toLowerCase()) {
                financeItems[i].style.order = '0';
            } else {
                financeItems[i].style.order = '1';
            }
        }

        for (var i = 0; i < macroItems.length; i++) {
            var term = macroItems[i].querySelector('span').textContent.toLowerCase();

            if (term === category.toLowerCase()) {
                macroItems[i].style.order = '0';
            } else {
                macroItems[i].style.order = '1';
            }
        }

        for (var i = 0; i < instrumentItems.length; i++) {
            var term = instrumentItems[i].querySelector('span').textContent.toLowerCase();

            if (term === category.toLowerCase()) {
                instrumentItems[i].style.order = '0';
            } else {
                instrumentItems[i].style.order = '1';
            }
        }
    }

    // Обработчик события для вызова фильтрации при изменении содержимого поля поиска
    document.getElementById('searchInput').addEventListener('input', filterTerms);

    // Обработчики событий для вызова сортировки при клике на микротему
    document.getElementById('financeCategory').addEventListener('click', function () {
        filterByCategory('Финансы');
    });

    document.getElementById('macroCategory').addEventListener('click', function () {
        filterByCategory('Макроэкономика');
    });

    document.getElementById('instrumentCategory').addEventListener('click', function () {
        filterByCategory('Финансовые инструменты');
    });
</script>
</body>

</html>


<?php require_once 'footer.php'; ?>

