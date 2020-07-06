<?php

namespace App\Model;
use App\Core\Model;

class User extends Model
{
    public function add($nome, $senha)
    {

        $cores = ["Neo", "Morpheus", "Trinity", "Cypher", "Tank"];
        $cor = $cores[array_rand($cores)];

        $sql = "INSERT INTO usuarios (nome, senha, cor) VALUES (:nome, :senha, :cor)";
        $query = $this->db->prepare($sql);
        $query->execute([':nome' => $nome, ':senha' => $senha, ':cor' => $cor]);
    }

    public function login($nome, $senha)
    {
        $user = $this->get($nome);
        if ($user != false) {
                $_SESSION['id'] = $user->id;
                return json_encode(['id'=>$user->id]);
        } 
        return 'false';
    }

    public function get($nome)
    {
        $sql = "SELECT id, nome, senha FROM usuarios WHERE id = ? OR nome = ? LIMIT 1";
        $query = $this->db->prepare($sql);
        $parameters = array($nome,$nome);
        $query->execute($parameters);
        return $query->fetch();
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