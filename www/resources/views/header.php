<?php use Illuminate\Support\Facades\Auth; ?>
<link rel="stylesheet" href="resources/css/boostrap.min.css">
<link rel="stylesheet" href="resources/css/project.css">

<body>
<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand display-8" href="#">Домино Финанс</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Главная</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/wiki">Финансовый словарь</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/games">Игры</a>
            </li>


            <?php if (Auth::check()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/account">Аккаунт</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/account/logout">Выход</a>
                </li>
            <?php endif; ?>
            <?php if (!Auth::check()): ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#registerModal">Регистрация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#loginModal">Вход</a>
            </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>

<div class="loading-overlay">
    <div class="loading-spinner"></div>
</div>
<!-- Модальное окно регистрации -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Регистрация</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registration">
                    <div class="form-group">
                        <label for="name">ФИО</label>
                        <input name="name" type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Сколько лет</label>
                        <input name="age" type="number" class="form-control" id="age" required>
                    </div>
                    <div class="form-group">
                        <label for="mail">Почта</label>
                        <input name="mail" type="email" class="form-control" id="mail" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Выбор уровня</label>
                        <select name="level" class="form-control" id="level" required>
                            <option value="дошкольник">Дошкольник</option>
                            <option value="школьник">Школьник</option>
                            <option value="студент">Студент</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Модальное окно входа -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Вход</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login">
                    <div class="form-group">
                        <label for="fullNameLogin">Почта</label>
                        <input name="mail" type="text" class="form-control" id="mail" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordLogin">Пароль</label>
                        <input name="password" type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<!-- Попап -->
<div id="popup-message" class="alert alert-dismissible fade show" role="alert">
    <span id="popup-message-text"></span>
</div>
