import requests
import base64
import json

# Открытие изображения
with open('image.jpg', 'rb') as image_file:
    encoded_image = base64.b64encode(image_file.read()).decode('utf-8')

# Создание JSON-объекта с изображением
data = {
    'image': encoded_image
}

# Преобразование JSON в строку
json_data = json.dumps(data)

# Отправка POST-запроса с JSON-объектом
url = 'https://example.com/api/endpoint'
headers = {'Content-Type': 'application/json'}
response = requests.post(url, data=json_data, headers=headers)

# Обработка ответа
if response.status_code == 200:
    print('Изображение успешно отправлено')
else:
    print('Произошла ошибка при отправке изображения')




