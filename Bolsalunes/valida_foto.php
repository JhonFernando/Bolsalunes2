 

<?php
require_once 'conexion1.php';
 

//$id_estudio=0;
$p_id_tipo_estudio= $_REQUEST["p_id_tipo_estudio"];
$p_institucion= $_REQUEST["p_institucion"];
$p_fecha_inicio= $_REQUEST["p_fecha_inicio"];
$p_fecha_fin= $_REQUEST["p_fecha_fin"];

$foto=$_FILES["foto"]["name"];
$ruta=$_FILES["foto"]["tmp_name"];
$destino= 'fotos/'.$foto;
copy($ruta,$destino);
$id_uss = $_POST['id_uss'];
//$p_accion = 'I';
 

/*
 
try 
{
        $BaseDatos = "bolsa";
        $Servidor = "localhost";
        $Usuario = "root";
        $Clave = "aaaaaaaa";
                //     $conector->Conexion2();
        // calling stored procedure command
        $pdo = new PDO("mysql:host=$Servidor;dbname=$BaseDatos", $Usuario, $Clave);
        $pdo->beginTransaction();
        
        $sql = 'call sp_crud_estudio(:p_id_estudio,:p_id_tipo_estudio,:p_institucion,:p_fecha_inicio,:p_fecha_fin,:p_descripcion,:p_usuario_reg,p_accion)';
        // prepare for execution of the stored procedure
        $stmt = $pdo->prepare($sql);
        // pass value to the command
        $stmt->bindParam(':p_id_estudio',     $id_estudio  ,PDO::PARAM_INT);
        $stmt->bindParam(':p_id_tipo_estudio',     $p_id_tipo_estudio  ,PDO::PARAM_INT);
        $stmt->bindParam(':p_institucion', $p_institucion,PDO::PARAM_STR);
        $stmt->bindParam(':p_fecha_inicio', $p_fecha_inicio,PDO::PARAM_STR);
        $stmt->bindParam(':p_fecha_fin', $p_fecha_fin,PDO::PARAM_STR);
        $stmt->bindParam(':p_descripcion', $destino,PDO::PARAM_STR);
        $stmt->bindParam(':p_usuario_reg', $id_uss,PDO::PARAM_INT);
        $stmt->bindParam(':p_accion', $p_accion,PDO::PARAM_STR);
 
        // execute the stored procedure
        $stmt->execute(); 
        $stmt->closeCursor();      
        $pdo->commit();
        
      } catch (PDOException $e) {
        die("Error occurred:" . $e->getMessage());
    }*/




 
 




mysqli_query($mysqli,"insert into estudio(id_tipo_estudio,institucion,fecha_inicio,fecha_fin,descripcion,usuario_reg) values($p_id_tipo_estudio,'$p_institucion','$p_fecha_inicio','$p_fecha_fin','$destino',$id_uss)");
header("Location:  http://localhost/bolsalunes/#dashboard.php");


?>
