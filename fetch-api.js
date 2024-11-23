async function getCalories() {
    try {
        const food = document.querySelector('#meal-input').value;
        const response = await fetch(`https://api.api-ninjas.com/v1/nutrition?query=${food}`,{
            headers: {
                'X-Api-Key': 'l7qln5xFED00F0m5gr03Qw==jqB9Ie0Ebv4V94SQ'
            }
        });
        const data = await response.json();
        console.log(data[0])
        const inputQuantity = document.querySelector('#quantity-input').value;
        const totalCalories = calculateInGm(data[0].serving_size_g, data[0].calories, inputQuantity);
        document.querySelector('#calorie-input').value = totalCalories;
        return data[0].calories;
    }
    catch(error) {
        console.error(error);
    }
}

function calculateInGm(quantity, calorie, inputQuantity) {
    const totalCalories = 1/quantity * calorie * inputQuantity;
    return totalCalories
}

document.querySelector('#meal-input').addEventListener('change', async (e) => {
    await getCalories();
});

document.querySelector('#quantity-input').addEventListener('change', async (e) => {
    await getCalories();
});





