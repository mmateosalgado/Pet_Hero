<?php 
include('nav.php');?>
<div class="headerSP">
    
<div>Dueño: <span><?php echo $userOwner->getuserName();?></span></div>
 
</div>

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
