<?php

namespace Isti\TripPlanner\Validators;

use Isti\TripPlanner\Contracts\Validator\Rule;

class NoCrossReference implements Rule
{
    public function validate(array $data): bool
    {
        foreach ($data as $location => $dependsOn) {
            if (isset($data[$dependsOn]) && $data[$dependsOn] == $location) {
                return false;
            }
        }

        return true;
    }

    public function message(): string
    {
        return 'The locations cannot cross-reference each other.';
    }
}
