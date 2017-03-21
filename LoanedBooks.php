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
 
<div class = "div" align = "center"> 
<form action="LoanedBooksSearch.php" method="POST"><pre>
<h3>Search a Loaned Book: (by Title,ID,Branch,Author or Publisher)</h3><input type = "text" name = "SearchLoanedBook" style= "width: 400px; height: 25px;"><input type = "submit" name = "Search" value = "Search" style= "width: 100px;height: 31px;"> 
</form>

<form action="LoanedBooksDelete.php" method="POST">
<h3>Delete a Loaned Book: (by Book ID and Member's Card Number)</h3><b>ENTER ID :</b> <input type = "text" name = "DeleteLoanedBookID" style= "width: 400px; height: 25px;">  <b>ENTER CARD NO :</b> <input type = "text" name = "DeleteLoanedBookCard" style= "width: 400px; height: 25px;"><input type = "submit" name = "Delete" value = "Delete" style= "width: 100px;height: 31px;"> 
</form></pre></div>
 
 

            <?php                           

                $db = mysqli_connect('localhost','root','','library') or die('Error connecting to MySQL server.');
     
                $query = "SELECT * FROM books_loaned";
                
                $result = mysqli_query($db, $query) or die('Error querying database.');  
                
                if (mysqli_num_rows($result) == 0) {
					echo '<h1>'."No Books are Loaned".'</h1>';
				}
				
				else {
                
                echo "<table id='display'>";

                echo '<tr>';
                echo '<td><b>'."Book ID".'</b></td>'.'<td><b>'."Book Name".'</b></td>'.'<td><b>'."Branch ID".'</b></td>'.'<td><b>'."Loaned Member ID".'</b></td>'.'<td><b>'."Due Date".'</b></td>'.'<td><b>'."Date Out".'</b></td>'.'<td><b>'."Loaned Member Name".'</b></td>';
                
                echo '<h2>'."All Loaned Books".'</h2>';
                                  
                while ($row = mysqli_fetch_row($result)) {
                      echo '<tr>';
                      foreach ($row as $field) {
						      $column = $row[3];						      
						      $new_query =  "SELECT * FROM member WHERE `Card_NO` = '$column'";
						      $new_result = mysqli_query($db, $new_query) or die('Error querying database.');
						      $new_row = mysqli_fetch_row($new_result);						      
                              echo '<td>' . $field . '</td>';
                              }           
                                                                       
						  if ($new_row == '') { $new_row[1] = "Member has been Deleted";}
						  echo '<td>' . $new_row[1] . '</td>';					  
						          
                      echo '</tr>';
                      }
				  }
                mysqli_close($db);

	?>
 </body>
</html>
                 


