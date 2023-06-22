function sendPoints(points) {

    fetch('/games/points', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ points: points})
    })
        .then(response => {
            // Обработка ответа от сервера
            if (response.ok) {
                // Поинты успешно отправлены
                console.log('Points sent successfully');
            } else {
                // Произошла ошибка
                console.log('Failed to send points');
            }
        })
        .catch(error => {
            // Обработка ошибок
            console.error('Error:', error);
        });
}
