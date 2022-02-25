<?php

/**
 * Reproduisez les tables présentes dans le fichier image ( via workbench ou phpmyadmin )
 * Ajoutez des donées dans chaque table en vous assurant d'ajouter au moins 1 fois un utilisateur identique dans deux tables.
 * Utilisez UNION pour récupérer les usernames de chaque table, affichez le résultat à l'aide d'un print_r ou d'une boucle.
 * Utilisez UNION ALL pour afficher toutes les données y compris les doublons, affichez le résultat  à l'aide d'une boucle ou d'un print_r.
 * PS: Si vous utilisez un print_r, alors utilisez la balise <pre> pour un résultat plus propre.
 */

try {
    $server = 'localhost';
    $db = 'exo_205';
    $user = 'root';
    $password = '';

    $pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Avec Union
    $request = $pdo->prepare("
        SELECT username FROM admin
        UNION 
        SELECT username FROM client
        UNION
        SELECT username FROM user
    ");

    $request->execute();
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";

    // Avec Union all
    $request = $pdo->prepare("
        SELECT username FROM admin
        UNION ALL 
        SELECT username FROM client
        UNION ALL  
        SELECT username FROM user
    ");

    $request->execute();
    echo "<pre>";
    print_r($request->fetchAll());
    echo "</pre>";
}

catch (Exception $exception) {
    echo $exception->getMessage();
}