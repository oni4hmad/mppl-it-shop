<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    public $user;
    public $user_cart;
    public $product;

    public function setUp(): void
    {
        parent::setUp();

        /* create user */
        $this->user = User::where('email', '=', 'oni@example.com')->first();
        if ($this->user === null) {
            $this->user = User::create([
                'nama' => 'Oni',
                'email' => 'oni@example.com',
                'password' => 'rahasia',
                'user_type' => UserType::CUSTOMER,
                'nomor_hp' => '0893437473',
                'kota' => 'Surabaya',
                'kode_pos' => '60185',
                'alamat' => 'Jl. Manukan Kulon',
            ]);
        }

        /* create user_cart */
        $this->user_cart = Cart::where('user_id', $this->user->id)->first();
        if ($this->user_cart === null) {
            $this->user_cart = Cart::create([
                'user_id' => $this->user->id,
            ]);
        }

        /* create product */
        $this->product = Product::where('slug', 'monitor-samsung')->first();
        if ($this->product === null) {
            $this->product = Product::create([
                'nama' => 'Monitor Samsung',
                'category_id' => 5, //Monitor
                'harga' => 10000000,
                'stok' => 5,
                'berat' => 2000,
                'deskripsi' => 'Monitor bagus',
            ]);
        }
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->product->productStackCarts()->delete();
        $this->user_cart->delete();
        $this->user->delete();
        $this->product->forceDelete();
    }

    public function test_guest_will_get_302_status_code_when_access_cart()
    {
        $this->get('/cart')
            ->assertStatus(302); // redirected
    }

    public function test_guest_will_be_redirected_when_access_cart()
    {
        $this->get('/cart')
            ->assertRedirect('/login');
    }

    public function test_user_will_get_200_status_code_when_access_cart()
    {
        $this->actingAs($this->user)
            ->get('/cart')
            ->assertStatus(200); // OK
    }

    public function test_user_wont_be_redirected_when_access_cart()
    {
        $this->actingAs($this->user)
            ->get('/cart')
            ->assertViewIs('cart');
    }

    public function test_user_can_add_product_to_cart()
    {
        $response = $this->actingAs($this->user)
            ->post('/cart', [
                "product_id" => $this->product->id,
                "kuantitas" => 1,
            ]);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
            'error' => false,
            'message' => 'Produk berhasil ditambahkan ke keranjang.'
        ]);
    }

    public function test_user_can_update_cart_product_quantity()
    {
        // add product to cart
        $this->actingAs($this->user)
            ->post('/cart', [
                "product_id" => $this->product->id,
                "kuantitas" => 1,
            ]);

        // get recently added product stack cart
        $productStackCart = $this->user_cart->productStackCarts->filter(function ($productStackCart) {
            return $productStackCart->product->id == $this->product->id;
        })->first();

        // update product stack cart
        $response = $this->actingAs($this->user)
            ->put('/cart/'.$productStackCart->id, [
                "checked" => false,
                "product_id" => $this->product->id,
                "kuantitas" => 2,
            ]);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJsonFragment([
            'error' => false,
        ]);
    }

    public function test_user_can_delete_cart_product()
    {
        // add product to cart
        $this->actingAs($this->user)
            ->post('/cart', [
                "product_id" => $this->product->id,
                "kuantitas" => 1,
            ]);

        // get recently added product stack cart
        $productStackCart = $this->user_cart->productStackCarts->filter(function ($productStackCart) {
            return $productStackCart->product->id == $this->product->id;
        })->first();

        // delete product stack cart
        $response = $this->actingAs($this->user)
            ->delete('/cart/'.$productStackCart->id);
        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertJson([
            'error' => false,
        ]);
    }
}
