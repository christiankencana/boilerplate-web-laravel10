# Boilerplate Aplikasi Web dengan Laravel 10

## Deskripsi

Boilerplate aplikasi web ini dikembangkan oleh Christian Kencana dengan tujuan untuk memudahkan pekerjaan para developer yang menggunakan **Laravel 10**. Dengan menyediakan fondasi yang sudah siap pakai, boilerplate ini mempercepat proses pengembangan sehingga Anda dapat lebih fokus pada pembuatan fitur utama, tanpa harus menghabiskan waktu untuk tugas-tugas setup yang berulang.

Boilerplate ini mencakup fitur-fitur penting yang sering dibutuhkan dalam aplikasi web, seperti:
- **Datatables**
- **Autentikasi**
- **Routing**
- **Manajemen Pengguna**

Aplikasi ini menggunakan Database SQLITE3 (Install SQLITE Viewer for Desktop untuk management SQLITE3 dengan mudah). Semua fitur tersebut sudah terintegrasi dan siap digunakan. Desainnya dibuat fleksibel, sehingga dapat disesuaikan dengan berbagai kebutuhan proyek, baik untuk aplikasi sederhana maupun sistem yang lebih kompleks.

## Fitur Utama

- **Struktur Aplikasi Solid**: Menyediakan struktur aplikasi yang rapi dan mudah dikelola.
- **Datatables Terintegrasi**: Memudahkan Anda dalam menampilkan data dalam tabel interaktif.
- **Autentikasi Pengguna**: Sistem login dan registrasi sudah tersedia, termasuk manajemen hak akses.
- **Manajemen Pengguna**: Pengelolaan pengguna dalam aplikasi mudah dilakukan dengan fitur yang sudah ada.
- **Routing Fleksibel**: Mudah untuk mengatur routing sesuai dengan kebutuhan aplikasi.

## Harapan

Saya berharap dengan adanya boilerplate ini, sesama developer dapat menghemat waktu dan tenaga dalam pengembangan proyek mereka, serta memiliki struktur aplikasi yang solid dan mudah dikelola sejak awal.

Terima kasih telah memilih boilerplate ini, dan semoga dapat membantu Anda dalam membangun aplikasi dengan lebih cepat dan efisien.

## Instalasi

Untuk memulai menggunakan boilerplate ini, Anda dapat mengikuti langkah-langkah berikut:

1. **Clone repository ini**:
   ```bash
   git clone https://github.com/christiankencana99/boilerplate-laravel.git
   ```

2. **Masuk ke direktori proyek:**:
   ```bash
   cd boilerplate-laravel
   ```

3. **Install dependensi menggunakan Composer:**:
   ```bash
   composer install
   ```

4. **Setup Project menggunakan :**:
   ```bash
   php artisan key:generate
   php artisan storage:link
   ```

5. **Set konfigurasi Database**:
    Ubah konfigurasi database di file .env sesuai dengan pengaturan Anda.

6. **Set Migrasi Data**:
    Gunakan script dibawah ini, jika saat inisiasi aplikasi pertama kali.
   ```bash
    php artisan migrate
   ```

    Gunakan script dibawah ini, jika ada perubahan di database.
   ```bash
    php artisan migrate:fresh --seed
   ```

7. **Perubahan Aplikasi**:
    Untuk mengubah nama aplikasi, buka file .env, pada bagian ini ubah :
    ```bash
        APP_NAME="Boilerplate Laravel"
    ```
    Ganti nama Aplikasinya sesuai kebutuhan.

    Saat ada perubahan di aplikasi, gunakan :
    ```bash
        php artisan optimize
    ```   

8. **Jalankan aplikasi:**:
    Aplikasi dapat dijalankan menggunakan server built-in Laravel 10. Selain itu, dapat menggunakan :
    ```bash
    php artisan serve
    php artisan serve --port 8000
    php artisan serve --host {{ IP_ADDRESS }} --port {{ NO_PORT }}
    ```

## Kontribusi

Jika ada pertanyaan atau masukan, jangan ragu untuk menghubungi saya di:
Email: christiankencana99@gmail.com

Terima kasih telah menggunakan boilerplate ini. Semoga proyek Anda berjalan lancar!

## License

[MIT](https://choosealicense.com/licenses/mit/)