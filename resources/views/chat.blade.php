<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Chat</title>

    <script>
        window.__CHAT__ = {
            myId:       @json($myId),
            receiverId: @json($receiverId),
        };
    </script>

    @vite(['resources/css/app.css', 'resources/js/chat/index.js'])

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: #0d0d0d;
            color: #e0e0e0;
            font-family: 'Instrument Sans', system-ui, sans-serif;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

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

        .header-name { font-size: 15px; font-weight: 500; color: #f0f0f0; }
        .header-id   { font-size: 11px; color: #3d3d3d; font-family: monospace; }

        .session-box {
            margin: 12px 16px;
            padding: 10px 14px;
            background: #111;
            border: 1px solid #1f1f1f;
            border-radius: 8px;
            font-size: 12px;
            color: #5a5a5a;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .session-box span { color: #e0e0e0; font-family: monospace; font-size: 11px; }

        .copy-btn {
            margin-left: auto;
            background: #1e1e1e;
            border: 1px solid #2a2a2a;
            color: #e0e0e0;
            padding: 4px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 11px;
        }

        .copy-btn:hover { background: #2a2a2a; }

        .messages {
            flex: 1;
            overflow-y: auto;
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .messages::-webkit-scrollbar { width: 4px; }
        .messages::-webkit-scrollbar-track { background: transparent; }
        .messages::-webkit-scrollbar-thumb { background: #2a2a2a; border-radius: 2px; }

        .message {
            max-width: 70%;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .message.received { align-self: flex-start; }
        .message.sent     { align-self: flex-end; }

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

        .message-time { font-size: 11px; color: #3d3d3d; padding: 0 4px; }
        .message.sent .message-time { text-align: right; }

        .empty-state {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2a2a2a;
            font-size: 13px;
        }

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

        .input-field::placeholder { color: #3d3d3d; }
        .input-field:focus { border-color: #2563eb; }

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

        .send-btn:hover { background: #1d4ed8; }
        .send-btn svg { width: 18px; height: 18px; fill: #fff; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <div class="header-avatar">💬</div>
        <div>
            <div class="header-name">Conversation privée</div>
            <div class="header-id">avec : {{ $receiverId }}</div>
        </div>
    </div>

    {{-- ID de session à partager --}}
    <div class="session-box">
        Ton ID à partager :
        <span id="myIdDisplay">{{ $myId }}</span>
        <button class="copy-btn" onclick="window.copyId()">Copier</button>
    </div>

    {{-- Messages --}}
    <div class="messages" id="messages">
        <div class="empty-state" id="emptyState">Aucun message pour l'instant…</div>
    </div>

    {{-- Input --}}
    <div class="input-area">
        <input
            type="text"
            class="input-field"
            id="messageInput"
            placeholder="Écrire un message… ou /help"
            autocomplete="off"
        />
        <button class="send-btn" id="sendBtn">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </div>

</body>
</html>