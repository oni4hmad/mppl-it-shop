<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MengelolaDataKurirTest extends DuskTestCase
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

    public function testMenambahkanKurir_E02_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                //Klik tombol “+ Kurir” untuk membuka form penambahan kurir
                ->press('+ Kurir')
                ->waitFor('#modal-tambah-courier')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-courier input[name=nama]', 'TIKI')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->waitFor('#toast-success')
                ->assertSee('Kurir berhasil ditambahkan.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenambahkanKurir_E01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                //Klik tombol “+ Kurir” untuk membuka form penambahan kurir
                ->press('+ Kurir')
                ->waitFor('#modal-tambah-courier')
                //Masukkan data test pada masing-masing field bersesuaian pada form
                ->type('#modal-tambah-courier input[name=nama]', '')
                //Klik tombol “Tambah”
                ->press('Tambah')
                ->pause(1500)
                ->assertValue('#modal-tambah-courier input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahKurir_E03_DataLengkap()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kurir yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu kurir
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-kurir"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            //Klik tombol “Simpan”
            $browser->type($modalSelector.' input[name=nama]', 'Wahana')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->waitFor('#toast-success')
                ->assertSee('Kurir berhasil diperbarui.');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMengubahKurir_E01_DataKosong()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kurir yang ada.
            //Klik button dengan logo pensil (edit) pada salah satu kurir
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-edit-kurir"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Masukkan data test pada masing-masing field bersesuaian pada form
            //Klik tombol “Simpan”
            $browser->type($modalSelector.' input[name=nama]', '')
                // Klik tombol “Simpan”
                ->press('Simpan')
                ->pause(1500)
                ->assertValue($modalSelector.' input[name=nama]', '');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMelihatKurir()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kurir yang ada
            $browser->assertSee('Wahana');

            // wait and close
            //$browser->pause(5000);
        });
    }

    public function testMenghapusKurir()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                // Klik nama user di pojok kanan navbar, akan muncul dropdown menu
                ->click('#navbarDropdown')
                // Klik menu dropdown “Halaman Admin”
                ->clickLink("Halaman Admin")
                //Klik menu “Kurir“ pada sidebar
                ->clickLink("Kurir")
                ->waitFor('#navbarDropdown');

            //Akan tampil tabel yang menampilkan data kurir yang ada
            //Klik button dengan logo sampah (delete) pada salah satu kurir
            $modalSelector = ".modal.fade.show";
            $editIcon = $browser->element('[data-bs-target^="#modal-delete-courier"]');
            $editIcon->click();
            $browser->waitFor($modalSelector);

            //Muncul modal konfirmasi penghapusan data kurir
            //Klik tombol “Hapus
            $deleteBtn = $browser->element('.modal.fade.show button[type=submit]');
            $deleteBtn->click();
            $browser->waitFor('#toast-success');

            // Assert result
            $browser->assertSee('Kurir berhasil dihapus.');

            // wait and close
            //$browser->pause(5000);
        });
    }
}
