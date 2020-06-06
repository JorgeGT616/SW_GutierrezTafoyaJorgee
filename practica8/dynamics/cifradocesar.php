<?php

  echo "
  <body style='text-align:center; background-color: #EFF5FB;'>";
  //Recepción y validación el mensaje desde el HTML
  $texto = (isset($_POST['sutexto'])&& $_POST['sutexto'])?$_POST['sutexto']:false;
  //Arreglo con las letras mayúsculas y minúsculas
  $abecenormal = array("A","B","C","D","E","F","G","H","I",
    "J","K","L","M","N","O","P","Q","R",
    "S","T","U","V","W","X","Y","Z","a",
    "b","c","d","e","f","g","h","i",
    "j","k","l","m","n","o","p","q","r",
    "s","t","u","v","w","x","y","z");
  //Arreglo con solo mayúsculas y trasladado para el cifrado César
  $abecifrado = array("X","Y","Z","A","B","C","D","E","F",
    "G","H","I","J","K","L","M","N","O",
    "P","Q","R","S","T","U","V","W",
    "X","Y","Z","A","B","C","D","E","F",
    "G","H","I","J","K","L","M","N","O",
    "P","Q","R","S","T","U","V","W");

  echo "
  <fieldset width: 80%>
    <legend><h2>Texto Inicial</h2></legend>";
    //Se imprime el texto original
    echo "<fieldset style= 'background-color:#FFFFFF;' width: 75%><p>".$texto."</p></fieldset>";
  echo "
  </fieldset>";
  echo "
    <fieldset width = 80%>
      <legend><h2>Texto Cifrado</h2></legend>";
      //Se cifra el texto reemplazando los caracteres desde los arreglos
      $textocifrado = str_replace($abecenormal,$abecifrado,$texto);
      echo "<fieldset style = 'background-color:#FFFFFF;' width = 75%><p>".$textocifrado."</p></fieldset>";
  echo "
    </fieldset>
  </body>";

?>
