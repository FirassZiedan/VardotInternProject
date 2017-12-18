<?php
include_once '../setting/conn.php';

$img = $GLOBALS['imgpath'];
class carousal {

  function __construct() {
    $conn = $GLOBALS['conn'];
  }

  function getCaro() {

      $conn = $GLOBALS['conn'];
      $sql = "SELECT *  FROM `files` Where type_id = 1 ORDER BY f_id DESC ;";
      
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        return $result;
      }
  }

  function getOne($id) {

    $conn = $GLOBALS['conn'];
    $sql = "SELECT *  FROM `files` Where type_id = 1  AND f_id =" . $id . ";";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

      return $result;
    }
  }

  function delete($id) {

    $conn = $GLOBALS['conn'];
    $sql = "DELETE FROM `files` WHERE type_id = 1 AND f_id=" . $id;
    

    if ($conn->query($sql) == TRUE) {
      echo "Record deleted successfully";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
  }

  function insertCaro($file, $caption) {
    $conn = $GLOBALS['conn'];

    //$sql = "INSERT INTO `files` (`name`,`path`,`caption`, `type_id`) VALUES (' ','".$file."','".$caption."',1)";
    $sql = sprintf("INSERT INTO `files` (`name`,`path`,`caption`, `type_id`) VALUES (' ','%s','%s',1)", $img.$file, strtoupper($caption));
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

  function updatCaro($id, $file, $caption) {
    $conn = $GLOBALS['conn'];

    //$sql = sprintf("UPDATE `files` SET `caption` = '%s' , `path` =  '%s'  WHERE f_id = '%s' ", $caption, $file, $id);
    $sql = "UPDATE `files` SET `caption` = '".strtoupper($caption)."' ";
   
    if ($file != '') {
      $sql =$sql ." , `path` = '". $img.$file ."' ";
    }
    $sql = $sql . "WHERE f_id = ". $id .";";

    if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $conn->error;
    }
    
  }

}

?>