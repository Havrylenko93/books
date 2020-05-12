##books (5.6 was chosen only for Nova)

**Postman documentation:**

https://documenter.getpostman.com/view/2570046/Szme4dEo?version=latest


####Installation
requirements:
- PHP >= 7.1
- MySQL >= 5.7
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- JSON PHP Extension

Directories within the  `storage` and the `bootstrap/cache` directories should be writable by your web server or Laravel will not run.

Create and fill .env file (example look in .env.example) than run these commands in root folder: 

```
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
php artisan db:seed
```

IDE helper

``php artisan ide-helper:generate``
