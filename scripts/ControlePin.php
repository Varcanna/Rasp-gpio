<?php
 $Pin =  $_POST['Pin'];
 $Etat =  $_POST['Etat'];



shell_exec("gpio -1 mode $Pin  output");
shell_exec("gpio -1 write $Pin $Etat");
header("Location: ../bouton.php");
?>