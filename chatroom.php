<!DOCTYPE html>
<html>
<head>
	<title>Chat Room</title>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<style type="text/css">

		#headerchat
		{
			flex: 1;
			background-color: rgb(175, 4, 4);
			padding: 0 30px;
			width: 100%;
			box-shadow: 0 3px 7px 0 rgba(168,168,168,1);
			color:#fff;
		}
		#messages
		{
			height: 200px;
			background: lightcoral;
			overflow: auto;
		}
		#chat-room-frm
		{
			margin-top: 10px;
			background: lightgreen;
		}
	</style>
	<!-- <link rel="stylesheet" href="css/style.css"> -->
</head>
<body>
	<div class="container">
		<hr>
		<div class="row">
			<div class="col-md-4">
                <?php
                    session_start();
					// PENCEGAHAN USER BISA MEMASUKI HALAMAN CHAT TANPA LOGIN
					if(!isset($_SESSION['user']))
					{
						header("location: index.php");
					}
                    require("db/users.php");
					require("db/chatrooms.php");
                    $objChatroom = new chatrooms;
                    $chatrooms   = $objChatroom->getAllChatRooms();

                    $objUser     = new users;
                    $users       = $objUser->getAllUsers();

					$userData = [];

					foreach($_SESSION['user'] as $key => $val) {
						$objUser->setEmail($val['email']);
						$userData = $objUser->getUserByEmail();
						
					}

					// var_dump($userData['id']);

					// echo '<input type="hidden" name="userId" id="userId" value=' . $userData['id'] .'">';					
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>
                                <?php
                                    foreach($_SESSION['user'] as $key => $user)
                                    {
										$userId = $key;
                                        echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
										// MENAMPILKAN USERNAME ATAU AKUN YANG SEDANG DIPAKAI
										echo "<div>Username : ".$user['username']."</div>";
                                        // echo "<div>".$user['email']."</div>";
                                    }
                                ?>
                            </td>
							<!-- MENAMPILKAN TOMBOL LOGOUT -->
							<td align="right" colspan="2">
								<input type="button" class="btn btn-warning" id="leave-chat" name="leave-chat" value="LOGOUT">
							</td>
                        </tr>
                        <tr>
                            <th>USERS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
						// UNTUK MENGETAHUI SIAPA SAJA USERS YANG SEDANG ONLINE ATAU OFFLINE
                        foreach($users as $key => $user)
                        {
							
							if($user["login_status"] == 1)
							{
								echo "<tr><td>".$user['username']."</td>";
                            	echo "<td>Online</td>";
							}else
							{
								echo "<tr><td>".$user['username']."</td>";
                            	echo "<td>Offline</td>";
							}
                        }
                    ?>                        
                    </tbody>

                </table>
			</div>
			<div class="col-md-8">
			<div id="headerchat">
					<table id="chats" class="table table-striped">
						<thead>
							<tr>
								<!-- <div class="root">
									<div class="chat">
										<div class="chat_header"> -->
											<th colspan="4" scope="col"><strong>Chat Room</strong></th>
										<!-- </div>
									</div>
								</div> -->
								
							</tr>
						</thead>
						<!-- <tr><td valign="top"><div><strong>From :</strong></div>
						<div>Message</div><td align="right" valign="top">Message Time</td></tr> -->
						<tbody>
						</tbody>
					</table>
				</div>
				<div id="messages">
					<table id="chats" class="table table-striped">
						<thead>
							<tr>
								<!-- <div class="root">
									<div class="chat">
										<div class="chat_header"> -->
											<!-- <th colspan="4" scope="col"><strong>Chat Room</strong></th> -->
										<!-- </div>
									</div>
								</div> -->
								
							</tr>
						</thead>
						<!-- <tr><td valign="top"><div><strong>From :</strong></div>
						<div>Message</div><td align="right" valign="top">Message Time</td></tr> -->
						<tbody>
							<?php
							// FUNGSI UNTUK MEMBEDAKAN USERNAME YANG SEDANG MENGIRIM PESAN
								foreach($chatrooms as $key => $chatroom)
								{
									// print_r($chatroom);
									if($userId == $chatroom['userid'])
									{
										$from = "Saya";
										echo '<tr><td align="right" valign="top"><div><strong>'.$from.'</strong></div><div>'.$chatroom['msg'].'</div><td align="center" valign="top">'.date("d/m/Y h:i:s A", strtotime($chatroom['created_on'])).'</td></tr>';

									}
									else
									{
										$from = $chatroom['username'];
										echo '<tr><td valign="top"><div><strong>'.$from.'</strong></div><div>'.$chatroom['msg'].'</div><td align="center" valign="top">'.date("d/m/Y h:i:s A", strtotime($chatroom['created_on'])).'</td></tr>';

									}
									// echo '<tr><td valign="top"><div><strong>'.$from.'</strong></div><div>'.$chatroom['msg'].'</div><td align="right" valign="top">'.date("d/m/Y h:i:s A", strtotime($chatroom['created_on'])).'</td></tr>';
								}
							?>
						</tbody>
					</table>
				</div>

				<form id="chat-room-frm" method="post" action="">
					<div class="form-group">
                    	<textarea class="form-control" id="msg" name="msg" placeholder=""></textarea>
	                </div>
	                <div class="form-group">
	                    <input type="button" value="Kirim Pesan" class="btn btn-success btn-block" id="send" name="send">
	                </div>
			    </form>
			</div>
		</div>
	</div>   
</body>
<script type="text/javascript">
	$(document).ready(function()
	{
		var conn = new WebSocket('ws://localhost:8080');
		// NOTIFIKASI SERVER SUDAH DIJALANKAN / USER SUDAH DAPAT MELAKUKAN CHATING
		conn.onopen = function(e)
		{
	    	console.log("Connection established!");
		};
		// NOTIFIKASI BAHWA CHAT BERHASIL TERKIRIM
		conn.onmessage = function(e)
		{
    		console.log(e.data);
			var data = JSON.parse(e.data);
			var row = '<tr><td valign="top"><div><strong>' + data.from + '</strong></div><div>'+data.msg+'</div><td align="right" valign="top">'+data.dt+'</td></tr>';
			$('#chats > tbody').prepend(row);
		};
		// NOTIFIKASI BAHWA USER BERHASIL LOGOUT ATAU KELUAR DARI GRUPCHAT
		conn.onclose = function(e)
		{
			console.log("Connection Close")
		};

		$("#send").click(function()
		{
			var userId = $("#userId").val(); 
			var msg    = $("#msg").val();
			var data   =
			{
				userId: userId,
				msg: msg
			};
			console.log(data);
			conn.send(JSON.stringify(data));
			$("#msg").val("");
		})

		$("#leave-chat").click(function()
		{
			var userId = $("#userId").val(); 
			$.ajax(
				{
					url:"action.php",
					method:"post",
					data: "userId="+userId+"&action=leave"
				}).done(function(result)
				{
					var data = JSON.parse(result);
					if(data.status == 1)
					{
						conn.close();
						location = "index.php";
					}else
					{
						console.log(data.msg);
					}
					console.log(result);
				});
			conn.close();
		})
		
	})
</script>
</html>