<?php

class CategorieVivantController extends AbstractController
{
    public function modiferCategorieVivant(): void
    {
        if ($this->checkAdmin()) {
            $cam = new CategorieAnimalManager();
            $categorie = $cam->getCatAnimalById($_GET['id']);
            $this->render('admin/modifier/modifierCategorieVivant.html.twig', ['categorie' => $categorie]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function supprimerCategorieVivant(): void
    {
        if ($this->checkAdmin()) {
            $cam = new CategorieAnimalManager();
            $cam->supprimerCategorieVivant($_GET['id']);
            $this->redirect('index.php?route=categories_alives');
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterCategorieVivant(): void
    {
        if ($this->checkAdmin()) {
            $this->render('admin/ajouter/ajouterCategorieVivant.html.twig', []);
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterCategorieVivant_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $cam = new CategorieAnimalManager();

                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');

                $cam->ajouterCategorieVivant($_POST['nom'], './uploads/' . $_FILES['input_file']['name']);

                $this->redirect("index.php?route=categories_alives");
            }
        } else {
            $this->redirect('index.php');
        }
    }
    public function modifierCategorieVivant_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $cam = new CategorieAnimalManager();

                $categorie = $cam->getAllCatAnimal();


                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');

                // dump($_POST);
                // dump($_FILES);


                if (empty($_FILES['input_file']['name'])) {
                    $cam->modifierCategorieVivant($_GET['id'], $_POST['nom'], $_POST['media_url']);
                } else {
                    $cam->modifierCategorieVivant($_GET['id'], $_POST['nom'], './uploads/' . $_FILES['input_file']['name']);
                }

                $this->redirect("index.php?route=categories_alives");
            }
        } else {
            $this->redirect("index.php");
        }
    }
}
