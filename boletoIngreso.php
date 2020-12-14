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
        
        <h2 class="negritaycolor text-center">BOLETO INGRESO PARQUEADERO</h2>
        <br>
        <br>
        
        <?php   
        include("BaseDatos.php");
        $placa=$_POST["placa"];
                $transaccion10=new BaseDatos();
                $consultaSQL="SELECT * FROM ingreso WHERE placa='$placa'";
                $vehiculos10=$transaccion10->consultarVehiculo($consultaSQL);
                 foreach($vehiculos10 as $vehiculo): ?>
                    <br>
                    <div class="container col-6 ">
                        <form action="ingreso.php" method="POST">
                            <div class="col">
                                <label><?= $vehiculo10["placa"] ?></label>
                            </div>
                            <div class="col">
                                <label><?= $vehiculo10["color"] ?></label>
                            </div>
                            <div class="col">
                                <label><?= $vehiculo10["contrato"] ?></label>
                            </div>
                            <div class="col">
                                <label><?= $vehiculo10["fechaIngreso"] ?></label>
                            </div>
                            <div class="col text-center">
                                <button type="text" class="btn btn-info" name="botonIngreso">Imprimir</button>
                            </div>
                        </form>
                    </div>
                    <?php endforeach ?>
       <!-- <div class="container col-2 ">
            <form action="formularioIngreso.php" method="POST" >
                <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <input type="text" class="form-control" placeholder="PLACA VEHICULO" name="placa">
                        </div>
                        <div class="col-auto my-1 text-center">   
                            <button type="submit" class="btn btn-secondary" name="botonIngreso">Ingreso Vehiculo</button>
                        </div>
                </div>
            </form>
            <br>
            <form action="salida.php" method="POST">
                <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                            <input type="text" class="form-control" placeholder="PLACA VEHICULO" name="placa">
                        </div> 
                        <div class="col-auto my-1 text-center">
                            <button type="submit" class="btn btn-dark" name="botonSalida">Salida Vehiculo</button>
                        </div> 
                </div>   
            </form>    
                    
        </div> -->
        
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