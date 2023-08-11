<?php

namespace Isti\TripPlanner\Calculators;

use Isti\TripPlanner\Contracts\Calculator\RouteCalculator;

class CalculateWithTopologicalSort implements RouteCalculator
{
    private array $locations;
    public function calculateOptimalRoute(array $locations): array
    {
        $this->locations = $locations;
        $visited = [];
        $stack = [];

        foreach ($this->locations as $location => $dependsOn) {
            if (!isset($visited[$location]) || !$visited[$location]) {
                $this->topologicalSortUtil($location, $stack, $visited);
            }
        }

        return $stack;
    }

    private function topologicalSortUtil($location, &$stack, &$visited): void
    {
        $visited[$location] = true;

        if (isset($this->locations[$location])) {
            if (!isset($visited[$this->locations[$location]]) || !$visited[$this->locations[$location]]) {
                $this->topologicalSortUtil($this->locations[$location], $stack, $visited);
            }
        }

        $stack[] = $location;
    }
}
