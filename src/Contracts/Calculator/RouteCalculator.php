<?php

namespace Isti\TripPlanner\Contracts\Calculator;

interface RouteCalculator
{
    /**
     * @param array $data
     * @return array
     */
    public function calculateOptimalRoute(array $data): array;
}
