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
        $sql = "INSERT INTO usuarios (nome, senha) VALUES (:nome, :senha)";
        $query = $this->db->prepare($sql);
        $query->execute([':nome' => $nome, ':senha' => $senha]);
    }

    public function logout()
    {
        unset($_SESSION['id']);
    }
}