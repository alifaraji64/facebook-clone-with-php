var userLoggedIn = '<?php echo $userLoggedIn?>';
$(document).ready(function(){
    $('#spinner').show();
    var page = 1;
    //ajax request for loading first post
    $.ajax({
        url:"includes/_ajax_load_posts.php",
        type:"POST",
        data:`page=${page}&userLoggedIn= ${userLoggedIn}`,
        cache:false,
        success:function(data){
            $('#spinner').hide();
            $('#posts_area').html(data);
        }
    })
    $(window).scroll(function(){
        var height = $('#posts_area').height();
        var scroll_top = $(this).scrollTop();
        var navHeight = $('#nav').height();
        var noMorePosts = $('#posts_area').find('.noMorePosts').val();
        if(($(window).scrollTop() + $(window).height() > $(document).height() - 1)) {
            $('#spinner').show();
            console.log('bottom');
            page++;
            $.ajax({
                url:'includes/_ajax_load_posts.php',
                type:"POST",
                data:`page=${page}&userLoggedIn=${userLoggedIn}`,
                cache:false,
                success:function(response){
                    $('#spinner').hide();
                    $('#posts_area').append(response);
                }
            })
        }//end if
        return false;
    })
});