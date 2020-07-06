<?php

namespace App\Model;
use App\Core\Model;

class User extends Model
{
    public function add($nome, $senha)
    {
        $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
        $query = $this->db->prepare($sql);
        $query->execute([':nome' => $nome, ':senha' => $senha]);
    }

    public function login($nome, $senha)
    {
        if ($usuario = $this->get($nome) != false) {
            if ($usuario->nome === $nome) {
                $_SESSION['id'] = $usuario->id;
                return json_encode(['id'=>$usuario->id,'nome'=>$usuario->nome]);
            }
        } 
        return 'false';
    }

    public function get($nome)
    {
        try {
            $query = $this->db->prepare("SELECT id,nome,senha FROM usuarios WHERE nome = ? OR id = ? LIMIT 1");
            $query->execute([$nome, $nome]);
            //$result = $query->fetch(\PDO::FETCH_BOTH);
            return $query->fetch(\PDO::FETCH_BOTH);
        } catch (\PDOException $e) {
            return false;
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['id']);
    }

    public function logged()
    {
        if (isset($_SESSION['id'])) {
            return 'true';
        }

        return 'false';
    }
}