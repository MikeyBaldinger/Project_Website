<?php
/* Embedding account credentials isn't ideal...preferable to
 * store in a separate file that is included by PHP (and not
 * accessible to others)
 */
$username = "student";
$password = "CompSci364";
$database = "student";

$connection = new mysqli("localhost", $username, $password,
                         $database);
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">

   <body>
     <h2>Stats</h2>

     <ul>
    <?php
      $query = "SELECT * ".
               "FROM Player";
      $book_results = $connection->query($query);
      while ($book = $book_results->fetch_assoc()) {
        $name = $book['player_name'];
        $num = $book['number'];
        $height = $book['height'];
        $weight = $book['weight'];
        $yrs_pro = $book['yrs_pro'];
        /*
        $authors = NULL;

        $query = "SELECT * ".
                 "FROM Author INNER JOIN Writes ".
                 "        ON Author.id = Writes.author_id ".
                 "WHERE Writes.isbn = '$isbn';";
        $author_results = $connection->query($query);
        while ($author = $author_results->fetch_assoc()) {
          if ($authors !== NULL) // not the first author
            $authors .= ", ";

          $authors .= $author['given_name']." ".$author['surname'];
        }
        */
     ?>
       <li><?php echo "$name, $num, $height".
                      "$weight, $yrs_pro"; ?></li>
    <?php
      }
     ?>
    </ul>

   </body>
 </html>
