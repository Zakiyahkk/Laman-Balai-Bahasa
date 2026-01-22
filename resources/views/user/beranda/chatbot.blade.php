<div id="icak-chatbot-container">

    <button id="icak-trigger-btn" onclick="toggleChat()">
        <i class="fa-solid fa-robot fa-bounce"></i>
        <span class="tooltip-text">SIBALAI</span>
    </button>

    <div id="icak-chat-window">
        <div class="icak-header">
            <div class="header-info">
                <i class="fa-solid fa-robot header-icon"></i>
                <div>
                    <h4>SIBALAI</h4>
                    <span class="status-dot"></span> Online
                </div>
            </div>
            <button class="close-chat" onclick="toggleChat()"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <div id="icak-body" class="icak-body">
        </div>

        <div id="icak-options" class="icak-options">
        </div>
    </div>
</div>

<style>
    /* --- CONTAINER UTAMA --- */
    #icak-chatbot-container {
        font-family: 'Plus Jakarta Sans', sans-serif;
        z-index: 9999;
        /* Paling atas */
    }

    /* --- TOMBOL FLOATING --- */
    #icak-trigger-btn {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: white;
        border: none;
        border-radius: 50%;
        font-size: 28px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.4);
        transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 10000;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #icak-trigger-btn:hover {
        transform: scale(1.1);
    }

    /* Tooltip kecil saat hover tombol */
    .tooltip-text {
        position: absolute;
        right: 70px;
        background: #333;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
        white-space: nowrap;
    }

    #icak-trigger-btn:hover .tooltip-text {
        opacity: 1;
        visibility: visible;
        right: 75px;
    }

    /* --- JENDELA CHAT --- */
    #icak-chat-window {
        position: fixed;
        bottom: 100px;
        right: 30px;
        width: 350px;
        height: 500px;
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.2);
        display: none;
        /* Hidden awal */
        flex-direction: column;
        overflow: hidden;
        z-index: 10000;
        animation: slideUp 0.4s ease forwards;
        border: 1px solid #e2e8f0;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header Chat */
    .icak-header {
        background: #1e3a8a;
        color: white;
        padding: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .header-icon {
        font-size: 24px;
        background: rgba(255, 255, 255, 0.2);
        padding: 8px;
        border-radius: 50%;
    }

    .icak-header h4 {
        font-size: 16px;
        margin: 0;
        font-weight: 700;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        margin-right: 3px;
    }

    .close-chat {
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
        opacity: 0.8;
    }

    .close-chat:hover {
        opacity: 1;
    }

    /* Body Chat (Area Pesan) */
    .icak-body {
        flex: 1;
        background: #f8fafc;
        padding: 15px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Bubble Chat */
    .chat-bubble {
        max-width: 80%;
        padding: 10px 15px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.4;
        position: relative;
        animation: fadeIn 0.3s ease;
    }

    /* Bot Message */
    .bot-msg {
        align-self: flex-start;
        background: #fff;
        color: #334155;
        border-bottom-left-radius: 2px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        border: 1px solid #e2e8f0;
    }

    .bot-msg::before {
        content: '\f544';
        /* FontAwesome Robot */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        position: absolute;
        top: -20px;
        left: 0;
        color: #1e3a8a;
        font-size: 14px;
    }

    /* User Message */
    .user-msg {
        align-self: flex-end;
        background: #3b82f6;
        color: white;
        border-bottom-right-radius: 2px;
    }

    /* Footer Options (Card Pertanyaan) */
    .icak-options {
        padding: 10px 15px 15px 15px;
        background: #fff;
        border-top: 1px solid #e2e8f0;
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-height: 200px;
        overflow-y: auto;
    }

    .option-card {
        background: #fff;
        border: 1px solid #cbd5e1;
        padding: 10px;
        border-radius: 8px;
        text-align: left;
        font-size: 12px;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .option-card:hover {
        background: #eff6ff;
        border-color: #3b82f6;
        color: #1d4ed8;
    }

    .option-card i {
        color: #3b82f6;
    }

    /* Typing Animation */
    .typing-indicator {
        font-size: 12px;
        color: #94a3b8;
        margin-left: 10px;
        display: none;
        /* Hidden default */
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsif Mobile */
    @media (max-width: 480px) {
        #icak-chat-window {
            width: 90%;
            height: 60vh;
            right: 5%;
            bottom: 90px;
        }
    }
</style>

<script>
    // --- DATABASE PERTANYAAN & JAWABAN ---
    // Kamu bisa tambah pertanyaan di sini
    const botData = [{
            id: 1,
            question: "Dimana alamat Balai Bahasa Provinsi Riau?",
            answer: "Balai Bahasa Provinsi Riau beralamat di <br><b>Jl. H.R. Soebrantas, Kampus Bina Widya UNRI, Pekanbaru.</b> <br><br>Gedung kami berada di dalam kompleks kampus UNRI Panam."
        },
        {
            id: 2,
            question: "Apa saja jam pelayanan kantor?",
            answer: "Pelayanan kami buka pada:<br><b>Senin - Kamis:</b> 08.00 - 16.00 WIB<br><b>Jumat:</b> 08.00 - 16.30 WIB<br>Sabtu & Minggu Libur."
        },
        {
            id: 3,
            question: "Bagaimana cara ikut uji UKBI?",
            answer: "Untuk mendaftar UKBI (Uji Kemahiran Berbahasa Indonesia), silakan kunjungi laman resmi: <a href='https://ukbi.kemdikbud.go.id' target='_blank'>ukbi.kemdikbud.go.id</a> atau datang langsung ke layanan ULT kami."
        },
        {
            id: 4,
            question: "Saya ingin menerjemahkan dokumen, bisa?",
            answer: "Bisa! Kami menyediakan layanan penerjemahan. Silakan ajukan permohonan melalui email resmi kami atau datang ke bagian layanan teknis."
        },
        {
            id: 5,
            question: "Apa kontak WhatsApp yang bisa dihubungi?",
            answer: "Anda dapat menghubungi kami via WhatsApp di nomor: <br><b><a href='https://wa.me/6281234567890'>+62 812-3456-7890</a></b>"
        }
    ];

    const chatWindow = document.getElementById('icak-chat-window');
    const chatBody = document.getElementById('icak-body');
    const optionsArea = document.getElementById('icak-options');
    let isChatOpen = false;

    // 1. Toggle Buka/Tutup Chat
    function toggleChat() {
        if (!isChatOpen) {
            chatWindow.style.display = 'flex';
            isChatOpen = true;

            // Jika chat kosong, mulai percakapan
            if (chatBody.children.length === 0) {
                botSay("Halo! Saya <b>SIBALAI</b>, asisten virtual Balai Bahasa Riau. 👋<br>Ada yang bisa saya bantu?");
                renderOptions(); // Tampilkan kartu pertanyaan
            }
        } else {
            chatWindow.style.display = 'none';
            isChatOpen = false;
        }
    }

    // 2. Fungsi Bot Bicara (Muncul Bubble Kiri)
    function botSay(htmlMsg) {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble bot-msg';
        bubble.innerHTML = htmlMsg;
        chatBody.appendChild(bubble);
        scrollToBottom();
    }

    // 3. Fungsi User Bicara (Muncul Bubble Kanan)
    function userSay(text) {
        const bubble = document.createElement('div');
        bubble.className = 'chat-bubble user-msg';
        bubble.innerText = text;
        chatBody.appendChild(bubble);
        scrollToBottom();
    }

    // 4. Tampilkan Pilihan Pertanyaan (Cards)
    function renderOptions() {
        optionsArea.innerHTML = ''; // Bersihkan opsi lama

        const label = document.createElement('div');
        label.style.fontSize = '11px';
        label.style.color = '#64748b';
        label.style.marginBottom = '5px';
        label.innerText = 'Pilih topik bantuan:';
        optionsArea.appendChild(label);

        botData.forEach(item => {
            const btn = document.createElement('div');
            btn.className = 'option-card';
            btn.innerHTML = `<i class="fa-regular fa-comments"></i> ${item.question}`;

            // Saat card diklik
            btn.onclick = () => handleSelection(item);

            optionsArea.appendChild(btn);
        });
    }

    // 5. Logika saat User Memilih Pertanyaan
    function handleSelection(item) {
        // 1. User "mengirim" pertanyaan
        userSay(item.question);

        // 2. Sembunyikan opsi sementara (efek loading)
        optionsArea.innerHTML = '<div style="text-align:center; padding:10px; color:#94a3b8; font-size:12px;"><i class="fa-solid fa-circle-notch fa-spin"></i> Icak sedang mengetik...</div>';

        // 3. Bot menjawab (delay 1 detik biar alami)
        setTimeout(() => {
            botSay(item.answer);

            // 4. Tampilkan tombol "Menu Utama" setelah menjawab
            showBackToMenu();
        }, 800);
    }

    // 6. Tampilkan tombol Reset
    function showBackToMenu() {
        optionsArea.innerHTML = '';
        const btnReset = document.createElement('div');
        btnReset.className = 'option-card';
        btnReset.style.background = '#f1f5f9';
        btnReset.style.justifyContent = 'center';
        btnReset.style.fontWeight = 'bold';
        btnReset.innerHTML = `<i class="fa-solid fa-rotate-left"></i> Kembali ke Menu Utama`;
        btnReset.onclick = () => renderOptions();

        optionsArea.appendChild(btnReset);
    }

    // 7. Auto Scroll ke Bawah
    function scrollToBottom() {
        chatBody.scrollTop = chatBody.scrollHeight;
    }
</script>