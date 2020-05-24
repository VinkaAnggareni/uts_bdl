<?php
require 'fungsi/fungsimata.php';
$mata = query("SELECT * FROM `matakuliah`
ORDER BY NamaMatakuliah ASC, SKS ASC
");


$hitung = query("SELECT * FROM kuliah_id");
// CREATE VIEW kuliah_id AS SELECT COUNT( mahasiswa.NIM_Mahasiswa) AS Jumlah , matakuliah.NamaMatakuliah AS Nama
// FROM detailkrs
// JOIN matakuliah
// ON matakuliah.Id_Matakuliah = detailkrs.Id_Matakuliah
// JOIN krs
// ON krs.Id_KRS = detailkrs.Id_KRS
// JOIN mahasiswa
// ON mahasiswa.id = krs.Id_Mahasiswa
// GROUP BY matakuliah.Id_Matakuliah
// cek apakah tombol submit sudah ditekan atau belum
if(isset($_POST["sumbit"])){
    if(tambahmaha($_POST) > 0){
        echo "
           <script>
               alert('Data Berhasil Di Tambahkan');
               document.location.href = 'matakuliah.php';
           </script>
        ";
    }else{
        echo"
        <script>
            alert('Data Gagal Di Dihapus');
            document.location.href = 'matakuliah.php';
        </script>
        ";
    }
}
?>
<html lang="en">
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
    <title>Halaman Admin</title>
</head>
<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Halaman Admin</a>
</nav>
<!-- akhir navbarr -->  




<div class="container-fluid">  
<form action="" method="post" enctype="multipart/form-data">
<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="panel panel-profile">
						<div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li><h1>Matakuliah</h1></span></li>
                                            <div class="text-center"><a href="index.php" class="btn btn-red">Kembali</a></div>
                                            </li>
                                    	</ul>
									</div>
								
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<h4 class="heading">Tentang Matakuliah</h4>
									<div class="tab-pane fade active in" id="tab-bottom-left2">
										<div class="table-responsive">
										
											<br>
												<a class="btn btn-primary" href="tambahmata.php">Tambah Data <span class="sr-only">(current)</span></a> 	
											<br>
											<table class="table project-table">
												<thead>
													<tr>
                                                        <th>NO</th>
														<th>Nama Matakuliah</th>
														<th>SKS</th>
                                                        <th>Kurikulum</th>
                                                        <th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<tr>
                                                    <?php $i=1; ?>
                                                        <?php foreach($mata as $row): ?>
                                                        <tr>
                                                            <td><?= $i ;?></td>
                                                            <td><?= $row["NamaMatakuliah"] ;?></td>
                                                            <td> <?= $row["SKS"] ;?></td>
                                                            <td> <?= $row["Kurikulum"] ;?></td>
                                                            <td><a href="ubahmata.php?id=<?= $row["Id_Matakuliah"]?>" class="btn btn-warning">Ubah</a> |
                                                                <a href="hapusmata.php?id=<?= $row["Id_Matakuliah"]?>" class="btn btn-danger" onclick="
                                                                return confirm('Yakin?');" >Hapus</a>
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->

							<div class="profile-right">
								<h4 class="heading">Detail</h4>
									<div class="tab-pane fade active in" id="tab-bottom-left2">
										<div class="table-responsive">
											<table class="table project-table">
												<thead>
													<tr>
                                                        <th>NO</th>
														<th>Nama Matakuliah</th>
														<th>Jumlah Mahasiswa</th>
													</tr>
												</thead>
												<tbody>
													<tr>
                                                    <?php $i=1; ?>
                                                        <?php foreach($hitung as $row): ?>
                                                        <tr>
                                                            <td><?= $i ;?></td>
                                                            <td><?= $row["Nama"] ;?></td>
                                                            <td> <?= $row["Jumlah"] ;?></td>
                                                      
                                                        </tr>
                                                        <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    </tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
    </form>
    </div>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
    </body>
</html>