<?php

namespace Isti\TripPlanner;

use Isti\TripPlanner\Contracts\Calculator\RouteCalculator;
use Isti\TripPlanner\Contracts\Writer\Writer;
use Isti\TripPlanner\Exceptions\ValidationException;
use Isti\TripPlanner\Validators\NoCrossReference;
use Isti\TripPlanner\Validators\NoInvalidDependencies;
use Isti\TripPlanner\Validators\NotEmpty;
use Isti\TripPlanner\Validators\OnlyOneDependency;

class TripPlanner
{
    private array $validationRules = [
        NotEmpty::class,
        OnlyOneDependency::class,
        NoInvalidDependencies::class,
        NoCrossReference::class
    ];

    private array $locations = [];

    public function __construct(
        private readonly RouteCalculator $calculator,
        private readonly Writer $writer
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function calculateOptimalRoute($locations): mixed
    {
        $this->locations = $locations;
        $this->validate();
        return $this->writer->write($this->calculator->calculateOptimalRoute($this->locations));
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
