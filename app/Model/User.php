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
        if ($usuario = $this->get()) {
            if ($usuario->nome == $nome) {
                $_SESSION['id'] = $usuario->id;
                return $usuario->id;
            }
        } 
        return 'false';
    }

    public function get($id)
    {
        try {
            $query = $this->db->prepare("SELECT id,nome,senha FROM usuarios WHERE nome = :nome LIMIT 1");
            $query->execute([':nome' => $nome]);
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
}