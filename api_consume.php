<?php 
$url1 = "http://localhost/Project/api.php";
$receive_data = file_get_contents($url1);
$data_decode = json_decode($receive_data, true);

foreach($data_decode as $row){
          echo  $row['Child_name'];


            }
   
   
?>
