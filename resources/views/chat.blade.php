<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Chat</title>

    <script>
        window.__CHAT__ = {
            myId: @json($myId),
            receiverId: @json($receiverId),
        };
    </script>

    @vite([
        'resources/css/app.css',
        'resources/css/chat.css',
        'resources/js/chat/index.js'
    ])
</head>

<body>

    {{-- HEADER --}}
    <header class="chat-header">
        <div class="chat-avatar">💬</div>

        <div class="chat-user">
            <div class="chat-title">Conversation privée</div>
            <div class="chat-subtitle">avec : {{ $receiverId }}</div>
        </div>
    </header>

    {{-- SESSION --}}
    <section class="chat-session">
        <span>Ton ID à partager :</span>

        <span class="chat-id" id="myIdDisplay">
            {{ $myId }}
        </span>

        <button class="chat-copy" onclick="window.copyId()">
            Copier
        </button>
    </section>

    {{-- MESSAGES --}}
    <main class="chat-messages" id="messages">

        <div class="chat-empty" id="emptyState">
            Aucun message pour l'instant…
        </div>

    </main>

    {{-- INPUT --}}
    <footer class="chat-input">
        <input
            type="text"
            id="messageInput"
            placeholder="Écrire un message… ou /help"
            autocomplete="off"
        >

        <button id="sendBtn">
            <svg viewBox="0 0 24 24">
                <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
            </svg>
        </button>
    </footer>

</body>
</html>