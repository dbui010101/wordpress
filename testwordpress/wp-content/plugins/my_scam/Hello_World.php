<?php function my_scam(){
    // if (!isset($_POST['envoie'])) {
    ?>
    <h2>Envoyé mail à toutes les personnes qui se sont enregistrées à la soirée afin de leur demander de
vous renvoyer une photo spectaculaire de leur déguisement</h2>
    <form class="" action="admin-post.php" method="post">
      <input type="hidden" name="action" value="mail">
      <button type="submit" name="envoie" value="mailquizfait">Envoyé à ceux qui ont passé un ou plusieurs quiz en particulier</button>
      <button type="submit" name="envoie" value="mailquizpasfait">Qui n’ont pas passé un ou plusieurs quiz en particulier</button>
      <button type="submit" name="envoie" value="mailconnecte">Envoyé à ceux qui se sont connecté au moins une fois depuis 1 mois</button>
      <button type="submit" name="envoie" value="mailpasconnecte">Qui ne se sont pas connecté au moins une fois depuis 1 mois</button>
    </form>

    <?php
    // } else {
      // echo "Email envoyé ✅";
    // }
}
?>
