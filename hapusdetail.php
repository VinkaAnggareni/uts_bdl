<?php
    require 'fungsi/fungsidetail.php';
    $id = $_GET["id"];
    if(hapus($id) > 0){
        echo "
        <script>
            alert('Data Berhasil Di Dihapus');
            document.location.href = 'index.php';
        </script>
     ";
    }else{
        echo "
        <script>
            alert('Data Gagal Di Dihapus');
            document.location.href = 'index.php';
        </script>
     ";
    }
?>