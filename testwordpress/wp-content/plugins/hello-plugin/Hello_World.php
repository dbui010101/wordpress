<?php function Hello_World(){
    // if (!isset($_POST['envoie'])) {
    ?>
    <h2>Ajouter une photo à un article</h2>
    <form class="" action="admin-post.php" enctype="multipart/form-data" method="post">
      <input type="hidden" name="action" value="image">
      <input type="file" name="img">
      <input type="text" name="utilisateur" placeholder="email de l'utilisateur cible / article"/>
      <button type="submit" name="envoie" value="ok">Ajouter</button>
    </form>
    <?php
    // } else {
      // echo "Email envoyé ✅";
    // }
}
?>
