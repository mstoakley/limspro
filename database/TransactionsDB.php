<?php
require_once 'database.php';
class TransactionsDB{
    

function checkoutBook($dbo, $MemberId, $bookId) {
    if ($this->canCheckOutBook($dbo, $MemberId)) {
        $this->updateBookAvailability($bookId, $dbo);
    $this->insertCheckoutEntry($bookId, $MemberId, $dbo);
    return true; 
    } else {
        // Provide feedback to the user that they have reached the maximum limit
        echo "Sorry, you can only check out a maximum of 2 books.";
        
    }
    
}
// Function to return a book
function returnBook($bookId, $memberID, $dbo) {
$checkoutId = $this->userCheckedOutBooks($dbo, $memberID);
if ($checkoutId !== null) {
    if($this->userCheckedOutBook($dbo, $memberID, $bookId)){
        $dueDate = $this-> getDueDate($dbo, $checkoutId);
    $this -> insertReturnEntryWithFine($checkoutId, $dueDate, $dbo);
    $this -> updateBookReturns($bookId,$dbo);
    
   return true;
    }else{
        exit("You have not checked out this book.");
    }
    
} else {
    exit("You have not checked out any books.");
}
 
}

// Function to get the all available books
function getBookAvailability($dbo) {
    try {
        // Replace 'books' with your actual table name
        $sql = "SELECT books.ID as BID,
        books.Title as BTitle FROM books WHERE Availability = 1";

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
function userCheckedOutBook($dbo, $memberID, $bookId) {
    $sql = "SELECT * FROM checkouts WHERE MemberId = :memberId AND BookID = :bookId";
    $statement = $dbo->conn->prepare($sql);
    $statement->execute([':memberId' => $memberID, ':bookId' => $bookId]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ? true : false;
}
function userCheckedOutBooks($dbo, $memberID) {
    $cmd = "SELECT ID as CheckoutId FROM checkouts WHERE MemberId = :memberID";
    $statement = $dbo->conn->prepare($cmd);
    $statement->execute([':memberID' => $memberID]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['CheckoutId'] : null;
}
function getCheckedOutBooks($dbo) {
    try {
        // Replace 'books' with your actual table name
        $sql = "SELECT books.ID as BID,
        books.Title as BTitle FROM books WHERE Availability = 0";

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


// Function to update the Availability of a book
function updateBookAvailability($bookId,$dbo) {
    // Replace 'books' with your actual table name
    $sql = "UPDATE books SET Availability = 0 WHERE ID = ?";

    // Use prepared statements to prevent SQL injection

    $statement= $dbo->conn->prepare($sql);
    try{
        $statement->execute([$bookId]);
        }catch(PDOException $e){
          echo "Error: Title " . $e->getMessage();
          return 0;
}}

function updateBookReturns($bookId,$dbo) {
    // Replace 'books' with your actual table name
    $sql = "UPDATE books SET Availability = 1 WHERE ID = ?";

    // Use prepared statements to prevent SQL injection

    $statement= $dbo->conn->prepare($sql);
    try{
        $statement->execute([$bookId]);
        }catch(PDOException $e){
          echo "Error: Title " . $e->getMessage();
          return 0;
}}
// Function to insert a new entry into the checkouts table
function insertCheckoutEntry($bookId, $MemberId, $dbo) {
    // Replace 'checkouts' with your actual table name
    $sql = "INSERT INTO checkouts (MemberId, BookId, DueDate, CheckOutDate)
            VALUES (:memberId, :bookId, DATE_ADD(CURDATE(), INTERVAL 14 DAY), CURDATE())";

    $stmt = $dbo->conn->prepare($sql);
    $stmt->bindParam(':memberId', $MemberId); // Replace with actual MemberId
    $stmt->bindParam(':bookId', $bookId);
    $stmt->execute();
}
function deleteCheckoutEntry($bookId, $memberId, $dbo) {
    // Replace 'checkouts' with your actual table name
    $sql = "DELETE FROM checkouts WHERE BookId = :bookId AND MemberId = :memberId";

    // Use prepared statements to prevent SQL injection
    $statement = $dbo->conn->prepare($sql);

    try {
        $statement->execute([':bookId' => $bookId, ':memberId' => $memberId]);
    } catch (PDOException $e) {
        // Handle the exception (e.g., log the error)
        echo "Error: " . $e->getMessage();
        return 0;
    }

    echo "Row deleted successfully.";
}


function insertReturnEntryWithFine($checkoutId, $dueDate, $dbo) {
    // Calculate the fine amount
    $fineAmount = $this->calculateFine(date('Y-m-d'), $dueDate);

    $sql = "INSERT INTO returns (CheckoutID, ReturnDate, FineAmount) VALUES (:checkoutId, CURDATE(), :fineAmount)";
    $statement = $dbo->conn->prepare($sql);

    try {
        $statement->execute([':checkoutId' => $checkoutId, ':fineAmount' => $fineAmount]);
        return $fineAmount;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0;
    }
}

function calculateFine($returnDate, $dueDate) {
    // Convert the date strings to DateTime objects
    $returnDate = new DateTime($returnDate);
    $dueDate = new DateTime($dueDate);
    
    // Calculate the difference in days
    $difference = $dueDate->diff($returnDate)->format('%R%a');
    
    // If the book is returned after the due date, calculate the fine
    if ($difference > 0) {
        // Example: $finePerDay is the fine amount per day
        $finePerDay = 2.50; // Adjust this value based on your requirements
        $fineAmount = $difference * $finePerDay;

        return $fineAmount;
    }else{
        return 0;
    }
}
function getDueDate($dbo, $checkoutId) {
    $cmd = "SELECT DueDate FROM checkouts WHERE ID = :checkoutId";
    $statement = $dbo->conn->prepare($cmd);
    $statement->execute([':checkoutId' => $checkoutId]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['DueDate'] : null;
}
function canCheckOutBook($dbo, $MemberId) {
    // Query to count the number of checked-out books for the member
    $sql = "SELECT COUNT(*) as numCheckedOut FROM checkouts WHERE MemberId = :memberID";
    $statement = $dbo->conn->prepare($sql);
    $statement->execute([':memberID' => $MemberId]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    // Check if the member can check out a new book (limit to 2 books)
    $maxBooksAllowed = 2;
    return $result['numCheckedOut'] < $maxBooksAllowed;
}

}

?>