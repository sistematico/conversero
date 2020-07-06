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
        if ($usuario = self::get($nome)) {
            if ($usuario->nome == $nome) {
                $_SESSION['id'] = $usuario->id;
                return $usuario->id;
            }
        } 
        return 'false';
    }

    public static function get($nome)
    {
        //$db = self::$database;
        try {
            $query = self::$database->prepare("SELECT id,nome,senha FROM usuarios WHERE nome = :nome OR id = :nome LIMIT 1");
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

    public function logged()
    {
        if (isset($_SESSION['id'])) {
            return 'true';
        }

        return 'false';
    }
}