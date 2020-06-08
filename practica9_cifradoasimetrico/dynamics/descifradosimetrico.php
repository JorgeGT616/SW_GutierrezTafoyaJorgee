<?php

  //Colocación del texto cifrado en un text area
  echo "
  <form action = 'descifradosimetrico.php' method = 'post'>
    Escriba el texto cifrado: <br><textarea name = 'mensaje' value = '' maxlength = '200' minlength = '1' pattern = '*[A-Za-z]'
    cols='40' rows='10' style = 'resize: none'></textarea><br>
    Escribe la llave secreta: <input type = 'password' name = 'secreto' maxlength='3' pattern = '[A-Za-z]{3}' value = '' required><br>
    <input type = 'submit' value = 'Enviar'><br>
  </form>";
  //Verificación del nuevo mensaje
  $mensaje = (isset($_POST['mensaje'])&& $_POST['mensaje'])?$_POST['mensaje']:false;
  $llaveSec = (isset($_POST['secreto'])&& $_POST['secreto'])?$_POST['secreto']:false;
  //Ante la existencia del mensaje y la llave
  if(($mensaje !== false)&&($llaveSec !== false))
  {
    //Se recuperan los arreglos de numeros y letros
    $nums = array("28","29","30","31","32","33","34","35","36",
    "37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53",
    "10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27",
    "1","2","3","4","5","6","7","8","9");
    $letras = array("a","b","c","d","e","f","g","h","i",
    "j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
    "J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"," ",
    "A","B","C","D","E","F","G","H","I");
    $letrasComa = array("a,","b,","c,","d,","e,","f,","g,","h,","i,",
    "j,","k,","l,","m,","n,","o,","p,","q,","r,","s,","t,","u,","v,","w,","x,","y,","z,",
    "J,","K,","L,","M,","N,","O,","P,","Q,","R,","S,","T,","U,","V,","W,","X,","Y,","Z,"," ,",
    "A,","B,","C,","D,","E,","F,","G,","H,","I,");
    //Se forma cadena con las letras de la lleva
    $llaveSec = explode(",",str_replace($letras,$letrasComa,$llaveSec));
    //Se vuelven a ordenar la llave para reemplazar las letras de la cadena cifrada
    $C1 = $llaveSec[0];
    $C2 = $llaveSec[1];
    $C3 = $llaveSec[2];
    //Se reemplazan las letras especiales
    $A1 = str_replace($letras,$nums,$C1);
    $A2 = str_replace($letras,$nums,$C2);
    $A3 = str_replace($letras,$nums,$C3);
    //Se concatenan los elementos como letras para formar un arreglo
    $llave = $A1." ".$A2." ".$A3;
    $llaveArr = explode(" ",$llave);
    rsort($llaveArr);
    //Se retoman los elementos de arreglo ahora ordenados
    $B1=$llaveArr[2];
    $B2=$llaveArr[1];
    $B3=$llaveArr[0];
    //Estos elementos vuelven a reemplazar las letras especiales
    $mensaje=str_replace("A ",$B1,$mensaje);
    $mensaje=str_replace("K ",$B2,$mensaje);
    $mensaje=str_replace("Z ",$B3,$mensaje);
    //Se recupera el algoritmo de cifrado a partir de la llave
    $llave = ((($A1*$A2)*($A2*$A3)*($A3*$A1))%($A1+$A2+$A3))+1;
    //Se recupera el espacio
    $llavesp = "&".($A2 + $A3 - 5)."&";
    $mensaje = str_replace($llavesp," ",$mensaje);
    $mensaje = explode(" ",$mensaje);
    //Se forma el texto que se va descifrando
    echo "<br>
    <fieldset style = 'width:300'>
      <legend>Texto Cifrado</legend>";
    foreach($mensaje as $apr)
    {
      foreach($nums as $evalu)
      {
        if(($evalu*$llave*$A2) == $apr)
        {
          //Colocación de las letras
          $apr = $evalu;
          $apr = str_replace($nums,$letras,$apr);
          echo $apr;
        }
      }
    }
    echo "</fieldset>";
  }

?>
