<?php 
 
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 header('Access-Control-Request-Method: GET');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Request-Method,Access-Control-Allow-Origin,Content-Type');

 $data = ['slackUsername'=>'manlikehenry','backend'=>true,'age'=>23,'bio'=>'Self-motivated and a problem solver'];
 echo json_encode($data);
?>