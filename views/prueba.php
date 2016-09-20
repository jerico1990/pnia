<?php 

$the_file_array = Array(); //Crea una variable tipo array 

$handle = opendir('./'); //Crea una variable con el directorio actual osea donde esta el archivo 

while (false !== ($file = readdir($handle))) { //se crea un ciclo q dura mientras halla archivos en la carpeta 
$the_file_array[] = $file; //Si cumple con lo anterior se asigna el nombre del archivo al array 

} 

closedir($handle); //Se cierra el directorio para evitar problemas de compilacion 
sort ($the_file_array); //Se ordena el array con los nombres de archivos .jpg 
reset ($the_file_array); //Se regresa el puntero al inicio del array 

while (list ($key, $val) = each ($the_file_array)) { //Se crea un ciclo que dura tantos valores tenga el array 
$largo = strlen($val); //Se optiene lo largo del nombre del archivo 
echo '<<a href="'.$val.'" target="centro">'.substr($val,0,$largo-4).'</a>><br>'; //Se pone una liga con el nombre del archivo para ver la img 
} 

?> 