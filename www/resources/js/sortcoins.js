/**
 * Shuffles an array in place using the Fisher-Yates algorithm
 *
 * @param {Array} array - the array to shuffle
 */
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

// create an array of coins
const coins = ["1 коп.", "2 коп.", "5 коп.", "10 коп.", "20 коп.", "50 коп.", "1 руб.", "2 руб.", "5 руб.", "10 руб."];

// shuffle the coins
shuffleArray(coins);

// create an object to store the sorted coins
const categories = {
    "1 коп.": [],
    "2 коп.": [],
    "5 коп.": [],
    "10 коп.": [],
    "20 коп.": [],
    "50 коп.": [],
    "1 руб.": [],
    "2 руб.": [],
    "5 руб.": [],
    "10 руб.": []
};

// print the coins to be sorted
console.log("Отсортируйте монеты по категориям:");
console.log(coins);

// create a counter for correct answers
let countOfCorrectAnswers = 0;

// sort the coins
while (coins.length > 0) {
    // take a coin from the array
    const coin = coins.pop();
    // ask the user which category to put the coin in
    const category = prompt(В какую категорию поместить монету ${coin}?);
    if (category in categories) {
        countOfCorrectAnswers++; // increase the counter for correct answers
        categories[category].push(coin); // sort the coin into the chosen category
    } else {
        console.log("Такой категории не существует!!"); // inform the user that they chose a non-existent category
    }
}

// print the sorted coins
console.log("Результат сортировки:");
for (const [category, coins] of Object.entries(categories)) {
    console.log(${category}: ${coins});
}

// check if all coins were sorted correctly
if (countOfCorrectAnswers === coins.length) {
    console.log("Всё правильно! Вы отсортировали все монеты!");
} else {
    console.log("Вы сделали неправильно. Попробуйте ещё раз.");
}
