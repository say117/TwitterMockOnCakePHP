<div id="side">
<?php
if ($user) {
  echo "<h2>User Data</h2>";
  echo $this->Html->image('/icons/'. $user['username'] .'.jpg', 
    array('alt' =>'icon', 'width' => 64, 'height' => 64));
  echo "<h3>" . $user['username'] . "</h3>";
  echo $this->Html->link('Edit', '/users/edit') . "<br>";
  echo $this->Html->link('Sign out', '/users/logout') . "<br>";
?>
<form id="bweet-form" method="POST">
  <textarea id="bweet-description" class="required"></textarea><br>
  <input type="submit" value="submit"/>
</form>

<?php
} else {
  echo $this->Html->link('Sign up', '/users/add') . "<br>";
  echo $this->Html->link('Sign in', '/users/login') . "<br>";
}
?>
</div>
<div id="main">
<h2>Bweets List</h2>
<div id="bweets">
<?php foreach ($bweets as $bweet) : ?>
  <fieldset>
    <legend>
      <?php 
            echo $this->Html->image('/icons/'. $bweet['User']['username'] .'.jpg', 
                array('alt' =>'icon', 'width' => 24, 'height' => 24));
            echo h($bweet['User']['username']); 
      ?>
    </legend>
    <p><?php echo h($bweet['Bweet']['description']); ?></p>
    <h6><?php echo h($bweet['Bweet']['created']); ?></h6>
  </fieldset>
  <hr>
<?php endforeach; ?>
</div>
<br>
<input type="button" value="More Show 10 Bweets" id="more-show"/>
</div>

  <script src="./js/jquery.validate.min.js"></script>
  <script type="text/javascript">
  $(function() {
    setTimeout(function() {
      $('#flashMessage').fadeOut('slow');
    }, 2000);
  });  
  $(function() {
     $("#bweet-form").validate({});
  });
  </script>
  <script type="text/javascript">
  $("#more-show").click(function(){
     $.ajax({
         url:"bweets/moreShow",
         type:"get",
         dataType:"html",
         success:function(data, status, xhr){
           data == "" ? alert("Bweetは全て表示されました。") : $("#bweets").append(data);
         },
         error: function(data, status, xhr) {
          alert('error!');
         }
     });
  });

  $("#bweet-form").submit(function(){
    if (!$("#bweet-form").valid()) {
        return false;
    }
     // HTMLでの送信をキャンセル
     event.preventDefault();
     var data = {"description": $("#bweet-description").val()};
     $.ajax({
         url:"bweets/add",
         data: data,
         type:"post",
         dataType:"html",
         success:function(data, status, xhr) {
           $("#bweets").prepend(data);
           $("#bweet-description").val("");
           $("#bweet-description").focus();
         },
         error: function(data, status, xhr) {
          alert('error!');
         }
     });
  });
  </script>