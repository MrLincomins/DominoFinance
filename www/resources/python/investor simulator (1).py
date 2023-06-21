import random

balance = 1000
stock_price = {"APPLE": 150, "GOOGLE": 200, "TESLA" : 250}
inventory = {"APPLE": 0, "GOOGLE": 0, "TESLA": 0}

while True:
    print("Ваш баланс:", balance)
    print("Цены на акции:")
    # цикл для вывода цен на акции
    for stock, price in stock_price.items():
        print(stock, '-', price)
    # выбор действия
    choice = input("Вы хотите купить или продать акции? (напишите 'купить', 'продать' или 'достаточно')")
    if choice == 'купить':
        stock = input("Акцию какой компании вы хотите купить?(APPLE, GOOGLE, TESLA)")
        if stock in stock_price:
            price = stock_price[stock]
            max_shares = balance // price
            shares = int(input(f"Сколько акций {stock} вы хотите купить?(Максимальное кол-во акций:{max_shares})"))
            if shares <= max_shares:
                balance -= shares * price
                inventory[stock] += shares
                print(f"Ты купил {shares} компании {stock} по цене {price} за акцию.")
            else:
                print("У вас недостаточно средств для покупки такого количества акций.")
        else:
            print("Неправильный ввод, попробуйте ещё раз.")
    elif choice == 'продать':
        stock = input("Какие акции ты хочешь продать? (Напиши 'APPLE', 'GOOGLE', или 'TESLA') ")
        if stock in stock_price:
            price = stock_price[stock]
            shares = int(input(f"Сколько акций компании {stock} ты хочешь продать? "))
            if shares <= inventory[stock]:
                balance += shares * price
                inventory[stock] -= shares
                print(f"Ты продал {shares} акций компании {stock} по цене {price} за акцию.")
            else:
                print("У тебя нет стольки акций для продажи.")
        else:
            print("Неверный ввод, попробуйте ещё раз.")
    elif choice == "достаточно":
        print("Спасибо за игру!")
        break
    else:
        print("Неверный ввод, попробуйте ещё раз.")

    # цикл для обновления цен на акции
    for stock, price in stock_price.items():
        change = random.uniform(-1, 1)
        price += int(price * change / 100)
        stock_price[stock] = price