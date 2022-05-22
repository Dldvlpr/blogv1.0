<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function list(): string
    {
        $adminManager = new AdminManager();
        $articles = $adminManager->selectAll('title');

        return $this->twig->render('Admin/list.html.twig', ['articles' => $articles]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = array_map('trim', $_POST);
            $adminManager = new AdminManager();
            $adminManager->add($article);

            header('Location:/admin');
             return null;
        }

        return $this->twig->render('Admin/add.html.twig');
    }

    public function show(int $id): string
    {
        $adminManager = new AdminManager();
        $article = $adminManager->selectOneById($id);

        return $this->twig->render('Admin/article.html.twig', ['article' => $article]);
    }

    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $adminManager = new AdminManager();
            $adminManager->delete((int)$id);

            header('Location:/admin');
        };
    }
}
