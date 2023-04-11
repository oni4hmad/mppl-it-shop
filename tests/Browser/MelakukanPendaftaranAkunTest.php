<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MelakukanPendaftaranAkunTest extends DuskTestCase
{
    public $testUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->testUser = User::where('email', 'user@gmail.com')->first();
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

    private function changeEmailBack() {
        $user1 = User::where('email', 'oni1@gmail.com')->first();
        if ($user1) {
            $user1->update(['email' => 'user@gmail.com']);
        }
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

    public function testMengubahDataAkun_A09_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->testUser)
                ->visit('/')
                //Klik nama user dipojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Pengaturan Akun”
                ->clickLink("Pengaturan Akun")
                //Klik edit pada field email yang terdapat pada card “Pengaturan Akun”
                ->click('[data-bs-target="#modal-edit-email"]')
                ->waitFor('.modal.fade.show')
                //Masukkan data test berupa email baru pada field tersebut
                ->type('input[name=email]', 'oni1@gmail.com')
                //Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#navbarDropdown')
                ->assertSee('Email berhasil diubah.');

            $this->changeEmailBack();

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahDataAkun_A08_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->testUser)
                ->visit('/')
                //Klik nama user dipojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Pengaturan Akun”
                ->clickLink("Pengaturan Akun")
                //Klik edit pada field email yang terdapat pada card “Pengaturan Akun”
                ->click('[data-bs-target="#modal-edit-email"]')
                ->waitFor('.modal.fade.show')
                //Masukkan data test berupa email baru pada field tersebut
                ->type('input[name=email]', 'oni1@gmail')
                //Klik tombol “Simpan”
                ->press('Simpan')
                ->click('#navbarDropdown')
                ->assertSee('Update Gagal');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahDataAkun_A07_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->testUser)
                ->visit('/')
                //Klik nama user dipojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Pengaturan Akun”
                ->clickLink("Pengaturan Akun")
                //Klik edit pada field email yang terdapat pada card “Pengaturan Akun”
                ->click('[data-bs-target="#modal-edit-email"]')
                ->waitFor('.modal.fade.show')
                //Masukkan data test berupa email baru pada field tersebut
                ->type('input[name=email]', '')
                //Klik tombol “Simpan”
                ->press('Simpan')
                ->pause(1500)
                ->assertValue('input[name=email]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
