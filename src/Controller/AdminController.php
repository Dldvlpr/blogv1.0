<?php

namespace App\Controller;

use App\Model\AdminManager;

class AdminController extends AbstractController
{
    public function index(): string
    {
        $adminManager = new AdminManager();
        $articles = $adminManager->selectAll('title');

        return $this->twig->render('Admin/index.html.twig', ['articles' => $articles]);
    }

    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $article = array_map('trim', $_POST);
            $adminManager = new AdminManager();
            $adminManager->add($article);

            $this->twig->render('Admin/add.html.twig');
             return null;
        }

        return $this->twig->render('Admin/add.html.twig');
    }

    public function show(int $id): string
    {
        $adminManager = new AdminManager();
        $article = $adminManager->selectOneById($id);

        return $this->twig->render('Admin/show.html.twig', ['article' => $article]);
    }

}
