<?php
$link = mysql_connect('zachhorton.netfirmsmysql.com', 'scalar2', 'Scale42!');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
mysql_select_db("scale_explorer", $link);

?>
<html>
<title>test2</title>
<p>
    <?php
    echo mysql_get_server_info($link) . "\n";

    // for($i = -9; $i < 15; $i++){
    //     $sql = "INSERT into images(imageLocation, ecoIDFK) VALUES('sets/dune/images/" . $i .  ".jpg' , 3)";
    //     $result = mysql_query($sql);
    //     echo mysql_error();
    // }
    $sql = "SELECT * FROM ecosystems";
    $result = mysql_query($sql);
    $datasets = array();
    while($row = mysql_fetch_assoc($result)){
        $imageList = array();
        $sql = "SELECT imageLocation FROM images where ecoIDFK = " . $row["ecoID"] ;
        $innerResult = mysql_query($sql);
        while($innerRow = mysql_fetch_assoc($innerResult)){
            $imageList[] = $innerRow["imageLocation"];
        }
        $datasets[$row["name"]] = array("images" => $imageList );
    }
    echo str_replace("\\", "", json_encode($datasets));


    ?>
</html>
