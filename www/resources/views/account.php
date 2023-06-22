<?php require_once 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Финансовая грамотность для детей - Аккаунт</title>
</head>

<body>
<div class="container">
    <h1 class="text-center mt-5">Аккаунт</h1>
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Данные пользователя</h5>
                    <p><strong>ФИО:</strong> <?php echo($_COOKIE['name']); ?></p>
                    <p><strong>Возраст:</strong> <?php echo($_COOKIE['age']); ?></p>
                    <p><strong>Почта:</strong> <?php echo($_COOKIE['mail']); ?></p>
                    <p><strong>Монетки:</strong><?php echo($_COOKIE['points']); ?></p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#changeDataModal">Изменить контактные данные</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно изменения контактных данных -->
<div class="modal fade" id="changeDataModal" tabindex="-1" role="dialog" aria-labelledby="changeDataModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changeDataModalLabel">Изменить контактные данные</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="contact">
                    <div class="form-group">
                        <label for="fullName">ФИО</label>
                        <input type="text" class="form-control" id="fullName" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Возраст</label>
                        <input type="number" class="form-control" id="age" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Почта</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<?php
require_once 'footer.php'; ?>

