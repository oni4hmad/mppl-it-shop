<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_user_can_open_register_page() {
        $this->get('/register')->assertStatus(200);
    }

    public function test_can_register(){
        $response = $this->call('POST', '/register', [
            'email' => 'user4@gmail.com',
            'password' => '121212',
            'password_confirmation' => '121212',
            "nomor_hp" => '123456789',
            "nama" => 'user',
            "kota" => 'surabaya',
            "kode_pos" => '696969',
            "alamat" => 'surabaya'
        ]);

        $response->assertStatus(200);
    }
}

