<?php

use Isti\TripPlanner\Contracts\Validator\Rule;
use Isti\TripPlanner\Validators\NoCrossReference;

beforeEach(function () {
    $this->rule = new NoCrossReference();
});

it('implements validator rule interface', function () {
    expect(NoCrossReference::class)->toImplement(Rule::class);
});

it('passes validation when no dependencies passed', function () {
    expect($this->rule->validate([]))->toBeTrue();
});

it('passes validation when all dependencies are valid', function () {
    expect($this->rule->validate([
        'A' => 'B',
        'B' => 'C',
        'C' => '',
    ]))->toBeTrue();
});

it('passes validation when there are no dependencies', function () {
    expect($this->rule->validate([
        'A' => '',
        'B' => '',
        'C' => '',
    ]))->toBeTrue();
});

it('fails validation when a dependencies cross reference each other', function () {
    expect($this->rule->validate([
        'A' => 'B',
        'B' => 'A',
    ]))->toBeFalse();
});
