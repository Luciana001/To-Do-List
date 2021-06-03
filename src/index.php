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
        <article class="container-fluid col-4">
            <div class="row ">
                <?php if ($name) : ?>
                    <h3>Bonjour <?= htmlentities($name).","; ?></h3>
                    <section class="justify-content-center">
                        <form action="" method="GET">
                            <?php
                            $taches = [];
                            $status = [];
                            if (isset($_GET['taches'])) {
                                $taches = $_GET['taches'];
                                $status = $_GET['status'];
                            }
                            if (isset($_GET['add'])) {
                                if (isset($_GET['tache'])) {
                                    $taches[] = $_GET['tache'];
                                    $status[] = "To Do";
                                }
                            }
                            if (isset($_GET['done'])) {
                                if ($status[$_GET['done']] === "To Do") {
                                    $status[$_GET['done']] = "Done";
                                } else $status[$_GET['done']] = "To Do";
                            }
                            if (isset($_GET['delete'])) {
                                unset($taches[$_GET['delete']]);
                                unset($status[$_GET['delete']]);
                            }

                            if (isset($_GET['clear-all'])) {
                                foreach ($taches as $key => $tache) {
                                    unset($taches[$key]);
                                    unset($status[$key]);
                                }
                            }
                            ?>
                            <div class="mb-5">
                                <h4>Ta To-Do List:</h4>
                                <ul>
                                    <?php foreach ($taches as $key => $tache) : ?>
                                        <div class="col-6">
                                        <li >
                                            <input type="hidden" name="taches[]" value="<?= $tache ?>">
                                            <input type="hidden" name="status[]" value="<?= $status[$key] ?>">
                                            <h6><?php echo $tache . " || " . $status[$key]; ?>
                                            <button type="submit" class="btn-md btn-success border col-2" name="done" value="<?= $key ?>">V</button>
                                            <button type="delete" class="btn-md btn-danger border-radius col-2" name="delete" value="<?= $key ?>">X</button>
                                            </h6>
                                        </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            </div>
                            <div class="row justify-content-md-center">
                            <div class="form-group mb-5">
                                <input class="form-control " name="tache" placeholder="Entrer une nouvelle tâche...">
                                <button name="add" class="btn-md btn-primary">Ajouter</button>
                            </div>
                            <div class="mb-5 col-3">
                                <button type="delete" class="btn-md btn-danger" name="clear-all">Clear All</button>
                            </div>
                        </form>
                    </section>
                    <a href="index.php?action=disconnect">Disconnect</a>
                <?php else : ?>
                    <h1>Connexion</h1>
                    <section>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input name="user" class="form-control" placeholder="user">
                            </div>
                            <button class="btn-md btn-secondary">Connect</button>
                        </form>
                    </section>
                <?php endif; ?>
            </div>
        </article>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>