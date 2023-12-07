<?php

namespace App\src;

use App\src\Controller\TwigController;

/**
 * Class Noyau Routeur 
 */
class Kernel extends TwigController
{
    public function start()
    {
        var_dump($_SERVER["PATH_INFO"]);
        //Je declare un tableau qui contiendra les paramétres url recuperer grace a la super global server
        $params = [];
        //je créer un tableau qui contiendra les valeurs de path_info puis j'indique le separateur / afin de recuperer le nom de la route passer en paramétre GET
        $params = explode("/", $_SERVER["PATH_INFO"]);
        var_dump($params);
        //Je conditionne mon routeur sur le paramétre 1 de mon url 
        if (isset($params[1]) && !empty($params[1]) && $params[1] != '/') {
            //Je créer un namespace afin de charger les controllers qui permettrons d'afficher les templates associé a la route passé en paramétre
            $controller = "\\App\\src\\Controller\\" . ucfirst($params[1]) . "Controller";
            var_dump($controller);
            //var_dump($params);
            //Je recupére le paramétre 2 de mon url qui me permettra de faire reference aux methodes du controller cible
            $method = (isset($params[2])) ? $params[2] :  "index";
            var_dump($method);
            //J'utilise le paramétre 3 afin de faire transité une data 
            $data = (isset($params[3])) ? $params[3] :  null;
            var_dump($data);
            $controllers = new $controller();
            if (method_exists($controllers, $method)) {
                $controllers->$method($params[3]);
            } else {
                http_response_code(404);
                echo 'Désoler aucune méthode nommé ' . $method . ' n\éxiste dans le controller ' . ucfirst($params[1]) . 'Controller';
            }
        } else {
            $controller = new TwigController();
            $controller->index();
        }
    }
}
