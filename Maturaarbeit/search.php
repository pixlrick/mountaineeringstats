<?php
  $search = $_GET['search'];
  $title = "Suche | ".$search;
  include 'header.php';
  include 'db.php';
  
  $searchLength = strlen($search);
  $sql = "SELECT * FROM users WHERE SUBSTRING(username,1,$searchLength)='$search'";
  $result = $conn->query($sql);

  $rownr = $result->num_rows;
  if($rownr>0){
    $rows = resultToArray($result);
    $result->free();
    foreach($rows as $row) {
      $username = $row['username'];
      $picPath = $row['pic_path'];
      $userID = $row['id'];
      echo "<a href='".$username."'><img class='circle' src='".$picPath."' height='40' width='40'></a>";
      echo "<h1><a href='".$username."'>".$username."</a></h1>";
      /*if($_SESSION['id'] != $userID){
        include 'includes/followButton.inc.php';
      }*/
    }
  }
  include 'footer.php';
?>