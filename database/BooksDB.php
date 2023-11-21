<?php
require_once 'database.php';
class BooksDB
 {  
    public function getAllBooks($dbo)
  {
    $cmd = "SELECT
      author.AuthorName as AName,
      books.Title as BTitle,
      genre.GenreName as GName
      FROM
      books 
      JOIN author ON books.AuthorId = author.ID
      JOIN genre ON books.GenreId = genre.ID
      WHERE books.Title IS NOT NULL";
    ;
  
    
    $statement = $dbo->conn->prepare($cmd);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }

  function getBookTitles($dbo){
    $cmd = "SELECT books.ID as BID,
        books.Title as BTitle FROM books WHERE Availability = 1";
    $statement = $dbo->conn->prepare($cmd);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  function deleteBook($bookId, $dbo) {
    $sql = "DELETE FROM books WHERE id = :bookId";
    $statement = $dbo->conn->prepare($sql);

    try {
      $statement->execute([':bookId' => $bookId]);
      return true;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return false;
    }
  }
  public function getBooksByGenre($dbo,$genreName)
  {
    $cmd = "SELECT
    author.AuthorName as AName,
    books.Title as BTitle,
    genre.GenreName as GName
    FROM
    books 
    JOIN author ON books.AuthorId = author.ID
    JOIN genre ON books.GenreId = genre.ID
    WHERE genre.GenreName = :genreName";
    $statement = $dbo->conn->prepare($cmd);
    $statement->execute([':genreName' => $genreName]);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function addNewBook($dbo,$booktitle,$authorname,$genreName)
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
    public function getGenres($dbo)
    {
      $cmd = "SELECT ID as GId, GenreName as GName
      FROM genre
      ";
      $statement = $dbo->conn->prepare($cmd);
      $statement->execute();
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    } 
    
}
?>