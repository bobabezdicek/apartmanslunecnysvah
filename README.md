# Apartmán Slunečný Svah

Web apartmánu Slunečný Svah ve Špindlerově Mlýně. Obsahuje českou a anglickou verzi, fotogalerii, kontaktní formulář, rezervační widget a rozpracovanou administraci.

## Požadavky

- PHP 8.3 nebo novější a Composer
- Node.js 20.19+ nebo 22.12+ a npm
- SQLite (výchozí databáze)

## Lokální spuštění

```bash
git clone https://github.com/bobabezdicek/apartmanslunecnysvah.git
cd apartmanslunecnysvah
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan storage:link
npm ci
npm run build
php artisan serve
```

Při spuštění přes `php artisan serve` nastavte v `.env` hodnotu `APP_URL=http://localhost:8000`. Web je dostupný také na `/cs` a `/en`. Pro průběžnou kompilaci stylů a JavaScriptu spusťte v dalším terminálu `npm run dev`.

Výchozí `.env.example` používá lokální domény `nakladal.test` a `admin.nakladal.test`. Pro jejich použití nastavte lokální webový server s kořenem v adresáři `public` a odpovídající DNS nebo hosts záznamy. Doménu administrace určuje `ADMIN_DOMAIN`.

## Konfigurace a obsah

- Překlady: `lang/cs/site.php` a `lang/en/site.php`.
- Fotografie a jejich pořadí: `config/site_media.php`; úvodní stránka má také vlastní mapu fotografií v `resources/views/welcome.blade.php`.
- Fotografie používané webem: `storage/app/public/lovable`. Příkaz `php artisan storage:link` je zpřístupní přes `public/storage`.
- E-mail: proměnné `MAIL_*` v `.env`. Výchozí ovladač `log` zapisuje zprávy pouze do lokálního logu; skutečné odesílání vyžaduje konfiguraci poštovní služby.
- Administrace je rozpracovaná a aktuální routy nevyžadují přihlášení. Před veřejným nasazením ji zabezpečte nebo omezte přístup.

## Ověření

```bash
php artisan test
npm run build
```

## Obsah repozitáře

Repozitář obsahuje zdrojové soubory, testy, migrace, používané fotografie, vzor konfigurace a soubory s uzamčenými verzemi závislostí. Skutečný `.env`, databáze, logy, cache, lokální nastavení editoru, závislosti `vendor` a `node_modules`, výstupy sestavení a nepoužité varianty fotografií se neukládají do Gitu.
