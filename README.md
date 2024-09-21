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

### Postman Collection https://www.postman.com/winter-moon-426614/workspace/library/collection/25778733-a236682d-0e4b-4759-8518-22709533f8e9?action=share&creator=25778733
