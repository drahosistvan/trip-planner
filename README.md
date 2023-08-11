# Trip planner
Software Developer homework

## How to run
1. Clone the repository
2. Run `composer install`
3. Initialize the `TripPlanner` class with a Calculator and a Writer
4. Call `calculateOptimalRoute` method with the input data

## How to run tests
1. Clone the repository
2. Run `composer install`
3. Run `./vendor/bin/pest`

## Example code
```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use Isti\TripPlanner\TripPlanner;
use Isti\TripPlanner\Calculators\CalculateWithTopologicalSort;
use Isti\TripPlanner\Writers\StringReturn;

$locations = [
    'u' => '',
    'v' => 'w',
    'w' => 'z',
    'x' => 'u',
    'y' => 'v',
    'z' => '',
];

$tripPlanner = new TripPlanner(new CalculateWithTopologicalSort(), new StringReturn());

$tripPlanner->calculateOptimalRoute($locations);
//this returns the following string: uzwvxy
```
