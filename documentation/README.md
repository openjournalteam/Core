# Basic Usage

## Configuration

#### Enabled

key : ```enabled```
default : ```true```

#### middleware

key : ```middleware```
default : ```['web']```

#### path

key : ```path```
default : ```'/panel'```

#### title

key : ```title```
default : ```'Panel'```


## Helpers
#### add_action
```php
add_action(string $name, string $callback, int $priority = 10, int $accepted_args = 1);
```

#### do_action
```php
do_action(string $name, ...$args);
```

#### add_filter
```php
add_filter(string $name, string $callback, int $priority = 10, int $accepted_args = 1);
```

#### apply_filters
```php
apply_filters(string $name, ...$args);
```

#### remove_action
```php
remove_action(string $name, string $callback);
```

#### remove_filter
```php
remove_filter(string $name, string $callback);
```

#### has_action
```php
has_action(string $name);
```

#### has_filter
```php
has_filter(string $name);
```

#### add_style
```php
add_style($href, $async = false);
```

#### add_script
```php
add_script($src, $async = false);
```

#### render
```php
render($view = null, $data = [], $mergeData = [], $template = 'core::template.default');
```

## Facade
#### Add Style
```php
Core::add_style($href, $async = false);
```

#### Add Script
```php
Core::add_script($src, $defer = false);
```


