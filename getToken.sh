#!/bin/bash

API_URL="http://127.0.0.1/api/v1/login"
EMAIL="test@example.com"
PASSWORD="password"
curl -s -w "\nHTTP_CODE:%{http_code}\n" "$API_URL?email=$EMAIL&password=$PASSWORD"
