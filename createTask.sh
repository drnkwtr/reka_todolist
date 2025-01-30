#!/bin/bash

read -p "Введите ваш API Token: " API_TOKEN
read -p "Введите заголовок задачи (title): " TITLE
read -p "Введите описание задачи (text): " TEXT
BASE_API_URL="http://127.0.0.1/api/v1"
TASKS_ENDPOINT="/tasks"
API_URL="$BASE_API_URL$TASKS_ENDPOINT?title=$TITLE&text=$TEXT"
curl -s -X POST \
    -H "Authorization: Bearer $API_TOKEN" \
    "$API_URL"
