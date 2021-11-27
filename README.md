# Laravel demo app
## Translations
Russian: [русский перевод](docs/translations/readme/rus.md)
## Tech stack and methods
Laravel 6. PHP 7. JavaScript. HTML. CSS.</br>
MVC. SOLID. REST API. DRY.</br>
## About
Briefly, it's a responsive web page with a simple limited comment filter.</br></br>
You can just start typing a name of comment author into the filter, a result is got imediately.</br>
A set of comments is already there.</br>
## What's inside
- Eloquent ORM (related User and Comment models)
- Database migrations and seeders
- An API to extract user and comment data (using controllers)
- A Blade template
- Local query scopes, middleware
- HTTP requests via JS, no web page reloading
- A responsive web design of a web page
## Installation
**It needs PHP 8** (that seems to be an internal Laravel 6 (or Homestead v10.17.0) error).</br>
Here I assume a working environment is already set (including Laravel and database).</br>
1. Run migrations :
```sh
php artisan migrate
```
2. Fill database tables : 
```sh
composer dump-autoload
php artisan db:seed
```
## Note
Made with Homestead v10.17.0.