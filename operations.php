<?php 
 header('Content-type: application/json');
 header('Access-Control-Allow-Origin: *');
 header('Access-Control-Request-Method: POST');
 header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Request-Method,Access-Control-Allow-Origin');


enum Operator{
    case multiplication ;
    case addition ;
    case subtraction ;

}

$data = json_decode(file_get_contents('php://input'));

$string = $data->operator_type;

$arr = explode(' ',$string);


$number_array = array();
$operator = '';


for ($i=0; $i < count($arr); $i++) { 
    if (is_numeric($arr[$i])) {
         array_push($number_array,$arr[$i]);
    }

    if (strtolower($arr[$i])=='multiply') {
        $operator = '*';
    }
    else if (strtolower($arr[$i])=='addition'||strtolower($arr[$i])=='add') {
        $operator = '+';
    }
   else if (strtolower($arr[$i])=='subtract'||strtolower($arr[$i])=='minus') {
        $operator = '-';
    }
}

$operand_1 = array_pop($number_array);
$operand_2 = array_pop($number_array);

$enum_operator = '';
switch ($operator) {
    case '*':
        $result = $operand_1 * $operand_2;
        $enum_operator = Operator::multiplication;
        break;

        case '+':
        $result = $operand_1 + $operand_2;
        $enum_operator = Operator::addition;
        break;
    
        case '-':
        $result =  $operand_1 - $operand_2;
        $enum_operator = Operator::subtraction;
        break;
    default:
         $result = 'invalid operator';
        break;
}

$result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>$enum_operator);
echo json_encode($result_array);
?>