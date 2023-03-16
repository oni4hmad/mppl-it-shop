<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_user_can_open_login_page() {
        $this->get('/login')->assertStatus(200);
    }

    public function test_can_login(){
        $response = $this->from('search')->call('POST', '/login', [
            'email' => 'user@gmail.com',
            'password' => '121212'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(session()->previousUrl());
    }

    public function test_can_logout(){
        $response = $this->call('GET', '/logout');
        $this->assertGuest();
        $response->assertRedirect('/login');
    }
}

