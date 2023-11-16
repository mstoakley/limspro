<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include  $root."/limspro/database/database.php";
include  $root."/limspro/database/TransactionsDB.php";
$action1 =$_POST["action"];

if($action1 == "CheckOut"){
    $ID = $_POST['userbook'];
    $memberID = $_POST['member'];
    $dbo = new Database();
    $mbo = new TransactionsDB();
    $result = $mbo -> checkoutBook($dbo,$memberID,$ID);
    echo($result);
}

if($action1 == "LoadAvailableBooks"){
    $dbo = new Database();
    $mbo = new TransactionsDB();
    $result = $mbo -> getBookAvailability($dbo);
    $rv = json_encode($result);
    echo($rv);
}
?>