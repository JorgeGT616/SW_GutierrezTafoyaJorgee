<?php

  //Formulario para introducir el texto a cifrar
  echo "
  <form action = 'cifradosimetrico.php' method = 'post'>
    Escribe tu texto: <input type = 'text' name = 'mensaje' value = '' maxlength = '20' minlength = '1' pattern = '*[A-Za-z]' required placeholder = 'Se permiten 20 caracteres'><br>";
    echo "<input type = 'submit' value = 'Enviar'><br>
  </form>";

  $mensaje = (isset($_POST['mensaje'])&& $_POST['mensaje'])?$_POST['mensaje']:false;

  if($mensaje !== false)
  {
    //Arreglo que involucra las letras permitidas
    $letras = array("J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"," ",
    "a","b","c","d","e","f","g","h","i",
    "j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
    "A","B","C","D","E","F","G","H","I");
    //Arreglo que relaciona las letras con numeros
    $nums = array("10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27",
    "28","29","30","31","32","33","34","35","36",
    "37","38","39","40","41","42","43","44","45","46","47","48","49","50","51","52","53",
    "1","2","3","4","5","6","7","8","9");
    //Las letras pero ajustadas para tener comas
    $letrasComa = array("J,","K,","L,","M,","N,","O,","P,","Q,","R,","S,","T,","U,","V,","W,","X,","Y,","Z,"," ,",
    "a,","b,","c,","d,","e,","f,","g,","h,","i,",
    "j,","k,","l,","m,","n,","o,","p,","q,","r,","s,","t,","u,","v,","w,","x,","y,","z,",
    "A,","B,","C,","D,","E,","F,","G,","H,","I,");

    //Estos valores se asignan para generar una llave para cifrar el texto
    $A1 = rand(1,26);
    $A2 = rand(6,26);
    $A3 = rand(1,26);
    //Formación de la llave como cadena con letras
    $llave = $A1." ".$A2." ".$A3;
    $llavelista = str_replace($nums,$letras,$llave);
    echo "Los caracteres de descifrado son: ".$llavelista;
    //Se establece el algoritmo de operación de los números del arreglo
    $numCambio = ((($A1*$A2)*($A2*$A3)*($A3*$A1))%($A1+$A2+$A3))+1;
    $increm = 0;
    $proceso = 0;
    $turno = false;
    $cifrado = $mensaje;
    //Reemplazo de los elementos del arreglo por las variantes con el algoritmo
    foreach ($nums as $apr)
    {
      $nums[$proceso] = ($apr * $A2 * $numCambio);
      $proceso++;
      if ($proceso > 54)
      {
        $proceso = 0;
      }
    }
    //Formación para identificar los espacios en la cadena
    $esp = ($A2 + $A3 - 5);
    $mensaje = str_replace($letras,$letrasComa,$mensaje);
    $mensaje = str_replace(",","&".$esp."&",$mensaje);
    //Convierte la llave en una cadena y la ordena de mayor a menor
    $llaveArr = explode(" ",$llave);
    rsort($llaveArr);
    //Se guardan ordenados los valores de la llave
    $B1=$llaveArr[2];
    $B2=$llaveArr[1];
    $B3=$llaveArr[0];
    //Se cifra la cadena con los nuevos valores del arreglo
    $cifrado=str_replace($letras,$nums,$mensaje);
    //Se cambian algunos numeros especificos según la clave por letras para complicar el descifrado
    $cifrado=str_replace($B1,"A ",$cifrado);
    $cifrado=str_replace($B2,"K ",$cifrado);
    $cifrado=str_replace($B3,"Z ",$cifrado);
    //Impresión  del texto cifrado
    echo "<br>
    <p>
    <fieldset>
      <legend>Texto Cifrado</legend>"
        .$cifrado."
      </fieldset>
    </p>";
  }

?>
