<?php

namespace Isti\TripPlanner;

class TripPlanner
{
    public function __construct(public array $locations)
    {
    }

    public function calculateOptimalRoute(): string
    {
        return '';
    }
}
