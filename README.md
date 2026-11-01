# 🕌 Manajemen Masjid — Al-Masjid

Sistem informasi manajemen masjid berbasis web — solusi _all-in-one_ untuk pengelolaan keuangan, jadwal ibadah & dakwah, mode display monitor TV, dan portal transparansi jamaah yang dirancang handal, aman, dan 100% siap offline (PWA).

🌐 **Live Website / Demo**: [https://almasjid.web.id](https://almasjid.web.id)  
👨‍💻 **Developer**: **jaddadeveloper**  
📧 **Email**: [jaddadeveloper@gmail.com](mailto:jaddadeveloper@gmail.com)

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-8.x-646CFF?logo=vite&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?logo=chartdotjs&logoColor=white)
![Developer](https://img.shields.io/badge/Developer-jaddadeveloper-blue)
![License](https://img.shields.io/badge/License-MIT-green)

---

## ✨ Fitur Utama

### 📊 Dashboard Admin
- Ringkasan pemasukan, pengeluaran, saldo, dan total transaksi
- Grafik pemasukan & pengeluaran per bulan (Chart.js dibundle lokal)
- Tabel transaksi terbaru

### 💰 Manajemen Transaksi
- Catat **pemasukan** (infaq, zakat, donasi, dll.) dan **pengeluaran** (operasional, renovasi, dll.)
- Klasifikasi transaksi berdasarkan **Buku Kas** dan **Kategori**
- Filter, pencarian, dan pagination
- Export data siap cetak

### 📒 Buku Kas _(Cash Book)_
- Beberapa buku kas independen dalam satu masjid (Kas Umum, Kas Ramadhan, dll.)
- Saldo per buku kas terpisah
- Status aktif/nonaktif

### 🏷️ Kategori Transaksi
- Kategori khusus **pemasukan** dan **pengeluaran**
- Kategori per buku kas (multi-tenant ringan)
- Fleksibel — admin bebas menambah/menghapus

### 📋 Jadwal Kegiatan
- **Jadwal Khatib Jumat** — nama khatib, tanggal, tema khutbah
- **Jadwal Pengajian** — ustadz/pemateri, topik, waktu, lokasi

### 📈 Laporan Keuangan (Publik)
- **Laporan Umum** — tabel pemasukan & pengeluaran dengan filter bulan/tahun
- **Laporan Bulanan** — ringkasan 12 bulan dalam satu tahun
- **Laporan per Kategori** — breakdown anggaran per kategori

### 👥 Manajemen Pengguna
- Multi-user dengan 2 role: **Admin** dan **Super Admin**
- Super Admin bisa menambah/menghapus pengguna
- Admin hanya mengelola konten
- Registrasi terbuka via halaman publik (opsional)

### ⚙️ Pengaturan Masjid
- Nama masjid, alamat, deskripsi
- Kontak (telepon, email, media sosial)
- Pengaturan identitas dan informasi operasional

### 🔐 Profil Admin
- Edit nama, username, email
- Ubah password (dengan verifikasi password lama)

### 🌐 Halaman Publik
- **Home** — landing page menampilkan ringkasan keuangan dan informasi masjid
- **Laporan Keuangan** — transparansi keuangan masjid untuk jamaah
- **Jadwal Khatib** — jadwal khatib Jumat mendatang
- **Jadwal Pengajian** — jadwal majelis taklim & kajian rutin
- **Kontak** — alamat dan kanal komunikasi masjid
- Registrasi & Login petugas

### 📱 PWA (Progressive Web App) & 100% Offline Ready
- Dapat diinstal di smartphone (Android/iOS) dan desktop
- Ikon & splash screen terintegrasi
- **Zero CDN Dependency**: Bootstrap 5.3, Bootstrap Icons font, dan Chart.js dibundle lokal via Vite
- Service Worker cerdas (Cache-First untuk bundle ter-hash, Network-First dengan cache fallback untuk navigasi, dan halaman fallback offline khusus)

---

## 🚀 Instalasi & Menjalankan

### Prasyarat
- **PHP 8.3+** dengan ekstensi: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, SQLite (atau MySQL)
- **Composer 2.x**
- **Node.js 18+ & NPM** (untuk build Vite asset pipeline)
- **SQLite** (default, siap pakai tanpa konfigurasi server DB terpisah) atau **MySQL 8.0+ / MariaDB 10.4+**

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/bipisurel-bps/Manajemen-Masjid-.git
cd Manajemen-Masjid-

# 2. Install dependensi PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Database (Default: SQLite)
# Buat file database SQLite jika belum ada:
touch database/database.sqlite

# 6. Jalankan migrasi database
php artisan migrate

# 7. Seed data awal (opsional)
php artisan db:seed

# 8. Install dependensi frontend & build asset (Wajib untuk bundle lokal & offline PWA)
npm install
npm run build

# 9. Jalankan development server
php artisan serve
```

### ⚡ Quick Start (SQLite)

```bash
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan serve
```

Buka `http://localhost:8000` di browser Anda — registrasi akun pertama Anda melalui menu login / registrasi.

---

## 🗃️ Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Pengguna sistem (Admin, Superadmin) |
| `cash_books` | Buku kas — wadah keuangan terpisah |
| `categories` | Kategori pemasukan/pengeluaran per buku kas |
| `transactions` | Semua transaksi keuangan (pemasukan & pengeluaran) |
| `khatibs` | Data khatib (nama, kontak) |
| `khatib_schedules` | Jadwal khatib Jumat |
| `pengajian_schedules` | Jadwal pengajian rutin |
| `settings` | Pengaturan aplikasi (key-value dengan cache) |

---

## 🔒 Role Pengguna

| Role | Hak Akses |
|------|-----------|
| **Super Admin** | Akses penuh — kelola akun pengguna, transaksi, semua buku kas, pengaturan sistem |
| **Admin** | Kelola transaksi, buku kas, kategori, jadwal, dan profil akun sendiri |

---

## 🛠️ Tech Stack Aktual

| Teknologi | Versi | Penggunaan |
|-----------|-------|------------|
| **[Laravel](https://laravel.com/)** | 13.x | Backend Framework (PHP ^8.3) |
| **[Bootstrap](https://getbootstrap.com/)** | 5.3.x | UI Framework (Bundled via NPM & Vite) |
| **[Bootstrap Icons](https://icons.getbootstrap.com/)** | 1.11.x | Icon Set (Font offline lokal via Vite) |
| **[Chart.js](https://www.chartjs.org/)** | 4.4.x | Grafik Interaktif Dashboard (Offline Bundle) |
| **[Vite](https://vitejs.dev/)** | 8.x | Frontend Asset Bundler & Compiler |
| **[Inter Font](https://fontsource.org/fonts/inter)** | 5.x | Tipografi Lokal Bebas CDN |
| **[SQLite](https://sqlite.org/)** | 3.x | Database Default (Praktis, Ringan, Portabel) |
| **Service Worker / PWA** | v2 | Standalone Web App dengan Cache Offline & Fallback |

---

## 🤝 Kontribusi

1. Fork repository ini
2. Buat branch fitur (`git checkout -b fitur-keren`)
3. Commit perubahan (`git commit -m 'Tambah fitur keren'`)
4. Push ke branch (`git push origin fitur-keren`)
5. Buat Pull Request

---

## 📝 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

## 📧 Kontak & Pengembang

Aplikasi ini dikembangkan dan dikelola oleh:
- **Pengembang**: **Jadda Developer**
- **Email**: [jaddadeveloper@gmail.com](mailto:jaddadeveloper@gmail.com)
- **Domain Resmi**: [https://almasjid.web.id](https://almasjid.web.id)
- **Repository**: [https://github.com/bipisurel-bps/Manajemen-Masjid-](https://github.com/bipisurel-bps/Manajemen-Masjid-)

Dibuat dengan ❤️ untuk kemajuan tata kelola dan transparansi masjid di seluruh Indonesia.
