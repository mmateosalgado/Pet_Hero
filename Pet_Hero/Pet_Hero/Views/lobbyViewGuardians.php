<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Guardianes <span>Disponibles</span></div>

</div>

<div class="tabla">
<div class="headerTable">

    <div class="table-wrapper">
    <a> <b><font color="black"><?php echo "Del: ".$fechaInicio. " Hasta el: ".$fechaFin;?></font></b></a><br>
    <a> <b><font color="black"><?php echo "Mascota: ".$mascota. "       Raza: ".$race. " Tamaño: ". $size;?></font></b></a>
    <table class="fl-table">
        <thead>
        <tr>
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
        <?php foreach($guardianList as $guardian){if($fechaInicio>= $guardian->getFechaInicio() && $fechaFin<=$guardian->getFechaFin()){?>
        <tr>
        <td><img width="60" height="60" src="<?php echo $guardian->getfotoPerfil();?>"></td>
        <td><?php echo $guardian->getUserName() ;?></td>
        <td><?php echo $guardian->getCalificacion() ;?></td>
        <td><?php echo $guardian->getCuil() ;?></td>
        <td><?php echo $guardian->getFechaInicio() ;?></td>
        <td><?php echo $guardian->getFechaFin() ;?></td>
        <td><?php echo $guardian->getTamanioParaCuidar() ;?></td>
        <td><?php echo $guardian->getPrecioPorHora()*24 ;?></td>
            <td><button class="btn_check"> </button></td>
            <td><button class="btn_reject"> </button></td>
        </tr>
        <?php }}?>
        <tbody>
    </table>
    
</div>
</div>
</div>