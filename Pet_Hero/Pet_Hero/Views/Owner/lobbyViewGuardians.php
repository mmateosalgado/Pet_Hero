<?php
require_once(VIEWS_PATH."Section/header.php");
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

    <table class="fl-table photoGuardian showClasificacion ">
        <thead>
        <tr></tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Calificacion</th>
            <th>CUIL</th>
            <th>Tamaño para cuidar</th>
            <th>Precio x Dia</th>
            <th>Total</th>
            <th>Reservar</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        //Generamos las fechas inbetewn
        


            foreach($guardianListToFilter as $guardian){//que pasa con las del medio 
                            //Modificar para que muestre los que tienen en esos dias una reserva con mismo tipo de animal-raza

            if($newPet->getSize() == $guardian->getTamanioParaCuidar()){
                if( count(array_diff($dates,$guardian->getFechasDisponibles())) == 0 || $reservasDao->VerifyByDateAndRace($guardian->getId(),$dates,$newPet->getRace(),$guardian->getFechasDisponibles())){?>
        <tr><?php $idPet=$newPet->getId();?>
        <td><a href="<?php echo FRONT_ROOT."Owner/showGuardian/".$guardian->getId()."/".$fechaInicio."/".$fechaFin."/".$idPet?>"><img width="60" height="60" src="<?php echo $guardian->getfotoPerfil();?>"></a></td>
        <td><?php echo $guardian->getUserName() ;?></td>
        <td><?php 
        
        switch($guardian->getCalificacion())
        {
        case 0:
            echo "Sin valoraciones" ;
            break;
        case 1:
             echo "<label>"."★"."</label>"."<a>"."★★★★". "</a>" ;
             break;
        case 2:
            echo "<label>"."★★"."</label>"."<a>"."★★★". "</a>";
            break;
        case 3:
            echo "<label>"."★★★"."</label>"."<a>"."★★". "</a>" ;
            break;
        case 4:
            echo "<label>"."★★★★"."</label>"."<a>"."★". "</a>" ;
            break;
        case 5:
            echo "<label>"."★★★★★"."</label>" ;
            break;
    
        } 
        ?></td>
        <td><?php echo $guardian->getCuil() ;?></td>
        <td><?php echo $guardian->getTamanioParaCuidar() ;?></td>
        <td><?php echo "$".$guardian->getPrecioPorHora() *24 ;?></td>
        <td><?php echo "$".$guardian->getPrecioPorHora() * 24 * $days?></td>


        <input type="hidden" value="<?php echo $guardian->getPrecioPorHora()*24*$days?>" name="precio">

            <td><button class="btn_check" name="idGuardian" value="<?php echo $guardian->getId() ;?>"> </button></td>
        </tr>
        <?php }}}?>
        <tbody>
    </table>
    </form>
</div>

</div>

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>