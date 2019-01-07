<?php
    $link = mysql_connect('zachhorton.netfirmsmysql.com', 'scalar2', 'Scale42!');
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    mysql_select_db("scale_explorer", $link);
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
    $setJson = str_replace("\\", "", json_encode($datasets));
?>
<html>
 <link rel="stylesheet" type="text/css" href="resources/coverflow.css">
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
 #centerDiv {
    position: absolute;
    left:0; right:0;
    top:0; bottom:0;
    margin:auto;
    max-width: 75%;
    max-height: 75%;
    display: flex;
    flex-flow: row;
}
.switcher {
    display: flex;
    height:100%;
    flex: 0 0 5%;
    background-color: #555;
}
.switcher:hover {
    background-color: #222;
}
.switcher:hover > .arrow-right  {
      border-left: 25px solid  #555;
}
.switcher:hover > .arrow-left  {
      border-right: 25px solid  #555;
}
#left {
}
#right {
}
#centerPic {
    height: 100%;
    width: 80%;
}

.arrow-right {
  width: 0;
  height: 0;
  border-top: 25px solid transparent;
  border-bottom: 25px solid transparent;
  border-left: 25px solid black;
  left:0; right:0;
  top:0; bottom:0;
  margin:auto;
}

.arrow-left {
  width: 0;
  height: 0;
  border-top: 25px solid transparent;
  border-bottom: 25px solid transparent;
  border-right: 25px solid black;
  left:0; right:0;
  top:0; bottom:0;
  margin:auto;
}
</style>

    <select id="ecoPicker">
    </select>
    <div id="centerDiv">
        <div class="switcher" id="left">
            <div class="arrow-left"></div>
        </div>
        <img id="centerPic"/>
        <div class="switcher" id="right">
            <div class="arrow-right"></div>
        </div>
        <div class="container-outer">
            <div class="container-inner">
                <!-- Your images over here -->
            </div>
        </div>
    </div>


<script
  src="https://code.jquery.com/jquery-2.1.3.js"
  integrity="sha256-goy7ystDD5xbXSf+kwL4eV6zOPJCEBD1FBiCElIm+U8="
  crossorigin="anonymous"></script>
<script src="resources/coverflow.min.js"></script>
<script>
    var datasets2 = <?php echo $setJson ?>;
    for(var set in datasets2){
        if (!datasets2.hasOwnProperty(set)) {
            continue;
        }
        var initVal = datasets2[set]["images"][0];
        initVal = initVal.split("/");
        datasets2[set]["start"] = parseInt(initVal[initVal.length-1].split("."));
        var lastVal = datasets2[set]["images"][datasets2[set]["images"].length-1];
        lastVal = lastVal.split("/");
        datasets2[set]["end"] = parseInt(lastVal[lastVal.length-1].split("."));
        $("#ecoPicker").append("<option value='" + set + "'>" + set + "</option>");
        datasets2[set]["offset"] = Math.abs(0 - datasets2[set]["start"]);
    }

    var changeImage = function( setName, index ){
        $("#centerPic").attr("src",datasets2[setName]["images"][index]);
        $("#centerPic").attr("set", setName);
        $("#centerPic").attr("index", index);
    }

    $(function(){
        var imgArray = datasets2[$("#ecoPicker").val()]["images"];
        changeImage($("#ecoPicker").val(), Math.floor(imgArray.length/2));
        $("#ecoPicker").change(function(){
            changeImage($("#ecoPicker").val(),
                Math.floor(datasets2[$("#ecoPicker").val()]["images"].length/2));
        });
        $(".switcher").click(function(){
            var oldIndex = parseInt($("#centerPic").attr("index"));
            var newIndex;
            var setData = datasets2[$("#ecoPicker").val()]
            if($(this).attr("id") == "right") {
                newIndex = oldIndex + 1;
            }
            if($(this).attr("id") == "left") {
                newIndex = oldIndex - 1;
            }
            console.log("New Index: " + newIndex + " | Old Index: " + oldIndex);
            console.log("Start: " + setData.start + + " | End: " + setData.end);
            if(newIndex > setData.end +setData.offset || newIndex < setData.start +setData.offset){
                $(this).animate(
                    {"background-color" : "red"}, 250, function(){
                        $(this).animate(
                            {"background-color" : " #333"}, 250);
                    }
                );
                return;
            }
            else{
                changeImage($("#ecoPicker").val(), newIndex);
            }
        });
    });

</script>

</html>
