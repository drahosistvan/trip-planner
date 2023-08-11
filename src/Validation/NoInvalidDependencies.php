<?php

namespace Isti\TripPlanner\Validation;

use Isti\TripPlanner\Contracts\Validation\Rule;

class NoInvalidDependencies implements Rule
{
    public function validate(array $data): bool
    {
        foreach ($data as $location => $dependsOn) {
            if (!empty($dependsOn) && !isset($data[$dependsOn])) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'The locations array contains invalid dependencies.';
    }
}
