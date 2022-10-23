<?php 
include('nav.php');?>
<div class="headerSP">
    
<div>Dueño: <span><?php echo $userOwner->getuserName();?></span></div>
 
</div>
<div class="tabla">
    <center>
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
            <th>Telefono</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $userOwner->getuserName();?></td>
            <td><?php echo $userOwner->getFullName();?></td>
            <td><?php echo $userOwner->getAge();?> </td>
            <td><?php echo $userOwner->getEmail();?></td>
            <td><?php echo $userOwner->getGender();?></td>
            <td>223-306942</td>
        </tr>
       
        <tbody>
    </table>
</div>
</center>
</div>
</div>  <!-- aca esta el boton mate, si queres metelo dentro de un form o ponele un href
           para que te lleve a donde te tenga que llevar (al home controller supongo) -->

<div class="update">
<input type="button" value="Modificar Datos">
</div>