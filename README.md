# array_aware
php array structure aware lib

Provides a simple (even stupid) interface to work with an array.

Usage
-----

Say, you have an array with relatively deep structure. For example, like this:

```php
$aArray = [
    'a' => [
        'b' => [
            'c' => [
                'd' => [
                    'c' => 'value'
                ]
            ]
        ]
    ]
];
```

Surely you can get value of 'd' key by asking it directly:

```php
$aArray['a']['b']['c']['d'];
```

It's OK but imagine you have to do it in several places (because of legacy for example (of because of prototyping, for example)).
You'd like to work with this array as with object. So you can do withh ArrayAware:

```php
$oArray = new ArrayAware($aArray);
$oArray->get('a/b/c/d'); // gives ['c' => 'value']
$oArray->get('a/b/c/www'); // gives null
```

It's important to remark that it's not a solution to use on a daily base, etc. It's just an example of how to make some difficult case a bit easier to work with.
