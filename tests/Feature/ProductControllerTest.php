<?php

namespace Tests\Feature;

use App\Enums\UserType;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public $user;
    public $admin;
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
            $this->user->save();
        }

        /* create admin */
        $this->admin = User::where('email', '=', 'admin@example.com')->first();
        if ($this->admin === null) {
            $this->admin = User::create([
                'nama' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'rahasia',
                'user_type' => UserType::ADMINISTRATOR,
                'nomor_hp' => '0893437473',
                'kota' => 'Surabaya',
                'kode_pos' => '60185',
                'alamat' => 'Jl. Manukan Kulon',
            ]);
            $this->admin->save();
        }

        /* create product */
        $this->product = new Product([
            'nama' => 'Monitor Samsung',
            'category_id' => 5, //Monitor
            'harga' => 10000000,
            'stok' => 5,
            'berat' => 2000,
            'deskripsi' => 'Monitor bagus',
        ]);
        $this->product->save();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->user->delete();
        $this->admin->delete();
        $this->product->forceDelete();
    }

    public function test_guest_will_get_302_status_code_when_access_manage_product() {
        $this->get('/manage-product')
            ->assertStatus(302); // redirected
    }

    public function test_guest_will_be_redirected_when_access_manage_product() {
        $this->get('/manage-product')
            ->assertRedirect('/');
    }

    public function test_user_will_get_302_status_code_when_access_manage_product() {
        $this->actingAs($this->user)
            ->get('/manage-product')
            ->assertStatus(302); // redirected
    }

    public function test_user_will_be_redirected_when_access_manage_product() {
        $this->actingAs($this->user)
            ->get('/manage-product')
            ->assertRedirect('/');
    }

    public function test_admin_will_get_200_status_code_when_access_manage_product() {
        $this->actingAs($this->admin)
            ->get('/manage-product')
            ->assertStatus(200);
    }

    public function test_admin_wont_be_redirected_when_access_manage_product() {
        $this->actingAs($this->admin)
            ->get('/manage-product')
            ->assertViewIs('admin.manage-product');
    }

    public function test_admin_can_create_new_product() {
        Storage::fake('public_direct'); // use the "public" disk for testing
        $file = UploadedFile::fake()->image('test.jpg'); // create a fake image file
        $this->actingAs($this->admin)
            ->post('/manage-product', [
                '_token' => csrf_token(),
                'nama' => 'VGA Nvidia',
                'category_id' => 2, // Graphics Card
                'harga' => 2000000,
                'stok' => 5,
                'berat' => 1000,
                'deskripsi' => 'VGA bagus',
                'photo_1' => $file,
            ])
            ->assertSessionHas("success", "Produk berhasil ditambahkan.");
    }

    public function test_admin_can_read_product() {
        $this->actingAs($this->admin)
            ->get('/product/'.$this->product->slug)
            ->assertStatus(200);
    }

    public function test_admin_can_update_product() {
        $this->actingAs($this->admin)
            ->put('/manage-product', [
                '_token' => csrf_token(),
                'id' => $this->product->id,
                'nama' => 'VGA Nvidia',
                'category_id' => 2, // Graphics Card
                'harga' => 4000000,
                'stok' => 1,
                'berat' => 2000,
                'deskripsi' => 'VGA bagus'
            ])
            ->assertSessionHas('success', 'Produk berhasil diupdate.');
    }

    public function test_admin_can_delete_product() {
        $this->actingAs($this->admin)
            ->delete('/manage-product/'.$this->product->id.'/delete')
            ->assertSessionHas("success", "Produk berhasil dihapus.");
    }
}
