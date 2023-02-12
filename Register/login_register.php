<?php 

require('connection.php');
session_start();




//for login
if(isset($_POST['login']))
{
    $querry="SELECT * FROM registered_users WHERE email = '$_POST[email_username]' OR username ='$_POST[email_username]'";
    $result=mysqli_query($con,$querry);

    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if(password_verify($_POST['password'],$result_fetch['password']))
            {
                #if password matched
                $_SESSION['logged_in'] =true;
                $_SESSION['username'] = $result_fetch['username'];
                header("location: index.php");
            }
            else
            {
                #if incorrect password
                echo"
                    <script>
                        alert('Incorrect password.');
                        window.location.href='index.php';
                    </script>
               ";  
            }
        }
        else
        {
            echo"
            <script>
                alert('Email or Username not registered with us.');
                window.location.href='index.php';
            </script>
        ";  
        }
    }
    else
    {
        echo"
            <script>
                alert('Cannot run query.');
                window.location.href='index.php';
            </script>
        ";  
    }
}



//check email and username already taken or not. And register.
if(isset($_POST['register']))
{
    $user_exist_query="SELECT * FROM registered_users WHERE username = '$_POST[username]'  OR email = '$_POST[email]'";
    $result=mysqli_query($con,$user_exist_query);


    if($result)
    {
        if(mysqli_num_rows($result)>0)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            if($result_fetch['username']==$_POST['username'])
            {
                echo"
                <script>
                  alert('$result_fetch[username] - This Username already taken.');
                  window.location.href='index.php';
                </script>
                ";
            }
            else
            {
                echo"
                 <script>
                    alert('$result_fetch[email] - This Email already registered.');
                    window.location.href='index.php';
                 </script>
                ";
            }
        }
        else //it will bw executed when no-one same user is registered before.
        {
            $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
            $query="INSERT INTO `registered_users`(`full_name`, `username`, `email`, `password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')";
            if(mysqli_query($con,$query))
            {
                echo"
                    <script>
                        alert('Registration successful.');
                        window.location.href='index.php';
                    </script>
                ";
            }
            else
            {
                echo"
                    <script>
                        alert('Cannot Run Query');
                        window.location.href='index.php';
                    </script>
                ";
            }
        }
    }
    else
    {
        echo"
        <script>
            alert('Cannot Run Query');
            window.location.href='index.php';
        </script>
        ";
    }
}


?>