<?php 
    require_once(VIEWS_PATH."Section/header.php");
    include('Section/nav.php');
?>


<body>
  <div class="container">
    <div class="row">

      <section class="discussions">
       
        <div class="discussion message-active">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Megan Leib</p>
          </div>
          <div class="timer">12 sec</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">El bryan</p>
          </div>
          <div class="timer">3 min</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80);">
          </div>
          <div class="desc-contact">
            <p class="name">El risas</p>
          </div>
          <div class="timer">42 min</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://card.thomasdaubenton.com/img/photo.jpg);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">El billetes</p>
          </div>
          <div class="timer">2 hour</div>
        </div>

        <div class="discussion">
          <div class="photo" style="background-image: url(https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80);">
            <div class="online"></div>
          </div>
          <div class="desc-contact">
            <p class="name">Paul Walker</p>
          </div>
          <div class="timer">1 week</div>
        </div>
      </section>
      <section class="chat">
        <div class="header-chat">
          <i class="icon fa fa-user-o" aria-hidden="true"></i>
          <p class="name">Megan Leib</p>
          <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
        </div>
        <div class="messages-chat">
          
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
         
          
        
        </div>
        <div class="footer-chat">

          <input type="texto" class="write-message" placeholder="Escriba aqui"></input>
          
          <form action="<?php echo FRONT_ROOT . "Guardian/viewReview"?>" method="post" enctype="multipart/form-data">
            <td><button class="btn_calify btn_send" name="send" title="send" value="<?php echo "" ?>"> </button></td>
            </form>
        
        </div>
      </section>
    </div>
  </div>
</body><body>
  

<?php 	require_once(VIEWS_PATH."Section/footer.php"); ?>