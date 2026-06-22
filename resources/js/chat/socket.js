import { appendMessage } from './ui.js';

export function initSocket(myId, receiverId) {
    const ids         = [myId, receiverId].sort();
    const channelName = `chat.${ids[0]}.${ids[1]}`;

    window.Echo.channel(channelName)
        .listen('.MessageSent', (e) => {
            if (e.senderId !== myId) {
                appendMessage(e.message, e.time, false);
            }
        });
}

export async function sendRaw(text, receiverId, csrfToken, isMine = true) {
    const now = new Date().toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
    appendMessage(text, now, isMine);

    await fetch('/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({ message: text, receiverId }),
    });
}