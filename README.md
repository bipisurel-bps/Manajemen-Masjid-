# 🕌 Manajemen Masjid

Sistem informasi manajemen masjid berbasis web — solusi _all-in-one_ untuk pengelolaan keuangan, jadwal kegiatan, dan data pengurus masjid.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-4.x-FF6384?logo=chartdotjs&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green)

---

## ✨ Fitur Utama

### 📊 Dashboard Admin
- Ringkasan pemasukan, pengeluaran, saldo, dan total transaksi
- Grafik pemasukan & pengeluaran per bulan (Chart.js)
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
- Tema tampilan (warna primer, secondary, dll.)

### 🔐 Profil Admin
- Edit nama, username, email
- Ubah password (dengan verifikasi password lama)

### 🌐 Halaman Publik
- **Home** — landing page menampilkan informasi masjid
- **Laporan Keuangan** — transparansi keuangan masjid
- **Jadwal Khatib** — jadwal khatib Jumat
- **Jadwal Pengajian** — jadwal pengajian rutin
- **Kontak** — informasi kontak masjid
- Registrasi & Login

### 📱 PWA (Progressive Web App)
- Dapat diinstal di smartphone
- Ikon & splash screen
- Service worker untuk offline support

---

## 🚀 Instalasi

### Prasyarat
- **PHP 8.2+** dengan ekstensi: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML, SQLite (atau MySQL)
- **Composer 2.x**
- **Node.js 18+** (untuk asset building — opsional)
- **SQLite** (default) atau **MySQL 5.7+ / MariaDB 10.3+**

### Langkah Instalasi

```bash
# 1. Clone repository
git clone https://github.com/bipisurel-bps/Manajemen-Masjid-.git
cd Manajemen-Masjid-

# 2. Install dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di .env
# SQLite (default, langsung pakai):
#   DB_CONNECTION=sqlite
#   DB_DATABASE=/path/ke/database/database.sqlite
#
# MySQL:
#   DB_CONNECTION=mysql
#   DB_HOST=127.0.0.1
#   DB_PORT=3306
#   DB_DATABASE=masjid_db
#   DB_USERNAME=root
#   DB_PASSWORD=secret

# 6. Buat file database SQLite (jika pakai SQLite)
touch database/database.sqlite

# 7. Jalankan migrasi
php artisan migrate

# 8. Seed data awal (opsional)
php artisan db:seed

# 9. Build asset (opsional — untuk production)
npm install && npm run build

# 10. Jalankan development server
php artisan serve
```

### ⚡ Quick Start (SQLite)

```bash
cp .env.example .env
sed -i 's/DB_CONNECTION=.*/DB_CONNECTION=sqlite/' .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
php artisan serve
```

Buka `http://localhost:8000` — registrasi akun pertama Anda melalui halaman `/register`.

---

## 🗃️ Struktur Database

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Pengguna sistem (admin, superadmin) |
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
| **Super Admin** | Full access — kelola pengguna, semua konten, pengaturan sistem |
| **Admin** | Kelola transaksi, buku kas, kategori, jadwal, profil sendiri |

---

## 📸 Screenshot

### Dashboard Admin
Dashboard menampilkan ringkasan keuangan, grafik pemasukan/pengeluaran bulanan (Chart.js), dan daftar transaksi terbaru.

### Transaksi
Form transaksi lengkap dengan pilihan buku kas, kategori, tanggal, jenis (pemasukan/pengeluaran), dan deskripsi.

### Laporan Publik
Halaman laporan keuangan publik untuk transparansi — dapat difilter per buku kas dan bulan/tahun.

### Jadwal Kegiatan
Halaman publik menampilkan jadwal khatib Jumat dan jadwal pengajian rutin.

---

## 🛠️ Tech Stack

| Teknologi | Penggunaan |
|-----------|------------|
| **[Laravel 11](https://laravel.com/)** | Backend framework |
| **[Bootstrap 5.3](https://getbootstrap.com/)** | UI framework |
| **[Chart.js 4](https://www.chartjs.org/)** | Grafik dashboard |
| **[Bootstrap Icons](https://icons.getbootstrap.com/)** | Icon set |
| **[Inter](https://rsms.me/inter/)** | Font utama |
| **[SQLite](https://sqlite.org/) / MySQL** | Database |

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

## 📧 Kontak

Dibuat dengan ❤️ untuk kemajuan manajemen masjid Indonesia.

**Bipi Surel** — [GitHub](https://github.com/bipisurel-bps)
