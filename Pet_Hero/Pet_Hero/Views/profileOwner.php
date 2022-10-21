<?php 
include('nav.php');?>
<div class="headerSP">
<div>Bienvenido al Perfil de <span>Owner</span></div>
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
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $userOwner->getuserName();?></td>
            <td><?php echo $userOwner->getFullName();?></td>
            <td><?php echo $userOwner->getAge();?> </td>
            <td><?php echo $userOwner->getEmail();?></td>
            <td><?php echo $userOwner->getGender();?></td>
        </tr>
       
        <tbody>
    </table>
</div>
</div>
</div>