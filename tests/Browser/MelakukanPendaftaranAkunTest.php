<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MelakukanPendaftaranAkunTest extends DuskTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->browse(function (Browser $browser) {
            $browser->logout();
        });
    }

    protected function tearDown(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
        });
        $user = User::where('email', 'oni@gmail.com')->first();
        if ($user) {
            $user->cart()->delete();
            $user->delete();
        }
        parent::tearDown();
    }

    public function testMelakukanPendaftaranAkunBaru_A03_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Register')
                ->waitFor('#navbar_top')
                ->type('[id="registration-form"] input[name=email]', 'oni@gmail.com')
                ->type('[id="registration-form"] input[name=password]', '121212')
                ->type('[id="registration-form"] input[name=password_confirmation]', '121212')
                ->type('[id="registration-form"] input[name=nomor_hp]', '0812323728')
                ->type('[id="registration-form"] input[name=nama]', 'Oni')
                ->type('[id="registration-form"] input[name=kota]', 'Surabaya')
                ->type('[id="registration-form"] input[name=kode_pos]', '60444')
                ->type('[id="registration-form"] input[name=alamat]', 'Jl. Kandangan GG/17')
                ->press('Daftar')
                ->waitFor('#navbar_top')
                ->assertSee('Pendaftaran Berhasil');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelakukanPendaftaranAkunBaru_A02_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Register')
                ->waitFor('#navbar_top')
                ->type('[id="registration-form"] input[name=email]', 'oni@gmail')
                ->type('[id="registration-form"] input[name=password]', '121212')
                ->type('[id="registration-form"] input[name=password_confirmation]', '121212')
                ->type('[id="registration-form"] input[name=nomor_hp]', '0812323728')
                ->type('[id="registration-form"] input[name=nama]', 'Oni')
                ->type('[id="registration-form"] input[name=kota]', 'Surabaya')
                ->type('[id="registration-form"] input[name=kode_pos]', '60444')
                ->type('[id="registration-form"] input[name=alamat]', 'Jl. Kandangan GG/17')
                ->press('Daftar')
                ->waitFor('#navbar_top')
                ->assertSee('Registrasi Gagal');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelakukanPendaftaranAkunBaru_A01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Register')
                ->waitFor('#navbar_top')
                ->type('[id="registration-form"] input[name=email]', 'oni@gmail.com')
                ->type('[id="registration-form"] input[name=password]', '121212')
                ->type('[id="registration-form"] input[name=password_confirmation]', '121212')
                ->type('[id="registration-form"] input[name=nomor_hp]', '0812323728')
                ->type('[id="registration-form"] input[name=nama]', 'Oni')
                ->type('[id="registration-form"] input[name=kota]', 'Surabaya')
                ->type('[id="registration-form"] input[name=kode_pos]', '')
                ->type('[id="registration-form"] input[name=alamat]', '')
                ->press('Daftar')
                ->waitFor('#navbar_top')
                ->pause(1500)
                ->assertValue('[id="registration-form"] input[name=kode_pos]', '')
                ->assertValue('[id="registration-form"] input[name=alamat]', '')
                ->assertSee('Registrasi Gagal');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelakukanLoginPadaAkunBaru_A06_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->waitFor('.modal.fade.show')
                ->type('.modal.fade.show input[name=email]', 'user@gmail.com')
                ->type('.modal.fade.show input[name=password]', '121212')
                ->press('Login')
                ->waitFor('#navbarDropdown')
                ->click('#navbarDropdown')
                ->assertSee('Logout')
                ->logout();

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelakukanLoginPadaAkunBaru_A05_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->waitFor('.modal.fade.show')
                ->type('.modal.fade.show input[name=email]', 'asd123@gmail.com')
                ->type('.modal.fade.show input[name=password]', 'password-asal')
                ->press('Login')
                ->waitFor('#navbar_top')
                ->assertSee('Email atau password salah.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelakukanLoginPadaAkunBaru_A04_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->clickLink('Login')
                ->waitFor('.modal.fade.show')
                ->type('.modal.fade.show input[name=email]', 'user@gmail.com')
                ->type('.modal.fade.show input[name=password]', '')
                ->press('Login')
                ->pause(1500)
                ->assertValue('.modal.fade.show input[name=password]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
