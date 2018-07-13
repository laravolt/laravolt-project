# LARAVOLT


## Getting Started

### 1. Symlink assets (css, js, icons, dll) dari laravolt/ui ke folder `public`

- Jalankan perintah `php artisan laravolt:link-assets`


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
