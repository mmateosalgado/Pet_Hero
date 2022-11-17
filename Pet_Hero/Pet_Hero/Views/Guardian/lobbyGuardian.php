<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>

<div class="headerSP">
<div>Solicitudes <span>Disponibles</span></div>
</div>

    <div class="table-wrapper">

    <form action="<?php echo FRONT_ROOT . "Guardian/changeReserve"?>" method="post" enctype="multipart/form-data">
    <table class="fl-table">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre de la Mascota</th>
            <th>Animal</th>
            <th>Raza</th>
            <th>Cant tiempo</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Total</th>
            <th>Cuidar</th>
            <th>Rechazar</th>
        </tr>
        </thead>
        <tbody>
        <?php if($reserveList != null) {        /*La LISTA DE RESERVAS ES SOLO DEL GUARDIAN CON LA ID DEL SESSION*/ 
        foreach($reserveList as $reserve){
            foreach($petList as $pet){
                if($pet->getId() == $reserve->getIdMascota() && $reserve->getEstado()=='en espera' ) {
         ?>
        <tr>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto() ?>"></td>
            <td><?php echo $pet->getName()?></td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td><?php echo "10 días"; ?></td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo $reserve->getTotal()?></td>
            <td><button class="btn_check" name="estado" value="2"> </button></td>
            <td><button class="btn_reject" name="estado" value="3"> </button></td>

            <input type="hidden" value="<?php  echo $reserve->getIdReserve()?>" name="idReserve"> 
        </tr>
       <?php  } }
          } }?>
        <tbody>
    </table>  
</div>

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>