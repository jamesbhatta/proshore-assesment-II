##  Proshore - Assesment
It is an assesment provided by Proshore Nepal to James Bhatta.

### Installation
```bash
git clone https://github.com/jamesbhatta/proshore-assesment-II.git
```

```bash
cd proshore-assesment-II
```

```bash
composer install
```

```bash
cp .env.example .env
```

Generate application keys:
```bash
php artisan key:generate
```

Now, set the environment variables in ``` .env ``` file .

Make sure you have configured database details.

Now migrate  database using:

```bash
php artisan migrate 
```

Seed the database with some defaults values:
```bash
php artisan db:seed
```
Optionally you can migrate and seed in single command: ```php artisan migrate --seed``` . This command will first migrate the database and then run the `DatabaseSeeder` class , which will be used to call other seed classes. 