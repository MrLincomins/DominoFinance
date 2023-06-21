from PIL import Image, ImageDraw, ImageFont

image = Image.open("image.png")

draw = ImageDraw.Draw(image)

font = ImageFont.truetype("arial.ttf", size = 30)

name = "Матвеев Кирилл"


x = 150
y = 275

draw.text((x,y), name, font = font, fill = (0, 0, 0))

image.save("image_with_name.png")
