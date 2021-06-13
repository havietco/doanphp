<?php
    @ob_start();
        session_start();
        require_once __DIR__. '/../lib/database.php';
        require_once __DIR__. '/../lib/function.php';

        if( isset($_SESSION['admin-id']))
        {
            redirect('admin/');
        }
        $db = new Database();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $username = postInput("user");
            $password = postInput("pass");
            $admin = $db->fetchOne("admin"," email = '".$username."' and password = '".md5($password)."' ");

            if($admin)
            {
                $_SESSION['admin-name'] = $admin['name'];
                $_SESSION['admin-id']   = $admin['id'];
                redirect('admin/');
            }
            $error = ' Đăng nhập thất bại ';
        }
?>

<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Log-in</title>
        <link rel='stylesheet prefetch' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
        <link rel="stylesheet" href="css/style.css">
        <style type="text/css">
            @import url(https://fonts.googleapis.com/css?family=Roboto:400,100);

            body {
              background: url(https://dl.dropboxusercontent.com/u/23299152/Wallpapers/wallpaper-22705.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
              font-family: 'Roboto', sans-serif;
            }

            .login-card {
              padding: 40px;
              width: 409px;
              background-color: #F7F7F7;
              margin: 0 auto 10px;
              border-radius: 2px;
              box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
              overflow: hidden;
            }

            .login-card h1 {
              font-weight: 100;
              text-align: center;
              font-size: 2.3em;
            }

            .login-card input[type=submit] {
              width: 100%;
              display: block;
              margin-bottom: 10px;
              position: relative;
            }

            .login-card input[type=text], input[type=password] {
              height: 44px;
              font-size: 16px;
              width: 100%;
              margin-bottom: 10px;
              -webkit-appearance: none;
              background: #fff;
              border: 1px solid #d9d9d9;
              border-top: 1px solid #c0c0c0;
              /* border-radius: 2px; */
              padding: 0 8px;
              box-sizing: border-box;
              -moz-box-sizing: border-box;
            }

            .login-card input[type=text]:hover, input[type=password]:hover {
              border: 1px solid #b9b9b9;
              border-top: 1px solid #a0a0a0;
              -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
              -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
              box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
            }

            .login {
              text-align: center;
              font-size: 14px;
              font-family: 'Arial', sans-serif;
              font-weight: 700;
              height: 36px;
              padding: 0 8px;
            /* border-radius: 3px; */
            /* -webkit-user-select: none;
              user-select: none; */
            }

            .login-submit {
              /* border: 1px solid #3079ed; */
              border: 0px;
              color: #fff;
              text-shadow: 0 1px rgba(0,0,0,0.1); 
              background-color: #4d90fe;
              /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
            }

            .login-submit:hover {
              /* border: 1px solid #2f5bb7; */
              border: 0px;
              text-shadow: 0 1px rgba(0,0,0,0.3);
              background-color: #357ae8;
              /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
            }

            .login-card a {
              text-decoration: none;
              color: #666;
              font-weight: 400;
              text-align: center;
              display: inline-block;
              opacity: 0.6;
              transition: opacity ease 0.5s;
            }

            .login-card a:hover {
              opacity: 1;
            }

            .login-help {
              width: 100%;
              text-align: center;
              font-size: 12px;
            }
            .login:hover { cursor: pointer !important; }
        </style>
    </head>
    <body>
        <div class="login-card">
            <h1> Đăng Nhập Hệ Thống </h1>
            <?php if( isset($error)) :?>
                <span style="color: red;text-align: center;display: block;"><?= $error ?></span>
             <?php endif ; ?>
            <br>
            <form action="" method="POST">
                <input type="text" name="user" placeholder="admin@gmail.com" required="">
                <input type="password" name="pass" placeholder="******" required="">
                <input type="submit" name="login" class="login login-submit" value="Đăng Nhập">
            </form>
    
        </div>
        <!-- <div id="error"><img src="https://dl.dropboxusercontent.com/u/23299152/Delete-icon.png" /> Your caps-lock is on.</div> -->
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    </body>
</html>