<?php

namespace src;

use PDOException;

require_once __DIR__."/Connect.php";
class User
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function verifyEmpty()
    {
        if(empty(trim($this->getName())) || empty(trim($this->getEmail()) ) || empty(trim($this->getPassword())))
        {
            return false;
        }
        return true;
    }

    public function save()
    {
        if(!$this->verifyEmpty())
        {
            return "Preencha todos os campos";
        }

        try {
            $query = "SELECT * FROM users where email=:email";
            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':email',$this->getEmail());
            $result->execute();

            if($result->rowCount()) {
                return "Ja existe um usuário cadastrado com esse email";
            }

            $query = "INSERT INTO users (name, email, password) VALUES (:name,:email,:password)";

            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':name', $this->getName());
            $result->bindValue(':email', $this->getEmail());
            $result->bindValue(':password', $this->getPassword());
            $result->execute();

            return $result->rowCount();
        }catch (PDOException $e)
        {
            return "Ocorreu um problema ao salvar, tente novamente!";
        }
    }

    public function edit()
    {
        if(!$this->verifyEmpty())
        {
            return "Preencha todos os campos";
        }

        try {
            $query = "SELECT * FROM users WHERE id!=:id AND email=:email";
            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':id',$this->getId());
            $result->bindValue(':email',$this->getEmail());
            $result->execute();

            if($result->rowCount()) {
                return "Ja existe um usuário cadastrado com esse email";
            }

            $query = "UPDATE users SET name=:name, email=:email, password=:password WHERE id=:id";
            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':id', $this->getId());
            $result->bindValue(':name', $this->getName());
            $result->bindValue(':email', $this->getEmail());
            $result->bindValue(':password', $this->getPassword());
            $result->execute();

            return $result->rowCount();
        }catch (PDOException $e)
        {
            return "Ocorreu um problema ao salvar, tente novamente!";
        }
    }

    public function getAll()
    {
        try {
            $query = "SELECT * FROM users";

            $result = Connect::getInstance()->prepare($query);
            $result->execute();

            return $result->fetchAll();
        }catch (PDOException $e) {
            return "Ocorreu um problema ao salvar, tente novamente!";
        }
    }

    public function delete()
    {
        try {
            if(empty(trim($this->getId()))) {
                return "Informe o usuário que deseja deletar";
            }

            $query = "SELECT * FROM users where id=:id";
            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':id',$this->getId());
            $result->execute();

            if($result->rowCount() == 0) {
                return "Esse usuário ja foi deletado";
            }

            $query = "DELETE FROM users where id=:id";
            $result = Connect::getInstance()->prepare($query);
            $result->bindValue(':id',$this->getId());
            $result->execute();

            return $result->rowCount();
        } catch (PDOException $e) {
            return "Ocorreu um problema ao salvar, tente novamente!";
        }
    }

}