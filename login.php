<?php
    session_start();
    include('server/connection.php');

    if(isset($_SESSION['logged_in'])){
        header('location: welcome.php');
        exit;
    }

    if (isset($_POST['login_btn'])){
        $email = $_POST['user_email'];
        $password = ($_POST['user_password']);

        $query = "SELECT user_id, user_name, user_email, user_password, user_phone, user_address, user_city, user_photo, user_nrp, user_kelas from user where user_email = ? and user_password = ? limit 1";

        $stmt_login = $conn->prepare($query);
        $stmt_login->bind_param('ss', $email, $password);

        if($stmt_login->execute()){
            $stmt_login->bind_result($user_id, $user_name, $user_email, $user_password, $user_phone, $user_address, $user_city, $user_photo, $user_nrp, $user_kelas);
            $stmt_login->store_result();
            
            if($stmt_login->num_rows() == 1){
                $stmt_login->fetch();

                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['user_email'] = $user_email;
                $_SESSION['user_password'] = $user_password;
                $_SESSION['user_phone'] = $user_phone;
                $_SESSION['user_address'] = $user_address;
                $_SESSION['user_city'] = $user_city;
                $_SESSION['user_photo'] = $user_photo;
                $_SESSION['user_nrp'] = $user_nrp;
                $_SESSION['user_kelas'] = $user_kelas;
                $_SESSION['logged_in'] = true;

                header('location: welcome.php?message=Logged in Succesfully');
            } else{
                header('location: login.php?message=Error could not verify your account');
            }
        }else{
            header('location: login.php?error=something went wrong');
        }

    }
?>

<section align="center">
    <div>
        <div>
            <form id="login-form" method="POST" action="login.php">
                <?php if (isset($_GET['error'])) {?>
                    <div role="allert">
                        <?php
                            if (isset($_GET['error'])){
                                echo $_GET['error'];
                            } ?>
                    </div>
                <?php } ?>
                <div>
                    <div>
                        <h2>Login</h2>
                        <div>
                            <p>Email</p>
                            <input type="email" name= "user_email">
                        </div>
                        <div>
                            <p>Password</p>
                            <input type="password" name= "user_password">
                        </div>
                        <div>
                            <input type="submit" class="site-btn" id="login-btn"
                            name="login_btn" value="LOGIN" style="margin-top: 5mm;">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
