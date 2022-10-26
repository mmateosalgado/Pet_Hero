<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Guardianes <span>Disponibles</span></div>

    <div class="table-wrapper">
    <a> <?php echo "Del: ".$fechaInicio. " Hasta el: ".$fechaFin. "<br>".
    "Mascota: ".$mascota. "       Raza: ".$race. " Tamaño: ". $size;?></a>

    <form action="<?php echo FRONT_ROOT . "Owner/addReserve"?>" method="post" enctype="multipart/form-data">

    <input type="hidden" value="<?php echo $_SESSION["id"]?>" name="idOwner" >
    <input type="hidden" value="<?php  echo $fechaInicio?>" name="fechaInicio">
    <input type="hidden" value="<?php  echo $fechaFin?>" name="fechaFin">
    <input type="hidden" value="<?php  echo $mascota?>" name="mascota">
    <input type="hidden" value="<?php  echo $race?>" name="race">
    <input type="hidden" value="<?php  echo $idPet?>" name="idPet"> 


    <table class="fl-table">
        <thead>
        <tr></tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Calificacion</th>
            <th>Disponibilidad</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Tamaño para cuidar</th>
            <th>Precio x Dia</th>
            <th>Aceptar</th>
            <th>Rechazar</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($guardianList as $guardian){if($fechaInicio>= $guardian->getFechaInicio() && $fechaFin<=$guardian->getFechaFin() && $size == $guardian->getTamanioParaCuidar()){?>
        <tr>
        <td><img width="60" height="60" src="<?php echo $guardian->getfotoPerfil();?>"></td>
        <td><?php echo $guardian->getUserName() ;?></td>
        <td><?php echo $guardian->getCalificacion() ;?></td>
        <td><?php echo $guardian->getCuil() ;?></td>
        <td><?php echo $guardian->getFechaInicio() ;?></td>
        <td><?php echo $guardian->getFechaFin() ;?></td>
        <td><?php echo $guardian->getTamanioParaCuidar() ;?></td>
        <td><?php echo $guardian->getPrecioPorHora()*24 ;?></td>

        <input type="hidden" value="<?php echo $guardian->getPrecioPorHora()*24?>" name="precio"> 
        
            <td><button class="btn_check" name="idGuardian" value="<?php echo $guardian->getId() ;?>"> </button></td>
            <td><button class="btn_reject"> </button></td>
        </tr>
        <?php }}?>
        <tbody>
    </table>
    </form>
    
</div>

</div>