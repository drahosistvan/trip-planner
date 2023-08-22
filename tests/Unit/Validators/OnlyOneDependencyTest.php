<?php

use Isti\TripPlanner\Validators\OnlyOneDependency;
use Isti\TripPlanner\Contracts\Validator\Rule;

beforeEach(function () {
    $this->rule = new OnlyOneDependency();
});

it('implements validator rule interface', function () {
    expect(OnlyOneDependency::class)->toImplement(Rule::class);
});

it('passes validation with max 1 dependency', function () {
    expect($this->rule->validate([
        'A' => 'B',
        'B' => 'C',
        'C' => '',
    ]))->toBeTrue();
});

it('fails validation with multiple dependency', function () {
    expect($this->rule->validate(['x' => ['y', 'z']]))->toBeFalse();
});
