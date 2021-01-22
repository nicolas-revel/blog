<?php

namespace blog\app\views;

class categorie extends \blog\app\controllers\categorie
{

    public function showNameCategorie()
    {
        $controlCat = new \blog\app\controllers\categorie();
        $table = $controlCat->showAllNavBar();

        foreach ($table as $key => $value) {
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

        foreach($table as $key => $value) {
            echo "<a id='filtre_categorie' href='articles.php?categorie=$key'>$value</a><br>";
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
    <td><a href="{$_SERVER['PHP_SELF']}?delCat={$categorie['id']}">Supprimer</a></td>
    <td><a href="{$_SERVER['PHP_SELF']}?table=cat&filter=Filtrer&modifcat={$categorie['id']}">Modifier</a></td>
</tr>
HTML;
        }
        return $tbody;
    }

    public function tableCategorie()
    {
        $tbody = $this->listCategorieAdmin();
        $vue = <<<HTML
<div class="tableAdmin">
<h2 id="title_table">Liste des catégories</h2>
<br>
<table id="table_ad">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Supprimer la categorie</th>
            <th>Modifier la categorie</th>
        </tr>
    </thead>
    <tbody id="table_body">
        {$tbody}
    </tbody>
</table>
</div>
HTML;
        echo $vue;
    }

}

