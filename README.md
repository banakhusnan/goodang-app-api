<h1 align="center">Goodang</h1>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/badge/Laravel-v11.0.7-orange?logo=Laravel&logoColor=orange" alt="Latest Stable Version"></a>
<a href="https://www.php.net/releases/8.3/en.php"><img src="https://img.shields.io/badge/php-version_>=_8.2-blue?logo=php&logoColor=rgb(255%2C255%2C255)" alt="PHP Version"></a>
</p>

## Tentang Goodang

Goodang merupakan aplikasi untuk merekap data gudang pada suatu toko. Aplikasi ini dikembangkan menggunakan infrastruktur <b>microservice</b>. Berikut beberapa teknologi yang digunakan, yaitu:

```
$summary = [
    'version-app' => '1.0',
    'Laravel' => [
        'version' => '11',
        'Authentication' => 'Sanctum'
    ],
];
```

## Instalasi

Apabila ingin mencoba install aplikasi ini, `clone` terlebih dahulu project ini

```
git clone https://github.com/banakhusnan/goodang-app-api.git
```

Setelah diduplikasi, install terlebih dahulu folder vendor.

```
composer install
```

Kemudian buat file env dengan meng-copy dari file `.env.example` dengan nama `.env`

```
cp .env.example .env
```

Setelah dicopy, isi `APP_KEY` pada file `.env`

```
php artisan key:generate
```

Kemudian hubungkan ke database.

```
DB_CONNECTION=mysql (choose your SQL: sqlite, mongodb, mysql, etc)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=goodang_server
DB_USERNAME=root
DB_PASSWORD=your_password
```

Kemudian konfigurasi juga bagian autentikasi, supaya ketika ingin mengecek yang login tanpa harus menggunakan `guard('api')`

```
AUTH_GUARD="api"
```

## Lisensi

Project ini bersifat open-source, karena project ini menjadi project latihan saya mengenai Rest API. Jangan lupa kasih star pada project kami hehe.

**HAPPY CODING :D**
