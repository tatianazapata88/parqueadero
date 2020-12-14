<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PARQUEADERO</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="stylesheet" href="estilos.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <a class="navbar-brand" href="index.php">SALIR DEL SISTEMA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="admon.php">Ingreso y Salida vehiculos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="admon.php" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reportes</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="mensualidad.php">Vehiculos con contrato</a>
                                <a class="dropdown-item" href="estado.php">Disponibilidad Actual</a>
                                <a class="dropdown-item" href="vehiculos.php">Vehiculos Ingresados</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <main class="dark">
        <BR>
        
        <h2 class="negritaycolor text-center">BOLETO SALIDA PARQUEADERO</h2>
        <br>
        <br>
<?php

    include("BaseDatos.php");

    if(isset($_POST["botonSalida"]))
    {
        
        //1. Recibo datos del formulario
        $placa=$_POST["placa"];
        date_default_timezone_set("America/Bogota");
        $horaSalida=new Datetime();
        $horaSalida1=$horaSalida->format("Y-m-d H:i:s");

        
        
      
        $transaccion=new BaseDatos();
        
        
        $nro="SELECT COUNT(*) total FROM ingreso where placa='$placa'";
                $vehiculos1=$transaccion->consultarVehiculo($nro);
                foreach($vehiculos1 as $vehiculo)
                $nro1=$vehiculo["total"];
                if($nro1==1)
                {
                                $consultaSQL="SELECT * from ingreso where placa='$placa'";
                                $vehiculos=$transaccion->consultarVehiculo($consultaSQL);
                                foreach($vehiculos as $vehiculo)
                                $contrato1=($vehiculo["contrato"]);
                                $horaIngreso=($vehiculo["horaIngreso"]);    
                                $idIngreso=($vehiculo["idIngreso"]);
                                if($contrato1=="SI")
                                {
                                    date_default_timezone_set("America/Bogota");
                                    $horaIngreso1=new Datetime("$horaIngreso");
                                    //echo($horaIngreso);
                                    $tiempoParqueo=date_diff($horaIngreso1, $horaSalida);
                                    $tiempoParqueo1=$tiempoParqueo->format("%d dias, %h horas, %i minutos");
                                    $valor="0";
                                    //echo($tiempoParqueo->format("%d dias, %h horas, %i minutos"));
                                    //echo($horaIngreso);
                                    //echo($tiempoParqueo->format("%d dias, %h horas, %i minutos"));
                                    //2. Crear un objeto(COPIA) de la clase BaseDatos
                                    $transaccion1=new BaseDatos();
                                    //3.Construir una consulta SQL para insertar datos
                                    $consultaSQL="UPDATE parqueadero SET horaSalida='$horaSalida1',tiempoParqueo='$tiempoParqueo1',valor='$valor' where id='$idIngreso'";
                                    //4. Utilizar el metodo agregarDatos() de la clase BaseDatos
                                    $transaccion1->agregarSalidaParqueadero($consultaSQL);
                                    $consultaSQL="DELETE FROM ingreso WHERE placa='$placa'";
                                    $transaccion1->eliminarVehiculo($consultaSQL);
                                }
                                elseif($contrato1=="No")
                                {
                                    date_default_timezone_set("America/Bogota");
                                    $horaIngreso1=new Datetime("$horaIngreso");
                                    //echo($horaIngreso);
                                    $tiempoParqueo=date_diff($horaIngreso1, $horaSalida);
                                    $tiempoParqueo1=$tiempoParqueo->format("%d dias, %h horas, %i minutos");
                                    $horas=$tiempoParqueo->format("%h");
                                    // echo($horas);
                                    $minutos=$tiempoParqueo->format("%i");
                                    //echo($minutos);
                                    $tominu=($horas*60)+$minutos;
                                    $valor=($tominu*1000);
                                    //echo($tiempoParqueo->format("%d dias, %h horas, %i minutos"));
                                    //echo($horaIngreso);
                                    //echo($tiempoParqueo->format("%d dias, %h horas, %i minutos"));
                                    //2. Crear un objeto(COPIA) de la clase BaseDatos
                                    $transaccion1=new BaseDatos();
                                    //3.Construir una consulta SQL para insertar datos
                                    $consultaSQL="UPDATE parqueadero SET horaSalida='$horaSalida1',tiempoParqueo='$tiempoParqueo1',valor='$valor' where id='$idIngreso'";
                                    $transaccion1->agregarSalidaParqueadero($consultaSQL);

                                    //borrar carro del parqueadero al dar salida
                                    $consultaSQL="DELETE FROM ingreso WHERE placa='$placa'";
                                    $transaccion1->eliminarVehiculo($consultaSQL); 
                                }
                              
                               
                                $transaccion12=new BaseDatos();
                                $salida="SELECT max(id) FROM parqueadero where placa='$placa'";
                                $vehiculos=$transaccion12->consultarVehiculo($salida);
                                foreach($vehiculos as $vehiculo)
                                $nro1=$vehiculo["max(id)"];
                                
                                $transaccion13=new BaseDatos();
                                $salida="SELECT * FROM parqueadero where id='$nro1'";
                                $vehiculos=$transaccion13->consultarVehiculo($salida);
                                //4. Utilizar el metodo agregarDatos() de la clase BaseDatos
                               ?>
                                 
                                <div class="container">
                                
                        
                                <div class="row row-cols-1 row-cols-md-3">
                        
                                    <?php foreach($vehiculos as $vehiculo): ?>
                        
                                        <div class="col mb-4">
                        
                                            <div class="card h-100">
                                                
                                                <div class="card-body">
                                                    <h5 class="card-title">Placa: <?=$vehiculo["placa"]?></h5>
                                                    <p class="card-text">Id Ingreso: <?=$vehiculo["id"]?></p>
                                                    <p class="card-text">Fecha y Hora Ingreso: <?=$vehiculo["horaIngreso"]?></p>
                                                    <p class="card-text">Fecha y Hora Salida: <?=$vehiculo["horaSalida"]?></p>
                                                    <p class="card-text">Tiempo Parqueo: <?=$vehiculo["tiempoParqueo"]?></p>
                                                    <p class="card-text">Contrato Mensual: <?=$vehiculo["contrato"]?></p>
                                                    <p class="card-text">Valor a Pagar: <?=$vehiculo["valor"]?></p>
                                                    
                                                </div>
                                            </div>
                                            </div>
                                           
                                        
                                    <?php endforeach ?>
                <?php                    
                }                
                else
                    {
                     echo("No coincide placa");
                    }

                }
                     ?>

    

</main>
    <footer class="bg-dark text-white mt-5">
        <div class="contaner">
            <div class="row justify-content-around text-center ">
                        <div class="col-md-3 mt-5">
                        <p>Luz Tatiana Zapata ©</p>
                        <p>tatianazz3@hotmail.com</p>
                        <p>Medellin - Antioquia</p>
                    </div>
                </div>
                <div class="row justify-content-center text-center">
                    <div class="col-md-8">
                        <div class="footer-copyright text-center py-3">© Colombia - 2020 Copyright:
                            <a
                                href=" https://www.intersoftware.org.co/">
                                Grupo Cerrado Intersoftware </a> <a href="https://www.cesde.edu.co/Paginas/tecnicos/procesos-tecnologicos-e-industriales/desarrollo-de-software-virtual.aspx"> - CESDE  </a>
                        </div>
                    </div>
                </div>
            </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
</body>

</html>



?>