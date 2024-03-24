<?php

namespace Tests\Feature;

use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

abstract class ProductTest extends TestingTestCase
{
    protected function setUp(): void
    {
        DB::delete('delete from categories');
        DB::delete('delete from products');
    }

    public function testStoreProduct()
    {
        $this->seed(CategorySeeder::class);

        $response = $this->post('/product', [
            'category_id' => 3,
            'name' => 'Ale-ale',
            'unit' => 'pcs',
            'stock' => 60,
            'price' => 2000,
            'expired_date' => '2025-03-21',
        ]);

        $response->assertStatus(200)->assertJson([
            'category' => 'Minuman',
            'name' => 'Ale-ale',
            'unit' => 'pcs',
            'stock' => 60,
            'price' => 2000,
            'expired_date' => '2025-03-21',
        ]);
    }
}
