<?php 
 header('Content-type: application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Request-Method: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Request-Method,Access-Control-Allow-Origin');


enum Enum: string{
//   case  operation_type = 'multiplication';
    case multiplication = 'multiplication';
    case addition = 'addition';
    case subtraction = 'subtraction';

}

$data = json_decode(file_get_contents('php://input'));

$string = $data->operator_type;
$string = str_replace('.','',$string);
$string = str_replace(',','',$string);
$string = str_replace('!','',$string);
$string = str_replace(';','',$string);
$string = str_replace(':','',$string);
$string = str_replace('"','',$string);
$string = str_replace('\'','',$string);

$arr = explode(' ',$string);


$number_array = array();
$operator = '';


for ($i=0; $i < count($arr); $i++) { 
    if (is_numeric($arr[$i])) {
         array_push($number_array,$arr[$i]);
    }

    if (strtolower($arr[$i])=='multiply'||strtolower($arr[$i])=='multiplication'||strtolower($arr[$i])=='times') {
        $operator = '*';
    }
    else if (strtolower($arr[$i])=='addition'||strtolower($arr[$i])=='add'||strtolower($arr[$i])=='plus'||strtolower($arr[$i])=='sum'||strtolower($arr[$i])=='all'||strtolower($arr[$i])=='altogether'||strtolower($arr[$i])=='many'&&strtolower($arr[$i-1])=='how'||strtolower($arr[$i])=='total'||strtolower($arr[$i])=='together') { 
      if ($operator != '-' && $operator != '*') {
      
        $operator = '+';
      }
    }
   else if (strtolower($arr[$i])=='subtract'||strtolower($arr[$i])=='minus'||strtolower($arr[$i])=='left'||strtolower($arr[$i])=='subtraction') {
        $operator = '-';
      
    }
}

$operand_1 = array_pop($number_array);
$operand_2 = array_pop($number_array);

// echo $operand_1.' '.$operator.' '.$operand_2;
// exit;
$enum_operator = '';
switch ($operator) {
    case '*':
        $result = $operand_1 * $operand_2;
        $enum_operator = Enum::multiplication->value;
        break;

        case '+':
        $result = $operand_1 + $operand_2;
        $enum_operator = Enum::addition->value;
        break;
    
        case '-':
       if ($operand_2>$operand_1) {
        $result =  $operand_2 - $operand_1;
       }
       else{
        $result =  $operand_1 - $operand_2;
       }
        $enum_operator = Enum::subtraction->value;
        break;
    default:
         $result = 'invalid operator';
        break;
}

$result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation type"=>$enum_operator);
echo json_encode($result_array);
?>