
let balance = 1000;
let stock_price = {"APPLE": 150, "GOOGLE": 200, "TESLA" : 250};
let inventory = {"APPLE": 0, "GOOGLE": 0, "TESLA": 0};

while (true) {
    console.log("Ваш баланс:", balance);
    console.log("Цены на акции:");
    // цикл для вывода цен на акции
    for (let stock in stock_price) {
        console.log(stock, '-', stock_price[stock]);
    }
    // выбор действия
    let choice = prompt("Вы хотите купить или продать акции? (напишите 'купить', 'продать' или 'достаточно')");
    if (choice === 'купить') {
        let stock = prompt("Акцию какой компании вы хотите купить?(APPLE, GOOGLE, TESLA)");
        if (stock in stock_price) {
            let price = stock_price[stock];
            let max_shares = Math.floor(balance / price);
            let shares = parseInt(prompt(Сколько акций ${stock} вы хотите купить?(Максимальное кол-во акций:${max_shares})));
            if (shares <= max_shares) {
                balance -= shares * price;
                inventory[stock] += shares;
                console.log(Ты купил ${shares} компании ${stock} по цене ${price} за акцию.);
            } else {
                console.log("У вас недостаточно средств для покупки такого количества акций.");
            }
        } else {
            console.log("Неправильный ввод, попробуйте ещё раз.");
        }
    } else if (choice === 'продать') {
        let stock = prompt("Какие акции ты хочешь продать? (Напиши 'APPLE', 'GOOGLE', или 'TESLA')");
        if (stock in stock_price) {
            let price = stock_price[stock];
            let shares = parseInt(prompt(Сколько акций компании ${stock} ты хочешь продать?));
            if (shares <= inventory[stock]) {
                balance += shares * price;
                inventory[stock] -= shares;
                console.log(Ты продал ${shares} акций компании ${stock} по цене ${price} за акцию.);
            } else {
                console.log("У тебя нет стольки акций для продажи.");
            }
        } else {
            console.log("Неверный ввод, попробуйте ещё раз.");
        }
    } else if (choice === "достаточно") {
        console.log("Спасибо за игру!");
        break;
    } else {
        console.log("Неверный ввод, попробуйте ещё раз.");
    }

    // цикл для обновления цен на акции
    for (let stock in stock_price) {
        let change = Math.random() * 2 - 1;
        price = stock_price[stock];
        price += Math.floor(price * change / 100);
        stock_price[stock] = price;
    }
}
