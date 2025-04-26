## 📦 Deskripsi Project

Project ini adalah aplikasi manajemen **inventory** dan **sales** sederhana yang dibangun untuk keperluan test interview.  
Fitur-fitur utamanya meliputi:

-   Pengelolaan **master data** item (nama item, harga, stock, SKU, dll).
-   Proses **transaksi sales** dan pembuatan **invoices**.
-   **Laporan penjualan** yang bisa difilter berdasarkan harian, mingguan, atau bulanan.
-   **QR Code** pada SKU untuk mempermudah pencarian dan scan item.

## 🛠️ Teknologi yang Digunakan

-   **Backend**: Laravel
-   **Frontend**: React.js (khusus untuk halaman transaksi dan scan QR code)
-   **Database**: MySQL
-   **QR Code Generator & Scanner**: Package QR Laravel + React QR Reader

## ⚙️ Cara Install

```bash
git clone https://github.com/abayzv/clinic-app-interview.git clinic-app
cd clinic-app
composer setup
```

![Laravel](https://img.shields.io/badge/Laravel-12-red)
![React](https://img.shields.io/badge/React-19-blue)
![MySQL](https://img.shields.io/badge/MySQL-8-orange)
