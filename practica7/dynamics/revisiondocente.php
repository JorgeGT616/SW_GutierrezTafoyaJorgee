<?php
  echo
  "<fieldset style = 'text-align:center;'>";
    $contrasenaprin = (isset($_POST['contrasena']) && $_POST['contrasena'] )!= "" ? $_POST['contrasena'] : '' ;
    $elnombre = (isset($_POST['Nombre']) && $_POST['Nombre'] )!= "" ? $_POST['Nombre'] : '' ;
    $elpapellido = (isset($_POST['Papellido']) && $_POST['Papellido'] )!= "" ? $_POST['Papellido'] : '' ;
    $elmapellido = (isset($_POST['Mapellido']) && $_POST['Mapellido'] )!= "" ? $_POST['Mapellido'] : '' ;
    $elnacimiento = (isset($_POST['nacimiento']) && $_POST['nacimiento'] )!= "" ? $_POST['nacimiento'] : '' ;
    $elrfc = (isset($_POST['rfc']) && $_POST['rfc'] )!= "" ? $_POST['rfc'] : 'Coloque su rfc' ;
    $elcolegio = (isset($_POST['colegio']) && $_POST['colegio'] )!= "" ? $_POST['colegio'] : 'Coloque su rfc' ;
    $hola="hola";
    $imposible = false;
    //Se valida que todos los datos existan
    if (($contrasenaprin === '')||($elpapellido === '')||($elmapellido === '')||($elnacimiento === '')||($elrfc === '')||($elcolegio === ''))
    {
      header('Location: ../templates/formulariodocente.html');
    }

    //Filtro 1

    //Este arreglo contiene contraseñas especialmente comunes y por lo tanto vulnerables
    $contcomunes = array("1234567890","0987654321","qwertyuiop","asdfghjklñ","zxcvbnm",
      "123456","654321","1234567","7654321","12345678","87654321","123456789","987654321",
      "starwars","Starwars","StarWars","dragon","Dragon","letmein","LetMeIn","password","contraseña","Password","Contraseña",
      "111111","222222","333333","444444","555555","666666","777777","888888",
      "999999","000000","qwerty","asdfgh","zxcvbn","sunshine","Sunshine", "iloveyou","ILoveYou","princess","Princess",
      "welcome","Welcome","football","Football","monkey","Monkey","abc123","abcdefg","123123","master","Master"
    );

    echo $contrasenaprin;
    //Se compara la contraseña puesta con las contraseñas vulnerables y se evita que esta sea puesta
    foreach ($contcomunes as $pass1)
    {
      if ($pass1 == $contrasenaprin)
      {
        echo " es una contraseña es insegura
              <br><a href = '../templates/formulariodocente.html'>Regresar</a>";
        $imposible = true;
      }
    }

    //Filtro 2

    //Verifica que la contraseña no sea ninguno de los datos personales de la persona
    if($imposible == false)
    {
      //Se genera un arreglo con los datos personales de la persona
      $arreglodatos = array($elnombre,$elpapellido,$elmapellido,$elnacimiento,$elrfc,$elcolegio);
      //Se comparan los datos personales de la persona con la contraseña introducida
      foreach ($arreglodatos as $pass2)
      {
        if ($pass2 == $contrasenaprin)
        {
          echo " es una contraseña es insegura, no se recomienda usar datos personales en ella
                <br><a href = '../templates/formulariodocente.html'>Regresar</a>";
          $imposible = true;
        }
      }
    }
    //Filtro 3

    if($imposible == false)
    {
      //Se establecen arreglos con múltiples caracteres
      $supremo = array(",","A","B","C","D","E","F","G","H","I","J","K","L",
        "M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z",
        "a","b","c","d","e","f","g","h","i","j","k","l",
        "m","n","ñ","o","p","q","r","s","t","u","v","w","x","y","z",
        "1","2","3","4","5","6","7","8","9","0",
        "!","@","#","$","%","&","/","(",")","=","?","¿",
        "¡","<",">","´","¨","[","]","{","}","+","*","-",".",'"',"'");
      //Se establece un nuevo arreglo con comas
      $supremocoma = array(",,","A,","B,","C,","D,","E,","F,","G,","H,","I,","J,","K,","L,",
        "M,","N,","Ñ,","O,","P,","Q,","R,","S,","T,","U,","V,","W,","X,","Y,","Z,",
        "a,","b,","c,","d,","e,","f,","g,","h,","i,","j,","k,","l,",
        "m,","n,","ñ,","o,","p,","q,","r,","s,","t,","u,","v,","w,","x,","y,","z,",
        "1,","2,","3,","4,","5,","6,","7,","8,","9,","0,",
        "!,","@,","#,","$,","%,","&,","/,","(,","),","=,","?,","¿,",
        "¡,","<,",">,","´,","¨,","[,","],","{,","},","+,","*,","-,",".,",'",',"',");
      //Arreglo con letras mayúsculas
      $mayus = array("A","B","C","D","E","F","G","H","I","J","K","L",
        "M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z");
      //Arreglo con letras minúsculas
      $minus = array("a","b","c","d","e","f","g","h","i","j","k","l",
        "m","n","ñ","o","p","q","r","s","t","u","v","w","x","y","z");
      //Arreglo con números
      $numeros = array("1","2","3","4","5","6","7","8","9","0");
      //Arreglo con caracteres especiales
      $especiales = array("!","@","#","$","%","&","/","(",")","=","?","¿",
        "¡","<",">","´","¨","[","]","{","}","+","*","-",",",".",'"',"'");
      $contadorperfecto = 0;
      //Se reemplazan todos los caracteres de la contraseña por unos que tienen comas
      $encomada = str_replace($supremo,$supremocoma,$contrasenaprin);
      $segmentada = explode(",",$encomada);
      //Se revisa que la contraseña tenga por lo menos una letra mayúscula
      $contrasegura = false;
      foreach ($segmentada as $carac)
      {
        foreach($mayus as $caractermayus)
        {
          if (($carac == $caractermayus) && ($contrasegura == false))
          {
            $contrasegura = true;
            $contadorperfecto ++;
          }
        }
      }
      if ($contrasegura == false)
      {
        echo "<br>Se recomienda que su contraseña tenga mayúsculas";
        $imposible = true;
      }
      //Se verifica que la contraseña tenga al menos una letra minúscula
      $contrasegura = false;
      foreach ($segmentada as $carac)
      {
        foreach($minus as $caracterminus)
        {
          if (($carac == $caracterminus) && ($contrasegura == false))
          {
            $contrasegura = true;
            $contadorperfecto++;
          }
        }
      }
      if ($contrasegura == false)
      {
        echo "<br>Se recomienda que su contraseña tenga minúsculas";
        $imposible = true;
      }
      //Se verifica que la contraseña tenga al menos una letra
      $contrasegura = false;
      foreach ($segmentada as $carac)
      {
        foreach($numeros as $caracternumero)
        {
          if (($carac == $caracternumero) && ($contrasegura == false))
          {
            $contrasegura = true;
            $contadorperfecto++;
          }
        }
      }
      if ($contrasegura == false)
      {
        echo "<br>Se recomienda que su contraseña tenga números";
        $imposible = true;
      }
      //Se verifica que la contraseña tenga al menos un caracter especial
      $contrasegura = false;
      foreach ($segmentada as $carac)
      {
        foreach($especiales as $caracterespeciales)
        {
          if (($carac == $caracterespeciales) && ($contrasegura == false))
          {
            $contrasegura = true;
            $contadorperfecto++;
          }
        }
      }
      if ($contrasegura == false)
      {
        echo "<br>Se recomienda que su contraseña tenga caracteres especiales";
        $imposible = true;
      }
      //De no cumplirse alguno de los parámetros anteriores se entrega un enlace para mejorar la contraseña
      if ($contadorperfecto != 4)
      {
        echo "<br><a href = '../templates/formulariodocente.html'>Regresar</a>";
      }
    }
    //Final
    if ($imposible == false)
    {
      echo "<br>Su contraseña es potencialmente segura, puede continuar";
    }
    echo "
  </fieldset>";

?>
