<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSocket Test</title>
    <style>
        #messages {
            width: 300px;
            height: 200px;
            overflow-y: scroll;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>WebSocket Test</h1>
    <textarea id="messages" readonly></textarea><br>
    <input type="text" id="messageInput" placeholder="Type a message...">
    <button id="sendMessage">Send</button>

    <script>
        // Connect to the WebSocket server
        const ws = new WebSocket('ws://87.248.138.154:8080');

        ws.onopen = () => {
            console.log('Connected to WebSocket server');
        };

        ws.onmessage = (event) => {
            const messages = document.getElementById('messages');
            // Check if the message is a Blob and handle it accordingly
            if (event.data instanceof Blob) {
                const reader = new FileReader();
                reader.onload = () => {
                    messages.value += `${reader.result}\n`;
                    messages.scrollTop = messages.scrollHeight;
                };
                reader.readAsText(event.data);
            } else {
                // Handle text data
                messages.value += `${event.data}\n`;
                messages.scrollTop = messages.scrollHeight;
            }
        };

        ws.onerror = (error) => {
            console.error('WebSocket Error:', error);
        };

        document.getElementById('sendMessage').addEventListener('click', () => {
            const input = document.getElementById('messageInput');
            const message = input.value;
            if (message) {
                ws.send(message);
                input.value = '';
            }
        });
    </script>
</body>
</html>