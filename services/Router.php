<?php


class Router
{
    private PageController $pc;
    private AuthController $ac;
    private MailController $mc;
    private AdminController $adc;
    private CategorieController $cc;
    private CategorieVivantController $cvc;
    private ProduitController $prc;
    private ProduitVivantController $prvc;
    private EvenementController $ec;

    public function __construct()
    {
        $this->pc = new PageController();
        $this->ac = new AuthController();
        $this->mc = new MailController();
        $this->adc = new AdminController();
        $this->cc = new CategorieController();
        $this->cvc = new CategorieVivantController();
        $this->prc = new ProduitController();
        $this->prvc = new ProduitVivantController();
        $this->ec = new EvenementController();
    }

    public function handleRequest(array $get): void
    {
        if (!isset($get["route"])) {
            $this->pc->home();
        } else if (isset($get["route"]) && $get["route"] === 'register') {
            $this->ac->register();
        } else if (isset($get["route"]) && $get["route"] === 'login') {
            $this->ac->login();
        } else if (isset($get["route"]) && $get["route"] === 'check-register') {
            $this->ac->checkRegister();
        } else if (isset($get["route"]) && $get["route"] === 'check-login') {
            $this->ac->checkLogin();
        } else if (isset($get["route"]) && $get["route"] === 'logout') {
            $this->ac->logout();
        } else if (isset($get["route"]) && $get["route"] === 'contact') {
            $this->pc->contact();
        } else if (isset($get["route"]) && $get["route"] === 'about') {
            $this->pc->about();
        } else if (isset($get["route"]) && $get["route"] === 'sendMail') {
            $this->mc->sendMail();
        } else if (isset($get["route"]) && $get["route"] === 'distribution') {
            $this->pc->showDistribution();
        } else if (isset($get["route"]) && $get["route"] === 'profil') {
            $this->pc->showProfil();
        } else if (isset($get["route"]) && $get["route"] === 'admin') {
            $this->adc->adminPage();
        } else if (isset($get["route"]) && $get["route"] === 'users') {
            $this->adc->showUsers();
        } else if (isset($get["route"]) && $get["route"] === 'products') {
            $this->adc->showProducts();
        } else if (isset($get["route"]) && $get["route"] === 'products_alives') {
            $this->adc->showProductsAlives();
        } else if (isset($get["route"]) && $get["route"] === 'categories_products') {
            $this->adc->showCategories();
        } else if (isset($get["route"]) && $get["route"] === 'categories_alives') {
            $this->adc->showCategoriesAlives();
        } else if (isset($get["route"]) && $get["route"] === 'evenements') {
            $this->adc->showEvenement();
        } else if (isset($get["route"]) && $get["route"] === 'filtre_produits') {
            $this->prc->filtrerProduit();
        } else if (isset($get["route"]) && $get["route"] === 'filtre_produitsVivants') {
            $this->prvc->filtrerProduitVivant();
        } else if (isset($get["route"]) && $get["route"] === 'modifier_categorie') {
            if (isset($get["id"])) {
                $this->cc->modiferCategorie();
            }
        } else if (isset($get["route"]) && $get["route"] === 'supprimer_categorie') {
            if (isset($get["id"])) {
                $this->cc->supprimerCategorie();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_categorieVivant') {
            if (isset($get["id"])) {
                $this->cvc->modiferCategorieVivant();
            }
        } else if (isset($get["route"]) && $get["route"] === 'supprimer_categorieVivant') {
            if (isset($get["id"])) {
                $this->cvc->supprimerCategorieVivant();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_evenement') {
            if (isset($get["id"])) {
                $this->ec->modiferEvenement();
            }
        } else if (isset($get["route"]) && $get["route"] === 'supprimer_evenement') {
            if (isset($get["id"])) {
                $this->ec->supprimerEvenement();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_produit') {
            if (isset($get["id"])) {
                $this->prc->modiferProduit();
            }
        } else if (isset($get["route"]) && $get["route"] === 'supprimer_produit') {
            if (isset($get["id"])) {
                $this->prc->supprimerProduit();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_produitVivant') {
            if (isset($get["id"])) {
                $this->prvc->modiferProduitVivant();
            }
        } else if (isset($get["route"]) && $get["route"] === 'supprimer_produitVivant') {
            if (isset($get["id"])) {
                $this->prvc->supprimerProduitVivant();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_categorie_') {
            if (isset($get["id"])) {
                $this->cc->modifierCategorie_();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_categorieVivant_') {
            if (isset($get["id"])) {
                $this->cvc->modifierCategorieVivant_();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_evenement_') {
            if (isset($get["id"])) {
                $this->ec->modifierEvenement_();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_produit_') {
            if (isset($get["id"])) {
                $this->prc->modifierProduit_();
            }
        } else if (isset($get["route"]) && $get["route"] === 'modifier_produitVivant_') {
            if (isset($get["id"])) {
                $this->prvc->modifierProduitVivant_();
            }
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_evenement') {
            $this->ec->ajouterEvenement();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_produit') {
            $this->prc->ajouterProduit();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_produitVivant') {
            $this->prvc->ajouterProduitVivant();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_categorie') {
            $this->cc->ajouterCategorie();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_CategorieVivant') {
            $this->cvc->ajouterCategorieVivant();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_evenement_') {
            $this->ec->ajouterEvenement_();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_produit_') {
            $this->prc->ajouterProduit_();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_produitVivant_') {
            $this->prvc->ajouterProduitVivant_();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_categorie_') {
            $this->cc->ajouterCategorie_();
        } else if (isset($get["route"]) && $get["route"] === 'ajouter_categorieVivant_') {
            $this->cvc->ajouterCategorieVivant_();
        }
    }
}
