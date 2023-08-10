<?php

describe('TripPlanner input - output', function () {
    it('can be instantiated', function () {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner([]);
        expect($tripPlanner)->toBeInstanceOf(\Isti\TripPlanner\TripPlanner::class);
    });

    it('has a method to calculate the optimal route', function () {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner([]);
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
