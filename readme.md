# LARAVOLT

Laravolt adalah platform untuk mengembangkan aplikasi berbasis web. Tujuan yang hendak dicapai adalah:

1. Mempercepat proses development
2. Meningkatkan happiness index programmer
3. Mengurangi barrier to entry bagi programmer baru

Untuk mencapai tujuan di atas, Laravolt menyediakan:

1. Package yang _ready to use_: authentication, user management, CMS, form builder, table builder, admin panel, settings, dan lain-lain.
2. Coding guideline, sehingga setiap programmer yang terlibat punya kerangka berpikir yang sama. Hal ini diperlukan agar programmer bisa saling membantu satu sama lain dengan cepat.

## Instalasi

### 0. Setup
Jalankan perintah `composer create-project laravolt/laravolt` untuk membuat proyek baru, ubah isi file `.env` sesuai dengan konfigurasi masing-masing.

### Jalankan Migration


### 1. Symlink assets (css, js, icons, dll)

- Jalankan perintah `php artisan laravolt:link-assets`

Langkah ini perlu dilakukan agar aset-aset yang dibutuhkan untuk menampilkan halaman admin bisa diakses oleh publik. Dibalik layar, perintah ini akan melakukan `copy/symlinks` dari laravolt/ui ke folder `public`

### 2. Ubah redirect route ketika mengakses halaman yang butuh autentikasi

- Tambahkan potongan kode berikut ke file `app/Exceptions/Handler.php`:

```php
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $request->expectsJson()
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest(route('auth::login'));
    }
```

## FAQ

### ENUM
Kenapa key dan value harus sama?
Translation

### Upload File
Laravel media-library

### Maipulasi Gambar
intervention/image

### Baca Tulis Excel
box/spout

### Export to PDf


### Semantic UI Form Builder
laravolt/semantic-form


### Suitable Table Builder
laravolt/suitable

### Avatar Generator
laravolt/avatar

### Struktur Tree
nested-set