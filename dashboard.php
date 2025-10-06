<?php
session_start();

// Jika belum login, redirect ke login
if (!isset($_SESSION['username'])) {
    header("Location: login.php?msg=belum_login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALAMEKA Jaya Minang - Restoran Masakan Padang Autentik</title>
    <style>
        /* BASIC STYLES */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        /* HEADER STYLES */
        header {
            background: #e63946;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .header-top {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .dark-toggle {
            background: white;
            color: #e63946;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .dark-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info {
            font-weight: bold;
            color: white;
            background: rgba(255,255,255,0.2);
            padding: 8px 15px;
            border-radius: 20px;
        }
        
        .logout-btn {
            background: white;
            color: #e63946;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        
        .header-title {
            margin-top: 60px;
            margin-bottom: 20px;
        }
        
        .header-title h1 {
            margin: 0 0 10px 0;
            font-size: 2.8em;
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .header-title p {
            margin: 0;
            font-style: italic;
            font-size: 1.3em;
            color: white;
            opacity: 0.9;
        }
        
        .header-nav {
            background: rgba(0,0,0,0.2);
            padding: 15px 0;
            margin-top: 15px;
        }
        
        .nav-menu {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 40px;
        }
        
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1em;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        
        .nav-menu a:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        /* MAIN CONTENT STYLES DENGAN BACKGROUND IMAGE */
        main {
            padding: 40px 20px;
            max-width: 1400px;
            margin: 0 auto;
            background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            border-radius: 20px;
            margin-top: 30px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            position: relative;
        }
        
        /* Overlay untuk konten agar lebih mudah dibaca */
        main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.92);
            border-radius: 20px;
            z-index: 0;
        }
        
        section {
            margin-bottom: 50px;
            padding: 35px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            border: 2px solid rgba(230, 57, 70, 0.1);
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease;
        }
        
        section:hover {
            transform: translateY(-5px);
        }
        
        /* Hero section khusus */
        #hero {
            background: linear-gradient(135deg, rgba(230, 57, 70, 0.9), rgba(193, 18, 31, 0.9));
            color: white;
            text-align: center;
            padding: 80px 40px;
            margin-bottom: 50px;
            border: none;
        }
        
        #hero h2 {
            color: white;
            border-bottom: none;
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.4);
        }
        
        #hero p {
            font-size: 1.4em;
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }
        
        h2 {
            color: #e63946;
            margin-bottom: 25px;
            border-bottom: 3px solid #e63946;
            padding-bottom: 15px;
            font-size: 2.2em;
            text-align: center;
        }
        
        /* TABLE STYLES */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        th, td {
            padding: 18px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: linear-gradient(135deg, #e63946, #c1121f);
            color: white;
            font-weight: bold;
            font-size: 1.1em;
        }
        
        tr:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        /* OUTLET STYLES */
        .outlet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .outlet-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            border-left: 5px solid #e63946;
            transition: all 0.3s ease;
        }
        
        .outlet-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.2);
        }
        
        .outlet-card h3 {
            color: #e63946;
            margin-bottom: 15px;
            font-size: 1.4em;
        }
        
        .outlet-card p {
            margin-bottom: 10px;
            color: #555;
        }
        
        .outlet-card .alamat {
            font-weight: bold;
            color: #333;
        }
        
        .outlet-card .jam {
            color: #e63946;
            font-weight: bold;
        }
        
        /* FORM STYLES */
        form {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.98);
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        label {
            display: block;
            margin: 15px 0 8px;
            font-weight: bold;
            color: #333;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 1em;
            transition: border 0.3s ease;
        }
        
        input:focus, textarea:focus, select:focus {
            border-color: #e63946;
            outline: none;
            box-shadow: 0 0 8px rgba(230, 57, 70, 0.2);
        }
        
        fieldset {
            border: 2px solid #e63946;
            padding: 20px;
            margin: 25px 0;
            border-radius: 10px;
            background: rgba(230, 57, 70, 0.05);
        }
        
        legend {
            font-weight: bold;
            color: #e63946;
            padding: 0 15px;
            font-size: 1.2em;
        }
        
        button {
            background: linear-gradient(135deg, #e63946, #c1121f);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(230, 57, 70, 0.3);
        }
        
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(230, 57, 70, 0.4);
        }
        
        /* BOOKING RESULT */
        #booking-result {
            display: none;
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            padding: 30px;
            border-radius: 15px;
            margin-top: 30px;
            border-left: 6px solid #2e7d32;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }
        
        /* FOOTER STYLES */
        footer {
            background: linear-gradient(135deg, #222, #444);
            color: #ccc;
            padding: 40px 20px;
            text-align: center;
            margin-top: 50px;
        }
        
        footer h3 {
            color: white;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        
        footer a {
            color: #ffebcd;
            transition: color 0.3s ease;
        }
        
        footer a:hover {
            color: #e63946;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            text-align: left;
        }
        
        /* DARK MODE */
        body.dark-mode {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #f0f0f0;
        }
        
        body.dark-mode main::before {
            background: rgba(30, 30, 30, 0.95);
        }
        
        body.dark-mode section {
            background: rgba(40, 40, 40, 0.95);
            color: #f0f0f0;
        }
        
        body.dark-mode .outlet-card {
            background: #2a2a2a;
            color: #f0f0f0;
        }
        
        body.dark-mode table {
            background: #2a2a2a;
            color: #f0f0f0;
        }
        
        body.dark-mode th {
            background: linear-gradient(135deg, #444, #333);
        }
        
        body.dark-mode tr:hover {
            background: #3a3a3a;
        }
        
        body.dark-mode form {
            background: rgba(40, 40, 40, 0.95);
            color: #f0f0f0;
        }
        
        body.dark-mode input, 
        body.dark-mode textarea, 
        body.dark-mode select {
            background: #333;
            color: #f0f0f0;
            border-color: #555;
        }
        
        body.dark-mode .dark-toggle,
        body.dark-mode .logout-btn {
            background: #444;
            color: white;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header-top {
                position: static;
                flex-direction: column;
                gap: 15px;
                margin-bottom: 20px;
            }
            
            .header-title {
                margin-top: 0;
            }
            
            .header-title h1 {
                font-size: 2em;
            }
            
            .nav-menu {
                flex-direction: column;
                gap: 10px;
            }
            
            .outlet-grid {
                grid-template-columns: 1fr;
            }
            
            section {
                padding: 20px;
            }
            
            #hero {
                padding: 50px 20px;
            }
            
            #hero h2 {
                font-size: 2em;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="header-top">
            <button id="dark-toggle" class="dark-toggle">🌙 Dark Mode</button>
            
            <div class="user-section">
                <span class="user-info">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <form action="logout.php" method="POST" style="display: inline;">
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>

        <div class="header-title">
            <h1>ALAMEKA Jaya Minang</h1>
            <p>Restoran Masakan Padang Autentik Sejak 1945</p>
        </div>

        <nav class="header-nav">
            <ul class="nav-menu">
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#menu">Menu</a></li>
                <li><a href="#outlet">Lokasi Outlet</a></li>
                <li><a href="#promo">Promo & Berita</a></li>
                <li><a href="#pesan">Pesan Sekarang</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="hero">
            <h2>Selamat Datang di ALAMEKA Jaya Minang</h2>
            <p>Nikmati kelezatan masakan Padang tradisional dengan cita rasa autentik yang telah melegenda</p>
        </section>

        <section id="tentang">
            <h2>Tentang Kami</h2>
            <p>ALAMEKA Jaya Minang didirikan pada tahun 1945 dengan misi melestarikan dan menyajikan masakan Padang asli kepada seluruh masyarakat Indonesia. Dengan bahan-bahan pilihan dan proses memasak yang tradisional, kami menjamin cita rasa yang autentik dalam setiap hidangan.</p>
        </section>

        <section id="menu">
            <h2>Menu Andalan Kami</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Rendang Daging</td>
                        <td>Daging sapi pilihan dimasak dengan bumbu rempah khas Padang</td>
                        <td>Rp 35.000</td>
                        <td><button>Pesan</button></td>
                    </tr>
                    <tr>
                        <td>Ayam Pop</td>
                        <td>Ayam kampung ungkep dengan bumbu tradisional</td>
                        <td>Rp 28.000</td>
                        <td><button>Pesan</button></td>
                    </tr>
                    <tr>
                        <td>Gulai Ikan Kakap</td>
                        <td>Ikan kakap segar dalam kuah gulai yang gurih</td>
                        <td>Rp 32.000</td>
                        <td><button>Pesan</button></td>
                    </tr>
                    <tr>
                        <td>Dendeng Balado</td>
                        <td>Daging sapi iris tipis digoreng kering dengan sambal balado</td>
                        <td>Rp 30.000</td>
                        <td><button>Pesan</button></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <section id="outlet">
            <h2>Lokasi Outlet Kami</h2>
            <div class="outlet-grid">
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Jakarta Pusat</h3>
                    <p class="alamat">📍 Jl. Sudirman No. 123, Jakarta Pusat</p>
                    <p>🏬 Gedung Sudirman Tower Lt. 5</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 22.00 WIB</p>
                    <p>📞 021-1234567</p>
                </div>
                
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Bandung</h3>
                    <p class="alamat">📍 Jl. Dago No. 45, Bandung</p>
                    <p>🏬 Dago Food District Blok A-12</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 22.00 WIB</p>
                    <p>📞 022-7654321</p>
                </div>
                
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Surabaya</h3>
                    <p class="alamat">📍 Jl. Tunjungan No. 78, Surabaya</p>
                    <p>🏬 Tunjungan Plaza Lt. 3</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 22.00 WIB</p>
                    <p>📞 031-9876543</p>
                </div>
                
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Yogyakarta</h3>
                    <p class="alamat">📍 Jl. Malioboro No. 56, Yogyakarta</p>
                    <p>🏬 Malioboro Mall Lt. 2</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 22.00 WIB</p>
                    <p>📞 0274-4567890</p>
                </div>
                
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Bali</h3>
                    <p class="alamat">📍 Jl. Legian No. 234, Kuta, Bali</p>
                    <p>🏬 Beachwalk Shopping Center Lt. 1</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 23.00 WITA</p>
                    <p>📞 0361-2345678</p>
                </div>
                
                <div class="outlet-card">
                    <h3>ALAMEKA Jaya Minang Cabang Medan</h3>
                    <p class="alamat">📍 Jl. Pemuda No. 89, Medan</p>
                    <p>🏬 Sun Plaza Lt. 4</p>
                    <p class="jam">🕐 Buka setiap hari: 09.00 - 22.00 WIB</p>
                    <p>📞 061-3456789</p>
                </div>
            </div>
        </section>

        <section id="pesan">
            <h2>Pesan Sekarang - Take Away</h2>
            <form id="order-form">
                <fieldset>
                    <legend>Form Pemesanan</legend>
                    
                    <label for="nama">Nama Pemesan:</label>
                    <input type="text" id="nama" name="nama" required>
                    
                    <label for="telepon">Nomor Telepon/WA:</label>
                    <input type="tel" id="telepon" name="telepon" required>
                    
                    <label for="alamat">Alamat Pengiriman:</label>
                    <textarea id="alamat" name="alamat" required></textarea>
                    
                    <label for="cabang">Pilih Cabang:</label>
                    <select id="cabang" name="cabang" required>
                        <option value="">-- Pilih Cabang --</option>
                        <option value="jakarta">Jakarta Pusat</option>
                        <option value="bandung">Bandung</option>
                        <option value="surabaya">Surabaya</option>
                        <option value="yogyakarta">Yogyakarta</option>
                        <option value="bali">Bali</option>
                        <option value="medan">Medan</option>
                    </select>
                    
                    <fieldset>
                        <legend>Pilihan Menu:</legend>
                        <div style="margin: 15px 0; padding: 15px; background: rgba(230,57,70,0.05); border-radius: 8px;">
                            <input type="checkbox" id="rendang" name="menu" value="rendang">
                            <label for="rendang">Rendang Daging (Rp 35.000)</label>
                            <label for="qty-rendang">Jumlah:</label>
                            <input type="number" id="qty-rendang" name="qty-rendang" min="0" value="0" style="width: 100px; display: inline-block;">
                        </div>
                        <div style="margin: 15px 0; padding: 15px; background: rgba(230,57,70,0.05); border-radius: 8px;">
                            <input type="checkbox" id="ayam-pop" name="menu" value="ayam-pop">
                            <label for="ayam-pop">Ayam Pop (Rp 28.000)</label>
                            <label for="qty-ayam-pop">Jumlah:</label>
                            <input type="number" id="qty-ayam-pop" name="qty-ayam-pop" min="0" value="0" style="width: 100px; display: inline-block;">
                        </div>
                        <div style="margin: 15px 0; padding: 15px; background: rgba(230,57,70,0.05); border-radius: 8px;">
                            <input type="checkbox" id="gulai-ikan" name="menu" value="gulai-ikan">
                            <label for="gulai-ikan">Gulai Ikan Kakap (Rp 32.000)</label>
                            <label for="qty-gulai-ikan">Jumlah:</label>
                            <input type="number" id="qty-gulai-ikan" name="qty-gulai-ikan" min="0" value="0" style="width: 100px; display: inline-block;">
                        </div>
                        <div style="margin: 15px 0; padding: 15px; background: rgba(230,57,70,0.05); border-radius: 8px;">
                            <input type="checkbox" id="dendeng" name="menu" value="dendeng">
                            <label for="dendeng">Dendeng Balado (Rp 30.000)</label>
                            <label for="qty-dendeng">Jumlah:</label>
                            <input type="number" id="qty-dendeng" name="qty-dendeng" min="0" value="0" style="width: 100px; display: inline-block;">
                        </div>
                    </fieldset>
                    
                    <label for="catatan">Catatan Tambahan:</label>
                    <textarea id="catatan" name="catatan"></textarea>
                    
                    <button type="submit">Buat Pesanan & Dapatkan Kode Booking</button>
                </fieldset>
            </form>
            
            <div id="booking-result">
                <h3>Pesanan Berhasil Dibuat!</h3>
                <p>Kode Booking Anda: <span id="kode-booking">SBPD-1234</span></p>
                <p>Total Pembayaran: Rp <span id="total-harga">125.000</span></p>
                <p>Silakan hubungi kami via WhatsApp di <strong>08123456789</strong> dengan menyertakan kode booking untuk konfirmasi dan pembayaran.</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div>
                <h3>Kontak Kami</h3>
                <p>📱 WhatsApp: 08123456789</p>
                <p>📧 Email: info@alamekaminang.com</p>
                <p>🌐 Website: www.alamekaminang.com</p>
            </div>
            
            <div>
                <h3>Layanan</h3>
                <p>🍽️ Dine In</p>
                <p>📦 Take Away</p>
                <p>🚗 Drive Thru</p>
                <p>🏍️ Delivery</p>
            </div>
            
            <div>
                <h3>Referensi Desain</h3>
                <p>Inspirasi desain dari:</p>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="https://www.sederhana.com/" target="_blank">Sederhana Restaurant</a></li>
                    <li><a href="https://www.pagaruyungresto.com/" target="_blank">Pagaruyung Resto</a></li>
                    <li><a href="https://www.parisrestaurant.co.id/" target="_blank">Paris Restaurant</a></li>
                </ul>
            </div>
        </div>
        
        <div style="margin-top: 30px; border-top: 1px solid #555; padding-top: 20px;">
            <p>&copy; 2025 ALAMEKA Jaya Minang. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Dark Mode Functionality
        document.addEventListener('DOMContentLoaded', function() {
            const darkToggle = document.getElementById('dark-toggle');
            const form = document.getElementById('order-form');
            const bookingResult = document.getElementById('booking-result');
            const kodeBooking = document.getElementById('kode-booking');
            const totalHarga = document.getElementById('total-harga');

            // Dark Mode toggle
            darkToggle.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                
                if (document.body.classList.contains('dark-mode')) {
                    darkToggle.textContent = '☀️ Light Mode';
                    localStorage.setItem('theme', 'dark');
                } else {
                    darkToggle.textContent = '🌙 Dark Mode';
                    localStorage.setItem('theme', 'light');
                }
            });
            
            // Load saved theme
            if (localStorage.getItem('theme') === 'dark') {
                document.body.classList.add('dark-mode');
                darkToggle.textContent = '☀️ Light Mode';
            }

            // Form submit handler
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const menuHarga = {
                    rendang: 35000,
                    "ayam-pop": 28000,
                    "gulai-ikan": 32000,
                    dendeng: 30000,
                };

                let total = 0;
                let menuDipilih = [];

                Object.keys(menuHarga).forEach((menu) => {
                    const checkbox = document.getElementById(menu);
                    const qtyInput = document.getElementById('qty-' + menu);
                    if (checkbox.checked && qtyInput.value > 0) {
                        const jumlah = parseInt(qtyInput.value);
                        total += menuHarga[menu] * jumlah;
                        menuDipilih.push(menu + ' x' + jumlah);
                    }
                });

                if (total === 0) {
                    alert("Silakan pilih menu dan jumlah pesanan terlebih dahulu!");
                    return;
                }

                const kode = "SBPD-" + Math.floor(Math.random() * 9000 + 1000);

                kodeBooking.textContent = kode;
                totalHarga.textContent = total.toLocaleString("id-ID");
                bookingResult.style.display = "block";

                form.reset();
            });
        });
    </script>
</body>
</html>