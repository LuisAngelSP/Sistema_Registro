<?php
include("../../bd.php");

  if($_POST){
    //RECOLECTAR DATOS
    $primernombre=(isset($_POST['primernombre'])?$_POST['primernombre']:"");
    $segundonombre=(isset($_POST['segundonombre'])?$_POST['segundonombre']:"");
    $primerapellido=(isset($_POST['primerapellido'])?$_POST['primerapellido']:"");
    $segundoapellido=(isset($_POST['segundoapellido'])?$_POST['segundoapellido']:"");
 

    $foto=(isset($_FILES['foto']['name'])?$_FILES['foto']:"");
    $cv=(isset($_FILES['cv']['name'])?$_FILES['cv']:"");

    $puesto=(isset($_POST['puesto'])?$_POST['puesto']:"");
    $fechadeingreso=(isset($_POST['fechadeingreso'])?$_POST['fechadeingreso']:"");

    // CONSULTA A LA BASE DE DATOS

    $sentencia=$conexion->prepare("INSERT INTO tbl_empleados (id, primernombre,  segundonombre ,  primerapellido ,  segundoapellido ,  foto ,  cv ,  idpuesto ,  fechadeingreso ) 
      VALUES (NULL, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechadeingreso);");
    $sentencia->bindParam(":primernombre",$primernombre);
    $sentencia->bindParam(":segundonombre",$segundonombre);
    $sentencia->bindParam(":primerapellido",$primerapellido);
    $sentencia->bindParam(":segundoapellido",$segundoapellido);
    // CREAR UNA VARIABLE PARA EL TIEMPO QUE SE SUBE EL ARCHIVO
    $fecha_=new DateTime();
    $nombreArchivo_foto=($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
    $tmp_foto=$_FILES["foto"]['tmp_name'];
    if($tmp_foto!=''){
      move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    }
    $sentencia->bindParam(":foto",$nombreArchivo_foto);

    $nombreArchivo_cv=($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
    $tmp_cv=$_FILES["cv"]['tmp_name'];
    if($tmp_cv!=''){
      move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
    }
    $sentencia->bindParam(":cv",$nombreArchivo_cv);


    $sentencia->bindParam(":idpuesto",$puesto);
    $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
    $sentencia->execute();

    header("Location:index.php");
  }

  //mostrar los puestos

  $sentencia=$conexion->prepare("SELECT * FROM tbl_puestos");
  $sentencia->execute();
  $registro=$sentencia->fetchAll(PDO::FETCH_ASSOC);




    include("../../templates/header.php")

?>
<br>

<div class="card">
    <div class="card-header">
        Datos de Empleado
    </div>
    <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
          <label for="primernombre" class="form-label">Primer Nombre</label>
          <input type="text"
            class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer Nombre">
        </div>
        <div class="mb-3">
          <label for="segundonombre" class="form-label">Segundo Nombre</label>
          <input type="text"
            class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo Nombre">
        </div>
        <div class="mb-3">
          <label for="primerapellido" class="form-label"> Primer Apellido</label>
          <input type="text"
            class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer Apellido">
        </div>
        <div class="mb-3">
          <label for="segundoapellido" class="form-label"> Segundo Apellido</label>
          <input type="text"
            class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo Apellido">
        </div>
        <div class="mb-3">
          <label for="foto" class="form-label">Foto:</label>
          <input type="file"
            class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto">
        </div>
        <div class="mb-3">
          <label for="cv" class="form-label">CV(PDF):</label>
          <input type="file"
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