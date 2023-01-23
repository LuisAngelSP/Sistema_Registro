<?php
    include("../../bd.php");

//ELIMINAR UN PUESTO

    if(isset($_GET['txtID'])){
    $txtID=(isset($_GET['txtID'])?$_GET['txtID']:"");
    $sentencia=$conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();

    header("Location:index.php");
    }
// MOSTRAR REGISTRO    
    $sentencia=$conexion->prepare("SElECT * FROM `tbl_puestos`");
    $sentencia->execute();
    $lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    include("../../templates/header.php")

?>
<br/>
<div class="card">
    <div class="card-header">

        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">
            Agregar Registro
        </a>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del Puesto</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($lista_tbl_puestos as $r){
                
                ?>
                <tr class="">
                    <td scope="row"><?php echo $r['id'];?></td>
                    <td><?php echo $r['nombredelpuesto'];?></td>
                    <td>
                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $r['id']?>" role="button">Editar</a>
                        <a class="btn btn-danger" href="index.php?txtID=<?php echo $r['id']?>" role="button">Eliminar</a>
                    </td>
                </tr>
             <?php
                }
             ?>           
            </tbody>
        </table>
    </div>
    
    </div>
</div>



<?php
    include("../../templates/footer.php")

?>