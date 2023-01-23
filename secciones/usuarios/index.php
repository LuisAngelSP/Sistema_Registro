<?php
    include("../../bd.php");
    //LISTAR USUARIOS
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios");
    $sentencia->execute();
    $lista_usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);

    //ELIMINAR USUARIOS

    if(isset($_GET['txtID'])){
        //recolectar los DATO DE GET
        $txtID=(isset($_GET['txtID']))? $_GET['txtID']:"";
        $sentencia=$conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

        header("Location:index.php");
    }



    include("../../templates/header.php")

?>

<br/>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Registro</a>
    </div>
    <div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre de Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($lista_usuarios as $r){
                ?>
                <tr class="">
                    <td scope="row"><?php echo $r['id'] ;?></td>
                    <td><?php echo $r['usuario']; ?></td>
                    <td><?php echo $r['password'] ?></td>
                    <td><?php echo $r['correo'] ?></td>
                    <td>
                        <a name="btneditar" id="btneditar" class="btn btn-primary" href="editar.php?txtID=<?php echo $r['id'];?>" role="button">Editar</a>
                        <a name="btneliminar" id="btneliminar" class="btn btn-danger" href="index.php?txtID=<?php echo $r['id'];?>" role="button">Eliminar</a>
                    </td>
                </tr>

                <?php 
                }
                ?>
            </tbody>
        </table>
    </div>
    
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>

<?php
    include("../../templates/footer.php")

?>