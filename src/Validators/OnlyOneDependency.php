<?php

namespace Isti\TripPlanner\Validators;

use Isti\TripPlanner\Contracts\Validator\Rule;

class OnlyOneDependency implements Rule
{
    public function message(): string
    {
        return 'Only one dependency allowed per location.';
    }

    public function validate(array $data): bool
    {
        foreach ($data as $location => $dependsOn) {
            if (is_array($dependsOn) && count($dependsOn) > 1) {
                return false;
            }
        }

        return true;
    }
}
