<?php
$name = null;
if (!empty($_GET['action']) && $_GET['action'] === 'disconnect') { //supprimer le cookie
    unset($_COOKIE['user']); //delete la variable mais pas les donnees ds le navigateur
    setcookie('user', '', time() - 10); //creer un cookie vide dans le passé --> vide le navigateur
}
if (!empty($_COOKIE['user'])) { //lire le cookie
    $name = $_COOKIE['user'];
}
if (!empty($_POST['user'])) { //creer 1 cookie avec setcookie
    setcookie('user', $_POST['user']);  //HEADERS 1er : clé, 2eme: valeur, 3eme: date(du jour), 4eme: date d expire (si rien expire a la fermeture du navigateur)
    $name = $_POST['user']; //nom entré par l utilisateur --> htmlentities --> securité
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>To Do List</title>
</head>

<body>
    <main>
        <article class="container-fluid col-8">
            <div class="row">
                <?php if ($name) : ?>
                    <h1>Bonjour <?= htmlentities($name); ?></h1>
                    <section>
                        <div class="">
                            <h2>Votre To Do List:</h2>
                            <ul>
                                <li></li>
                            </ul>
                        </div>
                        <form action="" method="GET">
                            <div class="form-group">
                                <input class="form-control " name="tache" placeholder="Entrer une nouvelle tâche...">
                                <button name="add" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </section>
                    <a href="profil.php?action=disconnect">Disconnect</a>
                <?php else : ?>
                    <h1>Connexion</h1>
                    <section>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input name="user" class="form-control" placeholder="user">
                            </div>
                            <button class="btn btn-secondary">Connect</button>
                        </form>
                    </section>
                <?php endif; ?>
            </div>
        </article>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>