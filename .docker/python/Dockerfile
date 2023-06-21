FROM python:3

WORKDIR /var/www

COPY requirements.txt ./
RUN pip install --no-cache-dir -r requirements.txt

COPY main.py .

CMD [ "python", "main.py" ]
