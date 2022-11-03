<?php
 include('Views/../../Section/nav.php');
?>

<div class="headerSP">
<div>Guardianes <span>Disponibles</span></div>

    <div class="table-wrapper datesView">
    <a> <?php echo "Del: ".$fechaInicio. " Hasta el: ".$fechaFin. "<br>".
    "Mascota: ". $newPet->getAnimal(). "       Raza: ".$newPet->getRace(). " Tamaño: ". $newPet->getSize();?></a>

    <form action="<?php echo FRONT_ROOT . "Owner/addReserve"?>" method="post" enctype="multipart/form-data">

    <input type="hidden" value="<?php echo $_SESSION["id"]?>" name="idOwner" >
    <input type="hidden" value="<?php  echo $fechaInicio;?>" name="fechaInicio">
    <input type="hidden" value="<?php  echo $fechaFin;?>" name="fechaFin">
    <input type="hidden" value="<?php  echo $newPet->getAnimal();?>" name="mascota">
    <input type="hidden" value="<?php  echo $newPet->getRace();?>" name="race">
    <input type="hidden" value="<?php  echo $newPet->getId();?>" name="idPet">


    <table class="fl-table">
        <thead>
        <tr></tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Calificacion</th>
            <th>Disponibilidad</th>
            <th>Tamaño para cuidar</th>
            <th>Precio x Dia</th>
            <th>Aceptar</th>
            <th>Rechazar</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        //Generamos las fechas inbetewn
        
            $formato="d-m-Y";
            $dates=array();//arreglo con todas las fechas a cubrir x el guardian
            $actual=strtotime($fechaInicio);
            $fin=strtotime($fechaFin);
            $stepVal='+1 day';
            while($actual<=$fin){
                $dates[]=date($formato,$actual);
                $actual=strtotime($stepVal,$actual);
            }
        
            foreach($guardianList as $guardian){//que pasa con las del medio 
                if( count(array_diff($dates,$guardian->getFechasDisponibles())) == 0 &&  $newPet->getSize() == $guardian->getTamanioParaCuidar()){?>
        <tr>
        <td><img width="60" height="60" src="<?php echo $guardian->getfotoPerfil();?>"></td>
        <td><?php echo $guardian->getUserName() ;?></td>
        <td><?php echo $guardian->getCalificacion() ;?></td>
        <td><?php echo $guardian->getCuil() ;?></td>
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