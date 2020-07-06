<?php

namespace App\Model;
use App\Core\Model;
use App\Model\User;

class Chat extends Model
{
    public function list()
    {
        $query = $this->db->prepare("SELECT id, usuario, mensagem, timestamp FROM chat ORDER BY timestamp DESC LIMIT 20");
        $query->execute();
        $results = [];
        while ($row = $query->fetch(\PDO::FETCH_BOTH)) {
            $results[] = $row;
            $results['cor'][] = $this->getCor($row->nome);
        }

        return json_encode($results);
    }

    public function add($mensagem)
    {
        $this->deleteLast($this->getLast());

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

    public function deleteLast($id)
    {
        if ($id != false) {
        $sql = 'DELETE FROM chat WHERE id = :id LIMIT 1';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);    
        $stmt->execute();    
        return $stmt->rowCount();
        }
    }

    public function getLast()
    {
        $query = $this->db->prepare("SELECT id timestamp FROM chat ORDER BY timestamp ASC LIMIT 1");
        $query->execute();
        $result = $query->fetch(\PDO::FETCH_BOTH);

        if ($result && count($result) > 20) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function getCor($nome)
    {
        $User = new User();
        return $User->get($nome)->cor;
    }

    public function notification($sound)
    {
        file_put_contents("audio.txt", $sound);
        return $sound;
    }    
}