<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MengelolaDataMetodePembayaranTest extends DuskTestCase
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

    public function testMenambahkanMetodePembayaran_D02_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                //Klik tombol “+ Metode Pembayaran” untuk membuka form penambahan metode pembayaran
                ->press('+ Metode Pembayaran')
                ->waitFor('#modal-tambah-payment')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-payment input[name=nama]', 'BSI')
                ->type('#modal-tambah-payment input[name=nomor_rekening]', '123-12-4002')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-success')
                ->assertSee('Metode pembayaran berhasil ditambahkan.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanMetodePembayaran_D01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                //Klik tombol “+ Metode Pembayaran” untuk membuka form penambahan metode pembayaran
                ->press('+ Metode Pembayaran')
                ->waitFor('#modal-tambah-payment')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-payment input[name=nama]', 'BSI')
                ->type('#modal-tambah-payment input[name=nomor_rekening]', '')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->pause(1500)
                ->assertValue('#modal-tambah-payment input[name=nomor_rekening]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahMetodePembayaran_D03_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data metode pembayaran yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu metode pembayaran
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-payment"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            //Klik tombol “Simpan”
            $browser->type($modalSelector.' input[name=nama]', 'BSI')
                ->type($modalSelector.' input[name=nomor_rekening]', '123-12-9999')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-success')
                ->assertSee('Metode pembayaran berhasil diperbarui.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahMetodePembayaran_D01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data metode pembayaran yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu metode pembayaran
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-payment"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            //Klik tombol “Simpan”
            $browser->type($modalSelector.' input[name=nama]', 'BSI')
                ->type($modalSelector.' input[name=nomor_rekening]', '')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->pause(1500)
                ->assertValue($modalSelector.' input[name=nomor_rekening]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelihatMetodePembayaran()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data metode pembayaran yang ada.
            $browser->assertSee('BSI');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenghapusMetodePembayaran()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                //Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                //Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Metode Pembayaran“ pada sidebar
                ->clickLink("Metode Pembayaran")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data metode pembayaran yang ada.
            //Klik button dengan logo sampah (delete) pada salah satu metode pembayaran
            $modalSelector = ".modal.fade.show";
            $deleteBtn = $browser->element('[data-bs-target^="#modal-delete-payment"]');
            $deleteBtn->click();
            $browser->waitFor($modalSelector);

            //Muncul modal konfirmasi penghapusan data metode pembayaran
            $deleteBtn = $browser->element($modalSelector.' button[type=submit]');
            $deleteBtn->click();
            $browser->waitFor('#toast-success');
            $browser->assertSee('Metode pembayaran berhasil dihapus.');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
