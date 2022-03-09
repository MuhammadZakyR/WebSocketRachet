<?php
    session_start();
    if(isset($_POST['action']) && $_POST['action'] == 'leave')
    {
        require("db/users.php");
        $objUser = new users;
        $objUser->setLoginStatus(0);
        $objUser->setLastLogin(date('Y-m-d h:i:s A'));
        $objUser->setId($_POST['userId']);
        // FUNGSI UNTUK MEMBUAT USER OFFLINE
        if($objUser->updateLoginStatus())
        {
            unset($_SESSION['user']);
            session_destroy();
            // NOTIFIKASI BERHASIL LOGOUT
            echo json_encode(['status'=>1, 'msg'=>"Berhasil Logout.."]);
        }else
        {
            // NOTIFIKASI GAGAL LOGOUT
            echo json_encode(['status'=>0, 'msg'=>"Gagal Logout.."]);
        }
    }
?>