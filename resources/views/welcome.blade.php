<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neon Nights Concert - Ticket Booking</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0d17;
            --primary-color: #ff2a5f;
            --secondary-color: #00d2ff;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --text-main: #ffffff;
            --text-muted: #a0a5b5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            background-image: 
                radial-gradient(circle at 15% 50%, rgba(255, 42, 95, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 85% 30%, rgba(0, 210, 255, 0.15) 0%, transparent 50%);
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .app-container {
            width: 100%;
            max-width: 1200px;
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
            animation: fadeIn 0.8s ease-out;
        }

        @media (max-width: 900px) {
            .app-container {
                grid-template-columns: 1fr;
            }
        }

        /* Glassmorphism Panel Base */
        .glass-panel {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
        }

        /* Header */
        .header {
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }

        .header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        /* Ticket Grid */
        .ticket-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .ticket-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .ticket-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary-color);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ticket-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .ticket-card:hover::before {
            opacity: 1;
        }

        .ticket-card.vip::before { background: #ffd700; }
        .ticket-card.festival::before { background: var(--secondary-color); }

        .ticket-name {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .ticket-price {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .ticket-card.vip .ticket-price { color: #ffd700; }
        .ticket-card.festival .ticket-price { color: var(--secondary-color); }

        .ticket-desc {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .add-btn {
            background: transparent;
            color: var(--text-main);
            border: 1px solid var(--glass-border);
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'Outfit', sans-serif;
            width: 100%;
        }

        .add-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .add-btn:active {
            transform: scale(0.98);
        }

        /* Cart Sidebar */
        .cart-sidebar {
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 2rem;
            height: fit-content;
        }

        .cart-title {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--glass-border);
        }

        .cart-items {
            flex-grow: 1;
            min-height: 150px;
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 1.5rem;
        }
        
        /* Scrollbar styles */
        .cart-items::-webkit-scrollbar {
            width: 6px;
        }
        .cart-items::-webkit-scrollbar-track {
            background: transparent;
        }
        .cart-items::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0,0,0,0.2);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 0.75rem;
            animation: slideIn 0.3s ease-out;
        }

        .item-info h4 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .item-info p {
            color: var(--primary-color);
            font-size: 0.9rem;
            font-weight: 600;
        }

        .item-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .qty-btn {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
            width: 28px;
            height: 28px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .qty-btn:hover {
            background: rgba(255,255,255,0.2);
        }
        
        .item-qty {
            font-weight: 600;
            width: 20px;
            text-align: center;
        }

        .empty-cart {
            text-align: center;
            color: var(--text-muted);
            padding: 2rem 0;
            font-style: italic;
        }

        .cart-summary {
            border-top: 1px solid var(--glass-border);
            padding-top: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            color: var(--text-muted);
        }

        .summary-row.total {
            color: var(--text-main);
            font-size: 1.25rem;
            font-weight: 700;
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px dashed var(--glass-border);
        }

        .checkout-btn {
            background: linear-gradient(45deg, var(--primary-color), #ff4d79);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 12px;
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 42, 95, 0.3);
        }

        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 42, 95, 0.4);
        }

        .checkout-btn:disabled {
            background: #3a3f58;
            box-shadow: none;
            cursor: not-allowed;
            color: #7a809b;
            transform: none;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body>

    <div class="app-container">
        <!-- Main Content (Ticket Selection) -->
        <main class="glass-panel">
            <div class="header">
                <h1>Neon Nights 2026</h1>
                <p>Pilih paket tiket konser Anda dan rasakan pengalaman tak terlupakan.</p>
            </div>

            <div class="ticket-list" id="ticket-list">
                <!-- Tickets will be injected here via JS -->
            </div>
        </main>

        <!-- Sidebar (Cart) -->
        <aside class="glass-panel cart-sidebar">
            <h2 class="cart-title">Rincian Pesanan</h2>
            
            <div class="cart-items" id="cart-items">
                <!-- Cart items injected here -->
                <div class="empty-cart" id="empty-message">Keranjang masih kosong</div>
            </div>

            <div class="cart-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="subtotal">Rp 0</span>
                </div>
                <div class="summary-row">
                    <span>Pajak (10%)</span>
                    <span id="tax">Rp 0</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="total">Rp 0</span>
                </div>
                
                <button class="checkout-btn" id="checkout-btn" disabled>Beli Tiket Sekarang</button>
            </div>
        </aside>
    </div>

    <script>
        // Data Tiket
        const tickets = [
            { id: 1, name: "VVIP Front Row", price: 3500000, desc: "Akses area terdepan, meet & greet, exclusive merchandise, dan fast track.", type: "vip" },
            { id: 2, name: "VIP Tribune", price: 2500000, desc: "Tempat duduk bernomor dengan view terbaik, VIP lounge access.", type: "vip" },
            { id: 3, name: "Festival A", price: 1200000, desc: "Area berdiri tepat di belakang VIP. Dekat dengan panggung utama.", type: "festival" },
            { id: 4, name: "Festival B", price: 850000, desc: "Area berdiri umum. Nikmati euforia konser bersama crowd.", type: "festival" }
        ];

        // State Keranjang
        let cart = [];

        // Format Rupiah
        const formatIDR = (number) => {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
        };

        // Render Tiket
        const renderTickets = () => {
            const list = document.getElementById('ticket-list');
            list.innerHTML = tickets.map(ticket => `
                <div class="ticket-card ${ticket.type}">
                    <h3 class="ticket-name">${ticket.name}</h3>
                    <div class="ticket-price">${formatIDR(ticket.price)}</div>
                    <p class="ticket-desc">${ticket.desc}</p>
                    <button class="add-btn" onclick="addToCart(${ticket.id})">Tambah ke Pesanan</button>
                </div>
            `).join('');
        };

        // Tambah ke Keranjang
        const addToCart = (ticketId) => {
            const ticket = tickets.find(t => t.id === ticketId);
            const existingItem = cart.find(item => item.id === ticketId);

            if (existingItem) {
                existingItem.qty += 1;
            } else {
                cart.push({ ...ticket, qty: 1 });
            }
            
            updateCart();
        };

        // Ubah Kuantitas
        const changeQty = (ticketId, delta) => {
            const itemIndex = cart.findIndex(item => item.id === ticketId);
            if (itemIndex > -1) {
                cart[itemIndex].qty += delta;
                if (cart[itemIndex].qty <= 0) {
                    cart.splice(itemIndex, 1);
                }
                updateCart();
            }
        };

        // Update UI Keranjang
        const updateCart = () => {
            const cartContainer = document.getElementById('cart-items');
            const emptyMessage = document.getElementById('empty-message');
            const btnCheckout = document.getElementById('checkout-btn');
            
            // Hitung total
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const tax = subtotal * 0.1;
            const total = subtotal + tax;

            // Render Items
            if (cart.length === 0) {
                cartContainer.innerHTML = '<div class="empty-cart" id="empty-message">Keranjang masih kosong</div>';
                btnCheckout.disabled = true;
                btnCheckout.innerText = "Beli Tiket Sekarang";
            } else {
                cartContainer.innerHTML = cart.map(item => `
                    <div class="cart-item">
                        <div class="item-info">
                            <h4>${item.name}</h4>
                            <p>${formatIDR(item.price)}</p>
                        </div>
                        <div class="item-controls">
                            <button class="qty-btn" onclick="changeQty(${item.id}, -1)">-</button>
                            <span class="item-qty">${item.qty}</span>
                            <button class="qty-btn" onclick="changeQty(${item.id}, 1)">+</button>
                        </div>
                    </div>
                `).join('');
                btnCheckout.disabled = false;
                btnCheckout.innerText = `Bayar ${formatIDR(total)}`;
            }

            // Update Summary Texts
            document.getElementById('subtotal').innerText = formatIDR(subtotal);
            document.getElementById('tax').innerText = formatIDR(tax);
            document.getElementById('total').innerText = formatIDR(total);
        };

        // Event listener checkout
        document.getElementById('checkout-btn').addEventListener('click', () => {
            if(cart.length > 0) {
                // Button animation
                const btn = document.getElementById('checkout-btn');
                const originalText = btn.innerText;
                btn.innerText = "Memproses...";
                btn.style.opacity = "0.8";
                
                setTimeout(() => {
                    alert('Pesanan berhasil dibuat! Terima kasih.');
                    cart = [];
                    updateCart();
                    btn.style.opacity = "1";
                }, 800);
            }
        });

        // Initialize
        renderTickets();
    </script>
</body>
</html>
