<?php

require_once __DIR__ . '/Database.php';

class User
{
    private int $id;
    private string $email;
    private string $password;
    private string $name;
    private int $userId;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function register()
    {
        $pdo = Database::getPDO();
        $sql = <<<SQL
          INSERT INTO users (email, password, name)
          VALUES (:email, :password, :name)
      SQL;
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'email' => $this->email,
            'password' => password_hash($this->password, PASSWORD_DEFAULT),
            'name' => $this->name,
        ]);
        $this->id = $pdo->lastInsertId();
    }
    public function login(): array
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM users
            WHERE email = :email
            -- WHERE email = :email AND password = :password
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'email' => $this->email,
            // 'password' => $this->password,
        ]);


        $row = $statement->fetch();


        if ($row === false || !password_verify($this->password, $row['password'])) {
            return [
                'isSucceeded' => false,
            ];
        } else {
            $this->id = $row['id'];
            return [
                'isSucceeded' => true,
            ];
        }
    }

    public static function getById(string|int $id): ?self
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM users
            WHERE id = :id
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);

        if ($statement->rowCount() === 0) {
            return null;
        }

        $row = $statement->fetch();
        $user = new self();
        $user->id = $row['id'];
        $user->email = $row['email'];
        $user->name = $row['name'];

        return $user;
    }

    public static function existsEmail(string $email): bool
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM users
            WHERE email = :email
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'email' => $email,
        ]);
        return $statement->rowCount() > 0;
    }
}
