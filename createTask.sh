#!/bin/bash

# Запрос API_TOKEN, title и text у пользователя
read -p "Введите ваш API Token: " API_TOKEN
read -p "Введите заголовок задачи (title): " TITLE
read -p "Введите описание задачи (text): " TEXT

# Укажите базовый URL API и эндпоинт для создания новой задачи
BASE_API_URL="http://127.0.0.1/api/v1"
TASKS_ENDPOINT="/tasks"

# Сформировать полный URL с параметрами
API_URL="$BASE_API_URL$TASKS_ENDPOINT?title=$TITLE&text=$TEXT"

# Выполнение curl-запроса для создания новой задачи с использованием API_TOKEN
echo "[$(date)] CREATE TASK"
curl -s -X POST \
    -H "Authorization: Bearer $API_TOKEN" \
    "$API_URL"
