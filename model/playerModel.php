<?php
//MODEL POUR LA CLASS ModelPlayer

class ModelPlayer implements InterfaceModel
{

    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?string $password;
    private ?int $score;
    private ?PDO $bdd;

    //constructeur
    public function __construct()
    {
        $this->bdd = connect();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;
        return $this;
    }

    public function getBdd(): ?PDO
    {
        return $this->bdd;
    }

    public function setBdd(?PDO $bdd): self
    {
        $this->bdd = $bdd;
        return $this;
    }

    //METHODS

    public function add(): string
    {
        try {
            //Préparation de la requête
            $req = $this->getBdd()->prepare(
                "INSERT INTO players (pseudo,email,score,psswrd) VALUES (?,?,?,?)"
            );

            $pseudo = $this->getPseudo();
            $email = $this->getEmail();
            $score = $this->getScore();
            $psswrd = $this->getPassword();

            //Récupération sécurisé des données
            $req->bindParam(1, $pseudo, PDO::PARAM_STR);
            $req->bindParam(2, $email, PDO::PARAM_STR);
            $req->bindParam(3, $score, PDO::PARAM_INT);
            $req->bindParam(4, $psswrd, PDO::PARAM_STR);
            //Envoi en BDD
            $req->execute();

            return "<p>" . $this->getPseudo() . " a bien été enregistré</p>";
        } catch (Exception $e) {
            echo $e->getMessage();
            return "Un erreur s'est produit à l'enregistrement. Veuillez réessayer.";
        }
    }

    public function getAll(): array | null
    {
        try {
            //Préparation de la requête
            $req = $this->getBdd()->prepare(
                "SELECT pseudo, email, score, psswrd FROM players"
            );
            // Execution de la requête
            $req->execute();

            //Récupération des données
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
    public function getByEmail(): array | null
    {
        try {
            //Préparation de la requête
            $req = $this->getBdd()->prepare(
                "SELECT pseudo, email, score, psswrd FROM players WHERE email = ? LIMIT 1"
            );

            $email = $this->getEmail();
            $req->bindParam(1, $email, PDO::PARAM_STR);
            // Execution de la requête
            $req->execute();

            //Récupération des données
            $data = $req->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}
