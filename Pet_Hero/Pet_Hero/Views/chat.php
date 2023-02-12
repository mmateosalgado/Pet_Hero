<?php 
    require_once(VIEWS_PATH."Section/header.php");
    include('Section/nav.php');
?>


<body>
  <div class="container">
    <div class="row">

      <section class="chat"> <!-- ******************* Encabezado del chat (nombre del contacto) ****************** -->
        <div class="header-chat">
          <i class="icon fa fa-user-o" aria-hidden="true"></i>
          <p class="name"><?php echo $user; ?></p>
          <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
        </div>
        <div class="messages-chat"> <!-- ********************************** aca arranca el chat ***************************************** -->
          
          <div class="message texto-only">
            <p class="time"> 14:58</p>
            <p class="texto"> Apartir de las 17:00 puedo pasar a buscar a tu mascota ?</p>
          </div>
          
          <a> <?php //echo $idReserve; ?></a>
          <a> <?php //echo $alert; ?></a>


          <a> <?php if(isset($chatUser)) { foreach($chatUser as $chat)
          { ?></a>
          <td> <?php echo $chat->getMensaje(); ?> </td>
          <br>
          <?php } }?>
          <div class="message texto-only">
            <div class="response">
            <p class="response-time time"> 15:04</p>
              <p class="texto"> Obvio ran 😃</p>
            </div>
          </div>
          <div class="message texto-only">
            <div class="response">
            <p class="response-time time"> 15:04</p>
              <p class="texto"> Mandale mecha </p>
            </div>
          </div>
          
          <div class="message texto-only">
            <p class="time"> 14:58</p>
            <p class="texto"> Apartir de las 17:00 puedo pasar a buscar a tu mascota ?</p>
          </div>
          
          <div class="message texto-only">
            <div class="response">
              <p class="response-time time"> 15:04</p>
              <p class="texto"> Obvio ran 😃</p>
            </div>
          </div>
         
        </div> <!-- ********************************** aca termina el chat ***************************************** -->
        <form action="<?php echo FRONT_ROOT . "Chat/sendMessage"?>" method="post" enctype="multipart/form-data">
        <div class="footer-chat">
          <input type="texto" class="write-message" placeholder="Escriba aqui" name="message"></input>
          <input type="hidden" value="<?php echo $user?>" name="user" >
          <td><button class="btn_check btn_send" name="id_reserve" title="send" value="<?php echo $chat->getId_reserva()?>"> </button></td>
            </form>
        </div>
      </section>

    </div>

  </div>

</body>

<br>        
                    <?php if($alert != ""){?>
                            <div class="message">
                                <a><?php echo $alert["text"]?></a></div>
                            </div>
                        <?php } ?> 
                    </div>
<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>
