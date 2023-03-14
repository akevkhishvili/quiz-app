### Requirements

- php 8.1+
- composer
- mysql 8+
- node.js 18+

### Installation On Localhost

1. cd to project folder
2. open terminal/powershell and run commands
3. install composer
```bash
composer install
```
4. copy .env.example to .env
```bash
cp .env.example .env
```
5. generate app key
```bash
php artisan key:generate
```
6. create database
```bash
mysql -u db_user_name -p
```

```mysql
CREATE DATABASE quiz_app;
```
7. migrate database tables
```bash
php artisan migrate:fresh --seed
```
8. install javascript packages
```bash
npm install
```
9. run vite server
```bash
npm run dev
```
10. run project server
```bash
php artisan serve
```

11. start task scheduler

```bash
php artisan schedule:work

```

### Testing

1. create database for testing:
```bash
mysql -u db_user_name -p
```

```mysql
CREATE DATABASE quiz_app_testing;
```

```bash
php artisan test
```

### Admin User credentials for testing web page
>- user: ***admin@example.com***
>- password: ***admin***

### User credentials for testing web page
>- user: ***user@example.com***
>- password: ***user***
