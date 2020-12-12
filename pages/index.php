
<?php
    include('../includes/_header.php');
    include('../includes/classes/Post.php');
    $post_obj = new Post($conn,$userLoggedIn);
    if(isset($_POST['submit_post']))
    {
        $post_obj->submitPost($_POST['post_text'],$userLoggedIn);
    }
?>
    <div class="mx-auto  w-3/4 flex">
        <div id="user_details_box" class="w-1/4 bg-white flex items-center justify-around max-h-screen">
            <img src="<?php echo $user['profile_pic']?>" alt="">
            <div>
                <h3 class="text-blue-500 text-lg"><?php echo $_SESSION['username']?></h3>
                <h4>likes: <?php echo $user['num_likes']?></h4>
                <h4>Posts: <?php echo $user['num_posts']?></h4>
            </div>
        </div>
        <div class="w-3/4  flex justify-center bg-white ml-3 items-center flex-col pt-5">
            <form class="flex items-center" method="POST" action="index.php">
                <textarea name="post_text" placeholder="Got something to say" cols="40" rows="3" class="border-2 border-gray-400 mr-1"></textarea>
                <button type="submit" name="submit_post" class="bg-blue-500 text-white p-2 rounded-sm hover:bg-blue-600">Post</button>
            </form>
            <section id="posts_area" class='flex justify-center items-start w-full flex-col pl-4 mt-8 border-t-2 border-gray-500'>
                <!-- AREA FOR INSERTING POSTS -->
            </section>
            <img id='spinner' src="assets/icons/spinner.gif" alt="spinner" width="80">

        </div>
    </div>
    <script>
        var userLoggedIn = '<?php echo $userLoggedIn?>';
        $(document).ready(function(){
            $('#spinner').show();
            //ajax request for loading first post
            $.ajax({
                url:"includes/_ajax_load_posts.php",
                type:"POST",
                data:'page=1&userLoggedIn='+ userLoggedIn,
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
                console.log('yoo');
                //var page = $('#posts_area').find('.nextPage').val();
                //var noMorePosts = $('#posts_area').find('.noMorePosts').val();
                noMorePosts = 'false';
                if($(window).scrollTop() + $(window).height() > $(document).height() -0.5   ) {
                    console.log('bottom');
                    console.log($(window));
                    console.log($(document));
                }
            })
        });
    </script>
</body>
</html>