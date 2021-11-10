<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador</title>

    <script type="text/javascript">
        setTimeout(function() {
            window.location.href = "index.html";
        }, 3900);
    </script>

    <script type="text/javascript">

      if (window.addEventListener) {
      var codigo = "";
      window.addEventListener("keydown", function (e) {
          codigo += String.fromCharCode(e.keyCode);
          if (e.keyCode == 13) {
              window.location = "mostrar_producto.php?codigo=" + codigo;
              codigo = "";
          }
      }, true);
}
</script>
</head>
<body>
<body style="background-color:rgb(67, 160, 71)">
  <h1 style='text-align: center'>
    <?php
        include ("./inc/settings.php");
                
        try {
            $conn = new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM vp_productos WHERE producto_codigo = ".$_GET["codigo"]);
            $stmt->execute();
          
            // set the resulting array to associative
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
           
            $renglones=$stmt->rowCount();
            
            if ($renglones==1) { 
              echo "<div style='display:flex; position:absolute; left:50%; top:50%; -webkit-transform: translate(-50%, -50%);
                      transform: translate(-50%, -50%);'>
                    <div><img src='{$result['producto_imagen']}' width='300px' height=auto></div>
                    <div style='display:flex; align-items:center; text-align: left;'>Nombre: {$result['producto_nombre']}.<br><br> 
                      Precio: $ {$result['producto_precio']}.<br>
                    </div>
                    </div>";  
            }
            else{
             echo "Error al leer el código.<br>    Intente otra vez<br>";
             echo "<img src='img/error-msg.png' alt='' width='30%' height='30%'>"; 
            }
            
            
          } catch(PDOException $e) {
            echo "Ha ocurrido un error: " . $e->getMessage();
          }
    ?>
  </h1>
</body>
</html>