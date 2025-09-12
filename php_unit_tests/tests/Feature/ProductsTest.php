<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    public function test_homepage_contains_empty_table()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee(__('No products found'));
    }

    public function test_homepage_contains_non_empty_table()
    {
        $product = Product::create([
            'name' => 'Product 2',
            'price' => '123',
        ]);
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee(__('No products found'));
        $response->assertSee(__('Product 2'));
        $response->assertViewHas('products', function( $collection ) use ($product) {
            return $collection->contains($product);
        });
    }
}
