<?php

namespace blog\app\views;

class categorie extends \blog\app\controllers\categorie
{

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

        foreach ($table as $key => $value) {
            echo "<option value='$value'>$value</option>";
        }
    }

    public function showFiltre()
    {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat->showAllNavBar();

        foreach ($table as $key => $value) {
            echo "<a href='articles.php?categorie=$key'>$value</a><br>";
        }
    }

    public function listCategorieAdmin()
    {
        $categories = $this->getAllCat();
        $tbody = "";
        foreach ($categories as $categorie) {
            $tbody = $tbody . <<<HTML
<tr>
    <td>{$categorie['id']}</td>
    <td>{$categorie['nom']}</td>
    <td><a href="{$_SERVER['PHP_SELF']}?delCat={$categorie['id']}">Supprimer 
    la categorie</a></td>
</tr>
HTML;
        }
        return $tbody;
    }

    public function tableCategorie()
    {
        $tbody = $this->listCategorieAdmin();
        $vue = <<<HTML
<h2>Liste des articles</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Supprimer la categorie</th>
        </tr>
    </thead>
    <tbody>
        {$tbody}
    </tbody>
</table>
HTML;
        echo $vue;
    }

}

