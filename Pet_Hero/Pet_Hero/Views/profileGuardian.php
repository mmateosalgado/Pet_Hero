<?php 
include('nav.php');?>
<div class="headerSP">
<div> Guardián: <span><?php echo $userGuardian->getuserName();?></span></div>
</div>
<div class="tabla">
<div class="headerTable">
    <div class="table-wrapper">

    <table class="fl-table">
        <thead>
        <tr>
            <th>Nombre de usuario</th>
            <th>Nombre Completo</th>
            <th>Fecha de nacimiento</th>
            <th>Email</th>
            <th>Genero</th>
            <th>CUIL</th>
            <th>Precio x Hora</th>
            <th>Fecha inicio disponibilidad</th>
            <th>Fecha fin disponibilidad</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $userGuardian->getuserName();?></td>
            <td><?php echo $userGuardian->getFullName();?></td>
            <td><?php echo $userGuardian->getAge();?> </td>
            <td><?php echo $userGuardian->getEmail();?></td>
            <td><?php echo $userGuardian->getGender();?></td>
            <td><?php echo $userGuardian->getCuil();?></td>
            <td><?php echo $userGuardian->getPrecioPorHora();?></td>
            <!-- telefono -->
            <td><?php echo $userGuardian->getFechaInicio();?></td>
            <td><?php echo $userGuardian->getFechaFin();?></td>
        </tr>
        <tbody>
    </table>
</div>
</div>
</div>  <!-- aca esta el boton mate, si queres metelo dentro de un form o ponele un href
           para que te lleve a donde te tenga que llevar (al home controller supongo) -->
<div class="update">
    <form action="<?php echo FRONT_ROOT."Guardian/showUpdateGuardian"?>" method="post">
        <input type="hidden" value="<?php echo $userGuardian->getuserName();?>" name="user">>
        <input type="submit" value="Modificar Datos">
    </form>
</div>