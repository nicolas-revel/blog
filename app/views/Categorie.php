<?php

namespace blog\app\views;

require('../app/controllers/Categorie.php');

class categorie {

    public function showNameCategorie()
    {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat->showAllNavBar();

        foreach($table as $key => $value) {
            echo "<li><a id='drop' class='dropdown-item' href='articles.php?categorie=$key'>$value</a></li>";
        }
    }

    public function showNameCategorieForm()
    {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat->showAllNavBar();

        foreach($table as $key => $value) {
            echo "<option value='$value'>$value</option>";
        }
    }

    public function showFiltre() {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat-> showAllNavBar();

        foreach($table as $key => $value) {
            echo "<a href='articles.php?categorie=$key'>$value</a><br>";
        }
    }



    }

