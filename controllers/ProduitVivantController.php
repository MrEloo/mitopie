<?php

class ProduitVivantController extends AbstractController
{
    public function modiferProduitVivant(): void
    {
        if ($this->checkAdmin()) {
            $pvm = new ProduitVivantManager();
            $produit = $pvm->getProductAliveById($_GET['id']);

            $cm = new CategorieAnimalManager();
            $categories = $cm->getAllCatAnimal();
            dump($produit);
            $this->render('admin/modifier/modifierProduitVivant.html.twig', ['produit' => $produit, 'categories' => $categories]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function supprimerProduitVivant(): void
    {
        if ($this->checkAdmin()) {
            $pm = new ProduitVivantManager();
            $pm->supprimerProduitVivant($_GET['id']);
            $this->redirect('index.php?route=products_alives');
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterProduitVivant(): void
    {
        if ($this->checkAdmin()) {

            $cm = new CategorieAnimalManager();
            $categories = $cm->getAllCatAnimal();

            $this->render('admin/ajouter/ajouterProduitVivant.html.twig', ['categories' => $categories]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterProduitVivant_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $pm = new ProduitVivantManager();

                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');


                $pm->ajouterProduitVivant($_POST['nom'], $_POST['prix'], $_POST['description'], './uploads/' . $_FILES['input_file']['name'], $_POST['categorie']);

                $this->redirect("index.php?route=products_alives");
            }
        } else {
            $this->redirect("index.php");
        }
    }

    public function modifierProduitVivant_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {

                $pm = new ProduitVivantManager();

                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');

                if (empty($_FILES['input_file']['name'])) {
                    $pm->ajouterProduitVivant($_POST['nom'], $_POST['prix'], $_POST['description'], $_POST['media_url'], $_POST['categorie']);
                } else {
                    $pm->ajouterProduitVivant($_POST['nom'], $_POST['prix'], $_POST['description'], './uploads/' . $_FILES['input_file']['name'], $_POST['categorie']);
                }


                $this->redirect("index.php?route=products_alives");
            }
        } else {
            $this->redirect("index.php");
        }
    }

    public function filtrerProduitVivant(): void
    {

        $pvm = new ProduitVivantManager();
        $cam = new CategorieAnimalManager();

        $categories = $cam->getAllCatAnimal();
        foreach ($categories as $key => $categorie) {
            $produit = $pvm->getProductsByCat($categorie->getId());
            $categorie->setProducts_alive($produit);
        }

        if (empty($_POST['categorie'])) {
            $produits = $pvm->getProductsAlives();
            $this->render('admin/produitVivant.html.twig', ['categories' => $categories, 'produits' => $produits]);
        } else if (!empty($_POST['categorie'])) {
            $produits = $pvm->getProductsByCat($_POST['categorie']);
            $this->render('admin/produitVivant.html.twig', ['produits_filtrer' => $produits, 'categories' => $categories]);
        } else {
            $this->render('admin/produitVivant.html.twig', ['categories' => $categories]);
        }
    }
}
