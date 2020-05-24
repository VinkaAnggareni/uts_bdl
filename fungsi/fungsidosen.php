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



 //fungsi dosen
 function tambahdosen($data){
    global $conn;
    $NIP_Dosen    =  htmlspecialchars($data["NIP_Dosen"]);
    $Nama_Dosen  = htmlspecialchars($data["Nama_Dosen"]);
    $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);

    $query="INSERT INTO dosen
    VALUES('','$NIP_Dosen','$Nama_Dosen','$Id_Jurusan')";
        mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}


function hapusdosen($id){
    global $conn;
    mysqli_query($conn,"DELETE FROM dosen WHERE Id_Dosen=$id");
    return mysqli_affected_rows($conn);
}



function ubahdosen($data) {
    global $conn;
    $id = $data["Id_Dosen"];
    $NIP_Dosen = htmlspecialchars($data["NIP_Dosen"]);
    $Nama_Dosen    =  htmlspecialchars($data["Nama_Dosen"]);
    $Id_Jurusan   = htmlspecialchars($data["Id_Jurusan"]);

    $query = "UPDATE dosen SET
                NIP_Dosen = '$NIP_Dosen',
                Nama_Dosen = '$Nama_Dosen',
                Id_Jurusan = '$Id_Jurusan'
                 WHERE Id_Dosen='$id'
            ";
    
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);	
}

function caridosen($keyword){
    $query = "SELECT  Nama_Dosen, NIP_Dosen , jurusan.Nama_Jurusan
            FROM dosen
             JOIN jurusan
             ON jurusan.Id_Jurusan = dosen.Id_Jurusan
            WHERE 
            Nama_Dosen LIKE '%$keyword%' OR 
            NIP_Dosen LIKE '$keyword' OR
            Nama_Jurusan LIKE '%$keyword%' ;
    ";
    return query($query);
}

?>