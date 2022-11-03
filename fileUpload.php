<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
  form{
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    width: 50%;
    margin:50px auto;
    height: 30vh;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  h3{
    text-align: center;
  }
  input{
    width: 80%;
    
  }
  input[type="submit"]{
    background-color: #FFA500;
    color: white;
    margin-top: 30px;
    height: 50px;
    border: none;
    font-size: 18px;
    border-radius: 5px;
  }
</style>
<body>
    
<form action="fileUpload.php" method="post" enctype="multipart/form-data">
  <h3>Convert CSV to JSON</h3>
    <input type="file" name="file" id="">
    <input type="submit" name="Upload" value="Upload">
</form>
</body>
</html>


<?php
// $file =  'new.txt';
// $file_o = fopen($file,'w');
// fclose($file_o);
 //CHECKS IF SUBMIT BUTTON WAS CLICKED
if (isset($_POST['Upload'])) {

 //CHECKS IF FILE WAS UPLOADED
  if ($_FILES["file"]["name"]) {
    $file_array = explode(".", $_FILES["file"]["name"]);
    $file_name = $file_array[0];
    $extension = end($file_array);

    //CHECKS IF FILE UPLOADED IS A CSV FILE
    if ($extension == 'csv') {
        $column_name = array();
        $final_data = array();
        $file_data = file_get_contents($_FILES["file"]["tmp_name"]);
    
        $data_array = array_map("str_getcsv", explode("\n",$file_data));
      
      //GET THE FIRST ELEMENT THAT CONTAINS THE COLUMN NAMES
        $labels = $data_array[0];


     //STORES THE COLUMN NAME
        for ($k=0; $k < count($labels); $k++) { 
            $column_name[$k] = $labels[$k];
        } 
        $count = count($data_array);

         //MERGES THE COLUMN NAME WITH ITS VALUE IN THE COLUMN
         $final_data['format'] = 'CHIP-0007';
         for ($i=1; $i <  $count; $i++) { 
          $data = array_combine($column_name, $data_array[$i]);
          $final_data[$i] = $data;
          }
  
        //CREATE JSON FILE AND WRITE
          $handle = fopen($file_name.'.json','w');
          fwrite($handle,json_encode($final_data));
          fclose($handle);

   
           $hash = '';
           $data_array[0][count($column_name)] = 'Hash';
          for ($j=1; $j < $count; $j++) { 
             for ($k=0; $k < count($column_name); $k++) { 
              $hash .= hash_hmac('sha256',$data_array[$j][$k],$column_name[$k]) ;     
             }
  
             $data_array[$j][count($column_name)] = $file_name.'.'.$hash.'.csv';
             $hash = '';
          }
 

        //CREATE CSV FILE AND WRITE
        $output = fopen($file_name.'.csv',"w");
        $header = $data_array[0];
        fputcsv($output, $header);
        for ($i=1; $i < count($data_array); $i++) { 
          fputcsv($output,$data_array[$i]);
        }
        fclose($output);



        //ZIP CSV AND JSON FILE AND FORCE DOWNLOAD ZIP FILE
        $files = array($file_name.'.csv',$file_name.'.json');
        $zipname = 'Output.zip';
        $zip = new ZipArchive;
        $zip->open($zipname,ZipArchive::CREATE);

        foreach($files as $file){
         $zip->addFile($file);
        }
        $zip->close();
        ob_clean();

        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: '.filesize($zipname));
        readfile($zipname);
    }

    //IF FILE IS NOT A CSV FILE
    else{
        echo "<h4>Only upload csv file</h4>";
    }
  }
}

?>

