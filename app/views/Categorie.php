<?php

namespace blog\app\views;

require('../app/controllers/Categorie.php');

class categorie {

    public function showNameCategorie()
    {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat->showAllNavBar();

        foreach($table as $key => $value)
        {
            echo "<li><a class='dropdown-item' href=''>".$value."</a></li>";
        }

    }

}