<?php

use App\Models\Product;
use App\Models\Provider;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a provider can be created and has many products', function () {
    $provider = Provider::create([
        'nit' => '900123456-1',
        'name' => 'Distribuidora Global',
        'phone' => '3001234567',
        'email' => 'ventas@global.com',
        'address' => 'Carrera 15 # 45-20',
    ]);

    $product1 = Product::create([
        'code' => 'P-001',
        'name' => 'Laptop Gamer',
        'amount' => 10,
        'unit' => 'und',
        'price' => 2500000,
        'provider_id' => $provider->id,
    ]);

    $product2 = Product::create([
        'code' => 'P-002',
        'name' => 'Mouse Inalambrico',
        'amount' => 25,
        'unit' => 'und',
        'price' => 75000,
        'provider_id' => $provider->id,
    ]);

    expect($provider->products)->toHaveCount(2)
        ->and($provider->products->first()->id)->toBe($product1->id)
        ->and($product1->provider->id)->toBe($provider->id)
        ->and($product2->provider->name)->toBe('Distribuidora Global');
});

test('api can list providers', function () {
    Provider::factory()->count(3)->create();

    $response = $this->getJson('/api/providers');

    $response->assertStatus(200)
        ->assertJsonStructure(['data']);
});

test('api can create a provider', function () {
    $payload = [
        'nit' => '123456789-0',
        'name' => 'Tech Supplies SAS',
        'phone' => '3110001122',
        'email' => 'info@techsupplies.com',
        'address' => 'Avenida Siempre Viva 123',
    ];

    $response = $this->postJson('/api/providers', $payload);

    $response->assertStatus(201)
        ->assertJsonPath('provider.name', 'Tech Supplies SAS')
        ->assertJsonPath('provider.nit', '123456789-0');

    $this->assertDatabaseHas('providers', ['nit' => '123456789-0']);
});

test('api can show a provider', function () {
    $provider = Provider::factory()->create();

    $response = $this->getJson("/api/providers/{$provider->id}");

    $response->assertStatus(200)
        ->assertJsonPath('data.id', $provider->id);
});

test('api can update a provider', function () {
    $provider = Provider::factory()->create();

    $response = $this->putJson("/api/providers/{$provider->id}", [
        'name' => 'Nombre Actualizado',
    ]);

    $response->assertStatus(200)
        ->assertJsonPath('data.name', 'Nombre Actualizado');

    $this->assertDatabaseHas('providers', [
        'id' => $provider->id,
        'name' => 'Nombre Actualizado',
    ]);
});

test('api can delete a provider', function () {
    $provider = Provider::factory()->create();

    $response = $this->deleteJson("/api/providers/{$provider->id}");

    $response->assertStatus(200)
        ->assertJsonStructure(['providerDelete', 'message']);

    $this->assertSoftDeleted('providers', ['id' => $provider->id]);
});
