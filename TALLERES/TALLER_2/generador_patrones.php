<?php 


echo "Bucle FOR";
$j="*";
for ($i = 1; $i <= 5; $i++) {
    echo $j."<br>";
    $j.="*";
}

echo "<br>";
echo "Bucle WHILE";
$k=1;
while ($k <= 20) {

    if ($k%2 != 0) {
        echo $k."<br>";
    }
    $k++;
 
}

echo "<br>";
echo "Bucle DO WHILE <br><br>";

$contador = 10;
do {
    $num = $contador;

    if($contador != 5){
        echo $num."<br>";
    }
   
    $contador--;
} while ($contador >=1);
echo "<br>";

?>