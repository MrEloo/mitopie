<?php

class CategorieController extends AbstractController
{
    public function modiferCategorie(): void
    {
        if ($this->checkAdmin()) {
            $cm = new CategorieManager();
            $categorie = $cm->getCatById($_GET['id']);
            $this->render('admin/modifier/modifierCategorie.html.twig', ['categorie' => $categorie]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function supprimerCategorie(): void
    {
        if ($this->checkAdmin()) {
            $cm = new CategorieManager();
            $cm->supprimerCategorie($_GET['id']);
            $this->redirect('index.php?route=categories_products');
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterCategorie(): void
    {
        if ($this->checkAdmin()) {
            $this->render('admin/ajouter/ajouterCategorie.html.twig', []);
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterCategorie_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $cm = new CategorieManager();

                $cm->ajouterCategorie($_POST['nom'], $_POST['media']);

                $this->redirect("index.php?route=categories_products");
            }
        } else {
            $this->redirect("index.php");
        }
    }

    public function modifierCategorie_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $cm = new CategorieManager();

                $cm->modifierCategorie($_GET['id'], $_POST['nom'], $_POST['media']);

                $this->redirect("index.php?route=categories_products");
            }
        } else {
            $this->redirect("index.php");
        }
    }
}
