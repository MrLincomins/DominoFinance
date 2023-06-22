document.querySelector('.loading-overlay').style.display = 'none';
document.getElementById('popup-message').style.display = 'none';

function handleSubmitForm(formId, url, successMessage, errorMessage) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        document.querySelector('.loading-overlay').style.display = 'flex';

        const formData = new FormData(form);
        const jsonData = JSON.stringify(Object.fromEntries(formData));

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: jsonData
        })
            .then(response => response.json())
            .then(data => {
                document.querySelector('.loading-overlay').style.display = 'none';
                if (data === 1 || data === true) {
                    sessionStorage.setItem('popupMessage', successMessage);
                    location.reload();
                } else {
                    showPopupMessage(errorMessage, 'danger');
                }
            })
            .catch(error => console.error(error));
    });
}

handleSubmitForm('registration', '/account/registration', 'Вы успешно зарегистрировались!', 'В регистрации произошла ошибка, возможно пользователь на данную почту уже зарегистрирован.');

handleSubmitForm('login', '/account/login', 'Вы успешно вошли!', 'Ошибка, неверный пароль или почта');

handleSubmitForm('contact', '/account/contact', 'Вы успешно изменили данные!', 'В изменении данных произошла ошибка, возможно email уже зарегистрирован.');

window.onload = function() {
    const popupMessage = sessionStorage.getItem('popupMessage');
    if (popupMessage) {
        showPopupMessage(popupMessage, 'success');
        sessionStorage.removeItem('popupMessage');
    }
};

function showPopupMessage(message, type) {
    const popupMessage = document.getElementById('popup-message');
    const popupMessageText = document.getElementById('popup-message-text');

    // Установка текста сообщения
    popupMessageText.textContent = message;

    // Установка класса Bootstrap для типа сообщения
    popupMessage.classList.add(`alert-${type}`);

    // Отображение всплывающего сообщения
    popupMessage.style.display = 'block';

    // Закрытие всплывающего сообщения через 3 секунды
    setTimeout(function () {
        hidePopupMessage();
    }, 10000);
}

// Функция скрытия всплывающего сообщения
function hidePopupMessage() {
    const popupMessage = document.getElementById('popup-message');

    // Скрытие всплывающего сообщения
    popupMessage.style.display = 'none';

    // Очистка текста сообщения
    popupMessageText.textContent = '';

    // Удаление классов Bootstrap для типа сообщения
    popupMessage.classList.remove('alert-success', 'alert-danger');
}





