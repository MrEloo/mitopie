<?php

class ProduitController extends AbstractController
{
    public function modiferProduit(): void
    {
        if ($this->checkAdmin()) {
            $pm = new ProduitManager();
            $produit = $pm->getProductById($_GET['id']);

            $cm = new CategorieManager();
            $categories = $cm->getAllCat();
            $this->render('admin/modifier/modifierProduit.html.twig', ['produit' => $produit, 'categories' => $categories]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function supprimerProduit(): void
    {
        if ($this->checkAdmin()) {
            $pm = new ProduitManager();
            $pm->supprimerProduit($_GET['id']);
            $this->redirect('index.php?route=products');
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterProduit(): void
    {
        if ($this->checkAdmin()) {
            $cm = new CategorieManager();
            $categories = $cm->getAllCat();
            $this->render('admin/ajouter/ajouterProduit.html.twig', ['categories' => $categories]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterProduit_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $pm = new ProduitManager();

                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');

                $pm->ajouterProduit($_POST['nom'], $_POST['prix'], $_POST['quantite'], $_POST['description'], './uploads/' . $_FILES['input_file']['name'], $_POST['categorie']);

                $this->redirect("index.php?route=products");
            }
        } else {
            $this->redirect("index.php");
        }
    }

    public function modifierProduit_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $pm = new ProduitManager();

                // dump($_FILES);
                // dump($_POST);

                $uploader = new Uploader();

                $uploader->upload($_FILES, 'input_file');

                if (empty($_FILES['input_file']['name'])) {
                    $pm->modifierProduit($_POST['nom'], $_POST['prix'], $_POST['quantite'], $_POST['description'], $_POST['media_url'], $_POST['categorie'], $_GET['id']);
                } else {
                    $pm->modifierProduit($_POST['nom'], $_POST['prix'], $_POST['quantite'], $_POST['description'], './uploads/' . $_FILES['input_file']['name'], $_POST['categorie'], $_GET['id']);
                }


                $this->redirect("index.php?route=products");
            }
        } else {
            $this->redirect("index.php");
        }
    }

    public function filtrerProduit(): void
    {

        $pm = new ProduitManager();
        $cm = new CategorieManager();

        $categories = $cm->getAllCat();
        foreach ($categories as $key => $categorie) {
            $produit = $pm->getAllProductByCat($categorie->getId());
            $categorie->setProducts($produit);
        }

        if (empty($_POST['categorie'])) {
            $produits = $pm->getAllProducts();
            $this->render('admin/produits.html.twig', ['categories' => $categories, 'produits' => $produits]);
        } else if (!empty($_POST['categorie'])) {
            $produits = $pm->getAllProductByCat($_POST['categorie']);
            $this->render('admin/produits.html.twig', ['produits_filtrer' => $produits, 'categories' => $categories]);
        } else {
            $this->render('admin/produits.html.twig', ['categories' => $categories]);
        }
    }
}
