<?php
$conn = mysqli_connect("localhost", "root" ,"", "mahasiswa");
function query($query){
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
    

    function tambah($data){
        global $conn;
        $NIM_Mahasiswa    =  htmlspecialchars($data["NIM_Mahasiswa"]);
        $Nama_Mahasiswa  = htmlspecialchars($data["Nama_Mahasiswa"]);
        $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);

        $query="INSERT INTO mahasiswa
        VALUES('','$NIM_Mahasiswa','$Nama_Mahasiswa','$Id_Jurusan')";
            mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }


    function hapus($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM mahasiswa WHERE id=$id");
        return mysqli_affected_rows($conn);
    }



    function ubah($data) {
        global $conn;
        $id = $data["id"];
        $NIM_Mahasiswa    =  htmlspecialchars($data["NIM_Mahasiswa"]);
        $Nama_Mahasiswa  = htmlspecialchars($data["Nama_Mahasiswa"]);
        $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);
    
        $query = "UPDATE mahasiswa SET
                    Nama_Mahasiswa = '$Nama_Mahasiswa',
                     NIM_Mahasiswa= '$NIM_Mahasiswa',
                    Id_Jurusan = '$Id_Jurusan'
                  WHERE id=$id
                ";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);	
    }

    function cari($keyword){
        $query = "SELECT  Nama_Mahasiswa, NIM_Mahasiswa , jurusan.Nama_Jurusan
                FROM mahasiswa
                 JOIN jurusan
                 ON jurusan.Id_Jurusan = mahasiswa.Id_Jurusan
                WHERE 
                Nama_Mahasiswa LIKE '%$keyword%' OR 
                NIM_Mahasiswa LIKE '$keyword' OR
                Nama_Jurusan LIKE '%$keyword%' ;
        ";
        return query($query);
    }


    function krs($data){
        global $conn;
        $Id_Mahasiswa    =  htmlspecialchars($data["Id_Mahasiswa"]);
        $TahunAkademik  = htmlspecialchars($data["TahunAkademik"]);
        $query="INSERT INTO krs
        VALUES('','$Id_Mahasiswa','$TahunAkademik')";      
        mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }



    
?>