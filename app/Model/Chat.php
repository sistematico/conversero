<?php

namespace App\Model;
use App\Core\Model;
use App\Model\User;

class Chat extends Model
{
    public function list()
    {
        //$query = $this->db->prepare("SELECT id, usuario, mensagem, timestamp FROM chat ORDER BY timestamp DESC LIMIT 20");
        $query = $this->db->prepare("SELECT chat.id AS id, chat.usuario AS usuario, chat.mensagem AS mensagem, chat.timestamp AS timestamp, usuarios.cor AS cor FROM chat LEFT JOIN usuarios ON chat.usuario = usuarios.nome ORDER BY chat.timestamp DESC LIMIT 20");
        $query->execute();
        $results = [];
        while ($row = $query->fetch(\PDO::FETCH_BOTH)) {
            $results[] = $row;
        }
      

        return json_encode($results);
    }

    public function add($mensagem)
    {
        $this->deleteLast();

        $User = new User();
        if (isset($_SESSION['id']) && $user = $User->get($_SESSION['id'])) {
            try {
                $mensagem = strip_tags($mensagem);
                $sql = "INSERT INTO chat (usuario,mensagem,timestamp) VALUES (:usuario,:mensagem,:timestamp)";
                $query = $this->db->prepare($sql);
                $query->execute([':usuario' => $user->nome, ':mensagem' => $mensagem, ':timestamp' => time()]);
                return 'true';
            } catch (\PDOException $e) {
                unset($e);
                return 'false';
            }        
        }

        return 'false';
    }

    public function deleteLast()
    {
        $query = $this->db->prepare("SELECT id timestamp FROM chat ORDER BY timestamp ASC LIMIT 1");
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);

        if ($result && count($result) > 20) {
            $stmt = $this->db->prepare('DELETE FROM chat WHERE id = :id LIMIT 1');
            $stmt->execute([':id' => $result[0]]);   
        }
    }

    public function getCor($nome)
    {
        $User = new User();
        $cor = $User->get($nome);
        return $cor['cor'];
    }

    public function notification($sound)
    {
        file_put_contents("audio.txt", $sound);
        return $sound;
    }    
}