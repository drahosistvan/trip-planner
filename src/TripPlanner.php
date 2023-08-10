<?php

namespace Isti\TripPlanner;

use Isti\TripPlanner\Exceptions\ValidationException;
use Isti\TripPlanner\Validation\NoInvalidDependencies;
use Isti\TripPlanner\Validation\NotEmpty;

class TripPlanner
{
    private array $validationRules = [
        NotEmpty::class,
        NoInvalidDependencies::class
    ];

    /**
     * @throws ValidationException
     */
    public function __construct(private readonly array $locations)
    {
        $this->validate();
    }

    public function calculateOptimalRoute(): string
    {
        return implode('', $this->topologicalSort());
    }

    private function topologicalSort(): array
    {
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

    /**
     * @throws ValidationException
     */
    private function validate(): void
    {
        foreach ($this->validationRules as $rule) {
            $validator = new $rule();
            if (!$validator->validate($this->locations)) {
                throw new ValidationException($validator->message());
            }
        }
    }
}
