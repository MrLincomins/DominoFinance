<?php require_once 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Магазин стилей CSS</title>

    <style>
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Магазин стилей CSS</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="resources/photo/bob.jfif" class="card-img-top" alt="Губка Боб">
                <div class="card-body">
                    <h5 class="card-title">Губка Боб</h5>
                    <p class="card-text">Описание стиля CSS</p>
                    <a class="btn btn-primary" onclick="buyStyle()">Купить за игровую валюту</a>
                </div>
            </div>
        </div>
        <!-- Добавьте здесь другие карточки с другими стилями CSS -->
    </div>
</div>

<script>
    function buyStyle() {
        const data = {
            points: 100
        };

        fetch('http://localhost/buy', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(result => {
                // Обработка успешного ответа от сервера
                console.log(result);
            })
            .catch(error => {
                // Обработка ошибки
                console.error(error);
            });
    }
</script>

</body>
</html>
<?php require_once 'footer.php'; ?>
