<?php
// {a:21 , b: 22,action:"GetAllBooks"},
$root = $_SERVER['DOCUMENT_ROOT'];
include  $root."/limspro/database/database.php";
include  $root."/limspro/database/BooksDB.php";
$action1 =$_POST["action"];

if($action1 == "GetAllBooks"){
        $dbo = new Database();
        $bbo = new BooksDB();
     $result = $bbo -> getAllBooks($dbo);
     $rv = json_encode($result);
 echo($rv);
 exit();
}
if($action1 == "LoadGenres"){
    $dbo = new Database();
    $bbo = new BooksDB();
    $result = $bbo -> getGenres($dbo);
    $rv = json_encode($result);
    echo($rv);
}

if($action1 == "SendBooks"){
    $authortext = $_POST["authortext"];
    $booktitle = $_POST["booktext"];
    $ddgenre = $_POST["ddgenre"];
    $dbo = new Database();
    $bbo = new BooksDB();
    $result = $bbo -> addNewBook($dbo,$booktitle,$authortext,$ddgenre);
    echo($result);
    exit();
}
?>