<?php 
 header('Content-type: application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Request-Method: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Request-Method,Access-Control-Allow-Origin');


// enum Enum: string{
// //   case  operation_type = 'multiplication';
//     case multiplication = 'multiplication';
//     case addition = 'addition';
//     case subtraction = 'subtraction';

// }
if($_SERVER['REQUEST_METHOD']=="POST"){
    
$data = json_decode(file_get_contents("php://input"));

$string = $_POST['operator_type'] ? $_POST['operator_type'] : $data->operator_type;
$x = $_POST['x'] ? $_POST['X']: $data->x ;
$y = $_POST['y'] ? $_POST['y'] : $data->y;


if (strtolower($string)=='addition'&&is_int($x)&&is_int($y)) {
 
   $result = $x + $y;
   $result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>'addition');
   echo(json_encode($result_array));
   exit;
}
else if(strtolower($string)=='multiplication'&&is_int($x)&&is_int($y)){
 
    $result = $x * $y;
    $result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>'multiplication');
    echo(json_encode($result_array));
    exit;
}
else if(strtolower($string)=='subtraction'&&is_int($x)&&is_int($y)){
  
    if ($x > $y) {
        $result = $x - $y;
    }
    else{
        $result = $y - $x;
    }
 
    $result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>'subtraction');
    echo(json_encode($result_array));
    exit;
}
// else if ($string != '' && $x == null && $y == null) 
// {
    
//     $string = str_replace('.','',$string);
//     $string = str_replace(',','',$string);
//     $string = str_replace('!','',$string);
//     $string = str_replace(';','',$string);
//     $string = str_replace(':','',$string);
//     $string = str_replace('"','',$string);
//     $string = str_replace('\'','',$string);
    
//     $arr = explode(' ',$string);
    
    
//     $number_array = array();
//     $operator = '';
    


//     for ($i=0; $i < count($arr); $i++) { 
//         if (is_numeric($arr[$i])) {
//              array_push($number_array,$arr[$i]);
//         }
    
//         if (strtolower($arr[$i])=='multiply'||strtolower($arr[$i])=='multiplication'||strtolower($arr[$i])=='times'
//         ||strtolower($arr[$i])=='x'||strtolower($arr[$i])=='*'||strtolower($arr[$i])=='exponentially'||strtolower($arr[$i])=='accumulate'
//         ||strtolower($arr[$i])=='proliferate'||strtolower($arr[$i])=='mount'||strtolower($arr[$i])=='expand'||strtolower($arr[$i])=='spread'
//         ||strtolower($arr[$i])=='mushroom'||strtolower($arr[$i])=='snowball'||strtolower($arr[$i])=='numerous'||strtolower($arr[$i])=='burgeon'
//         ||strtolower($arr[$i])=='wax'
//         // ||strtolower($arr[$i])=='each'
//         ) {   
//                 $operator = '*';
//         }
//         else if (strtolower($arr[$i])=='addition'||strtolower($arr[$i])=='add'||strtolower($arr[$i])=='plus'||
//         strtolower($arr[$i])=='sum'||strtolower($arr[$i])=='all'||strtolower($arr[$i])=='altogether'||
//         strtolower($arr[$i])=='many'&&strtolower($arr[$i-1])=='how'||strtolower($arr[$i])=='total'||
//         strtolower($arr[$i])=='together'||strtolower($arr[$i])=='more'&&strtolower($arr[$i+1])=='than'||
//         strtolower($arr[$i])=='increase'||strtolower($arr[$i])=='increased'||strtolower($arr[$i])=='count'||
//         strtolower($arr[$i])=='figure'&&strtolower($arr[$i+1])=='up'||strtolower($arr[$i])=='compute'||
//         strtolower($arr[$i])=='calculate'||strtolower($arr[$i])=='enumerate'||strtolower($arr[$i])=='reckon'||
//         strtolower($arr[$i])=='tally'||strtolower($arr[$i])=='+') { 
//           if ($operator != '-' && $operator != '*') {
          
//             $operator = '+';
//           }
//         }
//        else if (strtolower($arr[$i])=='subtract'||strtolower($arr[$i])=='minus'||strtolower($arr[$i])=='left'||
//        strtolower($arr[$i])=='subtraction'||strtolower($arr[$i])=='remove'||strtolower($arr[$i])=='reduce'||
//        strtolower($arr[$i])=='deduce'||strtolower($arr[$i])=='decrease'||strtolower($arr[$i])=='diminute'||
//        strtolower($arr[$i])=='diminish'||strtolower($arr[$i])=='take'||strtolower($arr[$i])=='deduct'||strtolower($arr[$i])=='debit'
//        ||strtolower($arr[$i])=='abstract'||strtolower($arr[$i])=='discount'||strtolower($arr[$i])=='withdraw'||strtolower($arr[$i])=='dock'
//        ||strtolower($arr[$i])=='off'||strtolower($arr[$i])=='-') {
//                 $operator = '-';
              
//         }
//     }
    
//     if ($operator == '') {
        
//         die(json_encode(['error'=>'INVALID SENTENCE']));
        
//     }
    

//     $operand_1 = array_pop($number_array);
// $operand_2 = array_pop($number_array);


// $enum_operator = '';
// switch ($operator) {
//     case '*':
//         $result = $operand_1 * $operand_2;
//         $enum_operator = 'multiplication';
//         break;

//         case '+':
//         $result = $operand_1 + $operand_2;
//         $enum_operator = 'addition';
        
//         break;
    
//         case '-':
//          if ($operand_1 > $operand_2) {
//             $result =  $operand_1 - $operand_2;
//          }
//          else{
//             $result =  $operand_2 - $operand_1;
//          }

//         $enum_operator = 'subtraction';
        
//         break;
//     default:
//          $result = 'invalid operator';
//         break;
// }

// $result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>$enum_operator);
// echo(json_encode($result_array));
// }
else{
   

    if ($string == '') {
        die(json_encode(['error'=>'INVALID OPERATION TYPE']));
    }
    if (!is_int($x)) {
        die(json_encode(['error'=>'X is not an integer']));
    }
    if (!is_int($y)) {
        die(json_encode(['error'=>'Y is not an integer']));
    }
}



}
?>