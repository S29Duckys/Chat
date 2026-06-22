import "../echo.js";
import { appendMessage, copyId } from "./ui.js"; // ← retire inputEl
import { initSocket, sendRaw } from "./socket.js";
import { buildCommands, parseCommand } from "./commands.js";

document.addEventListener("DOMContentLoaded", () => {
    const myId = window.__CHAT__.myId;
    const receiverId = window.__CHAT__.receiverId;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    const inputEl = document.getElementById("messageInput"); // ← ici, dans le callback
    const sendBtn = document.getElementById("sendBtn");

    initSocket(myId, receiverId);

    const commands = buildCommands(myId, receiverId, csrfToken);

    window.copyId = () => copyId(myId);

    async function sendMessage() {
        const text = inputEl.value.trim();
        if (!text) return;
        inputEl.value = "";

        if (text.startsWith("/")) {
            const { name, args } = parseCommand(text);
            if (commands[name]) {
                commands[name].execute(args, commands);
            } else {
                const { appendSystem } = await import("./ui.js");
                appendSystem(
                    `Commande inconnue : /${name}\nTape /help pour la liste.`,
                );
            }
            return;
        }

        await sendRaw(text, receiverId, csrfToken, true);
    }

    sendBtn.addEventListener("click", sendMessage);
    inputEl.addEventListener("keydown", (e) => {
        if (e.key === "Enter") sendMessage();
    });
});
