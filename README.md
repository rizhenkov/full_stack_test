## Fresh deployment

`composer install` (`--no-dev` flag for production)

`php artisan migrate:fresh --seed`

## Run on dev

`php artisan serve`

+ Autocompiling assets: `npm run watch`

## Password change

`php artisan tinker`

```php
$user = App\Models\User::find(1);
$user->password = Hash::make('new-password');
$user->save();
```
