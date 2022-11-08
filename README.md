<h1 align="center">
SISI ARLOJI
</h1>
<p align="center">Website pemesanan sisi arloji Laravel 9.x</p>

## Installation

Laravel 9.x menggunakan PHP versi 8.0. Jadi kalau belum update dulu. Lalu pastikan sudah menginstal composer.

1. Clone repository taroh ditempat yang di inginkan saran tempat di c:/xampp/htdocs/sisiarloji, bisa di download .zip atau dengan perintah git clone seperti ini

```
git clone https://github.com/Lukman08/sisiarloji.git
```

2. Masuk ke folder projek yang sudah di clone, klik kanan git bash here


lalu instal composer

```
composer install
```

3. kemudian ketik perintah 

```
code .
```
untuk membuka projek di vs code


Copy `.env.example` kemudian rename menjadi `.env`. Edit pengaturan database di file `.env`, juga masukkan perintah ini untuk mengisi `APP_KEY`

```
php artisan key:generate
```

<!-- 4. Migrasi tabelnya ke database dengan perintah

```
php artisan migrate
```

Lalu masukkan perintah berikut untuk insert beberapa data ke database

```
php artisan db:seed
``` -->

4. Siap dijalankan...
```
php artisan serve
```

<!-- <p align="center">Apabila memerlukan database sqldump, file bernama prognet8.sql</p> -->

## Contributing

1. Jika sudah di clone, pull dulu repository ini dengan perintah berikut, supaya dapat editan terbaru

```
git init
```

```
git remote add origin https://github.com/Lukman08/sisiarloji.git
```

```
git pull https://github.com/Lukman08/sisiarloji.git
```

2. Edit projek sesuai keinginan
3. Kalau sudah diedit, push kembali seperti perintah berikut

```
git add .
```

```
git commit -m "pesan perubahan"
```

```
git push origin master
```


## Kelompok 4 - D4RPL3 - 2022
