### Steps 

```bash
git clone https://github.com/DevMohamedEmad/library.git 
```
```bash
cd library/library 
```
```bash
cp .env.example .env
```
- Add your environmental variables into .env file
  
Install dependencies
```bash
composer install
```

Generate laravel unique key
```bash
php artisan key:generate
```


Running migrations
```bash
php artisan migrate
```

Running seeders
```bash
php artisan db:seed
```

start server
```bash
php artisan serve
```
