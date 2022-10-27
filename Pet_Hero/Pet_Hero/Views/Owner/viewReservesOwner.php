<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Reservas <span>Confirmadas</span></div>
</div>

    <div class="table-wrapper">
    <table class="fl-table">
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
            <th>Nombre Guardian</th>
            <th>CUIL</th>
            <th>Teléfono</th>
        </tr>
        </thead>
        <tbody>
        <?php if($reserveList != null) {        /*La LISTA DE RESERVAS ES SOLO DEL OWNER CON LA ID DEL SESSION*/ 
        foreach($reserveList as $reserve){
            foreach($petList as $pet){
                foreach($guardianList as $guardian){
                if($pet->getId() == $reserve->getIdMascota() && $reserve->getEstado()=='Confirmada'  && $guardian->getId() == $reserve->getIdGuardian()) {
         ?>
        <tr>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto() ?>"></td>
            <td><?php echo $pet->getName()?></td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td><?php echo $reserve->getEstado(); ?></td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo $reserve->getTotal()?></td>
            <td><?php echo $guardian->getUserName()?></td>
            <td><?php echo $guardian->getCuil()?></td>
            <td><?php echo $guardian->getTelefono()?></td>
        </tr>
       <?php  } } }
          } }?>
        <tbody>
    </table>  
</div>
