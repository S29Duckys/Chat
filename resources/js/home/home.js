const sendBtnHome = document.querySelector(".joinSession");
const inputHome = document.querySelector(".inputToken");

console.log("home.js chargé");

console.log(sendBtnHome, inputHome);

function goToChat() {
    const token = inputHome.value.trim();

    if (!token) return;

    window.location.href = `/chat?with=${token}`;
}

sendBtnHome.addEventListener("click", goToChat);

inputHome.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
        goToChat();
    }
});