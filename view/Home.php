    <?php
    require_once('Header.php');
    ?>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">

          <div class="masthead clearfix">
           <div class="inner">
            <?php
            if(!empty($this->result[0])) {
              ?>
            <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
             <?php
             $act='active'; 
              foreach ($this->result[0] as $pop_message) {
            ?>
              <div class="<?=$act?> item">
                <h3><?=$pop_message['new.message']?></h3>
                <p><?=$pop_message['new.name']?> от <?=$pop_message['new.date']?></p>
                <p><a href="/message/<?=$pop_message['new.mess_id']?>" class="btn btn-primary btn-md active">читать полность, комментарий (<?=$pop_message['quan_comm']?>) </a></p>
              </div>
              <?php
              $act='';
              } ?>
            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
          </div>
            <?php } ?>

            </div>
          </div>

          <div class="blog-post">
            <h2 class="blog-post-title">Добавить сообщение</h2>
            <form action="/home/add" method="POST">
              <div class="form-group">
                <label>Сообщение</label>
                <textarea placeholder="Message" name="message" class="grey-style form-control" rows="3"></textarea>
              </div>
               <div class="form-group">
                <label for="exampleInputName">Автор</label>
                <input type="text" name="author" class="grey-style form-control" id="exampleInputName" placeholder="Author">
              </div>
              <button type="submit" class="btn btn-primary"">Отправить</button>
            </form>
             <?php
            if(!empty($this->result[1])) {
              foreach ($this->result[1] as $date_message) {
            ?>
             <div class="text-left padd-tp">
              <p class="size-19"><?=$date_message['new.message']?></p> 
              <p class="text-muted"><?=$date_message['new.name']?> от <?=$date_message['new.date']?></p>
              <p><a href="/message/<?=$date_message['new.mess_id']?>"> читать полность, комментарий (<?=$date_message['quan_comm']?>)</a></p>
            </div>
              <?php 
              }
            } ?>
          </div>
        </div>
      </div>
    </div>
  <?php
    require_once('Footer.php');
  ?>