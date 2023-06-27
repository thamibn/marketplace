# marketplace
A basic marketplace POC for Ringier SA challenge test

Step to install

1. run the below commands to install sail and it will run composer install
```
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php82-composer:latest \
composer install --ignore-platform-reqs
```

2. CD to your project and run the following commands

```
1. ./vendor/bin/sail up -d`

2. ./vendor/bin/sail npm install

3. ./vendor/bin/sail artisan migrate --seed

4. ./vendor/bin/sail npm run dev

```
access the site on 127.0.0.0:8000

