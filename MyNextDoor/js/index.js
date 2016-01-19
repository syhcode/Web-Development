$(document).ready(function(){
    $("#search_start").click(function(){
        $("#search_form").submit();
    });

    $("#friend_feeds").click(function(){
        window.location.replace("./friend-feeds.php");
    });

    $("#neighbor_feeds").click(function(){
        window.location.replace("./neighbor-feeds.php");
    });

    $("#block_feeds").click(function(){
        window.location.replace("./block-feeds.php");
    });

    $("#hood_feeds").click(function(){
        window.location.replace("./hood-feeds.php");
    });

    $("#new_message").click(function(){
        window.location.replace("./new-messages.php");
    });
});
