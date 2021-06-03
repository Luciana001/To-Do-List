<?php
// - demander à l utilisateur sa date de naissance
// - Persister la date de naissance dans un cookie
// - Si l'utilisateur a plus de 18 ans lui montré le contenu du site
// - Sinon on affiche un message d'erreur
$bday= null;
if(!empty($_GET['action']) && $_GET['action']==="retour") {
    unset($_COOKIE['date']);
    setcookie('date','',time()-10);
}
if (!empty($_COOKIE['date'])) {
    $bday = $_COOKIE['date'];
}

if(!empty($_POST['date'])) {
    setcookie('date',$_POST['date']);
    $bday = $_POST['date'];
}

?>
<?php if($bday <= date('Y-m-d',strtotime("-18year")) && !empty($bday)) :?>
<div> 
    <p>Bien Joué tu es un(e) grand(e) !!</p>
</div>
<?php elseif($bday > date('Y-m-d',strtotime("-18year")) && !empty($bday)) : ?>
    <div>
        <p>Oh non quel dommage ! </p>
        <p>Mange ta soupe et reviens plus tard ....</p>
    </div>
    <a href="index.php?action=retour">Retour</a>
<?php else: ?>
<form action="" method="POST">
  <div>
    <label for="date">Veuillez entrer votre date de naissance :</label>
    <input type="date" name="date" min="<?= date('Y-m-d',strtotime("-100year"))?>" max="<?= date('Y-m-d',strtotime("-10year"))?>">
    <input type="submit">
  </div>
</form>
<?php endif;?>

