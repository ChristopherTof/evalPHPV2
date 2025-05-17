<?php
//LA VIEW POUR LA CLASS ViewPlayer
class ViewPlayer
{

    private ?string $signUpMessage = "";
    private ?string $playerList = "";

    public function getSignUpMessage(): ?string
    {
        return $this->signUpMessage;
    }

    public function setSignUpMessage(?string $signUpMessage): self
    {
        $this->signUpMessage = $signUpMessage;
        return $this;
    }

    public function getPlayerList(): ?string
    {
        return $this->playerList;
    }

    public function setPlayerList(?string $playerList): self
    {
        $this->playerList = $playerList;
        return $this;
    }


    //METHOD
    public function displayView(): string
    {
        ob_start()
?>
        <h1>
            Accueil
        </h1>

        <h2>Iscription d'un joueur</h2>

        <form action="" method="POST">
            <input type="text" id="pseudo" name="pseudo" placeholder="Votre pseudo" />
            <input type="text" id="email" name="email" placeholder="Votre email" />
            <input type="password" id="password" name="password" placeholder="Votre password" />
            <input type="number" id="score" name="score" placeholder="Votre score" />
            <button type="submit" name="signup">Envoyer</button>
        </form>
        <?= $this->signUpMessage ?>

        <h2>Liste des participants</h2>

<?php
        echo $this->playerList;
        return ob_get_clean();
    }
}
