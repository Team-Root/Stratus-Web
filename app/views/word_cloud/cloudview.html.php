<script>
    // Scroll to center of word cloud
    $("html, body").animate({ scrollTop: ((<?=$cloud->height;?> / 2) - ($(document).height() / 2)) }, { duration: 500, queue: false });
    $("html, body").animate({ scrollLeft: ((<?=$cloud->width;?> / 2) - ($(document).width() / 2))}, { duration: 500, queue: false } );
</script>

<div id="cloud" style="width: <?=$cloud->width;?>px; height: <?=$cloud->height;?>px; overflow: scroll;">

    <div id="topBar">
        <a href="/" class="waves-effect waves-light btn orange"><i class="mdi-navigation-arrow-back"></i></a> &nbsp
        <a class="waves-effect dropdown-button waves-light btn blue" data-activates='dropdown-share'> <i class="mdi-social-share"></i> </a> &nbsp
        <a href="/WordCloud/listview/<?=$cloud->cloudid;?>" class="waves-effect waves-light btn green">View Word List</a> <br>
        <h5 class="grey-text" style="margin-top: 30px;">CLOUDID</h5>
        <h1 style="margin-top: 0px;"><?=$cloud->cloudid;?></h1>
        <p>Created <?=date("F j, Y, g:i a", strtotime($cloud->timestamp));?></p>

        <!-- Share Dropdown -->
        <ul id='dropdown-share' class='dropdown-content' style="z-index: 1; margin-top: 50px;">
            <li><a target="_blank" href="http://www.facebook.com/sharer/sharer.php?u=#http://voicecloudapp.com/WordCloud/cloudview/<?=$cloud->cloudid;?>">Facebook</a></li>
            <li><a target="_blank" href="https://twitter.com/home?status=I just made a word cloud! http://voicecloudapp.com/WordCloud/cloudview/<?=$cloud->cloudid;?>">Twitter</a></li>
        </ul>

    </div>

    <?php foreach($words as $word) {

        // If we have an unpositioned word
        if ($word->top == 0 & $word->left == 0) { }

        $width = $word->right - $word->left;
        $height = $word->bottom - $word->top;

        $color = "blue";
        if ($word->count >= 5) $color = "green";
        if ($word->count >= 10) $color = "yellow";
        if ($word->count >= 15) $color = "red";
    ?>

            <!-- Word Button -->
            <div id="<?=$word->wordid;?>" style="position: absolute; width: <?=$width;?>px; height: <?=$height;?>px; top: <?=$word->top;?>px; left: <?=$word->left;?>px;">
                <button class="word btn dropdown-button waves-effect waves-light <?=$color;?>" data-activates='dropdown<?=$word->wordid;?>'><b><?=$word->name;?></b></button>
            </div>

            <!-- Word Dropdown -->
            <ul id='dropdown<?=$word->wordid;?>' class='dropdown-content' style="z-index: <?=$word->wordid;?>; margin-top: 30px; margin-left: 30px">
                <li><a><b>"<?=$word->name;?>"</b></a></li>
                <li class="divider"></li>
                <li><a>Count: <?=$word->count;?></a></li>
                <li class="divider"></li>
                <li><a target="_blank" href="https://google.com/#q=<?=$word->name;?>">Google</a></li>
                <li><a target="_blank" href="http://wikipedia.org/wiki/<?=$word->name;?>">Wikipedia</a></li>
                <li><a target="_blank" href="http://dictionary.reference.com/browse/<?=$word->name;?>">Define</a></li>
                <li class="divider"></li>
                <li><a href="/WordCloud/removeWord/<?=$word->wordid;?>">Remove</a></li>
            </ul>

    <?php } ?>

</div>