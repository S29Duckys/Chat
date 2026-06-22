export function appendMessage(text, time, isMine) {
    const messagesEl = document.getElementById("messages");

    const empty = document.getElementById("emptyState");
    if (empty) empty.remove();

    const div = document.createElement("div");
    div.className = `message ${isMine ? "sent" : "received"}`;
    div.innerHTML = `
        <div class="bubble">${text}</div>
        <div class="message-time">${time}</div>
    `;

    messagesEl.appendChild(div);
}

export function appendSystem(text) {
    const messagesEl = document.getElementById("messages");
    
    const div = document.createElement("div");
    div.style.cssText =
        "text-align:center; color:#3d3d3d; font-size:12px; padding:4px 0; font-family:monospace; white-space:pre-line;";
    div.textContent = text;

    messagesEl.appendChild(div);
    messagesEl.scrollTop = messagesEl.scrollHeight;
}

export function copyId(myId) {
    navigator.clipboard.writeText(myId);

    const btn = document.querySelector(".copy-btn");
    if (!btn) return;

    btn.textContent = "Copié !";
    setTimeout(() => {
        btn.textContent = "Copier";
    }, 2000);
}
