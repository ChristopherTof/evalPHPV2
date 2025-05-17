<?php
class PlayerController extends AbstractController
{

    private ?ViewPLayer $player;

    //Constructeur
    public function __construct(?ViewHeader $header, ?ViewFooter $footer, ?InterfaceModel $model, ?ViewPLayer $player)
    {
        parent::__construct($header, $footer, $model);
        $this->player = $player;
    }

    public function getPlayer(): ?ViewPLayer
    {
        return $this->player;
    }
    public function setPlayer(?ViewPLayer $player): self
    {
        $this->player = $player;
        return $this;
    }

    //METHOD

    public function addPLayer()
    {
        //Ici, on récupérer les données du form pour les envoyé en BDD
        //Vérification que le formulaire a été envoyé
        if (isset($_POST["signup"])) {
            //Vérification que les champs sont bien remplis
            if (empty($_POST["pseudo"]) || empty($_POST["email"]) || empty($_POST["score"]) || empty($_POST["password"])) {
                return "Merci de remplir les champs vides";
            }
            //Netoyage des champs avant envoi en BDD
            $pseudo = sanitize($_POST["pseudo"]);
            $email = sanitize($_POST["email"]);
            $score = sanitize($_POST["score"]);
            $password = sanitize($_POST["password"]);

            //Vérification que l'utilisateur n'est pas déjà existant 
            $checkmail = $this->getModel()->setEmail($email)->getByEmail();
            if ($checkmail) {
                return "User dejà existant";
            };
            // Si l'utilisateur n'existe pas, on hash le password 
            $password = password_hash($password, PASSWORD_BCRYPT);

            //Envoi des datas à la BDD + initialisation du message retourné
            $message = $this->getModel()
                ->setPseudo($pseudo)
                ->setEmail($email)
                ->setPassword($password)
                ->setScore($score)
                ->add();
            // on retourne le message de la BDD
            return $message;
        }
    }

    public function getAllPlayers(): string
    {
        //Récupération de la liste des utilisateurs
        $data = $this->getModel()->getAll();
        // Création d'une liste d'utilisateur avec les données récupérées
        ob_start();
        foreach ($data as $player) {
?>
            <h3> <?= $player["pseudo"] ?> </h3>
            <p><?= $player["email"] ?> </p>
            <p><?= $player["score"] ?> </p>
            <hr>
<?php
        };
        return ob_get_clean();
    }

    public function render(): void
    {
        $message = $this->addPlayer();
        $list = $this->getAllPlayers();

        echo $this->getHeader()->displayView();
        echo $this->getPlayer()->setSignUpMessage($message)->setPlayerList($list)->displayView();;
        echo $this->getFooter()->displayView();;
    }
}
