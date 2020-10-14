
<?php
  session_start();
	$page_title = 'GWU Advising System';


	//Load php tag into file once
  require_once('connectvars.php');
  require_once('appvars.php');
	require_once('header.php');
  require_once('navmenu.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $MSavgGPA = 0;
  $MScounter = 0;
  $PHDavgGPA = 0;
  $PHDcounter = 0;
  function avgGPAfunction($resultA, $resultB, $resultC, $resultD, $resultF, $totalhours){
            $attemptedhours = ($resultA * 4.00 * 3.00) + ($resultB * 3.00 * 3.00) + ($resultC * 2.00 * 3.00) + ($resultD * 1.00 * 3.00) + ($resultF * 0.00 * 3.00);
            if($totalhours == 0){
              $avggpa = 4.0;
            }else{
              $avggpa = $attemptedhours / $totalhours;
            }
            return $avggpa;
  }
  
  if(isset($_POST["searchterm"])){
    $query = "select unid, program, gpa from student, alumni WHERE (NOT unid = univid) and yearadmitted = '$_POST[searchterm]'";
    $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
    if(mysqli_num_rows($result) > 0){
      while($row = $result->fetch_assoc()){ 
        
          $uid = $row["unid"];
          $queryA = "SELECT SUM(CASE grade WHEN 'A' THEN 1 ELSE 0 END) totalA FROM transcript WHERE univerid = $uid;";
          $numberOfAs = mysqli_query($dbc, $queryA);
          $numberOfAs = $numberOfAs->fetch_assoc();
          $resultA= $numberOfAs['totalA'];
          
          $queryB = "SELECT SUM(CASE grade WHEN 'B' THEN 1 ELSE 0 END) totalB FROM transcript WHERE univerid = $uid;";
          $numberOfBs = mysqli_query($dbc, $queryB);
          $numberOfBs = $numberOfBs->fetch_assoc();
          $resultB = $numberOfBs['totalB'];
          
          $queryC = "SELECT SUM(CASE grade WHEN 'C' THEN 1 ELSE 0 END) totalC FROM transcript WHERE univerid = $uid;";
          $numberOfCs = mysqli_query($dbc, $queryC);
          $numberOfCs = $numberOfCs->fetch_assoc();
          $resultC= $numberOfCs['totalC'];
          
          $queryD = "SELECT SUM(CASE grade WHEN 'D' THEN 1 ELSE 0 END) totalD FROM transcript WHERE univerid = $uid;";
          $numberOfDs = mysqli_query($dbc, $queryD);
          $numberOfDs = $numberOfDs->fetch_assoc();
          $resultD= $numberOfDs['totalD'];
          
          $queryF = "SELECT SUM(CASE grade WHEN 'F' THEN 1 ELSE 0 END) totalF FROM transcript WHERE univerid = $uid;";
          $numberOfFs = mysqli_query($dbc, $queryF);
          $numberOfFs = $numberOfFs->fetch_assoc();
          $resultF= $numberOfFs['totalF'];
            
          $query2 = "SELECT SUM(chours) cHOURS FROM transcript WHERE univerid = $uid;";
          $chours = mysqli_query($dbc, $query2);
          $chours = $chours->fetch_assoc();
          $totalhours= $chours['cHOURS'] + 0.00;
            
            
          $avggpa = avgGPAfunction($resultA, $resultB, $resultC, $resultD, $resultF, $totalhours);
          $avggpa = round((float)$avggpa, 2);
          $dbc->query("UPDATE student SET gpa = ". $avggpa . " WHERE unid = " . $uid);
          if(strcmp($row["program"], 'MS') == 0){
            $MScounter += 1;
            $MSavgGPA += $avggpa;
          }else{
            $PHDcounter += 1;
            $PHDavgGPA += $avggpa;
          }
      }
    }else{
      $query = "select unid, program, gpa from student, alumni WHERE (NOT unid = univid) and major = '$_POST[searchterm]'";
      $result = mysqli_query($dbc, $query) or die(mysqli_error($dbc));
      if(mysqli_num_rows($result) > 0){
        while($row = $result->fetch_assoc()){
        
          $uid = $row["unid"];
          $queryA = "SELECT SUM(CASE grade WHEN 'A' THEN 1 ELSE 0 END) totalA FROM transcript WHERE univerid = $uid;";
          $numberOfAs = mysqli_query($dbc, $queryA);
          $numberOfAs = $numberOfAs->fetch_assoc();
          $resultA= $numberOfAs['totalA'];
          
          $queryB = "SELECT SUM(CASE grade WHEN 'B' THEN 1 ELSE 0 END) totalB FROM transcript WHERE univerid = $uid;";
          $numberOfBs = mysqli_query($dbc, $queryB);
          $numberOfBs = $numberOfBs->fetch_assoc();
          $resultB = $numberOfBs['totalB'];
          
          $queryC = "SELECT SUM(CASE grade WHEN 'C' THEN 1 ELSE 0 END) totalC FROM transcript WHERE univerid = $uid;";
          $numberOfCs = mysqli_query($dbc, $queryC);
          $numberOfCs = $numberOfCs->fetch_assoc();
          $resultC= $numberOfCs['totalC'];
          
          $queryD = "SELECT SUM(CASE grade WHEN 'D' THEN 1 ELSE 0 END) totalD FROM transcript WHERE univerid = $uid;";
          $numberOfDs = mysqli_query($dbc, $queryD);
          $numberOfDs = $numberOfDs->fetch_assoc();
          $resultD= $numberOfDs['totalD'];
          
          $queryF = "SELECT SUM(CASE grade WHEN 'F' THEN 1 ELSE 0 END) totalF FROM transcript WHERE univerid = $uid;";
          $numberOfFs = mysqli_query($dbc, $queryF);
          $numberOfFs = $numberOfFs->fetch_assoc();
          $resultF= $numberOfFs['totalF'];
            
          $query2 = "SELECT SUM(chours) cHOURS FROM transcript WHERE univerid = $uid;";
          $chours = mysqli_query($dbc, $query2);
          $chours = $chours->fetch_assoc();
          $totalhours= $chours['cHOURS'] + 0.00;
            
            
          $avggpa = avgGPAfunction($resultA, $resultB, $resultC, $resultD, $resultF, $totalhours);
          $avggpa = round((float)$avggpa, 2);
          $dbc->query("UPDATE student SET gpa = ". $avggpa . " WHERE unid = " . $uid);
          if(strcmp($row["program"], 'MS') == 0){
            $MScounter += 1;
            $MSavgGPA += $avggpa;
          }else{
            $PHDcounter += 1;
            $PHDavgGPA += $avggpa;
          }
        }
      }else{
        echo "<center><h4>Data Not Found for ". $_POST["searchterm"] ."</h4></center>";
      }   
    }
    if($MScounter != 0 || $PHDcounter != 0){
      if($MScounter == 0){
        $percMS = 0;
        $MSavgGPA = 0.00;
        $PHDavgGPA = round((float)$PHDavgGPA / $PHDcounter, 2);
        $percPHD = ($PHDcounter / ($MScounter + $PHDcounter)) * 100;
      }else if($PHDcounter == 0){
        $percPHD = 0;
        $PHDavgGPA = 0.00;
        $MSavgGPA = round((float)$MSavgGPA / $MScounter, 2);
        $percMS = ($MScounter / ($MScounter + $PHDcounter)) * 100;
      }else{
        $MSavgGPA = round((float)$MSavgGPA / $MScounter, 2);
        $PHDavgGPA = round((float)$PHDavgGPA / $PHDcounter, 2);
        $percMS = ($MScounter / ($MScounter + $PHDcounter)) * 100;
        $percPHD = ($PHDcounter / ($MScounter + $PHDcounter)) * 100;
      }
      echo "<center><h4>School Statistics for ". $_POST["searchterm"] ."</h4></center>";
      echo '<table style="width:100%">';
      echo '<tr><th>Average MS GPA</th><th>% Undergraduate Students</th><th>% Graduate Students</th><th>Average PHD GPA</th></tr>';
      echo "<center><tr><td><center>" . $MSavgGPA . "</center></td><td><center>" . round((float)$percMS, 2) . "%</center></td><td><center>" . round((float)$percPHD, 2) . "%</center></td><td><center>" . $PHDavgGPA . "</center></td></tr>"; 
      echo '</table></div>';
    }
  }else{
    $query = "select unid, program, gpa from student, alumni WHERE (NOT unid = univid)";
    $result = mysqli_query($dbc, $query);
    if(mysqli_num_rows($result) > 0){
      while($row = $result->fetch_assoc()){
        $uid = $row["unid"];
        $queryA = "SELECT SUM(CASE grade WHEN 'A' THEN 1 ELSE 0 END) totalA FROM transcript WHERE univerid = $uid;";
        $numberOfAs = mysqli_query($dbc, $queryA);
        $numberOfAs = $numberOfAs->fetch_assoc();
        $resultA= $numberOfAs['totalA'];
      
        $queryB = "SELECT SUM(CASE grade WHEN 'B' THEN 1 ELSE 0 END) totalB FROM transcript WHERE univerid = $uid;";
        $numberOfBs = mysqli_query($dbc, $queryB);
        $numberOfBs = $numberOfBs->fetch_assoc();
        $resultB = $numberOfBs['totalB'];
      
        $queryC = "SELECT SUM(CASE grade WHEN 'C' THEN 1 ELSE 0 END) totalC FROM transcript WHERE univerid = $uid;";
        $numberOfCs = mysqli_query($dbc, $queryC);
        $numberOfCs = $numberOfCs->fetch_assoc();
        $resultC= $numberOfCs['totalC'];
      
        $queryD = "SELECT SUM(CASE grade WHEN 'D' THEN 1 ELSE 0 END) totalD FROM transcript WHERE univerid = $uid;";
        $numberOfDs = mysqli_query($dbc, $queryD);
        $numberOfDs = $numberOfDs->fetch_assoc();
        $resultD= $numberOfDs['totalD'];
      
        $queryF = "SELECT SUM(CASE grade WHEN 'F' THEN 1 ELSE 0 END) totalF FROM transcript WHERE univerid = $uid;";
        $numberOfFs = mysqli_query($dbc, $queryF);
        $numberOfFs = $numberOfFs->fetch_assoc();
        $resultF= $numberOfFs['totalF'];
        
        $query2 = "SELECT SUM(chours) cHOURS FROM transcript WHERE univerid = $uid;";
        $chours = mysqli_query($dbc, $query2);
        $chours = $chours->fetch_assoc();
        $totalhours= $chours['cHOURS'] + 0.00;
        
        
        $avggpa = avgGPAfunction($resultA, $resultB, $resultC, $resultD, $resultF, $totalhours);
        $avggpa = round((float)$avggpa, 2);
        $dbc->query("UPDATE student SET gpa = ". $avggpa . " WHERE unid = " . $uid);
        if(strcmp($row["program"], 'MS') == 0){
          $MScounter += 1;
          $MSavgGPA += $avggpa;
        }else{
          $PHDcounter += 1;
          $PHDavgGPA += $avggpa;
        }
      }
    }
    $MSavgGPA = round((float)$MSavgGPA / $MScounter, 2);
    $PHDavgGPA = round((float)$PHDavgGPA / $PHDcounter, 2);
    $percMS = ($MScounter / ($MScounter + $PHDcounter)) * 100;
    $percPHD = ($PHDcounter / ($MScounter + $PHDcounter)) * 100;  
    echo "<center><h4>School Statistics</h4></center>";
    echo '<table style="width:100%">';
    echo '<tr><th>Average MS GPA</th><th>% Undergraduate Students</th><th>% Graduate Students</th><th>Average PHD GPA</th></tr>';
    echo "<center><tr><td><center>" . $MSavgGPA . "</center></td><td><center>" . round((float)$percMS, 2) . "%</center></td><td><center>" . round((float)$percPHD, 2) . "%</center></td><td><center>" . $PHDavgGPA . "</center></td></tr>"; 
    echo '</table></div>';
  }
  echo '<hr />';  
  echo '</br><form action="" method="post">';
  echo  '<label for="searchterm">Search Year or Major : </label><br>';
  echo  '<input type="text" id="searchterm" name="searchterm"><br>';
  echo  '<input type="submit" name="Search" value="Search">';
  echo	'</form>';

 	
  require_once('footer.php');

?>
