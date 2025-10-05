<?php

use App\Models\Contact;

beforeEach(function () {
    $this->uri = '/api/contacts';

    Contact::factory()->create([
        'id' => 1,
        'name' => 'Luis',
        'phone' => '123456789',
    ]);

    Contact::factory()->create([
        'id' => 2,
        'name' => 'Bryan',
        'phone' => '0123456789',
    ]);
});

test('la app responde con el listado de contactos cuando se lo solicita', function () {
    $this->getJson($this->uri)
        ->assertStatus(200)
        ->assertExactJson([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Luis',
                    'phone' => '123456789',
                ],
                [
                    'id' => 2,
                    'name' => 'Bryan',
                    'phone' => '0123456789',
                ],
            ],
        ]);
});

test('la app responde con los registros filtrados por nombre', function () {
    $this->getJson($this->uri.'?name=Luis')
        ->assertStatus(200)
        ->assertExactJson([
            'data' => [
                [
                    'id' => 1,
                    'name' => 'Luis',
                    'phone' => '123456789',
                ],
            ],
        ]);
});

test('la app responde con los registros filtrados por phone', function () {
    $this->getJson($this->uri.'?phone=0123456789')
        ->assertStatus(200)
        ->assertExactJson([
            'data' => [
                [
                    'id' => 2,
                    'name' => 'Bryan',
                    'phone' => '0123456789',
                ],
            ],
        ]);
});
