<?php
require_once 'database.php';
class MemberDB{

public function IfMemberExists($dbo,$memberID)
{ 
    $cmd = "SELECT ID FROM members WHERE ID = :memberID";

    $statement = $dbo->conn->prepare($cmd);
    $statement->execute([':memberID' => $memberID]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($result) > 0 ){
        return true;
    }
    else{
        return false;
    }

}
public function addNewMember($dbo,$booktitle,$authorname,$genreName)
  {
    $cmd = "INSERT into author (AuthorName) VALUES (:authorname)";
    $statement = $dbo->conn->prepare($cmd);
    try{
    $statement->execute([':authorname' => $authorname]);
    }catch(PDOException $e){
      echo "Error: Author " . $e->getMessage();
      return 0;
    }
    $authorID = $dbo->conn->lastInsertId();
    $cmd = "INSERT into genre (GenreName) VALUES (:genrename)";
    $statement = $dbo->conn->prepare($cmd);
    try{
    $statement->execute([':genrename' => $genreName]);
    }catch(PDOException $e){
      echo "Error:Genre" . $e->getMessage();
      return 0;
    }
    $genreID = $dbo->conn->lastInsertId();

    $cmd = "INSERT into books (Title,GenreId,ID) VALUES (:title,:genreID,:authorID)";
    $statement= $dbo->conn->prepare($cmd);
    try{
    $statement->execute([':title' => $booktitle, ':genreID' => $genreID,':authorID' => $authorID]);
    }catch(PDOException $e){
      echo "Error: Title " . $e->getMessage();
      return 0;
    }
    return 1;
}

}

?>