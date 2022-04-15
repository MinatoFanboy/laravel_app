# Laravel app

- Create database on localhost
- Install modules
- Rename file **.env.example** to **.env**
```bash
composer install
```

```link storage
php artisan storage:link
```

```create migrate model
php artisan make:model Slider --migration
```

```create migrate controller
php artisan make:controller Admin\SliderController
```