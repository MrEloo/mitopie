<?php abstract class AbstractController
{
    private \Twig\Environment $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());


        //Ajout de la session pour qu'elle soit facilement accessible avec twig
        $twig->addGlobal('session', $_SESSION);

        $this->twig = $twig;
    }

    protected function render(string $template, array $data): void
    {
        echo $this->twig->render($template, $data);
    }

    //Fonction de redirection
    protected function redirect($route)
    {
        header("Location: $route");
        exit();
    }

    protected function isUserOrAdmin(): ?bool
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'USER' || $_SESSION['role'] === 'ADMIN') {
                return true;
            }
        } else {
            return null;
        }
    }

    //Fonction qui check si le role de l'utilisateur est bien ADMIN
    protected function checkAdmin(): ?bool
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'ADMIN') {
                return true;
            }
        } else {
            return null;
        }
    }

    /**
     * Get the value of twig
     */
    public function getTwig()
    {
        return $this->twig;
    }

    /**
     * Set the value of twig
     *
     * @return  self
     */
    public function setTwig($twig)
    {
        $this->twig = $twig;

        return $this;
    }
}
