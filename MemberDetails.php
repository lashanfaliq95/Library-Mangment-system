
<html>
 <head>
  <title>Seach Member</title>
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
<form action="MemberDetailsSearch.php" method="POST"><pre>
<h3>Search a Member: (by Name, Card Number)</h3><input type = "text" name = "SearchMember" style= "width: 400px; height: 25px;"><input type = "submit" name = "Search" value = "Search" style= "width: 100px;height: 31px;"> 
</form>
<form action="MemberDetailsDelete.php" method="POST">
<h3>Delete a Member: (by Card Number)</h3><input type = "text" name = "DeleteMember" style= "width: 400px; height: 25px;"><input type = "submit" name = "Delete" value = "Delete" style= "width: 100px;height: 31px;"> 
</form></pre></div>



<?php  

                      

                $db = mysqli_connect('localhost','root','','library') or die('Error connecting to MySQL server.');
     
                $query = "SELECT * FROM member ORDER BY Card_No ASC ";
                
				
                $result = mysqli_query($db, $query) or die('Error querying database.');  
                
				
                if (mysqli_num_rows($result) == 0) {
					echo '<h1>'."Sorry!! No Members Found :(".'</h1>';
				}
				
				else {
                
                echo "<table id='display'>";

                echo '<tr>';
                echo '<td><b>'."Card_No".'</b></td>'.'<td><b>'."Name".'</b></td>'.'<td><b>'."Address".'</b></td>'.'<td><b>'."Book ID".'</b></td>'.'<td><b>'."Book Name".'</b></td>';
                
                echo '<h2>'."All Members".'</h2>';
                                  
                while ($row = mysqli_fetch_row($result)) {
					
					
                      echo '<tr>';
                      foreach ($row as $field) {
						      $column = $row[0];
						     
							 
						      $new_query1 =  "SELECT * FROM books_loaned WHERE `card_no` = '$column'";
						      $new_result1 = mysqli_query($db, $new_query1) or die('Error querying database.');
							  
							  $new_query2 =  "SELECT * FROM books_loaned WHERE `card_no` = '$column'";
						      $new_result2 = mysqli_query($db, $new_query2) or die('Error querying database.');
						     
							  

							
                              echo '<td>' . $field . '</td>';
                              }
							  
							  echo '<td>' ;
								
				while ($new_row1 = mysqli_fetch_row($new_result1)) {
							 echo $new_row1[0] .'<br>' ;
							 
				}
							 echo '</td>';
							 
							 
							 echo '<td>' ;
							 $bname='-';
							 if(mysqli_num_rows($new_result2)!=0){
				while ($new_row2 = mysqli_fetch_row($new_result2)) {
							$bname = $new_row2[1];	
							 echo $bname .'<br>' ;
							 }
				 }
				 
				 else{
					 echo $bname .'<br>' ;
				 }
							 echo '</td>';
							 
						
                      }
					  
					  
				  }
                mysqli_close($db);

	?>


 </body>
</html>
