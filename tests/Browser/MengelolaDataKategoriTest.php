<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MengelolaDataKategoriTest extends DuskTestCase
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

    public function testMenambahkanKategori_C03_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                //Klik tombol “+ Kategori” untuk membuka form penambahan kategori
                ->press('+ Kategori')
                ->waitFor('#modal-tambah-category')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-category input[name=nama]', 'Headset')
                ->attach('#modal-tambah-category input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-success')
                ->assertSee('Kategori berhasil ditambahkan.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanKategori_C02_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                //Klik tombol “+ Kategori” untuk membuka form penambahan kategori
                ->press('+ Kategori')
                ->waitFor('#modal-tambah-category')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-category input[name=nama]', 'Headset')
                ->attach('#modal-tambah-category input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.txt')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-error')
                ->assertSee('The photo must be an image.')
                ->assertSee('The photo must be a file of type: jpeg, png, jpg.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanKategori_C01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                //Klik tombol “+ Kategori” untuk membuka form penambahan kategori
                ->press('+ Kategori')
                ->waitFor('#modal-tambah-category')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-category input[name=nama]', '')
                ->attach('#modal-tambah-category input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->pause(1500)
                ->assertValue('#modal-tambah-category input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }


    public function testMengubahKategori_C05_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kategori yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu data kategori
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-category"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $browser->type($modalSelector.' input[name=nama]', 'Headset Gaming')
                ->attach($modalSelector.' input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-success')
                ->assertSee('Kategori berhasil diperbarui.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahKategori_C04_DataSalah()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kategori yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu data kategori
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-category"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $browser->type($modalSelector.' input[name=nama]', 'Headset Gaming')
                ->attach($modalSelector.' input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.txt')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-error')
                ->assertSee('The photo must be an image.')
                ->assertSee('The photo must be a file of type: jpeg, png, jpg.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahKategori_C01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kategori yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu data kategori
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-category"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            $browser->type($modalSelector.' input[name=nama]', '')
                ->attach($modalSelector.' input[name="photo"]', 'E:\PENDIDIKAN\. KAMPUS (IF ITS)\kuliah\Semester 8\PMPL\selenium\image.png')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->pause(1500)
                ->assertValue($modalSelector.' input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }


    public function testMelihatKategori()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan daftar data kategori yang ada.
            $browser->assertSee('Headset Gaming');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenghapusKategori()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kategori“ pada sidebar
                ->clickLink("Kategori")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kategori yang ada.
            //Klik button dengan logo sampah (delete) pada salah satu data kategori
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-delete-category"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Muncul modal konfirmasi penghapusan data kategori
            //Klik tombol “Hapus”
            $deleteBtn = $browser->element('.modal.fade.show button[type=submit]');
            $deleteBtn->click();
            $browser->waitFor('#toast-success');

            // Assert result
            $browser->assertSee('Kategori berhasil dihapus.');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
