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
            showMessage(`${this.name} купил ${toy.name} за ${toy.price}.`, 'success');
        } else {
            showMessage("Недостаточно средств.", 'error');
        }
    }

    sellToy(toy) {
        const index = this.inventory.indexOf(toy);
        if (index !== -1) {
            this.inventory.splice(index, 1);
            this.currency += toy.price;
            showMessage(`${this.name} продал ${toy.name} за ${toy.price}.`, 'success');
        } else {
            showMessage("Игрушка не найдена в инвентаре.", 'error');
        }
    }

    showInventory() {
        showMessage(`Инвентарь игрока ${this.name}:<br>${this.inventory.map(toy => toy.name).join('<br>')}`, 'info');
    }
}

const toys = [
    new Toy("Мишка", 10),
    new Toy("Кукла", 15),
    new Toy("Игрушечная машинка", 20),
    new Toy("Кубики", 12),
    new Toy("Пазл", 8)
];

const player_name = prompt("Введите свое имя:");
const currency = parseInt(prompt("Начальное количество денег:"));
const player = new Player(player_name, currency);
showMessage(`Добро пожаловать в магазин игрушек, ${player.name}!`, 'info');

const buyButton = document.getElementById('buy-button');
const sellButton = document.getElementById('sell-button');
const inventoryButton = document.getElementById('inventory-button');
const exitButton = document.getElementById('exit-button');
const toyList = document.getElementById('toy-list');
const inventoryList = document.getElementById('inventory-list');
const messageContainer = document.getElementById('message-container');
const messageText = document.getElementById('message');

buyButton.addEventListener('click', showCatalog);
sellButton.addEventListener('click', showInventory);
inventoryButton.addEventListener('click', showInventory);
exitButton.addEventListener('click', exitGame);

function showCatalog() {
    hideElement(inventoryContainer);
    showElement(catalogContainer);
    clearElement(toyList);

    for (let i = 0; i < toys.length; i++) {
        const toy = toys[i];
        const listItem = document.createElement('li');
        listItem.innerText = `${i + 1}. ${toy.name} - ${toy.price}`;
        toyList.appendChild(listItem);
    }
}

function showInventory() {
    hideElement(catalogContainer);
    showElement(inventoryContainer);
    clearElement(inventoryList);

    for (const toy of player.inventory) {
        const listItem = document.createElement('li');
        listItem.innerText = toy.name;
        inventoryList.appendChild(listItem);
    }
}

function exitGame() {
    showMessage(`Спасибо, что играли в игру "Магазин игрушек". Пока!`, 'info');
    hideElement(gameContainer);
}

function showMessage(text, type) {
    messageText.innerHTML = text;
    messageContainer.className = `message ${type}`;
    showElement(messageContainer);
}

function showElement(element) {
    element.style.display = 'block';
}

function hideElement(element) {
    element.style.display = 'none';
}

function clearElement(element) {
    element.innerHTML = '';
}
