<?php

use App\Models\Contact;

beforeEach(function () {
    $this->contact = Contact::factory()->create();

    $this->uri = "/api/contacts/{$this->contact->getKey()}";
});

test('la app responde con un 404 con una url inválida', function () {
    $this->deleteJson($this->uri.'/invalid')
        ->assertStatus(404);
});

test('la app responde con un 404 si el registro ya ha sido eliminado', function () {
    $this->contact->delete();

    $this->deleteJson($this->uri)
        ->assertStatus(404);
});

test('la app elimina el registro correctamente', function () {
    $this->deleteJson($this->uri)
        ->assertSuccessful();

    $this->assertModelMissing($this->contact);
});
