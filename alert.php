<?php

if(isset($_GET['message'])){
    if($_GET['message']=="successful"){

       echo '<div class="alert alert-primary alert-dismissible fade show" role="alert" id="messages">';
       echo 
       ' <strong>Data saved successfully!</strong>';
       echo '<button type="button" class="btn close" data-dismiss="alert" aria-label="Close">';
         echo '<span aria-hidden="true">&times;</span>';
         echo '</button>';
         echo '</div>';
}else{
    echo '<div class="alert alert-primary alert-dismissible fade hide" role="alert" id="messages">';
    echo 
    ' <strong>Data saved successfully!</strong>';
   echo '</div>';
}
     
}

    

?>