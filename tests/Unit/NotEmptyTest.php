<?php

use Isti\TripPlanner\Validators\NotEmpty;
use Isti\TripPlanner\Contracts\Validator\Rule;

beforeEach(function () {
    $this->rule = new NotEmpty();
});

it('implements validator rule interface', function () {
    expect(NotEmpty::class)->toImplement(Rule::class);
});

it('passes validation when locations are not empty', function () {
    expect($this->rule->validate([
        'A' => 'B',
        'B' => 'C',
        'C' => '',
    ]))->toBeTrue();
});

it('fails validation when locations are empty', function () {
    expect($this->rule->validate([]))->toBeFalse();
});
