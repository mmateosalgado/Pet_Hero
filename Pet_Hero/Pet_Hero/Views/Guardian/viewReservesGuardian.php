<?php 
    require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>
<div class="headerSP">
<div>Reservas <span>Confirmadas</span></div>
</div>
<div class="addPet">
    <form action="<?php echo FRONT_ROOT."Guardian/showHistorialReserves"?>" method="post">
        <input type="submit" value="Ver Historial">
    </form>
</div>

    <div>
            <br>  
            <?php if(isset($message)) 
            { echo "<div class='message'><a>". $message."</a></div>";} ?>
    </div>
    <div class="table-wrapper">
    <table class="fl-table fl-tableReserve photoGuardian" >
        <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre de la Mascota</th>
            <th>Animal</th>
            <th>Raza</th>
            <th>Estado</th>
            <th>Fecha inicio</th>
            <th>Fecha fin</th>
            <th>Total</th>
            <th>Dar por finalizada</th> <!--elimina la reserva y se pide review al owner-->
        </tr>
        </thead>
        <tbody>
        <?php if($reserveList != null) {        /*La LISTA DE RESERVAS ES SOLO DEL GUARDIAN CON LA ID DEL SESSION*/ 
        foreach($reserveList as $reserve){
            foreach($petList as $pet){
                if($pet->getId() == $reserve->getIdMascota() && ($reserve->getEstado()=='confirmada' || $reserve->getEstado()=='pagada')) {
         ?>
        <tr>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto() ?>"></td>
            <td><?php echo $pet->getName()?></td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td><?php echo $reserve->getEstado(); ?></td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo "$".$reserve->getTotal()?></td>
            <td><button class="btn_check" name="estado" value="confirmada"> </button></td>
        </tr>
       <?php  } }
          } }?>
        <tbody>
    </table>  
</div>
<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>