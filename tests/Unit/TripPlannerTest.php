<?php

use Isti\TripPlanner\Calculators\CalculateWithTopologicalSort;
use Isti\TripPlanner\TripPlanner;
use Isti\TripPlanner\Writers\StringReturn;

beforeEach(function () {
    $this->planner = new TripPlanner(new CalculateWithTopologicalSort(), new StringReturn());
});

describe('TripPlanner input - output', function () {
    it('can be instantiated', function () {
        expect($this->planner)->toBeInstanceOf(\Isti\TripPlanner\TripPlanner::class);
    });

    it('has a method to calculate the optimal route', function () {
        expect($this->planner)->toHaveMethod('calculateOptimalRoute');
    });
});

describe('TripPlanner route calculation', function () {
    it('can calculate the optimal route for a simple trip', function (array $locations, string $expected) {
        expect($this->planner->calculateOptimalRoute($locations))->toBe($expected);
    })->with([
        '1 destination without dependencies' => [['x' => '',], 'x'],
        '2 destinations with dependency' => [['x' => 'y', 'y' => '',], 'yx'],
        '3 destinations with dependency' => [['x' => '', 'y' => 'z', 'z' => '',], 'xzy'],
        '6 destinations with multiple dependency' => [
            ['u' => '', 'v' => 'w', 'w' => 'z', 'x' => 'u', 'y' => 'v', 'z' => '',], 'uzwvxy'
        ],
    ]);
});

describe('Exception handling', function () {
    it('throws an exception when the locations array is empty', function () {
        $this->planner->calculateOptimalRoute([]);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);

    it('throws an exception when the locations array contains invalid dependencies', function () {
        $this->planner->calculateOptimalRoute(['x' => 'y']);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);

    it('throws an exception when the location hase multiple dependencies', function () {
        $this->planner->calculateOptimalRoute(['x' => ['y', 'z']]);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);

    it('throws an exception when the locations has cross reference', function () {
        $this->planner->calculateOptimalRoute(['x' => 'y', 'y' => 'x']);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);
});
