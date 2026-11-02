# 🕌 SAF — Sistem Operasi Manajemen Masjid Open Source

> **"Sistem operasi yang merapikan tata kelola masjid: Tertib administrasi, Amanah keuangan & aset, Bersama jamaah, dan Berkelanjutan antar-generasi."**

[![Live Website](https://img.shields.io/badge/Live_Domain-safmasjid.web.id-064E3B?style=for-the-badge&logo=caddy&logoColor=white)](https://safmasjid.web.id)
[![Demo Sandbox](https://img.shields.io/badge/Instant_Demo-1--Klik_Login-F59E0B?style=for-the-badge&logo=google-chrome&logoColor=white)](https://safmasjid.web.id)
[![License: MIT](https://img.shields.io/badge/License-MIT-10B981?style=for-the-badge&logo=opensourceinitiative&logoColor=white)](https://opensource.org/licenses/MIT)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Offline PWA](https://img.shields.io/badge/Offline--First-PWA_Zero_CDN-0284C7?style=for-the-badge&logo=pwa&logoColor=white)](https://safmasjid.web.id)

---

## 📖 Mengapa Bernama SAF? (Filosofi & Nilai Inti)

Dalam salat berjamaah, **saf** menggambarkan **keteraturan, kebersamaan, dan kesetaraan**. Setiap orang memiliki tempat dalam satu barisan yang lurus dan rapat, bergerak bersama menuju tujuan yang sama.

> **سَوُّوا صُفُوفَكُمْ، فَإِنَّ تَسْوِيَةَ الصَّفِّ مِنْ تَمَامِ الصَّلَاةِ**  
> *"Luruskan dan rapatkan shaf-shaf kalian, karena sesungguhnya lurus dan rapatnya shaf adalah bagian dari kesempurnaan shalat."*  
> — **H.R. Bukhari No. 723 & Muslim No. 433**

Filosofi kelurusan dan kerapatan shaf ini kami terjemahkan ke dalam **4 Pilar Tata Kelola Masjid Modern**:

```
+-----------------------------------------------------------------------------------------+
|                                    EMPAT PILAR SAF                                      |
+--------------------+--------------------+-----------------------+-----------------------+
|    01. TERTIB      |    02. AMANAH      |     03. BERSAMA       |  04. BERKELANJUTAN    |
| (النِّظَامُ / Nizham) | (الأَمَانَةُ / Amanah) | (الجَمَاعَةُ / Jama'ah)  | (الإِسْتِمْرَارُ / Istimrar)|
+--------------------+--------------------+-----------------------+-----------------------+
| Administrasi,      | Pengelolaan dana   | Pengurus, relawan,    | Pergantian takmir/    |
| keuangan,          | dan aset dilakukan | dan jamaah saling     | pengurus DKM tidak    |
| inventaris, &      | secara transparan, | terhubung dalam satu  | membuat riwayat data  |
| kegiatan tercatat  | akuntabel, dan     | ekosistem digital     | & arsip pengelolaan  |
| dengan rapi.       | bertanggung jawab. | masjid yang inklusif. | masa lalu hilang.     |
+--------------------+--------------------+-----------------------+-----------------------+
```

---

## 🌐 Live Website & Demo Sandbox Instan

- **Domain Utama**: [https://safmasjid.web.id](https://safmasjid.web.id)
- **Mode Layar TV Fullscreen**: [https://safmasjid.web.id/display](https://safmasjid.web.id/display)
- **Portal Transparansi Publik (Zero Login)**: [https://safmasjid.web.id/transparansi](https://safmasjid.web.id/transparansi)
- **Format Rekap Kas Jumat A4**: [https://safmasjid.web.id/laporan/rekap-jumat](https://safmasjid.web.id/laporan/rekap-jumat)
- **Akses Demo 1-Klik**:
  - 👑 **Super Admin**: Masuk via modal sandbox atau URL `/demo-login/superadmin`
  - 💼 **Bendahara**: Masuk via modal sandbox atau URL `/demo-login/admin`
  - 🔑 **Login Manual**: Username: `bendahara` | Password: `Password123`

---

## ✨ Fitur-Fitur Utama

### 1. 📺 Mode Display TV Digital Dinding Masjid
- Tampilan layar penuh (*fullscreen*) otomatis dirancang untuk Smart TV, Android TV Box, atau PC monitor di dinding masjid.
- **Hisab Astronomis Lokal Kemenag RI**: Jadwal 5 waktu salat dihitung otomatis dengan algoritma hisab internal tanpa membutuhkan koneksi internet atau API pihak ketiga.
- Jam digital realtime sinkron dengan tanggal Masehi & Hijriah.
- Indikator salat aktif, hitung mundur iqamah, dan transisi layar saat adzan/iqamah berkumandang.
- Running text dinamis memuat saldo kas, pengumuman Jumat, dan agenda taklim.

### 2. 💰 Mutasi Kas Atomik & Buku Kas Multi-Wadah
- **Multi-Pot Independen**: Memisahkan wadah kas secara terpisah (Kas Umum Operasional, Kas Pembangunan/Renovasi, Kas ZISWAF, dan Kas Santunan Anak Yatim) sehingga dana umat tidak tercampur.
- **Database Mutex Guard**: Menggunakan transaksi atomik database dengan pengecekan saldo runtime untuk menjamin tidak ada selisih pembukuan saat diinput bersamaan.
- Klasifikasi kategori pemasukan dan pengeluaran yang fleksibel.

### 3. 📄 Rekap Cetak Kas Jumat Format A4 (1-Lembar)
- Format cetak khusus yang dirancang presisi untuk selembar kertas A4 tanpa terpotong.
- Memuat saldo awal pekan, seluruh mutasi infaq tromol/kotak amal, belanja operasional, saldo akhir pekan, dan kolom pengesahan tanda tangan Ketua DKM & Bendahara sebelum salat Jumat.

### 4. 🛡️ Portal Transparansi Publik Jamaah (Zero Login)
- Halaman publik terbuka tanpa memerlukan autentikasi login bagi jamaah.
- Dilengkapi grafik interaktif penerimaan dan pengeluaran bulanan menggunakan Chart.js yang dibundel secara lokal.
- Ringkasan posisi saldo amanah per wadah kas dan rincian transaksi terverifikasi.

### 5. 💬 Generator WhatsApp H-2 Muballigh
- Jadwal khatib salat Jumat dan pemateri pengajian terintegrasi.
- Cukup satu klik untuk membuka pesan konfirmasi otomatis yang sopan dan terformat rapi langsung ke nomor WhatsApp ustadz/khatib bersangkutan.

### 6. 📱 Arsitektur 100% Offline-First (Zero CDN PWA)
- **Zero External CDN**: Seluruh stylesheet Bootstrap 5.3, icon font Bootstrap Icons, Inter font, dan Chart.js dibundel lokal ke direktori build aplikasi via Vite.
- **PWA Service Worker**: Dapat diinstal di layar utama smartphone Android/iOS maupun desktop, serta tetap dapat dibuka saat wifi/internet masjid padam.

---

## 🔒 Privasi Data & Keuangan Masjid

SAF adalah **perangkat lunak open source independen**. Demi menjaga privasi dan kenyamanan:
1. Website ini **tidak memuat nomor rekening bank atau QRIS bawaan**.
2. Setiap pengurus masjid yang menginstal aplikasi ini mengatur nomor rekening bank, nama bank, dan gambar QRIS masjid masing-masing secara privat di panel **Pengaturan Sistem**.
3. Seluruh database keuangan tersimpan di server masjid sendiri (atau VPS privat Anda), tanpa ada pertukaran data ke server pusat mana pun.

---

## 🛠️ Tech Stack

| Komponen | Spesifikasi / Paket | Kegunaan |
|----------|---------------------|----------|
| **Backend Framework** | [Laravel 13.x](https://laravel.com/) (PHP ^8.3) | Arsitektur MVC, Eloquent ORM, Database Transactions |
| **Frontend UI** | [Bootstrap 5.3](https://getbootstrap.com/) | Framework tata letak responsif |
| **Asset Pipeline** | [Vite 8.x](https://vitejs.dev/) | Kompilasi CSS & JS lokal bebas CDN |
| **Tipografi** | Plus Jakarta Sans, Inter, Amiri Calligraphy | Tipografi modern & tulisan hadits Arab elegan |
| **Visualisasi Data** | [Chart.js 4.4](https://www.chartjs.org/) | Grafik keuangan publik offline |
| **Database** | SQLite (Default) / MySQL 8.0+ / MariaDB | Penyimpanan data portabel & tangguh |
| **PWA & Offline** | Service Worker v2 (Cache-First / Fallback) | Aplikasi standalone siap offline |
| **Web Server** | Caddy v2 (HTTPS Otomatis) | Reverse proxy aman HTTP/2 & HTTP/3 |

---

## 🚀 Panduan Instalasi Cepat

### Prasyarat Sistem
- **PHP 8.3+** (ekstensi: `bcmath`, `ctype`, `fileinfo`, `json`, `mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `sqlite3` atau `pdo_mysql`)
- **Composer 2.x**
- **Node.js 18+ & NPM**
- **Git**

### Langkah 1: Clone Repositori
```bash
git clone https://github.com/bipisurel-bps/Manajemen-Masjid-.git
cd Manajemen-Masjid-
```

### Langkah 2: Install Dependensi PHP & Frontend
```bash
composer install
npm install
```

### Langkah 3: Konfigurasi Environment & Database
```bash
cp .env.example .env
php artisan key:generate

# Menggunakan SQLite (Rekomendasi Cepat & Portabel):
touch database/database.sqlite
php artisan migrate --seed
```

### Langkah 4: Kompilasi Aset Frontend (Wajib untuk Offline Bundle)
```bash
npm run build
```

### Langkah 5: Jalankan Server Lokal
```bash
php artisan serve
```

Buka `http://localhost:8000` di peramban Anda. Akun demo bawaan:
- **Username**: `bendahara`
- **Password**: `Password123`

---

## 📦 Struktur Folder Penting

```
Manajemen-Masjid-/
├── app/
│   ├── Helpers/             # Helper format Rupiah & tanggal hisab
│   ├── Http/Controllers/    # Controller modul kas, display, jadwal, laporan
│   └── Models/              # Setting, Transaction, CashBook, KhatibSchedule
├── database/
│   ├── migrations/          # Skema database & mutex constraints
│   └── seeders/             # Data awal pengguna & kategori
├── public/
│   ├── build/               # Aset terkompilasi Vite (100% lokal tanpa CDN)
│   ├── manifest.json        # Manifest Progressive Web App
│   └── sw.js                # Service Worker offline-first
├── resources/
│   ├── css/ & js/           # Source styling & interaktivitas
│   └── views/
│       ├── display/         # Mode Layar TV Digital Fullscreen
│       ├── reports/         # Rekap Kas Jumat A4 & Laporan Bulanan
│       ├── transparency/    # Portal Transparansi Publik Jamaah
│       └── home.blade.php   # Landing Page UI/UX Pro Max Edition
└── routes/
    └── web.php              # Definisi rute aplikasi
```

---

## 🤝 Dua Pilihan Implementasi untuk DKM

1. **Jalur Mandiri (100% Bebas & Gratis)**:
   - Unduh kode sumber dari GitHub.
   - Pasang di komputer sekretariat masjid (XAMPP/Docker) atau VPS sendiri.
   - Dikelola mandiri oleh relawan IT masjid.

2. **Jalur Pendampingan Teknis Pengembang**:
   - Cocok bagi DKM yang ingin langsung siap pakai tanpa kendala teknis instalasi server.
   - Bantuan setup nama domain `.web.id` / `.id`, instalasi SSL HTTPS, konfigurasi display TV Android, dan migrasi buku kas lama.

---

## 📧 Kontak & Pengembang

Aplikasi ini dikembangkan dan didedikasikan secara terbuka untuk seluruh umat:

- **Pengembang**: **Jadda Developer**
- **Email Resmi**: [jaddadeveloper@gmail.com](mailto:jaddadeveloper@gmail.com)
- **Domain Resmi**: [https://safmasjid.web.id](https://safmasjid.web.id)
- **Repositori GitHub**: [https://github.com/bipisurel-bps/Manajemen-Masjid-](https://github.com/bipisurel-bps/Manajemen-Masjid-)

---

## 📝 Lisensi

Didistribusikan di bawah **[Lisensi MIT](https://opensource.org/licenses/MIT)**. Bebas digunakan, dipelajari, dimodifikasi, dan disebarluaskan oleh masjid dan mushalla di seluruh dunia tanpa biaya royalti.
