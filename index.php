<?php
//FICHIER D'EXECUTION

include "./env.php";
include "./utils/utils.php";
include "./view/header.php";
include "./view/footer.php";
include "./view/viewPlayer.php";

include "./abstract/abstractController.php";
include "./interface/interfaceModel.php";
include "./model/playerModel.php";
include "./controller/playerController.php";




$player = new playerController(new ViewHeader(), new ViewFooter(), new ModelPlayer(connect()), new ViewPlayer());

$player->render();
