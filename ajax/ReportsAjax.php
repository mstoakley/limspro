<?php

$root = $_SERVER['DOCUMENT_ROOT'];
include  $root."/limspro/database/database.php";
include  $root."/limspro/database/ReportsDB.php";
$action1 =$_POST["action"];

if($action1 == "GetFinesOver20"){
        $dbo = new Database();
        $bbo = new ReportsDB();
     $result = $bbo -> getFinesOver20Dollars($dbo);
     $rv = json_encode($result);
 echo($rv);
 exit();
}
if($action1 == "GetAllCheckedOutBooks"){
    $dbo = new Database();
    $mbo = new ReportsDB();
    $result = $mbo -> getCheckedOutBooks($dbo);
    $rv = json_encode($result);
    echo($rv);
}
if($action1 == "GetAllMembers"){
    $dbo = new Database();
    $mbo = new ReportsDB();
    $result = $mbo -> getAllMembers($dbo);
    $rv = json_encode($result);
    echo($rv);
}
?>