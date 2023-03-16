<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;


class AccountSettingsControllerTest extends TestCase
{
    public $user;
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
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->user->delete();
    }

    public function test_can_open_account_settings_page_as_guest(){
        $this->get('/account-settings')
            ->assertStatus(302);
    }

    public function test_can_open_account_settings_page_as_user(){
        $this->actingAs($this->user)->get('/account-settings')
            ->assertStatus(200);
    }

    public function test_user_can_update_profile_name() {
        $this->actingAs($this->user)
            ->put('/account-settings', [
                'nama' => 'Ino',
            ])->assertSessionHas('success', 'Nama berhasil diubah.');
    }

    public function test_user_can_update_profile_email() {
        $this->actingAs($this->user)
            ->put('/account-settings', [
                'email' => 'ino@gmail.com',
            ])->assertSessionHas('success', 'Email berhasil diubah.');
    }

    public function test_user_can_update_profile_nomorhp() {
        $this->actingAs($this->user)
            ->put('/account-settings', [
                'nomor_hp' => '123456789',
            ])->assertSessionHas('success', 'Nomor HP berhasil diubah.');
    }

    public function test_user_can_update_profile_alamat() {
        $this->actingAs($this->user)
            ->put('/account-settings', [
                'kota' => 'konoha',
                'alamat' => 'konohagakure',
                'kode_pos' => '696969',
            ])->assertSessionHas('success', 'Alamat berhasil diubah.');
    }

    public function test_user_can_update_profile_password() {
        $this->actingAs($this->user)
            ->put('/account-settings', [
                'password_current' => 'rahasia',
                'password' => 'tidakada',
                'password_confirmation' => 'tidakada',
            ])->assertSessionHas('success', 'Password berhasil diubah.');
    }

    public function test_user_can_update_profile() {
        Storage::fake('public_direct'); // use the "public" disk for testing
        $file = UploadedFile::fake()->image('test.jpg'); // create a fake image file

        $this->actingAs($this->user)
            ->put('/account-settings', [
                'profile_picture' => $file
            ])->assertSessionHas('success', 'Foto profil berhasil diubah.');
    }
}
