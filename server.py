import http.server
import socketserver
import sys

#по умолч
default_port = 8888

# Если передан арг командной
if len(sys.argv) > 1:
    try:
        port = int(sys.argv[1])
    except ValueError:
        print("Неверный порт. Используется порт по умолчанию:", default_port)
        port = default_port
else:
    port = default_port

# Указываем имя файла
index_file = "index.html"

#обработчик запросов
handler = http.server.SimpleHTTPRequestHandler

# Запускаем сервер
with socketserver.TCPServer(("", port), handler) as httpd:
    print(f"Сервер запущен на порту {port}")
    httpd.serve_forever()