<?php

namespace App\Model;

class AdminManager extends AbstractManager
{
    public const TABLE = 'article';

    public function add(array $article): bool
    {
        $query = "INSERT INTO article (title, core, author, section) VALUES (:title, :core, :author, :section)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':title', $article['title'], \PDO::PARAM_STR);
        $statement->bindValue(':core', $article['core'], \PDO::PARAM_STR);
        $statement->bindValue(':author', $article['author'], \PDO::PARAM_STR);
        $statement->bindValue(':section', $article['section'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
