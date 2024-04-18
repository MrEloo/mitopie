<?php

class AdminController extends AbstractController
{

    public function adminPage(): void
    {
        if ($this->checkAdmin()) {
            $this->render('admin/adminPage.html.twig', []);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showUsers(): void
    {
        if ($this->checkAdmin()) {
            $um = new UserManager();
            $users = $um->getAllUser();
            $this->render('admin/users.html.twig', ['users' => $users]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showProducts(): void
    {
        if ($this->checkAdmin()) {
            $pm = new ProduitManager();
            $cm = new CategorieManager();

            $categories_data = $cm->getAllCat();
            $categories_array = [];
            foreach ($categories_data as $key => $categorie_data) {
                $produit = $pm->getAllProductByCat($categorie_data->getId());
                $categorie_data->setProducts($produit);
                if (!empty($categorie_data->getProducts())) {
                    $categories_array[] = $categorie_data;
                }
            }
            $produits = $pm->getAllProducts();
            $this->render('admin/produits.html.twig', ['produits' => $produits, 'categories' => $categories_array]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showProductsAlives(): void
    {
        if ($this->checkAdmin()) {
            $pvm = new ProduitVivantManager();
            $cam = new CategorieAnimalManager();

            $categories_data = $cam->getAllCatAnimal();
            $categories_array = [];
            foreach ($categories_data as $key => $categorie_data) {
                $produit = $pvm->getProductsByCat($categorie_data->getId());
                $categorie_data->setProducts_alive($produit);
                if (!empty($categorie_data->getProducts_alive())) {
                    $categories_array[] = $categorie_data;
                }
            }
            $produits = $pvm->getProductsAlives();
            $this->render('admin/produitVivant.html.twig', ['produits' => $produits, 'categories' => $categories_array]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showCategories(): void
    {
        if ($this->checkAdmin()) {
            $cm = new CategorieManager();
            $categories = $cm->getAllCat();
            $this->render('admin/categorie.html.twig', ['categories' => $categories]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showCategoriesAlives(): void
    {
        if ($this->checkAdmin()) {
            $cam = new CategorieAnimalManager();
            $categoriesAnimeaux = $cam->getAllCatAnimal();
            $this->render('admin/categorieAnimal.html.twig', ['categoriesAnimeaux' => $categoriesAnimeaux]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function showEvenement(): void
    {
        if ($this->checkAdmin()) {
            $em = new EvenementManager();
            $evenements = $em->getEvenements();
            $this->render('admin/evenement.html.twig', ['evenements' => $evenements]);
        } else {
            $this->redirect('index.php');
        }
    }
}
