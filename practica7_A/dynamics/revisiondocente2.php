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
    $sincomas = array("A","B","C","D","E","F","G","H","I","J","K","L",
      "M","N","Ñ","O","P","Q","R","S","T","U","V","W","X","Y","Z",
      "a","b","c","d","e","f","g","h","i","j","k","l",
      "m","n","ñ","o","p","q","r","s","t","u","v","w","x","y","z","á","é",
      "í","ó","ú","ä","ë","ï","ö","ü","Á","É","Í","Ó","Ú","Ä","Ë","Ï","Ö","Ü",
      "1","2","3","4","5","6","7","8","9","0");
    //Arreglo de mayúsculas con comas
    $mayusconcomas = array("A,","B,","C,","D,","E,","F,","G,","H,","I,","J,","K,","L,",
      "M,","N,","N,","O,","P,","Q,","R,","S,","T,","U,","V,","W,","X,","Y,","Z,",
      "A,","B,","C,","D,","E,","F,","G,","H,","I,","J,","K,","L,",
      "M,","N,","N,","O,","P,","Q,","R,","S,","T,","U,","V,","W,","X,","Y,","Z,","A,","E,",
      "I,","O,","U,","A,","E","I,","O,","U,","A","E","I","O","U","A","E","I","O","U",
      "1,","2,","3,","4,","5,","6,","7,","8,","9,","0,");
      //Verificación de que el RFC sea correcto
      $arrPat = explode(",",str_replace($sincomas,$mayusconcomas,strtoupper($elpapellido)));
      $arrMat = explode(",",str_replace($sincomas,$mayusconcomas,strtoupper($elmapellido)));
      $arrNom = explode(",",str_replace($sincomas,$mayusconcomas,strtoupper($elnombre)));
      $elNac1 = str_replace($sincomas,$mayusconcomas,$elnacimiento);
      $arrNac2 = explode(",",str_replace("-","",$elNac1));
      $arrRFC = explode(",",str_replace($sincomas,$mayusconcomas,strtoupper($elrfc)));
      $rfcTemp = $arrPat[0].$arrPat[1].$arrMat[0].$arrNom[0].$arrNac2[2].$arrNac2[3].$arrNac2[4].$arrNac2[5].$arrNac2[6].$arrNac2[7];
      $rfcComp = $arrRFC[0].$arrRFC[1].$arrRFC[2].$arrRFC[3].$arrRFC[4].$arrRFC[5].$arrRFC[6].$arrRFC[7].$arrRFC[8].$arrRFC[9];
      if($rfcTemp != $rfcComp)
      {
        echo
        "El RFC que introdujo es incorrecto, se le solicita revisar sus datos y la escritura
        <br><a href = '../templates/formulariodocente.html'>Regresar</a>";
        $imposible = true;
      }
      else {
        echo "Su RFC es correcto";
      }
