<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/User.php';

class Comment
{
    private int $id;
    private string $comment;
    private int $userId;
    private int $memoId;



    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getMemoId(): int
    {
        return $this->memoId;
    }

    public function setMemoId(int $memoId)
    {
        $this->memoId = $memoId;
    }


    public static function create(
        string $comment,
        string|int $userId,
        string|int $memoId
    ) {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            INSERT INTO comments (comment,user , memo)
            VALUES (:comment,:userId, :memoId)
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'comment' => $comment,
            'userId' => $userId,
            'memoId' => $memoId,
        ]);
    }

    /**
     * @return Comment[]
     */
    public static function getByMemoId(string|int $memoId): array
    {
        $pdo = Database::getPDO();

        $sql = <<<SQL
            SELECT * FROM comments
            WHERE memo = :memoId
        SQL;

        $statement = $pdo->prepare($sql);
        $statement->execute([
            'memoId' => $memoId,
        ]);


        $comments = [];

        foreach ($statement as $row) {
            $comment = new self();
            $comment->setId($row['id']);
            $comment->setComment($row['comment']);
            $comment->setuserId($row['user']);
            $comment->setmemoId($row['memo']);
            $comments[] = $comment;
        }
        return $comments;
    }

    public function user(): User
    {
        return User::getById($this->userId);
    }
}
