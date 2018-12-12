<?php

$base = __DIR__;
require_once("$base/model/autor.class.php");
$autor = new Autor();
$res = $autor->getAll();
if ($res->correcta) {
    foreach ($res->dades as $row) {
        echo $row['id_aut'] . "-" . $row['nom_aut'] . " " . $row["fk_nacionalitat"] . "<br>";
    }
} else {
    echo $res->missatge;
}

$autor->insert(array("nom_aut" => "Tomeu Campaner", "fk_nacionalitat" => "MURERA"));   //produira un error
if (!$res->correcta) {
    echo "Error insertant<br>";  // Error per l'usuari
    error_log($res->missatge, 3, "$base/log/errors.log");  // Error per noltros
}

$res = $autor->get(25);
if ($res->correcta) {
    $row = $res->dades;
    echo $row['id_aut'] . "-" . $row['nom_aut'] . " " . $row["fk_nacionalitat"] . "<br>";
} else {
    echo $res->missatge;
}

$res = $autor->update(array("id_aut" => "6553", "nom_aut" => "tofol", "fk_nacionalitat" => "espanyol"));
if (!$res->correcta) {
    echo "Error al modificar<br>";
    error_log($res->missatge, 3, "$base/log/errors.log");
}

$res = $autor->update(array("id_aut" => "6552", "nom_aut" => "tofol 2", "fk_nacionalitat" =>NULL));
if (!$res->correcta) {
    echo "Error al modificar<br>";
    error_log($res->missatge, 3, "$base/log/errors.log");
} 

/*$res = $autor->delete("6552");
if (!$res->correcta) {
    echo "Error al eliminar<br>";
    error_log($res->missatge, 3, "$base/log/errors.log");
}*/

$res = $autor->filtra("WHERE NOM_AUT like '%jordi%'", "NOM_AUT", 2, 10);
if ($res->correcta) {
    foreach ($res->dades as $row) {
        echo $row['id_aut'] . "-" . $row['nom_aut'] . " " . $row["fk_nacionalitat"] . "<br>";
    }
} else {
    echo "Error al cercar<br>";
    error_log($res->missatge, 3, "$base/log/errors.log");
}
