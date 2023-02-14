<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>

<div class="headerSP">
<div>Reservas <span>Confirmadas</span></div>
</div>

    <div class="table-wrapper">
        <div class = "addPet">
    <form action="<?php echo FRONT_ROOT."Owner/showHistorialReserves"?>" method="post">
        <input type="submit" value="Ver Historial">
    </form>
    </div>
    <table class="fl-table fl-tableReserve">
        <thead>
        <tr>
            <th>Chat</th>
            <th>Foto</th>
            <th>Mascota</th>
            <th>Animal</th>
            <th>Raza</th>
            <th>Estado</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Total</th>
            <th>Guardian</th>
            <th>CUIL</th>
            <th>Teléfono</th>
            <th>Pagar</th>
        </tr>
        </thead>
        <tbody>
        <?php if($reserveList != null) {        /*La LISTA DE RESERVAS ES SOLO DEL OWNER CON LA ID DEL SESSION*/ 
        foreach($reserveList as $reserve){
            foreach($petList as $pet){
                foreach($guardianList as $guardian){
                if($pet->getId() == $reserve->getIdMascota() && ($reserve->getEstado()=='confirmada' || $reserve->getEstado()=='pagada')  && $guardian->getId() == $reserve->getIdGuardian()) {
         ?>
        <tr>
            <form action="<?php echo FRONT_ROOT . "Chat/Index"?>" method="post" enctype="multipart/form-data"> <!-- aca el redireccionamiento -->
             <td><button class="btn_calify btn_chat" name="chat" title="Ir al chat" value="<?php echo $reserve->getIdReserve() ?>"> </button></td>
            </form>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto() ?>"></td>
            <td><?php echo $pet->getName()?></td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td><?php echo $reserve->getEstado(); ?></td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo '$'.$reserve->getTotal()?></td>
            <td><?php echo $guardian->getUserName()?></td>
            <td><?php echo $guardian->getCuil()?></td>
            <td><?php echo $guardian->getTelefono()?></td>
            <?php if ($reserve->getEstado()=='confirmada') 
            {
            ?>
            <form action="<?php echo FRONT_ROOT . "Owner/goToPay"?>" method="post" enctype="multipart/form-data">
            <td><button class="btn_pay" name="estado" title="Ir a pagar" value="<?php echo $reserve->getIdReserve() ?>"> </button></td>
            </form>
            <?php } else if ($reserve->getEstado()=='pagada') {?>
                <td><button class="btn_ok" name="estado" title="Ya está pago"> </button></td>
                <?php } ?>
            
        </tr>
       <?php  } } }
          } }?>
        <tbody>
    </table>  
</div>
<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>