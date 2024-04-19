<?php

class AuthController extends AbstractController
{

    public function login(): void
    {
        if ($this->isUserOrAdmin()) {
            $this->redirect('index.php');
        } else {
            //Réinitialisation des sessions de messages d'erreur lors de l'inscription ou la connexion
            $_SESSION['erreur_hash'] = '';
            $_SESSION['erreur_mail'] = '';
            $_SESSION['erreur_remplissage'] = '';



            $this->render("authentification/login.html.twig", []);
        }
    }

    public function register(): void
    {
        if ($this->isUserOrAdmin()) {
            $this->redirect('index.php');
        } else {
            //Réinitialisation des sessions de messages d'erreur lors de l'inscription ou la connexion
            $_SESSION['erreur_hash'] = '';
            $_SESSION['erreur_mail'] = '';
            $_SESSION['erreur_remplissage'] = '';


            $this->render("authentification/register.html.twig", []);
        }
    }


    public function checkLogin(): void
    {

        $userManager = new UserManager();
        $tokenManager = new CSRFTokenManager();


        //Validation du token avant toute chose pour empêcher les faille CSRF
        if ($tokenManager->validateCSRFToken($_POST['csrf_token'])) {

            //Sécurisation des données reçu par le biais du formulaire d'authentification
            if (!empty($_POST['email']) && !empty($_POST['password'])) {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);

                //Récuperation de l'utilisateur par son EMAIL
                $user = $userManager->getUserByEmail($email);



                //Si l'utilisateur est présent et que son mot de passe est le bon, il se verra connecté
                if ($user) {

                    if ($_SESSION['connexion'] === 'autorise' && password_verify($password, $user->getPassword())) {
                        $_SESSION['role'] = $user->getRole();
                        $_SESSION['user_email'] = $user->getEmail();
                        $_SESSION['user_id'] = $user->getId();



                        $_SESSION['connexion_layout'] = 'autorise';


                        $this->redirect("index.php");
                    } else {
                        $_SESSION['erreur_hash'] = 'Le mot de passe est incorrect';
                        $this->redirect("index.php?route=login");
                    }
                } else {
                    $_SESSION['erreur_mail'] = 'Cette adresse mail n\'a pas été trouvé';
                    $this->redirect("index.php?route=login");
                }
            } else {
                $_SESSION['erreur_remplissage'] = 'Vous devez remplir toutes les informations';
                $this->redirect("index.php?route=login");
            }
        }
    }


    public function checkRegister(): void
    {
        $userManager = new UserManager();
        $tokenManager = new CSRFTokenManager();
        $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[A-Za-z\d!@#$%^&*()-_+=]{8,}$/';


        //Vaalidation du token avant toute chose pour empêcher les faille CSRF
        if ($tokenManager->validateCSRFToken($_POST["csrf_token"])) {

            //Sécurisation des données reçu par le biais du formulaire d'authentification avec le HTMLSPECIALCHARS
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['telephone']) && !empty($_POST['adresse']) && !empty($_POST['code_postal']) && !empty($_POST['ville'])) {

                //Sécurisation du mot de passe avec la RegEx
                if (preg_match($passwordRegex, $_POST['password'])) {
                    $password = htmlspecialchars(password_hash($_POST['password'], PASSWORD_DEFAULT));
                } else {
                    $_SESSION['erreur_regex'] = 'Le mot de passe doit contenir au moins une lettre majuscule ou minuscule, un chiffre, un caractère spécial et doit faire au moins 8 caractères';
                    $this->redirect("index.php?route=register");
                }

                //Initialisation des variables
                $nom = htmlspecialchars($_POST['nom']);
                $prenom = htmlspecialchars($_POST['prenom']);
                $email = htmlspecialchars($_POST['email']);
                $confirmPassword = htmlspecialchars($_POST['confirm_password']);
                $telephone = htmlspecialchars($_POST['telephone']);
                $adresse = htmlspecialchars($_POST['adresse']);
                $codePostal = htmlspecialchars($_POST['code_postal']);
                $ville = htmlspecialchars($_POST['ville']);

                //vérification que les deux mots de passe sont bien identique
                if ($confirmPassword === $_POST['password']) {



                    //Création d'un nouvel utilisateur et insertion en base de donnée
                    $newUser = new User($nom, $prenom, $email, $password, $telephone, $adresse, $codePostal, $ville, 0);

                    $userManager->createUser($newUser);

                    $this->redirect("index.php?route=login");
                } else {
                    $_SESSION['erreur_mdp'] = 'Les mots de passe ne sont pas indentiques';
                    $this->redirect("index.php?route=register");
                }
            } else {
                $_SESSION['erreur_remplissage'] = 'Vous devez remplir toutes les informations';
                $this->redirect("index.php?route=register");
            }
        } else {
            $_SESSION['erreur_csrf'] = 'Erreur de sécurité CSRF';
            $this->redirect("index.php?route=register");
        }
    }


    public function logout(): void
    {
        //destruction de la session afin de déconnécter l'utilisateur
        session_destroy();
        $this->redirect("index.php?route=login");
    }
}
