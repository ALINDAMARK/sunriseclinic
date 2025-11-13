# Run & Preview (local)

Quick steps to run this Laravel app locally and preview the available pages.

1. Install PHP dependencies (run in PowerShell):

```powershell
cd 'c:\Users\EEM\Desktop\SunRiseClinic'
composer install
```

2. Make sure `.env` exists and `APP_KEY` is set. If not, copy `.env.example` and generate a key:

```powershell
cp .env.example .env
php artisan key:generate
```

3. Start Laravel's development server:

```powershell
php artisan serve
```

4. Open these pages in your browser to preview views:

- / -> welcome
- /dashboard -> Dashboard view
- /services -> Services management (now extends `layouts.app`)
- /appointments -> Appointment scheduling
- /doctor-schedule -> Doctor schedule management
- /book -> Patient appointment booking
- /patients -> Patient management

Notes
- Some Blade files still contain full HTML (head/body). I created a shared layout (`resources/views/layouts/app.blade.php`) and refactored `services_management.blade.php` to extend it. Other pages will render as they are (they include their own head). If you want consistent layout across all pages, I can refactor the remaining views to extend the shared layout.

If you run into permission issues on Windows when copying `.env`, do it with PowerShell's Copy-Item command instead.
