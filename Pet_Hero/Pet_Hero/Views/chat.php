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
          
          
          <a> <?php //echo $idReserve; ?></a>
          <a> <?php // echo $alert; ?></a>


          <a> <?php if(isset($chatUser)) { foreach($chatUser as $chat)
          {   if ($chat->getUser_type() == 1) //ownerr
            {?>

              <div class="message texto-only">
              <p class="time"> <?php echo substr($chat->getFecha(),10,6) ?> </p>
               <p class="texto"> <?php echo $chat->getMensaje(); ?> </p>
              </div>

            <?php } else{?>

              <div class="message texto-only">
              <div class="response">
              <p class="response-time time"> <?php echo substr($chat->getFecha(),10,6) ?> </p>
                <p class="texto"> <?php echo $chat->getMensaje(); ?> </p>
              </div>
            </div>

            <?php }
            ?></a>

          <td>  </td>
          <br>
          <?php } }?>
       
        </div> <!-- ********************************** aca termina el chat ***************************************** -->
        <form action="<?php echo FRONT_ROOT . "Chat/sendMessage"?>" method="post" enctype="multipart/form-data">
        <div class="footer-chat">
          <input type="texto" class="write-message" placeholder="Escriba aqui" name="message"></input>
          <input type="hidden" value="<?php echo $user?>" name="user" >
          <input type="hidden" value="<?php echo $idReserve?>" name="id_reserve" >
          <td><button class="btn_check btn_send" title="send" type="submit"> </button></td>
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
