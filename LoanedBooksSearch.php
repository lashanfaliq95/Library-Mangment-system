<html>
 <head>
  <title>Search Order</title>
 </head>
 <body>
 
 <link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
 <link rel="stylesheet" type="text/css" href="background.css" media="screen" />
 
 <ul class="tab">
  <li><a href="HomePage.html" >HOME</a></li>
  <li><a href="AllBooks.php" >ALL BOOKS</a></li>
  <li><a href="LoanedBooks.php" >LOANED BOOKS</a></li>
  <li><a href="MemberDetails.php" >MEMBER DETAILS</a></li>
</ul>
 

            <?php  

                $book = $_POST['SearchLoanedBook'];         

                $db = mysqli_connect('localhost','root','','library') or die('Error connecting to MySQL server.');
     
                $query = "SELECT * FROM books_loaned WHERE `name` = '$book' OR `book_id` = '$book' OR `branch_id` = '$book' OR `card_no` = '$book' OR `due_date` = '$book' OR `date_out` = '$book' OR `name` Like '$book%'";
                
                $result = mysqli_query($db, $query) or die('Error querying database.');  
                
                if ((mysqli_num_rows($result) == 0) || ($book == '')) {
					echo '<h1>'."Sorry!! No results found :(".'</h1>';
				}
				
				else {
                
					echo "<table id='display'>";

					echo '<tr>';
					echo '<td><b>'."Book ID".'</b></td>'.'<td><b>'."Book Name".'</b></td>'.'<td><b>'."Branch ID".'</b></td>'.'<td><b>'."Loaned Member ID".'</b></td>'.'<td><b>'."Due Date".'</b></td>'.'<td><b>'."Date Out".'</b></td>'.'<td><b>'."Loaned Member Name".'</b></td>';
                
                echo '<h2>'."Your Search Results".'</h2>';
                                  
                while ($row = mysqli_fetch_row($result)) {
                      echo '<tr>';
                      foreach ($row as $field) {
						      $column = $row[3];						      
						      $new_query =  "SELECT * FROM member WHERE `Card_NO` = '$column'";
						      $new_result = mysqli_query($db, $new_query) or die('Error querying database.');
						      $new_row = mysqli_fetch_row($new_result);						      
                              echo '<td>' . $field . '</td>';
                              }                                                    
						  
						  echo '<td>' . $new_row[1] . '</td>';					  
						          
                      echo '</tr>';
                      }
				  }			  
				
				  
                mysqli_close($db);

	?>
 </body>
</html>
                 


