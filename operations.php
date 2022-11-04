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

    if (strtolower($arr[$i])=='multiply'||strtolower($arr[$i])=='multiplication'||strtolower($arr[$i])=='times'
    ||strtolower($arr[$i])=='x'||strtolower($arr[$i])=='*'||strtolower($arr[$i])=='exponentially'||strtolower($arr[$i])=='accumulate'
    ||strtolower($arr[$i])=='proliferate'||strtolower($arr[$i])=='mount'||strtolower($arr[$i])=='expand'||strtolower($arr[$i])=='spread'
    ||strtolower($arr[$i])=='mushroom'||strtolower($arr[$i])=='snowball'||strtolower($arr[$i])=='numerous'||strtolower($arr[$i])=='burgeon'
    ||strtolower($arr[$i])=='wax'
    // ||strtolower($arr[$i])=='each'
    ) {
        if ($operator != '-' && $operator = '+') {
            $operator = '*';
          }
    }
    else if (strtolower($arr[$i])=='addition'||strtolower($arr[$i])=='add'||strtolower($arr[$i])=='plus'||
    strtolower($arr[$i])=='sum'||strtolower($arr[$i])=='all'||strtolower($arr[$i])=='altogether'||
    strtolower($arr[$i])=='many'&&strtolower($arr[$i-1])=='how'||strtolower($arr[$i])=='total'||
    strtolower($arr[$i])=='together'||strtolower($arr[$i])=='more'&&strtolower($arr[$i+1])=='than'||
    strtolower($arr[$i])=='increase'||strtolower($arr[$i])=='increased'||strtolower($arr[$i])=='count'||
    strtolower($arr[$i])=='figure'&&strtolower($arr[$i+1])=='up'||strtolower($arr[$i])=='compute'||
    strtolower($arr[$i])=='calculate'||strtolower($arr[$i])=='enumerate'||strtolower($arr[$i])=='reckon'||
    strtolower($arr[$i])=='tally'||strtolower($arr[$i])=='+') { 
      if ($operator != '-' && $operator != '*') {
      
        $operator = '+';
      }
    }
   else if (strtolower($arr[$i])=='subtract'||strtolower($arr[$i])=='minus'||strtolower($arr[$i])=='left'||
   strtolower($arr[$i])=='subtraction'||strtolower($arr[$i])=='remove'||strtolower($arr[$i])=='reduce'||
   strtolower($arr[$i])=='deduce'||strtolower($arr[$i])=='decrease'||strtolower($arr[$i])=='diminute'||
   strtolower($arr[$i])=='diminish'||strtolower($arr[$i])=='take'||strtolower($arr[$i])=='deduct'||strtolower($arr[$i])=='debit'
   ||strtolower($arr[$i])=='abstract'||strtolower($arr[$i])=='discount'||strtolower($arr[$i])=='withdraw'||strtolower($arr[$i])=='dock'
   ||strtolower($arr[$i])=='off'||strtolower($arr[$i])=='-') {
        if ($operator != '*' && $operator = '+') {
            $operator = '-';
          }
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
        exit;
        break;
    
        case '-':
            $result =  $operand_1 - $operand_2;
    //    if ($operand_2>$operand_1) {
    //     $result =  $operand_2 - $operand_1;
    //    }
    //    else{
    //     $result =  $operand_1 - $operand_2;
    //    }
        $enum_operator = Enum::subtraction->value;
        exit;
        break;
    default:
         $result = 'invalid operator';
        break;
}

$result_array = array("slackUsername"=>"manlikehenry","result"=>intval($result),"operation_type"=>$enum_operator);
echo json_encode($result_array);
exit;

?>