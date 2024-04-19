<?php

class PageController extends AbstractController
{

    public function home(): void
    {

        $cm = new CategorieManager;
        $pm = new ProduitManager;
        $categories = $cm->getAllCat();
        foreach ($categories as $key => $categorie) {
            $products = $pm->getAllProductByCat($categorie->getId());
            $categorie->setProducts($products);
        }

        $cam = new CategorieAnimalManager();
        $pvm = new ProduitVivantManager();
        $categories_animeaux = $cam->getAllCatAnimal();
        foreach ($categories_animeaux as $key => $categorie_animal) {
            $products_alive = $pvm->getProductsByCat($categorie_animal->getId());
            $categorie_animal->setProducts_alive($products_alive);
        }


        $em = new EvenementManager();
        $evenements = $em->getEvenements();

        $hfm = new HoraireFermeManager();
        $horaires = $hfm->getFarmHours();

        $this->render("pages/home.html.twig", ['categories' => $categories, 'categories_animeaux' => $categories_animeaux, 'horaires' => $horaires, 'evenements' => $evenements]);
    }

    // public function homeWhenConnected(): void
    // {
    //     $cm = new CategorieManager;
    //     $pm = new ProduitManager;
    //     $categories = $cm->getAllCat();
    //     foreach ($categories as $key => $categorie) {
    //         $products = $pm->getAllProductByCat($categorie->getId());
    //         $categorie->setProducts($products);
    //     }
    //     $this->render("pages/home.html.twig", ['categories' => $categories]);
    // }

    public function contact(): void
    {
        if (isset($_GET['titre'])) {
            if (!empty($_SESSION['reussi']) || !empty($_SESSION['rate'])) {
                session_unset(); // Supprimer toutes les variables de session
                session_destroy(); // Détruire complètement la session
            }
            $titre = $_GET['titre'];
            $this->render("pages/contact.html.twig", ['titre' => $titre]);
        } else {
            if (!empty($_SESSION['reussi']) || !empty($_SESSION['rate'])) {
                session_unset(); // Supprimer toutes les variables de session
                session_destroy(); // Détruire complètement la session
            }
            $this->render("pages/contact.html.twig", []);
        }
    }

    public function about(): void
    {
        $this->render("pages/about.html.twig", []);
    }

    public function showDistribution(): void
    {
        $this->render('pages/distribution.html.twig', []);
    }

    public function showProfil(): void
    {
        if ($this->isUserOrAdmin()) {
            $um = new UserManager();

            $user = $um->getUserByEmail($_SESSION['user_email']);
            $this->render('pages/profil.html.twig', ['user' => $user]);
        } else {
            $this->redirect('index.php');
        }
    }
}
