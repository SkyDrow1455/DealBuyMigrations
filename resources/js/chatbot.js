document.getElementById('send-btn').addEventListener('click', sendMessage);
document.getElementById('prompt').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') sendMessage();
});

function appendMessage(message, sender) {
    const msg = document.createElement('div');
    msg.classList.add('chat-message', sender);
    msg.textContent = message;
    document.getElementById('chat-messages').appendChild(msg);
    msg.scrollIntoView({ behavior: 'smooth' });
}

function sendMessage() {
    const input = document.getElementById('prompt');  // Cambié 'user-input' a 'prompt'
    const prompt = input.value.trim(); // Obtener el valor del campo de entrada

    if (!prompt) return; // Si no hay valor, no se envía la solicitud

    appendMessage(prompt, 'user');
    input.value = ''; // Limpiar el campo de entrada

    fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ prompt }) // Enviar el valor como 'prompt'
    })
    .then(res => res.json())
    .then(data => {
        if (data.response) {
            appendMessage(data.response, 'bot');
        } else {
            appendMessage("No response from server.", 'bot');
        }
    })
    .catch(err => {
        console.error(err);
        appendMessage("Error en el servidor.", 'bot');
    });
}

// Mostrar/ocultar chatbot con el botón flotante
document.getElementById('chatbot-toggle').addEventListener('click', () => {
    const chatbot = document.getElementById('chatbot-container');
    chatbot.style.display = chatbot.style.display === 'flex' ? 'none' : 'flex';
});
