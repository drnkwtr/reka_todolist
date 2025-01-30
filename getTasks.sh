#!/bin/bash

read -p "Введите ваш API Token: " API_TOKEN
API_URL="http://127.0.0.1/api/v1/tasks"
curl -s -H "Authorization: Bearer $API_TOKEN" "$API_URL"
