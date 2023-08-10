<?php

describe('TripPlanner', function () {
    it('can be instantiated', function () {
        $tripPlanner = new \Isti\TripPlanner\TripPlanner([]);
        expect($tripPlanner)->toBeInstanceOf(\Isti\TripPlanner\TripPlanner::class);
    });

    it('can be instantiated with locations', function () {
        $locations = [
            'x' => ['y'],
            'y',
        ];
        $tripPlanner = new \Isti\TripPlanner\TripPlanner($locations);
        expect($tripPlanner->locations)->toBe($locations);
    });
});
