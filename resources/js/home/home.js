import { copyId } from "../chat/ui";

const sendBtnHome = document.querySelector(".joinSession");
const inputHome = document.querySelector(".inputToken");

console.log("home.js chargé");

function goToChat(token) {

    const finalToken = token ?? inputHome.value.trim();

    if (!finalToken) return;

    window.location.href = `/chat?with=${finalToken}`;
}

sendBtnHome.addEventListener("click", () => goToChat());

inputHome.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        goToChat(token);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.querySelector(".newSessionBtn");
    const modal = document.getElementById("sessionModal");
    const closeBtn = document.getElementById("closeModalBtn");

    const tokenInput = document.getElementById("userToken");
    const friendTokenInput = document.getElementById("friendToken");

    const createBtn = document.getElementById("createSessionBtn");
    const copyBtn = document.getElementById("copyTokenBtn");

    // Ouvrir la popup
    openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");

        tokenInput.value = window.__USER__.token;
        friendTokenInput.value = "";
    });

    // Fermer la popup
    closeBtn.addEventListener("click", () => {
        modal.classList.add("hidden");
    });

    // Fermer en cliquant à l'extérieur
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.add("hidden");
        }
    });

    // Copier le token
    copyBtn.addEventListener("click", () => {
        copyId(tokenInput.value);
    });

    // Créer la session
    createBtn.addEventListener("click", () => {
        const friendToken = friendTokenInput.value.trim();

        goToChat(friendToken)
    });
});
