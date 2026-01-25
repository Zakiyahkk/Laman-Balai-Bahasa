<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<div id="icak-chatbot-container">
    <button id="icak-trigger-btn" onclick="toggleChat()">
        <i class="fa-solid fa-robot fa-bounce"></i>
        <span class="tooltip-text">Serindit</span>
    </button>

    <div id="icak-chat-window">
        <div class="icak-header">
            <div class="header-info">
                <i class="fa-solid fa-robot header-icon"></i>
                <div>
                    <h4>SIBALAI</h4>
                    <span class="status-container">
                        <span class="status-dot"></span> Online
                    </span>
                </div>
            </div>
            <button class="close-chat" onclick="toggleChat()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div id="icak-body" class="icak-body">
        </div>

        <div id="icak-options" class="icak-options">
        </div>
    </div>
</div>