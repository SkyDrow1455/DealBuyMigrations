<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot Widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/chatbotStyle.css')
</head>
<body>

    <!-- Botón flotante para abrir el chatbot -->
    <div id="chatbot-toggle" class="chatbot-toggle">💬</div>

    <!-- Contenedor del chatbot oculto por defecto -->
    <div class="chatbot-container" id="chatbot-container">
        <div class="chat-header">Asistente Virtual</div>
        <div class="chat-messages" id="chat-messages"></div>
        <div class="chat-input-container">
            <input type="text" id="user-input" placeholder="Escribe un mensaje..." autocomplete="off" />
            <button id="send-btn">➤</button>
        </div>
    </div>

    @vite('resources/js/chatbot.js')
</body>
</html>



