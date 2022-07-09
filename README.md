# Fruit and Vegetables

## Goal
We want to build a service which will take a `request.json` and:
* Process the file and create two separate collections for `Fruits` and `Vegetables`
* Each collection has methods like `add()`, `remove()`, `list()`;
* Units have to be stored as grams;
* As a bonus you might consider giving option to decide which units are returned (kilograms/grams);
* As a bonus you might consider how to implement `search()` method collections;

## Approach
To use Declarative instead of Imperative wherever possible.

Imperative;
```php
function getUserEmails($users)
{
    $emails = [];
    
    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];
        
        if ($user->email !== null) {
            $emails[] = $user->email;
        }
    }

    return $emails;
}
```
Declarative;
```php
$users->filter(fn($item) => $item->email !== null);
```
