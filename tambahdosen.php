<?php
    require 'fungsi/fungsidosen.php';
    $dosen = query("SELECT Id_Dosen, NIP_Dosen,Nama_Dosen, jurusan.Nama_Jurusan
    FROM dosen
    JOIN jurusan
    ON jurusan.Id_Jurusan = dosen.Id_Jurusan
    ");
    // tombol cari di klik
    if(isset($_POST["cari"])){
        $dosen = caridosen($_POST["keyword"]);
    }

    if(isset($_POST["sumbit"])){
        if(tambahdosen($_POST) > 0){
            echo "
               <script>
                   alert('Data Berhasil Di Tambahkan');
                   document.location.href = 'indexdosen.php';
               </script>
            ";
        }else{
            echo"
            <script>
                alert('Data Gagal Di Dihapus');
                document.location.href = 'indexdosen.php';
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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Halaman Admin</a>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="tambahdosen.php">Tambah Data <span class="sr-only">(current)</span></a>
                </li>

        
                </ul>
                <form class="form-inline my-2 my-lg-0" method="post" action=""> 
                <input class="form-control mr-sm-2" type="search" name=keyword placeholder="Search" aria-label="Masukan Nama/Nim">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="cari">Cari</button>
                </form>
            </div>
            </nav>
<!-- akhir navbarr -->    
<div class="container-fluid">
<form action="" method="post" enctype="multipart/form-data">
    <h1>Form Tambah Data Dosen</h1>
        <ul>
            <li>
                <label for="NIP">NIP</label>
                <input type="text" name="NIP_Dosen" id="NIP" required>
            </li>
            <li>
                <label for="Nama_Dosen">Nama_Dosen</label>
                <input type="text" name="Nama_Dosen" id="Nama_Dosen" required>
            </li>
            <li>
                <label for="Id_Jurusan">jurusan</label>
                <select class="form-control" name="Id_Jurusan" id="Id_Jurusan">
                <?php 
                     $jurusan = query("SELECT * FROM jurusan");
                     foreach($jurusan as $row):?>
                    <option  value="<?php echo $row['Id_Jurusan'];?>"><?php echo $row['Nama_Jurusan'];?></option>
                    <?php ?>
                    <?php endforeach; ?>

                </select>
            </li>

            
                <button type="sumbit" name=sumbit>Tambah Data</button>
        </ul>
    </form>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>