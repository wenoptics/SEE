<?php
    session_start();
    $link = mysql_connect('zachhorton.netfirmsmysql.com', 'scalar2', 'Scale42!');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    mysql_select_db("scale_explorer", $link);

    if (key_exists("password", $_POST) and
    	$_POST["password"] != "scalar") {
            $_SESSION['error'][] = "Wrong Password";
            header("Location: setuploader.php");
            die();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (key_exists("setName", $_POST) and $_POST["setName"] != '' ){
            if(!file_exists("sets/" . $_POST["setName"])){
                mkdir("sets/" . $_POST["setName"]);
                mkdir("sets/" . $_POST["setName"] . "/" . "images");
                $sql = "INSERT into ecosystems(name) VALUES(\"$_POST[setName]\")";
                $result = mysql_query($sql);
            }
            else{
                $_SESSION['error'][] = "That set already exists";
                header("Location: setuploader.php");
                die();
            }
        }
        else{
            $_SESSION['error'][] = "We need a set name.";
            header("Location: setuploader.php");
            die();
        }
    }

   foreach($_FILES as $key => $image){
      $index = str_replace("image", "", $key);
      $powerName = "power" . $index;
      $newFileName = $_POST[$powerName];

      $file_name = $image['name'];
      $file_size = $image['size'];
      $file_tmp = $image['tmp_name'];
      $file_type = $image['type'];
      $file_ext=strtolower(end(explode('.',$image['name'])));

      $extensions= array("jpeg","jpg");

      if(in_array($file_ext,$extensions)=== false){
         $_SESSION['error'][]="extension not allowed, please submit only JPG files.";
      }

      if($file_size > 2097152) {
         $_SESSION['error'][]='File size must be smaller than 2 MB';
      }

      if(empty($_SESSION['error'])==true) {
         $newLoc = "sets/".$_POST["setName"] . "/images/" . $newFileName . "." . $file_ext;
         move_uploaded_file($file_tmp, $newLoc);
         $sql = "Select * from ecosystems where name = \"" . $_POST["setName"] . "\"";
         $result = mysql_query($sql);
         echo "Error 1:" . mysql_error();
         $row = mysql_fetch_assoc($result);
         echo "Row: |";
         print_r($row);
         $ecoID = $row["ecoID"];
         echo "ID: |  $ecoID |";
         $sql = "INSERT into images(imageLocation, ecoIDFK) VALUES(\"$newLoc\",  $ecoID)";
         $result = mysql_query($sql);
         echo mysql_error();
      }
   }
?>
<html>
    <style>
    .container-outer {
        overflow: scroll;
        width: 500px;
        height: 50px;
    }
    .container-inner {
        width: 10000px;
        display: flex;        /* Flex layout so items have equal height  */
        flex-flow: row;
    }
    .filePicker{
        display: flex;
        flex-flow: column;
    }
    </style>
   <body>

      <form action = "" method = "POST" enctype = "multipart/form-data">
        <input id="numImages" type = "text" name = "count" placeholder="Set Image Count"></input>
        <input id="setName" type = "text" name = "setName" placeholder="Set Name" required></input>
        <input id="password" type = "password" name = "password" placeholder="Password ('scalar')"></input>
         <div class="container-outer">
             <div class="container-inner">
                 <!-- Your images over here -->
             </div>
         </div>

         <input type = "submit"/>

         <ul>
            <?php print_r( $_SESSION['error']);
            $_SESSION['error'] = array();
            ?>
         </ul>

      </form>

   </body>
   <script
     src="https://code.jquery.com/jquery-2.1.3.js"
     integrity="sha256-goy7ystDD5xbXSf+kwL4eV6zOPJCEBD1FBiCElIm+U8="
     crossorigin="anonymous">
   </script>

   <script id = "imageSelector" type="text/plain">
    <div class = 'filePicker'>
        <input  type = 'file' required/>
        <input  type = 'number' placeholder="Power of Ten (-1, 0, 1, 2... )" required/>
    </div>
   </script>

   <script>
   console.log($("#imageSelector").html());
        $("#numImages").keyup(function(){
            var count = parseInt( $(this).val());
            if(!isNaN(count)){
                var curCount = $(".filePicker").length
                for( var i = curCount; i < count; i++){
                    $(".container-inner").append($("#imageSelector").html());
                    $(".filePicker:last>:first-child").attr("name", "image"+parseInt(i));
                    $(".filePicker:last>:last-child").attr("name", "power"+parseInt(i));
                }
                for( var i = 0; i < curCount-count; i++){
                    $(".filePicker:last").remove();
                }

            }
        }
        );
   </script>
</html>
