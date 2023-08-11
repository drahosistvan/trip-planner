<?php

namespace Isti\TripPlanner\Validators;

use Isti\TripPlanner\Contracts\Validator\Rule;

class NotEmpty implements Rule
{
    public function validate(array $data): bool
    {
        return !empty($data);
    }

    public function message(): string
    {
        return 'The locations array cannot be empty.';
    }
}
