<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include  $root."/limspro/database/database.php";
include  $root."/limspro/database/MembersDB.php";
$action1 =$_POST["action"];
if($action1 == "CheckMember"){
    $memberID = $_POST['member'];
    $dbo = new Database();
    $mbo = new MemberDB();
    $result = $mbo -> IfMemberExists($dbo,$memberID);
    echo($result);
}
?>