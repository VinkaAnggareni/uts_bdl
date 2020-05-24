<?php
require 'fungsi/fungsidetail.php';
// ambil data di URL
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT  id,Nama_Mahasiswa, NIM_Mahasiswa , jurusan.Nama_Jurusan
FROM mahasiswa
JOIN jurusan
ON jurusan.Id_Jurusan = mahasiswa.Id_Jurusan
WHERE id = $id")[0];


$matakuliah =query("SELECT Id_Detail, matakuliah.NamaMatakuliah, dosen.Nama_Dosen,
IF(Nilai >= 3, 'Lulus','Tidak Lulus')Nilai, Nilai AS Nilais,Kelas, krs.TahunAkademik 
FROM detailkrs 
INNER JOIN krs 
ON krs.Id_KRS = detailkrs.Id_KRS 
INNER JOIN matakuliah 
ON matakuliah.Id_Matakuliah = detailkrs.Id_Matakuliah 
INNER JOIN dosen 
ON dosen.Id_Dosen = detailkrs.Id_Dosen
WHERE krs.Id_Mahasiswa = $id
ORDER BY TahunAkademik");



$kuli =query("SELECT  AVG(detailkrs.Nilai) AS Rata,krs.TahunAkademik AS Tahun
FROM detailkrs
INNER JOIN krs
ON krs.Id_KRS = detailkrs.Id_KRS
INNER JOIN matakuliah
ON matakuliah.Id_Matakuliah = detailkrs.Id_Matakuliah
WHERE krs.Id_Mahasiswa = $id
GROUP BY krs.TahunAkademik
ORDER BY TahunAkademik");
// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["sumbit"]) ) {
	
	// cek apakah data berhasil diubah atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diubah!');
				document.location.href = 'datail.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diubah!');
				document.location.href = 'detail.php';
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
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<h3 class="name"><?= $mhs["Nama_Mahasiswa"] ;?></h3>
										<span class="online-status status-available">Available</span>
									</div>
									<div class="profile-stat">
										<div class="row">
											
										</div>
									</div>
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>NIM <span><?= $mhs["NIM_Mahasiswa"] ;?></span></li>
                                            <li>Jurusan <span><?= $mhs["Nama_Jurusan"] ;?></span></li>
                                            <li><div class="text-center"><a href="ubah.php?id=<?= $mhs["id"]?>" class="btn btn-primary">Edit Profi</a></div>
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
								<h4 class="heading">Tentang <?= $mhs["Nama_Mahasiswa"] ;?> </h4>
									<div class="tab-pane fade active in" id="tab-bottom-left2">
										<div class="table-responsive">
										
											<br>
												<a class="btn btn-primary" href="tambahdetail.php">Tambah Data <span class="sr-only">(current)</span></a>
											<br>
											<table class="table project-table">
												<thead>
													<tr>
                                                        <th>NO</th>
														<th>Nama Matakuliah</th>
														<th>Dosen</th>
														<th>Kelas</th>
														<th>Nilai</th>
														<th>Status</th>
														<th>TahunAkademik</th>
                                                        <th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<tr>
                                                    <?php $i=1; ?>
                                                    <?php foreach($matakuliah as $row): ?>
                                                    <tr>
                                                        <td><?= $i ;?></td>
                                                        <td><?= $row["NamaMatakuliah"] ;?></td>
                                                        <td> <?= $row["Nama_Dosen"] ;?></td>
														<td><?= $row["Kelas"] ;?></td>
														<td><?= $row["Nilais"];?></td>
                                                        <td> <?= $row["Nilai"] ;?></td>
														<td> <?= $row["TahunAkademik"] ;?></td>
                                                        <td><a href="ubahdetail.php?id=<?= $row["Id_Detail"]?>" class="btn btn-warning">Ubah</a>
                                                       <td><a href="hapusdetail.php?id=<?= $row["Id_Detail"]?>" class="btn btn-danger" onclick="
                                                        return confirm('Yakin?');" >Hapus</a>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    <?php endforeach; ?>
												</tbody>
											</table>
											<table class="table project-table">
												<thead>
													<tr>
                                                        <th>NO</th>
														<th>Tahun</th>
														<th>Rata-Rata Nilai pertahun</th>
													</tr>
												</thead>
												<tbody>
													<tr>
                                                    <?php $i=1; ?>
                                                    <?php foreach($kuli as $row): ?>
                                                    <tr>
                                                        <td><?= $i ;?></td>
                                                        <td><?= $row["Rata"] ;?></td>
                                                        <td> <?= $row["Tahun"] ;?></td>
                                                        </td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                    <?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
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