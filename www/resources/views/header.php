<link rel="stylesheet" href="resources/css/boostrap.min.css">
<body>
<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Финансовая грамотность</a>
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
            <li class="nav-item">
                <a class="nav-link" href="/account">Аккаунт</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#registerModal">Регистрация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#loginModal">Вход</a>
            </li>
        </ul>
    </div>
</nav>


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
<script>
    const form = document.getElementById('registration');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(form);
        const name = formData.get('name');
        const mail = formData.get('mail');
        const password = formData.get('password');
        const age = formData.get('age');
        const level = formData.get('level');
        const jsonData = JSON.stringify({'name' : name, 'mail' : mail, 'age' : age, 'level' : level, 'password' : password});

        fetch('/account/registration', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonData
        })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error(error));
    });

    const formLogin = document.getElementById('login');
    formLogin.addEventListener('submit', (event) => {
        event.preventDefault();
        const formData = new FormData(formLogin);
        const mail = formData.get('mail');
        const password = formData.get('password');
        const jsonDatal = JSON.stringify({'mail' : mail,  'password' : password});

        fetch('/account/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonDatal
        })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error(error));
    });
</script>
</body>
