<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SISTEMA DE PARQUEADERO</title>
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
                        <li>
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
        <h2 class="negritaycolor text-center">INGRESO VEHICULOS</h2>
        <?php
            if(isset($_POST["botonIngreso"])):
                //rutina para consultar todos los datos de una tabla
                $placa=$_POST["placa"];
                $marca;
                $horaIngreso=new DateTime();
                //$horaIngreso=new Time();
               // $contrato;
                //1. Incluir el archivo BaseDatos.php (Para pdoer usar la clase)
                include("BaseDatos.php" );
                
                //contar cuanto vehiculos estan registrados con mensualidad
                $transaccion3=new BaseDatos();
                $consultaSQL="SELECT COUNT(*) total FROM mensualidad";
                $vehiculos3=$transaccion3->consultarVehiculo($consultaSQL);
                foreach($vehiculos3 as $vehiculo)
                $nromensu1=$vehiculo["total"];
                //echo($nromensu1);

                //contar cuantos vehiculos hay actualmente en el parqueadero
                $transaccion4=new BaseDatos();
                $consultaSQL="SELECT COUNT(*) total FROM ingreso";
                $vehiculos4=$transaccion4->consultarVehiculo($consultaSQL);
                foreach($vehiculos4 as $vehiculo)
                $nroingre1=$vehiculo["total"];
                //echo($nroingre1);

                //contar cuantos vehiculos de los que estan en el parqueadero tienen mensualidad
                $transaccion5=new BaseDatos();
                $cont="SI";
                $consultaSQL="SELECT COUNT(*) total FROM ingreso where contrato='$cont'";
                $vehiculos5=$transaccion5->consultarVehiculo($consultaSQL);
                foreach($vehiculos5 as $vehiculo)
                $nroingremensu1=$vehiculo["total"];
                //echo($nroingremensu1);
                
                //consultar la capacidad del parqueadero
                $transaccion9=new BaseDatos();
                $consultaSQL="SELECT capacidad FROM registro";
                $vehiculos9=$transaccion9->consultarVehiculo($consultaSQL);
                foreach($vehiculos9 as $vehiculo)
                $capacidad=$vehiculo["capacidad"];
                echo($capacidad);
                
                
                $disponi=$capacidad-$nroingre1;
                $separar=$nromensu1-$nroingremensu1;
                $disponlibre=$disponi-$separar;

                //2. Crear un objeto de la clase BaseDatos
                $transaccion=new BaseDatos();
                $nro="SELECT COUNT(*) total FROM ingreso where placa='$placa'";
                $vehiculos=$transaccion->consultarVehiculo($nro);
                foreach($vehiculos as $vehiculo)
                $nro1=$vehiculo["total"];
                //3. Escribir una consulta SQL para buscar datos(La que usted necesite)
                if ($nro1==0):
                    $transaccion1=new BaseDatos();
                    $nro2="SELECT COUNT(*) total FROM mensualidad where placa='$placa'";
                    $vehiculos1=$transaccion1->consultarVehiculo($nro2);
                    foreach($vehiculos1 as $vehiculo)
                    $nro3=$vehiculo["total"];
                    if ($nro3>0):
                        $transaccion8=new BaseDatos();
                        $consultaSQL="SELECT * FROM mensualidad WHERE placa='$placa'";
                        $vehiculos8=$transaccion8->consultarVehiculo($consultaSQL);
                        //4. Utilizar el metodo consultarDatos de mic lase BaseDatos
                    
                        // print_r($vehiculo);
                        date_default_timezone_set("America/Bogota");
                        ?>
                        <?php foreach($vehiculos8 as $vehiculo): ?>
                        <br>
                        <div class="container col-6 ">
                            <form action="ingreso.php" method="POST">
                                <div class="form-group col">
                                    <label for="placa">Placa Vehiculo</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["placa"] ?>" name="placa" readonly>
                                </div>
                                <div class="form-group col mt-2">
                                    <label for="marca">Marca Vehiculo</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["marca"] ?>" name="marca" readonly>
                                </div>
                                <div class="form-group col mt-2">
                                    <label for="modelo">Modelo Vehiculo</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["modelo"] ?>" name="modelo" readonly>
                                </div>
                                <div class="form-group col mt-2">
                                    <label for="color">Color Vehiculo</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["color"] ?>" name="color" readonly>
                                </div>
                                <div class="form-group col mt-2">
                                    <label for="nombreConductor">Nombre Conductor</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["nombreConductor"] ?>" name="nombreConductor" readonly>
                                </div>
                                <div class="form-group col mt-2">
                                    <label for="contrato">Contrato Mensual</label>
                                    <input type="text" class="form-control" value="<?= $vehiculo["contrato"] ?>" name="contrato" readonly>
                                </div>
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-info" name="botonIngreso">Ingreso</button>
                                </div>
                            </form>
                        </div>
                        <?php endforeach ?>
                    <?php elseif($disponlibre>0): ?>
                            <div class="container col-6 ">
                                <form action="ingreso.php" method="POST">
                                    <div class="form-group col">
                                        <label for="placa">Placa Vehiculo</label>
                                        <input type="text" class="form-control" value="<?= $placa ?>" name="placa">
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="color">Color Vehiculo</label>
                                        <input type="text" class="form-control" placeholder="Color Vehiculo" name="color">
                                    </div>
                                    <div class="form-group col mt-2">
                                        <label for="contrato">Contrato Mensual</label>
                                        <input type="text" class="form-control" value="No" name="contrato">
                                    </div>
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-info" name="botonIngreso">Ingreso</button>
                                    </div>
                                </form>
                            </div>
                    <?php else: ?>
                        <H1>No hay Disponibilidad de parqueadero</H1>    
                    <?php endif ?>
                        
                <?php else:?>
                   <h1>La placa ya registra dentro del parqueadero</h1>   
                <?php endif ?>
                <?php endif ?>
                
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