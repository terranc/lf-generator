# Lf-generator

## Installation

### Step 1

```shell
composer install terranc/lf-generator --dev
```

### Step 2
Add the following code to your `app/Providers/AppServiceProvider.php` file, within the `root()` method:
```php
if ($this->app->environment() == 'local') {
  $this->app->register(\Lookfeel\Boilerplate\GeneratorCommandServiceProvider::class);
}
```



## Usage
```shell
php artisan app:xxx
```

```
 app
  app:attribute        Create a new attribute traits for model
  app:model            Create a new Eloquent model class with attribute, relationship and scope traits
  app:name             Set the application namespace
  app:relationship     Create a new relationship traits for model
  app:repository       Create a new repository class
  app:scope            Create a new scope traits for model
```
