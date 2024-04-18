<?php

class EvenementController extends AbstractController
{
    public function modiferEvenement(): void
    {
        if ($this->checkAdmin()) {
            $pm = new EvenementManager();
            $evenement = $pm->getEvenementById($_GET['id']);
            $this->render('admin/modifier/modifierEvenement.html.twig', ['evenement' => $evenement]);
        } else {
            $this->redirect('index.php');
        }
    }

    public function supprimerEvenement(): void
    {
        if ($this->checkAdmin()) {
            $em = new EvenementManager();
            $em->supprimerEvenement($_GET['id']);
            $this->redirect('index.php?route=evenements');
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterEvenement(): void
    {
        if ($this->checkAdmin()) {
            $this->render('admin/ajouter/ajouterEvenement.html.twig', []);
        } else {
            $this->redirect('index.php');
        }
    }

    public function ajouterEvenement_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $em = new EvenementManager();

                $em->ajouterEvenement($_POST['titre'], $_POST['description']);

                $this->redirect("index.php?route=evenements");
            }
        } else {
            $this->render("page/home.html.twig", []);
        }
    }

    public function modifierEvenement_(): void
    {
        if ($this->checkAdmin()) {
            if (isset($_POST)) {
                $em = new EvenementManager();

                $em->modifierEvenement($_GET['id'], $_POST['titre'], $_POST['description']);

                $this->redirect("index.php?route=evenements");
            }
        } else {
            $this->redirect("index.php");
        }
    }
}
