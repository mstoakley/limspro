<?php
// {a:21 , b: 22,action:"GetAllBooks"},
$root = $_SERVER['DOCUMENT_ROOT'];
include  $root."/limspro/database/database.php";
include  $root."/limspro/database/BooksDB.php";
include  $root."/limspro/database/MembersDB.php";
$action1 =$_POST["action"];

if($action1 == "GetAllBooks"){
        $dbo = new Database();
        $bbo = new BooksDB();
     $result = $bbo -> getAllBooks($dbo);
     $rv = json_encode($result);
 echo($rv);
 exit();
}
if($action1 == "LoadAllGenres"){
    $dbo = new Database();
    $bbo = new BooksDB();
    $result = $bbo -> getGenres($dbo);
    $rv = json_encode($result);
    echo($rv);
}

if($action1 == "SaveBook"){
    $author = $_POST['author'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $dbo = new Database();
    $bbo = new BooksDB();
    $result = $bbo -> addNewBook($dbo,$title,$author,$genre);
    echo($result);
    exit();
}

if($action1 == "CheckMember"){
    $memberID = $_POST['member'];
    $dbo = new Database();
    $mbo = new MemberDB();
    $result = $mbo -> IfMemberExists($dbo,$memberID);
    echo($result);
}
?>