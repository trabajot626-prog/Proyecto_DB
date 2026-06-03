<?php

use App\Models\User;

test('login issues a sanctum token', function (): void {
    $user = User::factory()->create([
        'password' => 'password',
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $response->assertOk()
        ->assertJsonStructure([
            'token',
            'user' => ['id', 'name', 'email'],
        ]);
});