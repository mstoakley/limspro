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

public function addNewMember($dbo,$fName,$lName,$eMail,$address)
  {
    $cmd = "INSERT into members (FirstName,LastName,Email,HomeAddress) VALUES (:fName,:lName,:eMail,:haddress)";
    $statement = $dbo->conn->prepare($cmd);
    try{
    $statement->execute([':fName' => $fName,':lName' => $lName,':eMail' => $eMail,':haddress' => $address]);
    $MembID = $dbo->conn->lastInsertId();
    return $MembID;
    }catch(PDOException $e){
      echo "Error: Author " . $e->getMessage();
      return 0;
}

}
}

?>