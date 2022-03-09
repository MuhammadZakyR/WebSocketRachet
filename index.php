<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 5px; padding-top: 0;">Chat Application</h2>
        <h3 class="text-center" style="margin-top: 5px; padding-top: 0;">Form Login</h3>
        <hr>
        <?php
            if(isset($_POST['join']))
            // Update Data Users
            {
                date_default_timezone_set('Asia/Jakarta');
                session_start();
                
                require("db/users.php");

                $objUser = new users;
                $objUser->setEmail($_POST['email']);
                $objUser->setName($_POST['username']);
                $objUser->setLoginStatus(1);
                $objUser->setLastLogin(date('Y-m-d h:i:s'));
                $userData = $objUser->getUserByEmail();

                if(is_array($userData) && count($userData)>0)
                {
                    // Notifikasi Login
                    $objUser->setId($userData['id']);
                    if($objUser->updateLoginStatus())
                    {
                        echo "User Berhasil Login";
                        $_SESSION['user'][$userData['id']] = $userData;
                        header("location: chatroom.php");
                    }
                    else
                    {
                        echo "User Gagal Login";
                    }
                } else 
                {
                    // Notifikasi Register
                    if($objUser->save())
                    {
                        $lastId = $objUser->dbConn->lastInsertId();
                        $objUser->setId($lastId);
                        $_SESSION['user'][$userData['id']] = (array) $objUser;
                        echo "User Berhasil Terdaftar";
                        header("location: chatroom.php");
                    }
                    else
                    {
                        echo "User Gagal Terdaftar";
                    }
                }
                
            }
        ?>
        <div class="row join-room">
            <div class="col-md-6 col-md-offset-3">
                <!-- FORM LOGIN -->
                <form id="join-room-frm" role="form" method="post" action="" class="form-horizontal">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon addon-dif-color">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <!-- LABEL USERNAME -->
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon addon-diff-color">
                            <span class="glyphicon glyphicon-enveloper"></span>
                        </div>
                        <!-- LABEL EMAIL -->
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="">
                    </div>
                </div>
                <div class="form-group">
                    <!-- LABEL BUTTON SUBMIT -->
                    <input type="submit" value="JOIN CHATROOM" class="btn btn-succes btn-block" id="join" name="join">
                </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>