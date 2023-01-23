<?php
    include("../../bd.php");
    //mostrar los datos del empleado

    if(isset($_GET)){
        $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";
    
        $sentencia=$conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $primernombre=$registro['primernombre'];
        $segundonombre=$registro['segundonombre'];
        $primerapellido=$registro['primerapellido'];
        $segundoapellido=$registro['segundoapellido'];
        $foto=$registro['foto'];
        $cv=$registro['cv'];
        $puesto=$registro['idpuesto'];
        $fechadeingreso=$registro['fechadeingreso'];
    }


    include("../../templates/header.php")

?>

<br>

<div class="card">
    <div class="card-header">
        Editar Empleado
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="txtID" class="form-label">ID:</label>
          <input type="text"
          value="<?php echo $txtID ?>"
            class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
        </div>
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text"
          value="<?php echo $primernombre  ?>"
            class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text"
          value="<?php echo $segundonombre ?>"
            class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label"> Primer Apellido</label>
          <input type="text"
          value="<?php echo $primerapellido ?>"
            class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label"> Segundo Apellido</label>
          <input type="text"
          value="<?php echo $segundoapellido  ?>"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file"
          value="<?php echo $foto?>"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <input type="file"
          value="<?php echo $cv ?>"
            class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
        </div>
        <div class="mb-3">
            <label for="puesto" class="form-label">Puesto:</label>
            <select class="form-select form-select-lg" name="puesto" id="puesto">
            <option selected>Selecione</option>
            <?php foreach($registro as $r){ ?>
                <option value="<?php echo $r['id'] ?>"><?php echo $r['nombredelpuesto'] ?></option>

                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
          <label for="fechadeingreso" class="form-label">Fecha de Ingreso:</label>
          <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId">
        </div>
        <button type="submit" class="btn btn-success">Agregar Registro</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

    </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>

<?php
    include("../../templates/footer.php")

?>