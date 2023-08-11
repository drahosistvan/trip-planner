<?php

namespace Isti\TripPlanner\Contracts\Validator;

interface Rule
{
    public function message(): string;
    public function validate(array $data): bool;
}
