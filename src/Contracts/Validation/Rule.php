<?php

namespace Isti\TripPlanner\Contracts\Validation;

interface Rule
{
    public function message(): string;
    public function validate(array $data): bool;
}
