<?php
    require 'fungsi/fungsi.php';
    $mahasiswa = query("SELECT  id, UPPER(Nama_Mahasiswa)AS Nama_Mahasiswa, NIM_Mahasiswa , jurusan.Nama_Jurusan
    FROM mahasiswa
    JOIN jurusan
    ON jurusan.Id_Jurusan = mahasiswa.Id_Jurusan
    ORDER BY Nama_Mahasiswa ASC, NIM_Mahasiswa ASC
    ");

    $hitungdosen = query("SELECT COUNT(dosen.Id_Dosen) as Dosen FROM dosen");
    $hitung = query("SELECT hitung() AS hitung");

    // tombol cari di klik
    if(isset($_POST["cari"])){
        $mahasiswa = cari($_POST["keyword"]);
    }

    if(isset($_POST["sumbit"])){
        if(tambah($_POST) > 0){
            echo "
               <script>
                   alert('Data Berhasil Di Tambahkan');
                   document.location.href = 'index.php';
               </script>
            ";
        }else{
            echo"
            <script>
                alert('Data Gagal Di Dihapus');
                document.location.href = 'index.php';
            </script>
            ";
        }
    }

?>
<html lang="en">
<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css.css">
    <title>Halaman Admin</title>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light col-sm-12">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Halaman Admin</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="tambah.php">Tambah Data <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="indexdosen.php">Dosen <span class="sr-only">(current)</span></a>
                </li>


        
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action=""> 
                <input class="form-control mr-sm-2" type="search" name=keyword placeholder="Search" aria-label="Masukan Nama/Nim">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Cari</button>
                </form>
            </div>
            </nav>
<!-- akhir navbarr -->    
<br>
<div class="row">
  <div class="col-sm-5">
  <div class="card text-white bg-primary">
  <div class="card-header">Total Mahasiswa</div>
  <div class="card-body">
 
    <h5 class="card-title">  <?php foreach( $hitung as $row): ?>
                        <tr>
                            <td><?= $row["hitung"] ;?></td>
                        </tr>
                        <?php endforeach; ?></h5>
   <a href="index.php" class="btn btn-primary">Detail > </a>
  </div>
</div>
  </div>
  <div class="col-sm-5">
  <div class="card text-white bg-secondary">
  <div class="card-header">Total Dosen Mengajar</div>
  <div class="card-body">
    <h5 class="card-title"> 
                        <?php foreach( $hitungdosen as $row): ?>
                        <tr>
                            <td><?= $row["Dosen"] ;?></td>
                        </tr>
                        <?php endforeach; ?>
    </h5>
   <a href="indexdosen.php" class="btn btn-secondary">Detail ></a>
  </div>
    </div>
  </div>
</div>

    <br>
        <a class="btn btn-primary" href="tambah.php">Tambah Data <span class="sr-only">(current)</span></a> | <a class="btn btn-primary" href="matakuliah.php">Matakuliah <span class="sr-only">(current)</span></a>
       | <a class="btn btn-primary" href="history.php">History <span class="sr-only">(current)</span></a> 
    <br>
    <br>
    <table class="table table-striped col-sm-12">
                <thead>
                    <tr>
                    <th scope="col-2">No</th>      
                    <th scope="col-2">Nama</th>
                    <th scope="col-2">NIM</th>
                    <th scope="col-2">Jurusan</th>
                    <th scope="col-2">Aksi</th>
                    <th scope="col2">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php $i=1; ?>
                        <?php foreach($mahasiswa as $row): ?>
                        <tr>
                            <td><?= $i ;?></td>
                            <td><?= $row["Nama_Mahasiswa"] ;?></td>
                            <td> <?= $row["NIM_Mahasiswa"] ;?></td>
                            <td> <?= $row["Nama_Jurusan"] ;?></td>
                            <td><a href="ubah.php?id=<?= $row["id"]?>" class="btn btn-warning">Ubah</a> |
                                <a href="hapus.php?id=<?= $row["id"]?>" class="btn btn-danger" onclick="
                                return confirm('Yakin?');" >Hapus</a>
                            <td><a href="datail.php?id=<?= $row["id"]?>" class="btn btn-primary">Detail</a> |
                            <a href="krs.php?id=<?= $row["id"]?>" class="btn btn-primary">KRS</a> </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>