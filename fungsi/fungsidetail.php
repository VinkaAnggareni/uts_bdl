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
        $Id_KRS  = htmlspecialchars($data["Id_KRS"]);
        $Id_Matakuliah   = htmlspecialchars($data["Id_Matakuliah"]);
        $Kelas   = htmlspecialchars($data["Kelas"]);
        $Nilai   = htmlspecialchars($data["Nilai"]);
        $Id_Dosen   = htmlspecialchars($data["Id_Dosen"]);

        $query="INSERT INTO detailkrs
        VALUES ('','$Id_KRS', '$Id_Matakuliah', '$Kelas', '$Nilai', '$Id_Dosen')";
            mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }


    function hapus($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM detailkrs WHERE Id_Detail = $id");
    }

    
    function ubah($data) {
        global $conn;
        $id = $data["Id_Detail"];
        $Id_KRS  = htmlspecialchars($data["Id_KRS"]);
        $Id_Matakuliah   = htmlspecialchars($data["Id_Matakuliah"]);
        $Kelas   = htmlspecialchars($data["Kelas"]);
        $Nilai   = htmlspecialchars($data["Nilai"]);
        $Id_Dosen   = htmlspecialchars($data["Id_Dosen"]);
        
        $query = "UPDATE detailkrs SET 
                    Id_KRS ='$Id_KRS',
                    Id_Matakuliah ='$Id_Matakuliah',
                    Kelas ='$Kelas',
                    Nilai ='$Nilai',
                    Id_Dosen= '$Id_Dosen'
                  WHERE Id_Detail=$id
                ";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);	
    }





?>