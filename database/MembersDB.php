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

}

?>