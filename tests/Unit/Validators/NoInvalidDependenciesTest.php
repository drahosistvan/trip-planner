<?php

use Isti\TripPlanner\Validators\NoInvalidDependencies;
use Isti\TripPlanner\Contracts\Validator\Rule;

beforeEach(function () {
    $this->rule = new NoInvalidDependencies();
});

it('implements validator rule interface', function () {
    expect(NoInvalidDependencies::class)->toImplement(Rule::class);
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

it('fails validation when a dependency is missing from locations', function () {
    expect($this->rule->validate([
        'A' => 'B',
        'C' => '',
    ]))->toBeFalse();
});
