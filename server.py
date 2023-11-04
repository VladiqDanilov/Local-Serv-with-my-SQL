import http.server
import socketserver

port = 888


index_file = "index.html"

handler = http.server.SimpleHTTPRequestHandler
with socketserver.TCPServer(("", port), handler) as httpd:
    print(f"Сервер запущен на порту {port}")
    httpd.serve_forever()