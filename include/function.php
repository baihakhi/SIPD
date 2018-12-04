<?php

ob_start();

require_once ('global_function.php');


//------------------------------admin login function
function login ($table,$username,$password){
  global $db;

  $query = $db->query("SELECT * FROM ".$table." WHERE username='.$username.'");
  if ($query->num_rows > 0){

    $data = $query->fetch_object();
    if ($data->password == $password){
      return true;
    }
    else {
      return showAlert(2,"Password dan username tidak cocok");
    }
  }
  else{
    return showAlert(2,"username tidak ditemukan");
  }
  return true;
  //echo $query;
}

/*
function getAdmin ($username){

  $admin = $query->fetch_object();
  $nama = $admin->nama;
}
*/

//------------------------------data dosen function
//input data dosen function
function checkDosenExist ($arr){
  global $db;
  $NIP = $arr[0];
  $nama = $arr[1];
  $TTL = $arr[2];
  $email = $arr[3];
  $alamat = $arr[4];
  $foto = $arr[5];
  $password = $arr[6];
  $laboratorium = $arr[7];

  $query = $db->query("SELECT * FROM dosen WHERE NIP='$NIP' ");
  return checkQueryExist($query);
}


//==============edit data dosen function
function tambahDosen ($arr){
  global $db;

  $query = $db->query("INSERT INTO dosen (NIP, nama, TTL, alamat, email, foto, password, laboratorium)
  VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[4]','$arr[3]','$arr[5]','$arr[6]','$arr[7]')");

  return isset($query) ? checkQuery($query) : false;
}

function editDosen($arr,$dosenID){
  global $db;

  $query = $db->query("UPDATE dosen SET NIP='".$arr[0]."', nama='".$arr[1]."', TTL='".$arr[2]."', alamat='".$arr[4]."', email='".$arr[3]."', foto='".$arr[5]."', laboratorium='".$arr[6]."' WHERE NIP = '".$dosenID."'  ");

  return isset($query) ? checkQuery($query) : false;
}

function editDosen2($arr,$dosenID){
  global $db;

  $query = $db->query("UPDATE dosen SET NIP='".$arr[0]."', nama='".$arr[1]."', TTL='".$arr[2]."', email='".$arr[3]."', alamat='".$arr[4]."', laboratorium='".$arr[5]."' WHERE NIP = '".$dosenID."'  ");

  return isset($query) ? checkQuery($query) : false;
}

function getLabDosen($id){
  global $db;

  $query = $db->query("SELECT * FROM laboratorium JOIN dosen
                        ON laboratorium.id_lab=dosen.laboratorium
                        WHERE dosen.laboratorium='$id'");

  return isset($query) ? runQuery($query) : false;
}

//delete data dosen
function hapusData($id){
  global $db;

  $query = $db->query("DELETE FROM dosen WHERE nip='$id'");

  return isset($query) ? checkQuery($query) : false;
}

//==============edit data dosen function
function tambahMapel ($arr){
  global $db;

  $query = $db->query("INSERT INTO mapel (kode, nama, departemen, semester, tempat, hari, jam)
  VALUES ('$arr[0]','$arr[1]','$arr[2]','$arr[3]','$arr[4]','$arr[5]','$arr[6]')");

  return isset($query) ? checkQuery($query) : false;
}




?>
