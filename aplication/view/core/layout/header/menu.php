<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style>
                body {
                    margin: 0;
                }

                .topnav {
                    display: table;
                    text-align: center;
                    width: 100%;

                    overflow: hidden;
                    background-color: black;
                }

                .topnav a {
                    color: #f2f2f2;
                    display: inline-block;
                    float: none;
                    font-size: 25px;
                    padding: 10px 30px;
                    text-decoration: none;
                    font-weight: bold;
                }

                .topnav a:hover {
                    color: black;
                }

                #logoutbutton{
                    background-color: black;
                }
                

            </style>
        </head>
        <body>

        <div class="topnav">
            <?php

            $fileList = glob('Controller/*.php');
            foreach($fileList as $filename){
                if(is_file($filename)){
                    $file = explode("/", $filename);
                    //print_r($file);
                    $fileList = explode(".",$file[1]); ?>
                    <a href="index.php?c=<?php echo strtolower($fileList[0]); ?>&a=grid"><?php echo $fileList[0]; ?></a>
                    <?php
                }   
            }
        ?>
        <button id="logoutbutton"><a href="index.php?c=admin_login&a=logout">Logout</a></button>
        </div>

    </body>
</html>
