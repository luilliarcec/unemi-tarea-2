<?php

use App\Models\Contact;

beforeEach(function () {
    $this->uri = '/api/contacts';
});

test('la app responde con un 422 cuando no se envían los parámetros correctos', function () {
    $this->postJson($this->uri)
        ->assertStatus(422)
        ->assertInvalid(['name', 'phone']);
});

test('la app responde con un 422 cuando el name está vacío', function () {
    $this->postJson($this->uri, [
        'name' => '',
        'phone' => '+593987654321',
    ])
        ->assertStatus(422)
        ->assertInvalid(['name']);
});

test('la app responde con un 422 cuando el phone no cumple el formato', function () {
    $this->postJson($this->uri, [
        'name' => 'Luis',
        'phone' => '987654321',
    ])
        ->assertStatus(422)
        ->assertInvalid(['phone']);
});

test('la app guarda el registro cuando pasa las validaciones', function () {
    $this->postJson($this->uri, [
        'name' => 'Luis',
        'phone' => '+593987654321',
    ])
        ->assertSuccessful()
        ->assertValid();

    $this->assertDatabaseHas(Contact::class, [
        'name' => 'Luis',
        'phone' => '+593987654321',
    ]);
});
