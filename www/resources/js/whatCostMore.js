const items = {
    "Банан": 20,
    "Яблоко": 15,
    "Ручка": 30,
    "Книга": 150,
    "Телефон": 20000,
    "Планшет": 27000,
    "Ноутбук": 40000,
    "Компьютер": 100000,
};

function getTwoRandomItems() {
    let itemsList = Object.keys(items);
    let firstItem = itemsList[Math.floor(Math.random() * itemsList.length)];
    let secondItem = itemsList[Math.floor(Math.random() * itemsList.length)];
    while (secondItem == firstItem) {
        secondItem = itemsList[Math.floor(Math.random() * itemsList.length)];
    }
    return [firstItem, secondItem];
}

function play() {
    let score = 0;
    while (true) {
        const [item1, item2] = getTwoRandomItems();
        let answer = prompt(Что стоит дороже? ${item1} или ${item2});
        if (items[item1] > items[item2]) {
            correctAnswer = item1;
        } else {
            correctAnswer = item2;
        }
        if (answer == correctAnswer) {
            console.log("Правильно!");
            score += 1;
        } else {
            console.log(Неправильно. Правильный ответ: ${correctAnswer});
        }
        console.log(Ваш счёт: ${score});
        if (score == 10) {
            console.log("Ты набрал 10 очков. Ты выиграл!");
            break;
        }
    }
}

play();
