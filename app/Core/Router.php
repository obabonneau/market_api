<?php

///////////////////////
// CLASSE DE ROUTAGE //
///////////////////////
class Router
{
    ///////////////
    // ATTRIBUTS //
    ///////////////
    private $controller;
    private $action;

    ////////////////////
    // METHODE ROUTES //
    ////////////////////
    public function routes()
    {
        // RECUPERATION DE LA ROUTE (Par défaut, HomeControler->homeAction)
        $this->controller = ($_GET["controller"] ?? "Home") . "Controller";
        $this->action = $_GET["action"] ?? "homeAction";

        // VERIFICATION DE L'EXISTENCE DU CONTROLEUR
        if (file_exists("../app/Controllers/" . $this->controller . ".php")) {

            // UTILISATION DU CONTROLEUR
            require_once "../app/Controllers/" . $this->controller . ".php";

            // VERIFICATION DE L'EXISTANCE DE LA METHODE DANS LE CONTROLEUR
            if (method_exists($this->controller, $this->action)) {

                // INSTANCIATION D'UN OBJET "controller"
                $controller = new $this->controller();

                // UTILISATION D'UNE METHODE DE L'OBJET
                $controller->{$this->action}();

            } else {
// A REVOIR : echo "ERREUR DE PAGE : La méthode '" . $this->action . "' n'existe pas dans le contrôleur '" . $this->controller . "'.";
            }
        } else {
// A REVOIR : echo "ERREUR DE PAGE : Le contrôleur '" . $this->controller . "' n'existe pas.";
        }
    }
}