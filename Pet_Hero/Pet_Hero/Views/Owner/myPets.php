<?php 
require_once(VIEWS_PATH."Section/header.php");
 include('Views/../../Section/nav.php');
 ?>

<div class="headerSP">
<div>Tus <span>Mascotas</span></div>
</div>

<div class="addPet">
    <form action="<?php echo FRONT_ROOT."Owner/showAddPet"?>" method="post">
        <input type="submit" value="Agregar Mascota">
    </form>




    <div class="table-wrapper">

    <table class="fl-table noWrap">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Nombre de la Mascota</th>
            <th>Animal</th>
            <th>Raza</th>
            <th>Tamaño</th>
            <th>Peso</th>
            <th>Edad</th>
            <th>Gr x Porcion</th>
            <th>Descripcion</th>
            <th>Plan Vacunacion</th>
            <th>Video Opcional</th>
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
            <td><?php echo $pet->getSize();?></td>
            <td><?php echo $pet->getWeight();?></td>
            <td><?php echo $pet->getAge();?></td>
            <td><?php echo $pet->getGrXfoodPortion();?></td>
            <td><?php echo $pet->getDescription();?></td>
            <td><img width="60" height="60" src="<?php echo $pet->getPlanVacunacion();?>"></td>

            <?php if($pet->getVideo()==null ){?>    
            <td><img width="100" height="100" src="https://descubrecomohacerlo.com/wp-content/uploads/mch/error-youtube-videos_4028.jpg" alt="Video no disponible" title="Video no disponible"> </td>
            <?php } else{ ?>
            <td><iframe width="200" height="200" src="<?php echo $pet->getVideo();?>" frameborder="0" allowfullscreen ></iframe></td>
            <?php } ?>
            <form action="<?php echo FRONT_ROOT."Owner/DeletePet"?>" method="post">
            <input type="hidden" value="<?php echo $pet->getId();?>" name="id" >
            <td><button class ="btn_reject" type="submit"> </button> </td>
        </form>              
        </tr>
        <?php }?>
        <tbody>
    </table>  
    <?php if($alert){?>
        <div class="message">
            <a><?php echo $alert["text"]?></a></div>
        </div>
    <?php } ?> 
</div>
<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>