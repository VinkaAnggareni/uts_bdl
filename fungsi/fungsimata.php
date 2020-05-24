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
    
    function tambahmaha($data){
        global $conn;
        //`Id_Matakuliah`, `NamaMatakuliah`, `Semester`, `SKS`, `Kurikulum`, `Id_Jurusan`
        $NamaMatakuliah   = htmlspecialchars($data["NamaMatakuliah"]);
        $Semester   = htmlspecialchars($data["Semester"]);
        $SKS   = htmlspecialchars($data["SKS"]);
        $Kurikulum   = htmlspecialchars($data["Kurikulum"]);
        $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);
    

        $query="INSERT INTO matakuliah
        VALUES ('','$NamaMatakuliah','$Semester','$SKS',
                '$Kurikulum',
                '$Id_Jurusan')";
            mysqli_query($conn,$query);
        return mysqli_affected_rows($conn);
    }


    function hapus($id){
        global $conn;
        mysqli_query($conn,"DELETE FROM matakuliah WHERE Id_Matakuliah = $id");
    }

    
    function ubahmata($data) {
        global $conn;
        $id = $data["Id_Matakuliah"];
        $NamaMatakuliah   = htmlspecialchars($data["NamaMatakuliah"]);
        $Semester   = htmlspecialchars($data["Semester"]);
        $SKS   = htmlspecialchars($data["SKS"]);
        $Kurikulum   = htmlspecialchars($data["Kurikulum"]);
        $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);
    
        $query = "UPDATE matakuliah SET 
        NamaMatakuliah='$NamaMatakuliah',
        Semester='$Semester',
        SKS='$SKS',
        Kurikulum='$Kurikulum',
        Id_Jurusan='$Id_Jurusan' 
        WHERE Id_Matakuliah = $id
                ";
        
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);	
    }

    // function view($data) {
    //     global $conn;
    //     $Nama_Mahasiswa  = htmlspecialchars($data["Nama_Mahasiswa"]);
    //     $NIM_Mahasiswa   = htmlspecialchars($data["Id_Matakuliah"]);
    //     $NamaMatakuliah  = htmlspecialchars($data["NamaMatakuliah"]);
        
    //     $query = "CREATE VIEW kuliah_id AS SELECT mahasiswa.Nama_Mahasiswa, mahasiswa.NIM_Mahasiswa, matakuliah.NamaMatakuliah
    //     FROM detailkrs
    //     JOIN matakuliah
    //     ON matakuliah.Id_Matakuliah = detailkrs.Id_Matakuliah
    //     JOIN krs
    //     ON krs.Id_KRS = detailkrs.Id_KRS
    //     JOIN mahasiswa
    //     ON mahasiswa.id = krs.Id_Mahasiswa
    //     WHERE matakuliah.Id_Matakuliah = $id
    //     ";
        
    //     mysqli_query($conn, $query);
    //     return mysqli_affected_rows($conn);	
    // }



?>