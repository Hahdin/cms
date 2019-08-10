
```bash
#make auth
php artisan make:auth

# make our model framework and db tables
php artisan make model Post -m
php artisan make model Category -m

# remember to setup your .env file for the database
# run migrations
php artisan migrate

# make request classes
php artisan make:request CreatePostRequest
php artisan make:request UpdatePostRequest
php artisan make:request CreateCategoryRequest
php artisan make:request UpdateCategoryRequest


add FILESYSTEM_DRIVER to your .env file and set to public for storing post images


php artisan storage:link
# The [public/storage] directory has been linked.
```

## error with trix editor tool bar not working

In the layout page (app.blade.php) move the main app script to the bottom from the header and remove the `defer` flag

```php
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
```

