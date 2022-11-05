<?php
    //CORS SETTINGS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: POST");
    header('Content-Type: application/json');
    
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $json = file_get_contents('php://input');
        
        // Converts it into a PHP object
        $data = json_decode($json ,true);


        $slackUsername="manlikehenry";
        $operands= array('addition','subtraction','multiplication');
        $operation_type = (strtolower($_POST['operation_type']) ? strtolower($_POST['operation_type']) : strtolower($data['operation_type']));
        $x = ($_POST['x'] ? $_POST['x'] : $data['x']);
        $y = ($_POST['y'] ? $_POST['y'] : $data['y']);
        
        if($operation_type==='' || !in_array($operation_type, $operands)){
            die( json_encode(['error' => 'INVALID OPERATION TYPE']));
        }
        
        if(is_nan($x)){ 
         die( json_encode(['error' => 'X is not an integer']));
        }
        
        if(is_nan($y)){ 
         die( json_encode(['error' => 'Y is not an integer']));
        }
        
        $result = "";
        
        if(in_array($operation_type, $operands) && $operation_type==='addition'){
            $result = $x + $y;
        }
        
        if(in_array($operation_type, $operands) && $operation_type==='multiplication'){
            $result = $x * $y;
        }
        
        
        if(in_array($operation_type, $operands) && $operation_type==='subtraction'){
            $result = $x - $y;
        }
        
        
        $details = array(
            "slackUsername"=> $slackUsername, 
            "result"=>$result,
            "operation_type"=>$operation_type
        );

        // Use json_encode() function 
        $json = json_encode($details); 
          
        // Display the output 
        echo($json); 
    } 
    else {
        die( json_encode(['error' => 'NOTHING FOR YOU TO ' .$_SERVER['REQUEST_METHOD'].' HERE PAL']));
    }
?>