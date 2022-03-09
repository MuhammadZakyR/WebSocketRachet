<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . "/db/users.php";
require dirname(__DIR__) . "/db/chatrooms.php";

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        echo "Server Started.";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $numRecv = count($this->clients) - 1;
        echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
            , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
            $data = json_decode($msg, true);
            $objChatroom = new \chatrooms;
            $objChatroom->setUserId($data['userId']);
            $objChatroom->setMsg($data['msg']);
            $objChatroom->setCreatedOn(date("Y-m-d h:i:s A"));
            if($objChatroom->saveChatRoom())
            {  
                $objUser = new \users;
                $objUser->setId($data['userId']);
                $user = $objUser->getUserById();
                $data['from'] = $user['username'];
                $data['msg']  = $data['msg'];
                $data['dt']   = date("d-m-Y h:i:s");
            }

            // print_r($data);
        // FUNGSI AGAR CHAT DAPAT TERLIHAT DISELURUH LAYAR YANG TERHUBUNG DENGAN GRUP CHAT YANG SAMA
        foreach ($this->clients as $client) {
            // FUNGSI UNTUK MEMBEDAKAN PENGIRIM PESAN
            if ($from !== $client)
            {
                $data['from']  = $user['username'];
            } else
            {
                $data['from']  = "Saya";
            }
                $client->send(json_encode($data));
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}