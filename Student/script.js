function generateResponse() {
    const textInput = document.getElementById("text");
    const responseContainer = document.getElementById("response");

    // User message
    const userMessage = document.createElement("div");
    userMessage.className = "message-container user-message";
    userMessage.textContent = textInput.value;
    responseContainer.appendChild(userMessage);
    
    fetch("response.php", {
        method: "post",
        body: JSON.stringify({ text: textInput.value }),
    })
    .then((res) => res.text())
    .then((resText) => {
        // Bot response
        const botMessage = document.createElement("div");
        botMessage.className = "message-container bot-message";
        botMessage.textContent = resText;
        responseContainer.appendChild(botMessage);

        // Auto-scroll to the bottom of chat
        responseContainer.scrollTop = responseContainer.scrollHeight;
    })
    .catch((error) => console.error("Fetch error:", error));
    
    textInput.value = ""; // Clear input after sending
}
