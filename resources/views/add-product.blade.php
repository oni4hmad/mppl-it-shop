<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Tambah Produk</title>
</head>
<body>
    <section style="padding-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            Tambah Produk
                        </div>
                        <div class="card-body">
                            @if (Session::has('product_added'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('product_added') }}
                                </div>
                            @endif
                            <form enctype="multipart/form-data" method="POST" action="{{ route('product.store') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori" class="form-control">
                                        <option value="processor">Processor</option>
                                        <option value="vga">Graphics Card</option>
                                        <option value="memory">Memory</option>
                                        <option value="storage">Storage</option>
                                        <option value="monitor">Monitor</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="berat">Berat (gram)</label>
                                    <input type="number" name="berat" id="berat" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="15" rows="5" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="foto1">Foto Utama</label>
                                    <input type="file" name="foto1" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="foto2">Foto Depan</label>
                                    <input type="file" name="foto2" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="foto3">Foto Samping</label>
                                    <input type="file" name="foto3" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="foto4">Foto Belakang</label>
                                    <input type="file" name="foto4" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
</body>
</html>