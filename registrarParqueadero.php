<?php

    include("BaseDatos.php");

    if(isset($_POST["botonRegistro"])){
        
        //1. Recibo datos del formulario
        $capacidad=$_POST["capacidad"];

        $transaccion1=new BaseDatos();
        $nro2="SELECT COUNT(*) total FROM mensualidad";
        $vehiculos1=$transaccion1->consultarVehiculo($nro2);
        foreach($vehiculos1 as $vehiculo)
        $nro3=$vehiculo["total"];
       // echo($nro3);
       if($capacidad>=$nro3)
        {
            $transaccion1=new BaseDatos(); 
            $consultaSQL="UPDATE registro SET capacidad='$capacidad' WHERE 1";
            $transaccion1->agregarParqueadero($consultaSQL); 
        }
        else
        {
            echo("No se permite capacidad");
        }

    }




?>