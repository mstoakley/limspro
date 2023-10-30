<?php
require_once 'database.php';
require_once 'BooksDB.php';
//create an instance of the database class to make a connection to the database
$dbo = new Database();
$booksDB = new BooksDB();

$booksDB -> getAllBooks($dbo);
print_r($result);

?>
<?php
require_once 'database.php';
//create an instance of the database class to make a connection to the database

$dbo = new Database();
//The following is how a new book would be added to the database
$booktitle = "The Hobbit";
$authorname = "J.R.R. Tolkien";
$isbn = "9780618574985";
$genreName = "Science Fiction";


$cmd = "INSERT into author (AuthorName) VALUES (:authorname)";
$statement = $dbo->conn->prepare($cmd);
$statement->execute([':authorname' => $authorname]);

$authorID = $dbo->conn->lastInsertId();

$cmd = "INSERT into genre (GenreName) VALUES (:genrename)";
$statement = $dbo->conn->prepare($cmd);
$statement->execute([':genrename' => $genreName]);

$genreID = $dbo->conn->lastInsertId();

$cmd = "INSERT into books (Title,ISBN,GenreId,AuthorID) VALUES (:title,:isbn,:genreID,:authorID)";
$statement= $dbo->conn->prepare($cmd);
$statement->execute([':title' => $booktitle, ':isbn' => $isbn, ':genreID' => $genreID,':authorID' => $authorID]);

///Query to get all books
$cmd = "SELECT
author.AuthorName as AName,
books.Title as BTitle,
genre.GenreName as GName,
FROM
books 
JOIN author ON books.AuthorId = author.AuthorId
JOIN genre ON books.GenreId = genre.GenreId
";
//prepare the sql statement
$statement = $dbo->conn->prepare($cmd);
//execute the statement
 $statement->execute();
//fetch the results
print_r($result);
?>