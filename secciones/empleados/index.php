<?php
include("../../bd.php");

    //mostrar LOS DATOS DE EMPLEADO

    $sentencia=$conexion->prepare("SELECT *,
    (SELECT nombredelpuesto FROM tbl_puestos
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1)as puesto
     FROM tbl_empleados");
    $sentencia->execute();
    $registro=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    include("../../templates/header.php");
    //ELIMINAR USUARIOS

    if(isset($_GET['txtID'])){
        //recolectar los DATO DE GET
        $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
       
        //BUSCAR LOS ARCHIVOS DE FOTO Y CV PRA ELIMINALOS
        $sentencia=$conexion->prepare("SELECT foto,cv FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

        if(isset($registro_recuperado["foto"])&& $registro_recuperado["foto"]!=""){
            if(file_exists("./".$registro_recuperado["foto"])){
                //unlink sirve para eliminar un archivo 
                unlink("./".$registro_recuperado["foto"]);
            }
        }
        if(isset($registro_recuperado["cv"])&& $registro_recuperado["cv"]!=""){
            if(file_exists("./".$registro_recuperado["cv"])){
                //unlink sirve para eliminar un archivo 
                unlink("./".$registro_recuperado["cv"]);
            }
        }

        $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

        header("Location:index.php");
    }
?>

<br/>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" 
        href="crear.php" role="button">
        Agregar Registro
    </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de Ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($registro as $r){ ?>
                    <tr class="">
                        <td scope="row"><?php echo $r['id'] ?></td>
                        <td><?php echo $r['primernombre'] ;?>
                            <?php echo $r['segundonombre'] ;?> 
                            <?php echo $r['primerapellido'] ;?>
                            <?php echo $r['segundoapellido'] ;?> </td>
                        <td>
                            <img width="50"
                             src="<?php echo $r['foto'] ;?>" 
                            class="img-fluid rounded" alt=""/>
                            
                        </td>
                        <td><?php echo $r['cv'] ;?></td>
                        <td><?php echo $r['puesto'] ;?></td>
                        <td><?php echo $r['fechadeingreso'] ;?></td>
                        <td>
                        <a name="" id="" class="btn btn-info" href="#" role="button">Carta</a>
                        <a name="" id="" class="btn btn-primary" href="editar.php?txtID=<?php echo $r['id'] ?>" role="button">Editar</a>    
                        <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $r['id'] ?>" role="button">Eliminar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
            
    </div>
</div>
<?php
    include("../../templates/footer.php")

?>