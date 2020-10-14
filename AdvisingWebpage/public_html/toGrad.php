
<?php
  session_start();
	$page_title = 'GWU Advising System';


	//Load php tag into file once
  require_once('connectvars.php');
  require_once('appvars.php');
	require_once('header.php');
  require_once('navmenu.php');
 	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  
  
  if(isset($_POST["searchterm"])){
    echo "<center><h4>Students to Graduate by '$_POST[searchterm]'</h4></center>";
    $query = "select * from  student, personalinfo where universid = unid and applied_to_grad = 2 and program = '$_POST[searchterm]'";
    $result= mysqli_query($dbc, $query);
    echo '<table style="width:100%">';
    echo '<tr><th>First Name</th><th>Last Name</th><th>University ID</th><th>Major</th><th>Year Admitted</th><th>Program</th></tr>';
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["unid"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["program"]. "</center></td></tr></table>";
      }
    }else{
      $query = "select * from  student, personalinfo where universid = unid and applied_to_grad = 2 and major = '$_POST[searchterm]'";
      $result= mysqli_query($dbc, $query);
      if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
          echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["unid"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["program"]. "</center></td></tr></table>";
        }
      }else{
        $query = "select * from  student, personalinfo where universid = unid and applied_to_grad = 2 and yearadmitted = '$_POST[searchterm]'";
        $result= mysqli_query($dbc, $query);
        if ($result->num_rows > 0){
          while($row = $result->fetch_assoc()){
            echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["unid"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["program"]. "</center></td></tr></table>";
          }
        }else{
          echo "No Student Data Found";
        }
      }
    }
    echo '</table></div><br>';
    echo '<hr />';  
    echo '</br><form action="" method="post">';
    echo  '<label for="searchterm">Search : </label><br>';
    echo  '<input type="text" id="searchterm" name="searchterm"><br>';
    echo  '<input type="submit" name="Search" value="Search">';
    echo	'</form>';
  }
  else{
  
    echo '<center><h4>Students to Graduate</h4></center><div class="stuData">';
    $query = "select * from  student, personalinfo where universid = unid and applied_to_grad = 2";
    $result= mysqli_query($dbc, $query);
    //PRINT OUT ALL USERS TO A TABLE
    if ($result->num_rows > 0){
      echo '<table style="width:100%">';
      echo '<tr><th>First Name</th><th>Last Name</th><th>University ID</th><th>Major</th><th>Year Admitted</th><th>Program</th></tr>';
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["unid"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["program"]. "</center></td></tr>";
      }
      echo '</table></div><br>';
      echo '<hr />';  
      echo '</br><form action="" method="post">';
      echo  '<label for="searchterm">Search : </label><br>';
      echo  '<input type="text" id="searchterm" name="searchterm"><br>';
      echo  '<input type="submit" name="Search" value="Search">';
      echo	'</form>';
    }
    else{
      echo "<center>No Students Eligble for Graduation</center>";
    }
    
  }  
  
  
  
  
  
  
  
  require_once('footer.php');

?>
