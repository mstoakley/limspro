<?php
require_once 'database.php';
class ReportsDB{
    
function getFinesOver20Dollars($dbo) {
    $cmd = "SELECT m.ID as MemberID, r.FineAmount
    FROM returns r
    JOIN checkouts c ON r.CheckoutID = c.ID
    JOIN members m ON c.MemberId = m.ID
    WHERE r.FineAmount > 20;
    ";
   $statement = $dbo->conn->prepare($cmd);
   $statement->execute();
   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
   return $result;
}
function getAllMembers($dbo) {
    $cmd = "SELECT * FROM `members` WHERE 1";
   $statement = $dbo->conn->prepare($cmd);
   $statement->execute();
   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
   return $result;
}
function getCheckedOutBooks($dbo) {
    try {
        // Replace 'books' with your actual table name
        $sql = "SELECT b.ID as BookID,b.Availability as Bvailability, b.Title as BookTitle, a.AuthorName as AuthorName, c.DueDate
        FROM checkouts c
        JOIN books b ON c.BookID = b.ID
        JOIN author a ON b.AuthorId = a.ID
        Where b.Availability = 0"
        ;

        // Use prepared statements to prevent SQL injection
        $statement = $dbo->conn->prepare($sql);
        $statement->execute();
        
        // Fetch the result set as an associative array
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    } catch (PDOException $e) {
        // Handle any database errors
        return array('error' => $e->getMessage());
    }
}
}
?>