<?php

namespace Isti\TripPlanner\Validation;

use Isti\TripPlanner\Contracts\Validation\Rule;

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
