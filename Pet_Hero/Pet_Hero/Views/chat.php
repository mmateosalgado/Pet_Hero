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
          <p class="name">Megan Leib</p><!--TODO: Aca va nomrbe -->
          <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
        </div>
        <div class="messages-chat"> <!-- ********************************** aca arranca el chat ***************************************** -->
          
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
        <div class="footer-chat">

          <input type="texto" class="write-message" placeholder="Escriba aqui"></input>
          
          <form action="<?php echo FRONT_ROOT . "Guardian/viewReview"?>" method="post" enctype="multipart/form-data">
            <td><button class="btn_check btn_send" name="send" title="send" value="<?php echo "" ?>"> </button></td>
            </form>
        
        </div>
      </section>
    </div>
  </div>
</body><body>
  

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>