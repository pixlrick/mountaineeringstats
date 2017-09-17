<div id="commentForm<?php echo $actid; ?>" class="commentForm">
  <textarea class="commentBox" id="comment<?php echo $actid; ?>" placeholder="Kommentar schreiben" rows="1"></textarea>
  <button type="button" onclick="postComment(<?php echo $actid; ?>)">Kommentieren</button>
</div>
<script>
  function postComment(actid){
    var commentText=document.getElementById("comment"+actid).value;
    /***
    *check wether the textbox is empty
    *.trim is needed in case a user only entered spaces, which should not be posted
    ***/
    if(jQuery.trim(commentText).length>0){
      var username='<?php 
        $id=$_SESSION['id'];
        $sql="SELECT * FROM users WHERE id='$id'";
        $result=$conn->query($sql);
        $rowUser=$result->fetch_assoc();
        $usernam=$rowUser['username'];
        echo $username; 
      ?>';
      console.log(actid);
      console.log(commentText);
      console.log('<?php echo $_SESSION['id']; ?>');
      $.ajax({
        type: 'post',
        url: 'includes/comment.inc.php',
        datatype: 'json',
        data: {
          id: '<?php echo $_SESSION['id']; ?>',
          actid: actid,
          commentText: commentText
        },
        complete: function(){
          //display comment
          $("#comments"+actid).append("<div id='commentLine'><p class='comment'><b>"+username+"</b> "+commentText);
          //clear textbox
          document.getElementById("comment"+actid).value="";
        },
      });
    }
    return false;
  }
</script>
