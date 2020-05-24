<?php
    require 'fungsi/fungsidosen.php';
    $id = $_GET["id"];
    if(hapusdosen($id) > 0){
        echo "
        <script>
            alert('Data Berhasil Di Dihapus');
            document.location.href = 'indexdosen.php';
        </script>
     ";
    }else{
        echo "
        <script>
            alert('Data Gagal Di Dihapus');
            document.location.href = 'indexdosen.php';
        </script>
     ";
    }
?>