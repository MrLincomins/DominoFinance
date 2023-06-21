class Toy {
    constructor(name, price) {
        this.name = name;
        this.price = price;
    }
}

class Player {
    constructor(name, currency) {
        this.name = name;
        this.currency = currency;
        this.inventory = [];
    }

    buyToy(toy) {
        if (this.currency >= toy.price) {
            this.inventory.push(toy);
            this.currency -= toy.price;
            console.log(${this.name} купил ${toy.name} за ${toy.price}.);
        } else {
            console.log("Insufficient funds.");
        }
    }

    sellToy(toy) {
        const index = this.inventory.indexOf(toy);
        if (index !== -1) {
            this.inventory.splice(index, 1);
            this.currency += toy.price;
            console.log(${this.name} продал ${toy.name} за ${toy.price}.);
        } else {
            console.log("Игрушка не найдена в инвентаре.");
        }
    }

    showInventory() {
        console.log(Инвентарь игрока ${this.name}:);
        for (const toy of this.inventory) {
            console.log(toy.name);
        }
    }
}

// Toy catalog
const toys = [
    new Toy("Мишка", 10),
    new Toy("Кукла", 15),
    new Toy("Игрушечная машинка", 20),
    new Toy("Кубики", 12),
    new Toy("Пазл", 8)
];

// Game setup
const player_name = prompt("Введи своё имя:");
const currency = parseInt(prompt("Начальное кол-во денег:"));
const player = new Player(player_name, currency);
console.log(Добро пожаловать в магазин игрушек, ${player.name}!);

// Game loop
while (true) {
    console.log("\n==== Действия ====");
    console.log("1. Купить игрушку");
    console.log("2. Продать игрушку");
    console.log("3. Показать инвентарь");
    console.log("4. Выйти из магазина");
    const choice = prompt("Введи число (1-4):");
    if (choice === "1") {
        console.log("\n==== Каталог игрушек ====");
        for (let i = 0; i < toys.length; i++) {
            console.log(${i + 1}. ${toys[i].name} - ${toys[i].price});
        }
        const toy_choice = parseInt(prompt("Введи число игрушки, которую хочешь купить:"));
        if (!isNaN(toy_choice) && toy_choice >= 1 && toy_choice <= toys.length) {
            const selected_toy = toys[toy_choice - 1];
            player.buyToy(selected_toy);
        } else {
            console.log("Неправильный ввод, повтори попытку.");
        }
    } else if (choice === "2") {
        player.showInventory();
        const toy_choice = prompt("Введи название игрушки, которую хочешь продать:");
        let found_toy = null;
        for (const toy of player.inventory) {
            if (toy.name.toLowerCase() === toy_choice.toLowerCase()) {
                found_toy = toy;
                break;
            }
        }
        if (found_toy) {
            player.sellToy(found_toy);
        } else {
            console.log("Игрушка не найдена, повтори попытку.");
        }
    } else if (choice === "3") {
        player.showInventory();
    } else if (choice === "4") {
        console.log("Спасибо, что играете в игру Магазин игрушек. Пока!");
        break;
    } else {
        console.log("Неправильный ввод, повторите попытку.");
    }
}
