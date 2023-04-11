<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MengelolaDataProdukTest extends DuskTestCase
{
    public $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::where('email', '=', 'admin@gmail.com')->first();
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->admin);
        });
    }

    protected function tearDown(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
        });
        parent::tearDown();
    }

    public function testMenambahkanProduk_B03_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
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
                ->attach('#modal-tambah-produk input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-success')
                ->assertSee('Produk berhasil ditambahkan.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanProduk_B02_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
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
                ->attach('#modal-tambah-produk input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.txt')
                // Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-error')
                ->assertSee('The photo 1 must be an image.')
                ->assertSee('The photo 1 must be a file of type: jpeg, png, jpg.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanProduk_B01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
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
                ->type('#modal-tambah-produk input[name=nama]', '')
                ->select('#modal-tambah-produk select[name="category_id"]', '2')
                ->type('#modal-tambah-produk input[name="harga"]', '5000000')
                ->type('#modal-tambah-produk input[name="stok"]', '10')
                ->type('#modal-tambah-produk input[name="berat"]', '500')
                ->type('#modal-tambah-produk textarea[name="deskripsi"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->attach('#modal-tambah-produk input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Tambah”
                ->press('Tambah')
                ->pause(1500)
                ->assertValue('#modal-tambah-produk input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahProduk_B05_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data produk yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu produk
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-product"]');
            $editIcon->click();
            $browser->waitFor('.modal.fade.show');

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $modalSelector = ".modal.fade.show";
            $browser->driver->executeScript("AutoNumeric.getAutoNumericElement(document.querySelector('".$modalSelector." input[name=harga]')).clear()");

            $browser->type($modalSelector.' input[name=nama]', 'Monitor Samsung')
                ->select($modalSelector.' select[name="category_id"]', '5')
                ->type($modalSelector.' input[name="harga"]', '1000000')
                ->type($modalSelector.' input[name="stok"]', '10')
                ->type($modalSelector.' input[name="berat"]', '1000')
                ->type($modalSelector.' textarea[name="deskripsi"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->attach($modalSelector.' input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-success')
                ->assertSee('Produk berhasil diupdate.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahProduk_B04_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data produk yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu produk
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-product"]');
            $editIcon->click();
            $browser->waitFor('.modal.fade.show');

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $modalSelector = ".modal.fade.show";
            $browser->driver->executeScript("AutoNumeric.getAutoNumericElement(document.querySelector('".$modalSelector." input[name=harga]')).clear()");

            $browser->type($modalSelector.' input[name=nama]', 'Monitor Samsung')
                ->select($modalSelector.' select[name="category_id"]', '5')
                ->type($modalSelector.' input[name="harga"]', '1000000')
                ->type($modalSelector.' input[name="stok"]', '10')
                ->type($modalSelector.' input[name="berat"]', '1000')
                ->type($modalSelector.' textarea[name="deskripsi"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->attach($modalSelector.' input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.txt')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-error')
                ->assertSee('The photo 1 must be an image.')
                ->assertSee('The photo 1 must be a file of type: jpeg, png, jpg.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahProduk_B01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data produk yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu produk
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-product"]');
            $editIcon->click();
            $browser->waitFor('.modal.fade.show');

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $modalSelector = ".modal.fade.show";
            $browser->driver->executeScript("AutoNumeric.getAutoNumericElement(document.querySelector('".$modalSelector." input[name=harga]')).clear()");

            $browser->type($modalSelector.' input[name=nama]', '')
                ->select($modalSelector.' select[name="category_id"]', '5')
                ->type($modalSelector.' input[name="harga"]', '1000000')
                ->type($modalSelector.' input[name="stok"]', '10')
                ->type($modalSelector.' input[name="berat"]', '1000')
                ->type($modalSelector.' textarea[name="deskripsi"]', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
                ->attach($modalSelector.' input[name="photo_1"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->pause(1500)
                ->assertValue('#modal-tambah-produk input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelihatProduk()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                ->waitFor('#navbarDropdown');

            //Assert
            $browser->assertSee('Monitor Samsung');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenghapusProduk()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Produk“ pada sidebar
                ->clickLink("Produk")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data produk yang ada.
            //Klik button dengan logo sampah (delete) pada salah satu produk
            $deleteIcon = $browser->element('[data-bs-target^="#modal-delete-product"]');
            $deleteIcon->click();
            $browser->waitFor('.modal.fade.show');

            //Muncul modal konfirmasi penghapusan data produk
            //Klik tombol “Hapus”
            $deleteBtn = $browser->element('.modal.fade.show button[type=submit]');
            $deleteBtn->click();
            $browser->waitFor('#toast-success');

            // Assert result
            $browser->assertSee('Produk berhasil dihapus.');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
