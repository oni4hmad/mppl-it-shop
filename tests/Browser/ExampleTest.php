<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{

    public $user;
    public $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::where('email', '=', 'user@gmail.com')->first();
        $this->admin = User::where('email', '=', 'admin@gmail.com')->first();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Cari Komponen')
                    ->assertSee('PC Impianmu');
        });
    }

    public function testLogin() {
        $this->browse(function (Browser $browser) {
//            $browser->visit('/')
//                ->click('#navbar_top > div > div:nth-child(3) > ul > li:nth-child(2) > a')
//                ->waitFor('#login-modal > div > div > div.modal-body')
//                ->assertSee('Forgot Your Password?');

//            $browser->visit('/')
//                ->click('#navbar_top > div > div:nth-child(3) > ul > li:nth-child(2) > a')
//                ->waitFor('#login-modal > div > div > div.modal-body')
//                ->value('input[id=email]', 'user@gmail.com')
//                ->value('input[id=password]', '121212')
//                ->click('#login-modal > div > div > div.modal-body > form > div.modal-footer.justify-content-center.pb-0 > button')
//                ->waitFor('#navbar_top > div > div:nth-child(3) > ul > li.nav-item.border-end.border-2 > a > i')
//                ->assertSee('Yuser');
//            $browser->pause(5000);

            $browser->loginAs($this->user)
                ->visit('/')
                ->assertSee('Yuser')
                ->logout();
//            $browser->pause(5000);


//            $loginBtn = $browser->element('#navbar_top > div > div:nth-child(3) > ul > li:nth-child(2) > a');
//            $loginBtn->click();
//
//            $browser->waitFor('#login-modal > div > div > div.modal-body')
//                ->value('input[id=email]', 'user@gmail.com')
//                ->value('input[id=password]', '121212')
//                ->click('#login-modal > div > div > div.modal-body > form > div.modal-footer.justify-content-center.pb-0 > button')
//                ->waitFor('#navbar_top > div > div:nth-child(3) > ul > li.nav-item.border-end.border-2 > a > i')
//                ->assertSee('Yuser');
//            $browser->pause(5000);
        });
    }


    public function testBasicExample2()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Login')
                ->assertSee('Register');
        });
    }

    public function testMenambahkanProduk()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin)
                ->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                // Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                // Klik tombol “+ Produk” untuk membuka form penambahan produk
                ->press('+ Produk')
                ->waitFor('#modal-tambah-produk')
                // isi field yang ada
                ->type('#modal-tambah-produk input[name=nama]', 'AMD Ryzen 5')
                ->select('#modal-tambah-produk select[name="category_id"]', '2')
                ->type('#modal-tambah-produk input[name="harga"]', '5000000')
                ->type('#modal-tambah-produk input[name="stok"]', '10')
                ->type('#modal-tambah-produk input[name="berat"]', '500')
                ->type('#modal-tambah-produk textarea[name="deskripsi"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->attach('#modal-tambah-produk input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\photo-temp.png')
                // Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-success')
                ->assertSee('Produk berhasil ditambahkan.');
            $browser->pause(5000);
        });
    }
}
