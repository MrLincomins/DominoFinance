import random

items = {
    "Банан" : 20,
    "Яблоко" : 15,
    "Ручка" : 30,
    "Книга" : 150,
    "Телефон" : 20000,
    "Планшет" : 27000,
    "Ноутбук" : 40000,
    "Компьютер" : 100000
}

def get_two_random_items():
    items_list = list(items.keys())
    first_item = random.choice(items_list)
    second_item = random.choice(items_list)
    while second_item == first_item:
        second_item = random.choice(items_list)
    return first_item, second_item

def play():
    score = 0
    while True:
        item1, item2 = get_two_random_items()
        answer = input(f"Что стоит дороже? {item1} или {item2}")
        if items[item1] > items[item2]:
            correct_answer = item1
        else:
            correct_answer = item2
        if answer == correct_answer:
            print("Правильно!")
            score += 1
        else:
            print(f"Неправильно. Правильный ответ: {correct_answer}")
        print(f"Ваш счёт: {score}")
        if score == 10:
            print("Ты набрал 10 очков. Ты выиграл!")

play()