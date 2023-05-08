<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

class Memo
{
    private int $id;
    private string $body;
    private string $updatedAt;
    private int $userId;



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body)
    {
        $this->body = $body;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public static function getAll(): array
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM memos
            WHERE deleted_at IS NULL
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute();

        $memos = [];

        foreach ($statement as $row) {
            $memo = new self();
            $memo->setId($row['id']);
            $memo->setBody($row['body']);
            $memo->setUpdatedAt($row['updated_at']);
            $memos[] = $memo;
        }

        return $memos;
    }

    public static function get(string|int $id): self
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM memos
            WHERE id = :id
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);


        $row = $statement->fetch();
        $memo = new self();
        $memo->setId($row['id']);
        $memo->setBody($row['body']);
        $memo->setUpdatedAt($row['updated_at']);
        $memo->setUserId($row['user']);

        return $memo;
    }

    /**
     *  @return Memo[]
     */
    public static function search(string $body): array
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM memos
            WHERE body LIKE :body
            AND deleted_at IS NULL
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'body' => "%$body%",
        ]);

        $memos = [];

        foreach ($statement as $row) {
            $memo = new self();
            $memo->setId($row['id']);
            $memo->setBody($row['body']);
            $memo->setUpdatedAt($row['updated_at']);
            $memos[] = $memo;
        }
        return $memos;
    }

    public static function create(string $body, int $userId)
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            INSERT INTO memos (body,user) VALUES (:body,:userId)
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'body' => $body,
            'userId' => $userId,
        ]);
    }

    public static function update(string|int $id, string $body, int $userId)
    {
        $pdo = Database::getPDO();

        // TODO:
        $sql = <<<SQL
            UPDATE  memos
            SET body = :body, user = :userId
            WHERE id = :id
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
            'body' => $body,
            'userId' => $userId,
        ]);
    }

    public static function delete(string|int $id)
    {
        $pdo = Database::getPDO();

        // TODO:

        $sql = <<<SQL
            UPDATE memos SET
            deleted_at = NOW()
            WHERE id = :id
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $id,
        ]);
    }

    public  function user(): User
    {
        return User::getById($this->userId);
    }

    /**
     * @return Comment[]
     */
    public function comments(): array
    {
        return Comment::getByMemoId($this->id);
    }
}
