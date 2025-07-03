# Laravel Schedule Blocker

**Disables Laravel scheduled commands in the local environment.**

This package automatically prevents any scheduled tasks from being executed when your application is running in the `local` environment. Ideal for development, when heavy scheduled jobs can slow down your work or interfere with testing.

---

## 🚀 Installation

```bash
  composer require nnovosad19/laravel-schedule-skippper --dev
```

## Publishing Configuration File:
Publish the schedule skipper configuration file:

```php artisan vendor:publish --tag=schedule-skipper```

## Optional Configuration
You can customize the following settings in the schedule-skipper configuration file (config/schedule-skipper.php):

- **env**: Environment to schedule skipper (default: local).
