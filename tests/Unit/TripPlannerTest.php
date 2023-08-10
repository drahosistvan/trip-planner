<?php

describe('TripPlanner input - output', function () {
    it('can be instantiated', function () {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner(['x' => '']);
        expect($tripPlanner)->toBeInstanceOf(\Isti\TripPlanner\TripPlanner::class);
    });

    it('has a method to calculate the optimal route', function () {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner(['x' => '']);
        expect($tripPlanner->calculateOptimalRoute())->toBeString();
    });
});

describe('TripPlanner route calculation', function () {
    it('can calculate the optimal route for a simple trip', function (array $locations, string $expected) {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner($locations);
        expect($tripPlanner->calculateOptimalRoute())->toBe($expected);
    })->with([
        [
            [
                'x' => '',
            ],
            'x',
        ],
        [
            [
                'x' => 'y',
                'y' => '',
            ],
            'yx',
        ],
        [
            [
                'x' => '',
                'y' => 'z',
                'z' => '',
            ],
            'xzy',
        ],
        [
            [
                'u' => '',
                'v' => 'w',
                'w' => 'z',
                'x' => 'u',
                'y' => 'v',
                'z' => '',
            ],
            'uzwvxy',
        ]
    ]);
});

describe('Exception handling', function () {
    it('throws an exception when the locations array is empty', function () {
        new \Isti\TripPlanner\TripPlanner([]);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);

    it('throws an exception when the locations array contains invalid dependencies', function () {
        new \Isti\TripPlanner\TripPlanner(['x' => 'y']);
    })->throws(\Isti\TripPlanner\Exceptions\ValidationException::class);
});
