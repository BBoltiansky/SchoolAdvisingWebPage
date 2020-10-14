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
    echo "<center><h4>Alumni Results for '$_POST[searchterm]'</h4></center>";
    echo '<table style="width:100%">';
    echo '<tr><th>First Name</th><th>Last Name</th><th>Major</th><th>Program</th><th>Year Admitted</th><th>Year Graduated</th><th>Cellphone</th><th>Address</th></tr>';
    
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and ftname = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and ltname = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and major = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and program = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and yearadmitted = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid and yeargrad = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query);
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
      }
    }
    echo "</table>";
  }else{
    $query = "select * from  alumni, student, personalinfo where universid = unid and univid = unid";
    $result = mysqli_query($dbc, $query);
    echo "<center><h4>Alumni Database</h4></center>";
    echo '<table style="width:100%">';
    echo '<tr><th>First Name</th><th>Last Name</th><th>Major</th><th>Program</th><th>Year Admitted</th><th>Year Graduated</th><th>Cellphone</th><th>Address</th></tr>';
    if ($result->num_rows > 0){
      while($row = $result->fetch_assoc()){
        echo "<tr><td><center>" . $row["ftname"]. "</center></td><td><center>" . $row["ltname"]. "</center></td><td><center>" . $row["major"]. "</center></td><td><center>" . $row["program"]. "</center></td><td><center>" . $row["yearadmitted"]. "</center></td><td><center>" . $row["yeargrad"]. "</center></td><td><center>" . $row["cell"]. "</center></td><td><center>" . $row["address"]. "</center></td></tr>";
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
  
  
  
  require_once('footer.php');

?>
