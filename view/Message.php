 <?php
  require_once('Header.php');
 ?>
    <div class="site-wrapper">
      <div class="site-wrapper-inner">
        <div class="cover-container">

          <div class="masthead padd-tp40 clearfix">
          <a href="/" class="text-center">НА ГЛАВНУЮ</a>
           <div class="inner">
             <p class="text-left lead"><?=$this->result[0]['message']?></p>
             <p class="text-left"><?=$this->result[0]['name']?> от <?=$this->result[0]['date']?></p>
            </div>
          </div>

          <div class="blog-post">
            <h2 class="blog-post-title">Добавить комментарий</h2>

            <form action="/message/add" method="POST">
              <div class="form-group">
                <label>Комментарий</label>
                <textarea name="comment" placeholder="Comment" class="grey-style form-control" rows="3"></textarea>
              </div>
               <div class="form-group">
                <label for="exampleInputName">Автор</label>
                <input type="text" name="user" class="grey-style form-control" id="exampleInputName" placeholder="Author">
              </div>
              <input type="hidden" name="mess_id" value="<?=$this->result[0]['mess_id']?>">
              <button type="submit" class="btn btn-primary">Добавить</button>
            </form>

            <?php
            if(!empty($this->result[1])) {
              foreach ($this->result[1] as $comm) {
            ?>
            <div class="text-left padd-tp">
              <p class="size-19"><?=$comm['message']?></p> 
              <p class="text-muted"><?=$comm['name']?> от <?=$comm['date']?></p>
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