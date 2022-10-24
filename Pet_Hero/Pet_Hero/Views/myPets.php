<?php 
 include('nav.php');
?>

<div class="headerSP">
<div>Tus <span>Mascotas</span></div>
</div>

<div class="addPet">
    <form action="<?php echo FRONT_ROOT."Owner/showAddPet"?>" method="post">
        <input type="submit" value="Agregar Mascota">
    </form>
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
            <th>Peso</th>
            <th>Edad</th>
            <th>Gr x Porcion</th>
            <th>Descripcion</th>
            <th>Plan Vacunacion</th>
            <th>Quitar</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($petList as $pet){?>
        <tr>
            <td><img width="60" height="60" src="<?php echo $pet->getFoto();?>"></td>
            <td><?php echo $pet->getName();?></td>
            <td><?php echo $pet->getAnimal();?></td>
            <td><?php echo $pet->getRace();?></td>
            <td><?php echo $pet->getWeight();?></td>
            <td><?php echo $pet->getAge();?></td>
            <td><?php echo $pet->getGrXfoodPortion();?></td>
            <td><?php echo $pet->getDescription();?></td>
            <td><img width="60" height="60" src="<?php echo $pet->getPlanVacunacion();?>"></td>
            <td><button class ="btn_reject"> </button> </td>
        </tr>
        <?php }?>
        <tbody>
    </table>  
</div>
</div>
</div>