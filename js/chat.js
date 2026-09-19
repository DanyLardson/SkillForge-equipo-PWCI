document.addEventListener("DOMContentLoaded", function() {
    console.log("Mensajería cargada.");

    const chatBody = document.querySelector('.chat-body');
    if (chatBody) {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
});