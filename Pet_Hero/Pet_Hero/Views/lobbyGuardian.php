<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Solicitudes <span>Disponibles</span></div>
</div>
<div class="tabla">
<div class="headerTable">
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
            <td><?php echo $_SESSION["id"];?></td>
            <th>Rechazar</th>
        </tr>
        </thead>
        <tbody>
        <?php if($reserveList != null) foreach($reserveList as $reserve){?>
        <tr>
            <td><img width="60" height="60" src="https://t2.uc.ltmcdn.com/es/posts/8/7/8/cuanto_mide_un_perro_chihuahua_29878_600_square.jpg"></td>
            <td>Puppy</td>
            <td><?php echo $reserve->getTipoMascota()?></td>
            <td><?php echo $reserve->getRace()?></td>
            <td>7 dias</td>
            <td><?php echo $reserve->getFechaInicio()?></td>
            <td><?php echo $reserve->getFechaFin()?></td>
            <td><?php echo $reserve->getTotal()?></td>
            <td><button class="btn_check"> </button></td>
            <td><button class ="btn_reject"> </button> </td>
        </tr>
       <?php }?>
        <tbody>
    </table>  
</div>
</div>
</div>