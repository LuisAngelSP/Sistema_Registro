<?php
    include("../../bd.php");
    if($_POST){
        //Recolectamos los datos del metodo POST
        $nombredelpuesto=(isset($_POST['nombredelpuesto'])?$_POST['nombredelpuesto']:"");
        
        //Preparar la sentencia de los Dtaos
        $sentencia=$conexion->prepare("INSERT INTO tbl_puestos (id, nombredelpuesto)
                                 VALUES (NULL, :nombredelpuesto)");
        //ASIGNANDO los valores que vienen del formulario
        $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
        $sentencia->execute();

        header("Location:index.php");
    }
    include("../../templates/header.php")

?>

    <br/>

    <div class="card">
        <div class="card-header">
            Puestos
        </div>
        <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
          <label for="nombredelpuesto" class="form-label">Nombre del Puesto:</label>
          <input type="text"
            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombe del Puesto">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
        <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>


        </form>

        </div>
        <div class="card-footer text-muted">

        </div>
    </div>



<?php
    include("../../templates/footer.php")

?>