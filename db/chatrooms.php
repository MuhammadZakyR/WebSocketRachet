<?php 
	
	class chatrooms
	{
		private $id;
		private $userId;
		private $msg;
		private $createdOn;
		protected $dbConn;

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setUserId($userId) { $this->userId = $userId; }
		function getUserId() { return $this->userId; }
		function setMsg($msg) { $this->msg = $msg; }
		function getMsg() { return $this->msg; }
		function setCreatedOn($createdOn) { $this->createdOn = $createdOn; }
		function getCreatedOn() { return $this->createdOn; }

		public function __construct() {
			require_once('db_Connect.php');
			$db = new DbConnect();
			$this->dbConn = $db->connect();
		}

		// FUNGSI UNTUK MENYIMPAN RIWAYAT CHAT KE DATABASE
		public function saveChatRoom() {
			$stmt = $this->dbConn->prepare('INSERT INTO tb_chatroom VALUES(null, :userid, :msg, :createdOn)');
			$stmt->bindParam(':userid', $this->userId);
			$stmt->bindParam(':msg', $this->msg);
			$stmt->bindParam(':createdOn', $this->createdOn);
			
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}
		}
		// FUNGSI UNTUK MENAMPILKAN RIWAYAT CHAT DARI DATABASE KE ROOM CHAT
		public function getAllChatRooms() {
			$stmt = $this->dbConn->prepare("SELECT c.*, username FROM tb_chatroom c JOIN tb_userwebsocket u ON(c.userid = u.id) ORDER BY c.id DESC");
			$stmt->execute();
			$chatrooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $chatrooms;
		}

	}
 ?>