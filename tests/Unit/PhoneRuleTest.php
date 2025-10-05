<?php

use App\Rules\PhoneRule;

it('la validación no lanza excepciones si los valores son correctos con el formato', function ($value) {
    $rule = app(PhoneRule::class);
    $rule->validate('phone', $value, fn () => throw new RuntimeException);
})->with([
    '+593987654321',
    '+593999999999',
])->throwsNoExceptions();

it('la validación lanza excepciones si los valores no concuerdan con el formato', function ($value) {
    $rule = app(PhoneRule::class);
    $rule->validate('phone', $value, fn () => throw new RuntimeException);
})->with([
    'sin código de país' => '0987654321',
    'no empieza con 9' => '+593887654321',
    'solo 9 dígitos' => '+59398765432',
])->throws(RuntimeException::class);
