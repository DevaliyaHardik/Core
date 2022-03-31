
<div class="topnav">
    <?php

    $fileList = glob('Controller/*.php');
    foreach($fileList as $filename){
        if(is_file($filename)){
            $file = explode("/", $filename);
            //print_r($file);
            $fileList = explode(".",$file[1]); ?>
            <a href="index.php?c=<?php echo strtolower($fileList[0]); ?>&a=index"><?php echo $fileList[0]; ?></a>
            <?php
        }   
    }
?>
<button id="logoutbutton"><a href="index.php?c=admin_login&a=logout">Logout</a></button>
</div>