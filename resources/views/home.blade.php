<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #0d0d0d;
            color: #e0e0e0;
            font-family: 'Inter', system-ui, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header {
            padding: 16px 24px;
            border-bottom: 1px solid #1f1f1f;
            display: flex;
            align-items: center;
            gap: 12px;
            background: #111111;
        }

        .header-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #2a2a2a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
        }

        .header-name {
            font-size: 15px;
            font-weight: 500;
            color: #f0f0f0;
        }

        .header-status {
            font-size: 12px;
            color: #5a5a5a;
        }

        /* Messages */
        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .messages::-webkit-scrollbar {
            width: 4px;
        }

        .messages::-webkit-scrollbar-track {
            background: transparent;
        }

        .messages::-webkit-scrollbar-thumb {
            background: #2a2a2a;
            border-radius: 2px;
        }

        .message {
            max-width: 70%;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .message.received {
            align-self: flex-start;
        }

        .message.sent {
            align-self: flex-end;
        }

        .bubble {
            padding: 10px 14px;
            border-radius: 16px;
            font-size: 14px;
            line-height: 1.5;
        }

        .message.received .bubble {
            background: #1e1e1e;
            color: #e0e0e0;
            border-bottom-left-radius: 4px;
        }

        .message.sent .bubble {
            background: #2563eb;
            color: #fff;
            border-bottom-right-radius: 4px;
        }

        .message-time {
            font-size: 11px;
            color: #3d3d3d;
            padding: 0 4px;
        }

        .message.sent .message-time {
            text-align: right;
        }

        /* Input */
        .input-area {
            padding: 16px;
            border-top: 1px solid #1f1f1f;
            background: #111111;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .input-field {
            flex: 1;
            background: #1a1a1a;
            border: 1px solid #262626;
            border-radius: 24px;
            padding: 10px 16px;
            color: #e0e0e0;
            font-size: 14px;
            outline: none;
            transition: border-color 0.15s;
        }

        .input-field::placeholder {
            color: #3d3d3d;
        }

        .input-field:focus {
            border-color: #2563eb;
        }

        .send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #2563eb;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: background 0.15s;
        }

        .send-btn:hover {
            background: #1d4ed8;
        }

        .send-btn svg {
            width: 18px;
            height: 18px;
            fill: #fff;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-avatar">💬</div>
        <div>
            <div class="header-name">Chat</div>
            <div class="header-status">En ligne</div>
        </div>
    </div>

    {{-- Messages --}}
    <div class="messages" id="messages">

        @foreach ($messages ?? [] as $message)
            <div class="message {{ $message['type'] === 'sent' ? 'sent' : 'received' }}">
                <div class="bubble">{{ $message['text'] }}</div>
                <div class="message-time">{{ $message['time'] }}</div>
            </div>
        @endforeach

        {{-- Messages de démo si aucun message --}}
        @if(empty($messages))
            <div class="message received">
                <div class="bubble">Bonjour ! Comment puis-je vous aider ?</div>
                <div class="message-time">14:30</div>
            </div>
            <div class="message sent">
                <div class="bubble">Salut ! Tout va bien merci.</div>
                <div class="message-time">14:31</div>
            </div>
            <div class="message received">
                <div class="bubble">Super ! Dites-moi si vous avez besoin de quoi que ce soit.</div>
                <div class="message-time">14:31</div>
            </div>
        @endif

    </div>

    {{-- Input --}}
    <div class="input-area">
        <input
            type="text"
            class="input-field"
            id="messageInput"
            placeholder="Écrire un message..."
            autocomplete="off"
        />
        <button class="send-btn" id="sendBtn">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </div>

    <script>
        const input = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const messages = document.getElementById('messages');

        function sendMessage() {
            const text = input.value.trim();
            if (!text) return;

            const now = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });

            const div = document.createElement('div');
            div.className = 'message sent';
            div.innerHTML = `<div class="bubble">${text}</div><div class="message-time">${now}</div>`;
            messages.appendChild(div);

            input.value = '';
            messages.scrollTop = messages.scrollHeight;
        }

        sendBtn.addEventListener('click', sendMessage);
        input.addEventListener('keydown', e => {
            if (e.key === 'Enter') sendMessage();
        });

        messages.scrollTop = messages.scrollHeight;
    </script>

</body>
</html>