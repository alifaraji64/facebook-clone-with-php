<?php
    class Post{
        private $con;
        private $user_obj;

         public function __construct($con,$user)
         {
             $this->con = $con;
             $this->user_obj = new User($con,$user);
         }


         public function submitPost($body, $user_to)
         {
             $body = strip_tags($body);
             $body = mysqli_real_escape_string($this->con,$body);
             $length = strlen($body);
             if($length<6)
             {
                 echo 'your text is too short';
             }
             //text is long enough
             else
             {
                 $added_by = $this->user_obj->getUsername();
                 //if user is on own profile user_to is 'none'
                 if($user_to == $added_by)
                 {
                     $user_to = 'none';
                     //insert post
                     $date_added = date("Y-m-d H:i:s");
                     $user_closed = 'no';
                     $deleted = 'no';
                     $likes = '0';
                     $q1 = "INSERT INTO `posts` values('','$body','$added_by','$user_to','$date_added','$user_closed','$deleted','$likes')";
                     $insert_post_query = mysqli_query($this->con,$q1);

                     //inset notiication when user sends post to others

                     //update post count for user
                     $num_posts =  $this->user_obj->getNumPosts();
                     $num_posts++;
                     $q2 = "UPDATE users SET num_posts='$num_posts' WHERE username='$added_by'";
                     $update_query=mysqli_query($this->con,$q2);
                 }
             }
             header("Location: index.php");
             exit();
         }


         public function loadPostsFriends($data)
         {
             $page = $data['page'];
             if($page == 1 ) $limit =6;
             else $limit=4;

             $page_start = ($page - 1) * $limit;
             $str = '';//string to return
             $query = "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC LIMIT $page_start, $limit";
             $get_posts_query = mysqli_query($this->con,$query);
             while($row = mysqli_fetch_assoc($get_posts_query))
             {
                 $id = $row['id'];
                 $body = $row['body'];
                 $added_by = $row['added_by'];
                 $date_time = $row['date_added'];

                 //prepare user_to string so it can be included even if not posted to a user
                 if($row['user_to'] == 'none')
                 {
                     $user_to = '';
                 }
                 //user posted the post for others(not himself)
                 else
                 {
                     //new instance of user with the username of related person
                     $user_to_obj = new User($this->con, $row['user_to']);
                     $user_to_name = $user_to_obj->getFirstAndLastName();
                     $user_to = "to <a href = ".'$row["user_to"]'.">'$user_to_name'</a>";

                 }

                 //check if user who posted, has their account closed we are going to jump to next iteration
                 $added_by_obj = new User($this->con, $added_by);
                 if($added_by_obj->isClosed())
                 {
                     continue;
                 }
                 //create a new User instance just for checking if the username that we are iterating right now is a friend of the logged in user
                 $followed_by_obj = new User($this->con, $_SESSION['username']);
                 if($followed_by_obj->isFriend($added_by)){
                    //if user account is not closed we can fetch infos of that user from users table
                    $user_details_query = mysqli_query($this->con,"SELECT first_name,last_name,profile_pic FROM users WHERE username='$added_by'");
                    $user_row = mysqli_fetch_assoc($user_details_query);
                    $first_name = $user_row['first_name'];
                    $last_name = $user_row['last_name'];
                    $profile_pic = $user_row['profile_pic'];
                    ?>
                    <script>
                        function toggle<?php echo $id;?>(){
                            var element = document.getElementById('toggleComment<?php echo $id?>');
                            if(element.style.display == 'block') element.style.display='none';
                            else {element.style.display='block'}
                        }
                    </script>
                    <?php
                    //timeframe
                    $date_time_now = date("Y-m-d H:i:s");
                    $start_date = new DateTime($date_time);
                    $end_date = new DateTime($date_time_now);
                    $interval = $start_date->diff($end_date);
                    //older than a year
                    if($interval->y >= 1)
                    {
                        if($interval->y == 1)
                        {
                            $time_message = $interval->y . 'year ago';
                        }
                        else
                        {
                            $time_message = $interval->y . 'years ago';
                        }
                    }

                    //older than or equal to a month
                    else if($interval->m >=1)
                    {
                        if($interval->d == 0)
                        {
                            $days = ' ago';
                        }
                        else if($interval->d == 1)
                        {
                            $days = $interval->d . 'day ago';
                        }
                        else
                        {
                            $days = $interval->d . 'days ago';
                        }
                        if($interval->m == 1)
                        {
                            $time_message = $interval->m . 'month ago' . $days;
                        }
                        else
                        {
                            $time_message = $interval->m . 'months ago' . $days;
                        }
                    }

                    //older than a day
                    else if($interval->d >= 1)
                    {

                        if($interval->d == 1)
                        {
                            $time_message = 'yesterday';
                        }
                        else
                        {
                            $time_message = $interval->d . 'days ago';
                        }
                    }

                    //older than an hour
                    else if($interval->h >= 1)
                    {
                        if($interval->h == 1)
                        {
                            $time_message = $interval->h . 'hour ago';
                        }
                        else
                        {
                            $time_message = $interval->h . 'hours ago';
                        }
                    }
                    else if($interval->i < 59){
                        $time_message = 'a few minutes ago';
                    }
                    $str .=
                    "<div class='my-4' onClick='toggle$id()'>
                        <div>
                            <img src='$profile_pic' width='50'/>
                        </div>
                        <div class='text-blue-400'>
                            <a href='$added_by'>$first_name $last_name</a> $user_to &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp $time_message
                        </div>
                        <div id='$id'>
                            $body <br/>
                        </div>
                    </div>
                    <div id='toggleComment$id' class='hidden'>
                        <iframe src='./includes/_comment_frame.php?post_id=$id'></iframe>
                    </div>
                    "
                    ;
                    //when we are opening an iframe for each post we are making a GET request to that URL
                }
            }
            echo $str;
         }

    }
?>