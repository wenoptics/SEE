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
.ui-coverflow-wrapper{
    height: 540px;
    margin-top: -50px;
    margin-bottom: -50px;
    width: 135%;
    left: -18%;
    border: 1px solid black;
}
.ui-state-active{
    border:0px;
}
#basics {
    transform: scale(.75,.75);
}
img.flowingImg {
    max-height: 540px;
}
.setpreview>img {
    max-height: 100px;
    display: block;
    margin:auto;
}
</style>
<div id="prevSet" class="setpreview"<>
    <img setname="nausicaa" src="sets/nausicaa/images/0.jpg"></img>
</div>
<div id="basics">
	<div id="coverflow">
	</div>
</div>
<div id="nextSet" class="setpreview">
    <img setname="dune" src="sets/dune/images/0.jpg"></img>
</div>
<script
  src="https://code.jquery.com/jquery-2.1.3.js"
  integrity="sha256-goy7ystDD5xbXSf+kwL4eV6zOPJCEBD1FBiCElIm+U8="
  crossorigin="anonymous"></script>
<script src="resources/coverflow.min.js"></script>
<script>
    var coverflowSettings =
    {
        active: 16, angle: 10, scale: .5,
        select: function(event, ui){
            var scale = $(".ui-state-active").attr("scale");
            var set1 = $("#prevSet>img").attr("setname");
            var set2 = $("#nextSet>img").attr("setname");

            if(datasets2[set1].start <= scale && datasets2[set1].end >= scale){
                var newSrc = datasets2[set1]["images"][ Math.abs(datasets2[set1].start - scale) ];
                $("#prevSet>img").prop("src", newSrc);
            }
            else{
                $("#prevSet>img").prop("src", "resources/images/300x100.png");
            }
            if(datasets2[set2].start <= scale && datasets2[set2].end >= scale){
                var newSrc = datasets2[set2]["images"][ Math.abs(datasets2[set2].start - scale) ];
                $("#nextSet>img").prop("src", newSrc);
            }
            else{
                $("#nextSet>img").prop("src", "resources/images/300x100.png");
            }
        }
    }
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
        var img= new Image();
        img.src = datasets2[set]["images"][0];
        img.setVal = set;
        img.onload = function(){
            datasets2[this.setVal]["placeholder"] = "https://placehold.it/" + this.width +"x"+ this.height;
            console.log(datasets2[this.setVal]["placeholder"]);
        }

    }

    var populate = function(setName){
        var initVal = datasets2[setName]["start"];
        for(var i = initVal; i <= datasets2[setName]["end"] ; i++){
            $( "<img class='flowingImg' scale='" + i + "' setname='" + setName + "'src=" + datasets2[setName]["images"][i - (initVal < 0 ? initVal : 0)] +" />" ).appendTo( "#coverflow" );
        }

    }
    $(function(){
        populate("powers");
    });

    $(window).load(function() {
        $('#coverflow').coverflow(coverflowSettings);
        $('#coverflow img').click(function() {
            if( ! $(this).hasClass('ui-state-active')){
                return;
            }
            $('#coverflow').coverflow('next');
        });

    });
    $(".setpreview>img").click(function() {

        var idSet = $(this).parent().prop("id");
        var setName = $(this).attr("setname");
        var scale = $(".ui-state-active").attr("scale");
        var oldSetName = $(".ui-state-active").attr("setname");
        console.log(oldSetName + "|");
        var keyArray = Object.keys(datasets2);
        var centerPoint = keyArray.indexOf(oldSetName);

        $(".flowingImg").each(function() {
            var scale = $(this).attr("scale");
            if(datasets2[setName].start <= scale && datasets2[setName].end >= scale){
                var newSrc = datasets2[setName]["images"][ Math.abs(datasets2[setName].start - scale) ];
                $(this).prop("src", newSrc);
            }
            else {
                $(this).prop("src", datasets2[setName].placeholder);
            }

            $('#coverflow').coverflow(coverflowSettings);
            $(this).attr("setname", setName);
        });
        $('#coverflow' ).coverflow( 'select', $("img[scale="+ scale + "]"));
        if(idSet == "prevSet"){
            console.log(keyArray + "|" + centerPoint);
            var newPrevSet = centerPoint > 0 ? keyArray[centerPoint -1] : keyArray[keyArray.length-1];
            var newNextSet = keyArray[(centerPoint+1) % keyArray.length];
            console.log()
            console.log( newPrevSet + "|" + (centerPoint+1) % keyArray.length );
            var newPrevSrc = datasets2[newPrevSet]["images"][ Math.abs(datasets2[newPrevSet].start - scale) ];
            var newNextSrc = datasets2[newNextSet]["images"][ Math.abs(datasets2[newNextSet].start - scale) ];
            $("#prevSet>img").attr("setName", newPrevSet);
            $("#prevSet>img").attr("src", newPrevSrc);
            $("#nextSet>img").attr("setName", newNextSet);
            $("#nextSet>img").attr("src", newNextSrc);
        }
        else {
            var newPrevSet = centerPoint > 0 ? keyArray[centerPoint -1] : keyArray[keyArray.length-1];
            var newNextSet = keyArray[(centerPoint+1) % keyArray.length];
            var newPrevSrc = datasets2[newPrevSet]["images"][ Math.abs(datasets2[newPrevSet].start - scale) ];
            var newNextSrc = datasets2[newNextSet]["images"][ Math.abs(datasets2[newNextSet].start - scale) ];
            $("#prevSet>img").attr("setName", newPrevSet);
            $("#prevSet>img").attr("src", newPrevSrc);
            $("#nextSet>img").attr("setName", newNextSet);
            $("#nextSet>img").attr("src", newNextSrc);
        }
    });


</script>

</html>
