<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Manter os produtos existentes
        Product::factory()->create([
            'title' => 'Brigadeiros personalizados',
            'description' => 'Brigadeiros gourmet feitos com chocolate belga',
            'price' => 500
        ]);

        Product::factory()->create([
            'title' => 'Kit degustação com 6 unidades',
            'description' => 'Seleção especial com 6 sabores diferentes',
            'price' => 1800
        ]);

        // Adicionar mais 18 produtos
        Product::factory()->create([
            'title' => 'Brigadeiro de Pistache',
            'description' => 'Brigadeiro gourmet com pistache importado',
            'price' => 700
        ]);

        Product::factory()->create([
            'title' => 'Brigadeiro de Caramelo Salgado',
            'description' => 'Brigadeiro com caramelo e flor de sal',
            'price' => 650
        ]);

        Product::factory()->create([
            'title' => 'Brigadeiro de Café',
            'description' => 'Brigadeiro com café especial e chocolate meio amargo',
            'price' => 550
        ]);

        Product::factory()->create([
            'title' => 'Brigadeiro de Limão',
            'description' => 'Brigadeiro branco com raspas de limão siciliano',
            'price' => 600
        ]);

        Product::factory()->create([
            'title' => 'Trufa de Chocolate Belga',
            'description' => 'Trufa clássica com chocolate belga 70% cacau',
            'price' => 900
        ]);

        Product::factory()->create([
            'title' => 'Trufa de Maracujá',
            'description' => 'Trufa com recheio cremoso de maracujá',
            'price' => 950
        ]);

        Product::factory()->create([
            'title' => 'Trufa de Morango',
            'description' => 'Trufa com ganache de chocolate branco e morango',
            'price' => 950
        ]);

        Product::factory()->create([
            'title' => 'Trufa de Avelã',
            'description' => 'Trufa com creme de avelã e chocolate ao leite',
            'price' => 1000
        ]);

        Product::factory()->create([
            'title' => 'Bolo no Pote de Chocolate',
            'description' => 'Bolo de chocolate com ganache e brigadeiro',
            'price' => 1500
        ]);

        Product::factory()->create([
            'title' => 'Bolo no Pote de Red Velvet',
            'description' => 'Bolo red velvet com cream cheese',
            'price' => 1600
        ]);

        Product::factory()->create([
            'title' => 'Bolo no Pote de Limão',
            'description' => 'Bolo de limão com mousse de limão e raspas',
            'price' => 1500
        ]);

        Product::factory()->create([
            'title' => 'Bolo no Pote de Coco',
            'description' => 'Bolo de coco com leite condensado e coco ralado',
            'price' => 1500
        ]);

        Product::factory()->create([
            'title' => 'Kit Festa com 12 unidades',
            'description' => 'Kit com 12 doces variados para festas',
            'price' => 3600
        ]);

        Product::factory()->create([
            'title' => 'Kit Presente com 9 unidades',
            'description' => 'Kit presente com embalagem especial e 9 doces',
            'price' => 2700
        ]);

        Product::factory()->create([
            'title' => 'Brownie Recheado',
            'description' => 'Brownie com recheio de doce de leite',
            'price' => 1200
        ]);

        Product::factory()->create([
            'title' => 'Palha Italiana',
            'description' => 'Palha italiana tradicional com chocolate meio amargo',
            'price' => 800
        ]);

        Product::factory()->create([
            'title' => 'Bombom de Morango',
            'description' => 'Morango fresco coberto com chocolate belga',
            'price' => 1000
        ]);

        Product::factory()->create([
            'title' => 'Caixinha de Alfajores',
            'description' => 'Caixa com 4 mini alfajores artesanais',
            'price' => 2000
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory()->create([
            'name' => 'Doces Gourmet',
            'slug' => str('Doces Gourmet')->slug(),
        ]);

        Category::factory()->create([
            'name' => 'Trufas',
            'slug' => str('Trufas')->slug(),
        ]);

        Category::factory()->create([
            'name' => 'Bolos no Pote',
            'slug' => str(string: 'Bolos no Pote')->slug(),
        ]);

        Category::factory()->create([
            'name' => 'Kits e Presentes',
            'slug' => str(string: 'Kits e Presentes')->slug(),
        ]);
    }
}
