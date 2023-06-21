class Toy:
    def __init__(self, name, price):
        self.name = name
        self.price = price
class Player:
    def __init__(self, name, currency):
        self.name = name
        self.currency = currency
        self.inventory = []
    def buy_toy(self, toy):
        if self.currency >= toy.price:
            self.inventory.append(toy)
            self.currency -= toy.price
            print(f"{self.name} купил {toy.name} за {toy.price}.")
        else:
            print("Insufficient funds.")
    def sell_toy(self, toy):
        if toy in self.inventory:
            self.inventory.remove(toy)
            self.currency += toy.price
            print(f"{self.name} продал {toy.name} за {toy.price}.")
        else:
            print("Игрушка не найдена в инвентаре.")
    def show_inventory(self):
        print(f"Инвентарь игрока {self.name}:")
        for toy in self.inventory:
            print(toy.name)
# Toy catalog
toys = [
    Toy("Мишка", 10),
    Toy("Кукла", 15),
    Toy("Игрушечная машинка", 20),
    Toy("Кубики", 12),
    Toy("Пазл", 8)
]
# Game setup
player_name = input("Введи своё имя: ")
currency = int(input("Начальное кол-во денег: "))
player = Player(player_name, currency)
print(f"Добро пожаловать в магазин игрушек, {player.name}!")
# Game loop
while True:
    print("\n==== Действия ====")
    print("1. Купить игрушку")
    print("2. Продать игрушку")
    print("3. Показать инвентарь")
    print("4. Выйти из магазина")
    choice = input("Введи число (1-4): ")
    if choice == "1":
        print("\n==== Каталог игрушек ====")
        for i, toy in enumerate(toys):
            print(f"{i + 1}. {toy.name} - {toy.price}")
        toy_choice = input("Введи число игрушки, которую хочешь купить: ")
        if toy_choice.isdigit() and int(toy_choice) in range(1, len(toys) + 1):
            toy_index = int(toy_choice) - 1
            selected_toy = toys[toy_index]
            player.buy_toy(selected_toy)
        else:
            print("Неправильный ввод, повтори попытку.")
    elif choice == "2":
        player.show_inventory()
        toy_choice = input("Введи название игрушки, которую хочешь продать: ")
        found_toy = None
        for toy in player.inventory:
            if toy.name.lower() == toy_choice.lower():
                found_toy = toy
                break
        if found_toy:
            player.sell_toy(found_toy)
        else:
            print("Игрушка не найдена, повтори попытку.")
    elif choice == "3":
        player.show_inventory()
    elif choice == "4":
        print("Спасибо, что играете в игру Магазин игрушек. Пока!")
        break
    else:
        print("Неправильный ввод, повторите попытку.")