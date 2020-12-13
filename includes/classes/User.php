<?php
    class User{
        private $user;
        private $con;


        public function __construct($con,$user)
        {
            $this->con = $con;
            $user_details_query = mysqli_query($this->con,"SELECT * FROM users WHERE username='$user'");
            $this->user = mysqli_fetch_assoc($user_details_query);
        }



        public function getUsername()
        {
            return $this->user['username'];
        }



        public function getNumPosts()
        {
            $username = $this->user['username'];
            $query = "SELECT num_posts FROM users WHERE username='$username'";
            $row = mysqli_fetch_assoc(mysqli_query($this->con,$query));
            return $row['num_posts'];
        }



        public function getFirstAndLastName()
        {
            return $this->user['first_name'] . '-' . $this->user['last_name'];
        }

        public function isClosed()
        {
            if($this->user['user_closed'] == 'yes')
                return true;
            else
                return false;
        }

        public function isFriend($username_to_check){
            $usernameComma = ',' . $username_to_check . ',';
            $res = strstr($this->user['friend_array'],$usernameComma);
            if($res || $username_to_check == $this->user['username'])
            {
                    //the respective person is our friend
                    return true;
            }
            else
            {
                return false;
            }
        }
    }