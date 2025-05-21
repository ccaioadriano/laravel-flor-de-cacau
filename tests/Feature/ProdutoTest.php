<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

uses( WithoutMiddleware::class);

it('cria um produto com sucesso', function () {
    $response = $this->post('/store', [
        'title' => 'Trufa de Chocolate',
        'description' => 'Deliciosa trufa de chocolate ao leite',
        'price' => 550,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('products', [
        'title' => 'Trufa de Chocolate',
        'description' => 'Deliciosa trufa de chocolate ao leite',
        'price' => 550,
    ]);
});

it('valida que title é obrigatório', function () {
    $response = $this->post('/store', [
        'title' => '',
        'description' => 'Deliciosa trufa de chocolate ao leite',
        'price' => 1000,
    ]);

    $response->assertSessionHasErrors('title');
});

it('valida que preço não pode ser negativo', function () {
    $response = $this->post('/store', [
        'title' => 'Produto inválido',
        'description' => 'Produto com preço negativo',
        'price' => -1,
    ]);

    $response->assertSessionHasErrors('price');
});

it('lista produtos e categorias corretamente', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertViewHas(['products', 'categories']);
});

it('atualiza um produto com sucesso', function () {
    $produto = Product::factory()->create([
        'title' => 'Bolo de Cenoura',
        'description' => 'Bolo de cenoura',
        'price' => 700,
    ]);

    $response = $this->put("/updateProduct/{$produto->id}", [
        'title' => 'Bolo de Cenoura com Chocolate',
        'description' => 'Bolo de cenoura com cobertura de chocolate',
        'price' => 850,
    ]);

    $response->assertRedirect();
    $this->assertDatabaseHas('products', [
        'id' => $produto->id,
        'title' => 'Bolo de Cenoura com Chocolate',
        'description' => 'Bolo de cenoura com cobertura de chocolate',
        'price' => 850,
    ]);
});

it('deleta um produto com sucesso', function () {
    $produto = Product::factory()->create();

    $response = $this->delete("/deleteProduct/{$produto->id}/delete");

    $response->assertRedirect();
    $this->assertDatabaseMissing('products', [
        'id' => $produto->id,
    ]);
});
