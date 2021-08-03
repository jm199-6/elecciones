<!DOCTYPE html>

<html lang="es" dir="ltr">

  <head>

    <meta charset="utf-8">

    <title></title>

    <style >

      .form{

        width: 25%;

        border: 2px dotted #5e4e09;

        border-radius: 10px;

        background: linear-gradient(0deg, #2a3d70,#bab373,#2a3d70);

      }

      .form>h2{

        text-align: center;

        background: linear-gradient(0deg, #616519,#bab373,#616519);

        margin: 0px 0px 20px 0px;

        padding-top: 10px;

        padding-bottom: 10px;

        color: #092137;

      }

      .form>.content{

        margin: 20px;

        position: relative;



      }

      .form>.content>input{

        width: 90%;

        padding: 15px 10px 15px 10px;

        background-color: #ced9c211;

        border: 1px solid #160c32;

        border-radius: 5px;

        color: #530ef1;

        font-size: 15px;

        font-weight: bold;

      }

      .form>.content>select{

        width: 97%;

        padding: 15px 10px 15px 10px;

        background-color: #ced9c211;

        border: 1px solid #160c32;

        border-radius: 5px;

        color: #530ef1;

        font-size: 15px;

        font-weight: bold;

      }

    </style>

  </head>

  <body>

    <form class="form" method="post">

      <h2>Cifrado Cesar</h2>

      <div class="content">

        <label for="txtCl">Entrada</label><br>

        <input type="text" id="txtCl" name="txtCl">

        <br>

        <label for="type">Elija una opción</label><br>

        <select id="type" name="type_enc">

          <option value="0">Encriptar</option>

          <option value="1">Desencriptar</option>

        </select>

        <br>

        <label for="txtCi">Resultado</label><br>

        <input type="text" id="txtCi" name="txtCiphred">

      </div>



      <hr>

      <center>

        <input type="submit" class="submit" name="ok" value="Operar">

      </center>

    </form>

  </body>

</html>





<?php

function desencriptar($str,$pos_forward,$pos1_forward){

  $ln = strlen($str);

  $strC="";

  for($i=0 ; $i<$ln; $i++){

    $char = substr($str,$i,1);

    if($i%2 == 0){

      $asc= ord($char)-$pos_forward;

    }else{

      $asc= ord($char)-$pos1_forward;

    }



    $strC.=chr($asc);

  }

  return $strC;

}

  function encriptar($str,$pos_forward,$pos1_forward){

    $ln = strlen($str);

    $strC="";

    for($i=0 ; $i<$ln; $i++){

      $char = substr($str,$i,1);

      if($i%2 == 0){

        $asc= ord($char)+$pos_forward;

      }else{

        $asc= ord($char)+$pos1_forward;

      }



      $strC.=chr($asc);

    }

    return $strC;

  }

  if(isset($_POST['ok'])){

    $text = $_POST['txtCl'];

    $type = $_POST['type_enc'];

    if($type==0){

      $enc = encriptar($text,2,4);

    }else{

      $enc = desencriptar($text,2,4);

    }



    ?>

    <script type="text/javascript">

      document.getElementById("txtCi").value = '<?php echo $enc; ?>';

    </script>

    <?php

  }

 ?>

