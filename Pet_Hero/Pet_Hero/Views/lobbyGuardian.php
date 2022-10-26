<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Solicitudes <span>Disponibles</span></div>
</div>

    <div class="table-wrapper">

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
        <?php if($reserveList != null) foreach($reserveList as $reserve){
            foreach($petList as $pet){if($pet->getId() == $reserve->getIdMascota()) { ?>
        <tr>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto() ?>"></td>
            <td><?php echo $pet->getName()?></td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td><?php echo "10 días"; ?></td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo $reserve->getTotal()?></td>
            <td><button class="btn_check"> </button></td>
            <td><button class ="btn_reject"> </button> </td>
        </tr>
       <?php } }
          }?>
        <tbody>
    </table>  

</div>