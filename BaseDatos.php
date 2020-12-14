<?php 

class BaseDatos{

//DATOS/VARIABLES/ATRIBUTOS
public $usuarioBD="root";
public $passwordBD="";


//CONSTRUCTOR FUNCION ESPECIAL
public function __construct(){}


//ACCIONES/FUNCIONES/METODOS
public function conectarBD(){

    //1. DEFINIR EL DSN(info generica de mi BD)
    //gestorBD:host=nombreServidor;dbname=nombreBD
    $infoBD="mysql:host=localhost;dbname=parqueadero";

    //2. Revisar(intentar) si hay conexión con la BD
    try{

        //3. UTILIZAR A PDO(crear un objeto de la clase PDO)
        $conexionBD=new PDO($infoBD, $this->usuarioBD, $this->passwordBD);
        return($conexionBD);

    }catch(PDOException $error){
        //3.1 Manejo del error
        echo($error->getMessage());
    }

}

public function agregarParqueadero($consultaSQL){

    //1. Establecer una conexión con la BD
    $conexionBD=$this->conectarBD();
    
    //2. Peparar la consulta
    $consultarAgregarParqueadero=$conexionBD->prepare($consultaSQL);

    //3. Ejecutar la consulta
    $resultado=$consultarAgregarParqueadero->execute();

    //4. Verificar el resultado
    if($resultado){
        echo("Se agrego el parqueadero con éxito");
    }else{
        echo("Error agregando el producto");
    }
  Header("location:admon.php");
}

public function agregarIngresoParqueadero($consultaSQL){

    //1. Establecer una conexión con la BD
    $conexionBD=$this->conectarBD();
    
    //2. Peparar la consulta
    $consultarAgregarIngresoParqueadero=$conexionBD->prepare($consultaSQL);

    //3. Ejecutar la consulta
    $resultado=$consultarAgregarIngresoParqueadero->execute();

    //4. Verificar el resultado
    /*if($resultado){
        echo("Se dio ingreso al vehiculo al parqueadero con éxito");
    }else{
        echo("Error ingresando el vehiculo al parqueadero");
    }
  //Header("location:ingreso.php");*/
}

public function agregarSalidaParqueadero($consultaSQL){

    //1. Establecer una conexión con la BD
    $conexionBD=$this->conectarBD();
    
    //2. Peparar la consulta
    $consultarAgregarSalidaParqueadero=$conexionBD->prepare($consultaSQL);

    //3. Ejecutar la consulta
    $resultado=$consultarAgregarSalidaParqueadero->execute();

    //4. Verificar el resultado
  /*  if($resultado){
        echo("Se dio salida al vehiculo del parqueadero con éxito");
    }else{
        echo("Error con salida del vehiculo del parqueadero");
    }*/
 
}

public function consultarVehiculo($consultaSQL){

    //1.Establecer la conexión
    $conexionBD=$this->conectarBD();

    //2. Preparar la consulta para agregar datos
    $consultaBuscarVehiculo=$conexionBD->prepare($consultaSQL);

    //3. Establecer como(En que formato) devolver los datos consultados
    $consultaBuscarVehiculo->setFetchMode(PDO::FETCH_ASSOC);

    //4. Ejecutar la consulta preparada
    $resultado=$consultaBuscarVehiculo->execute();

    //5. Retornar los datos consultados
    return($consultaBuscarVehiculo->fetchAll());
}

public function eliminarVehiculo($consultaSQL){
  //1. Establecer una conexión con la BD
  $conexionBD=$this->conectarBD();
    
  //2. Peparar la consulta
  $consultaEliminarVehiculo=$conexionBD->prepare($consultaSQL);

  //3. Ejecutar la consulta
  $resultado=$consultaEliminarVehiculo->execute();

  //4. Verificar el resultado
  /*if($resultado){
      echo("Vehiculo salio del parqueadero");
  }else{
      echo("Error dando salida al vehiculo de parqueadero");
  }*/
  

}

public function editarProductos($consultaSQL){
    //1. Establecer una conexión con la BD
    $conexionBD=$this->conectarBD();
      
    //2. Peparar la consulta
    $consultaEditarProductos=$conexionBD->prepare($consultaSQL);
  
    //3. Ejecutar la consulta
    $resultado=$consultaEditarProductos->execute();
  
    //4. Verificar el resultado
    if($resultado){
        echo("se editó el producto con éxito");
    }else{
        echo("Error editando el producto");
    }
    Header("location:editarProductos.php");
  
  }

}



?>