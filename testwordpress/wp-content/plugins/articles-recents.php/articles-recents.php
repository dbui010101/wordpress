<?php
/*
Plugin Name: Boutons Menus
Plugin URI: http://google.com
Description: Choisis un des deux boutons.
Version: 1.0
Author: Tim
Author URI: http://www.wpexplorer.com/create-widget-plugin-wordpress/
*/

include('crud.php');
class My_Custom_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'my_custom_widget',
            __('Boutons menu', 'text_domain'),
            array(
                'customize_selective_refresh' => true,
            )
        );
    }

    public function form($instance)
    {

        $defaults = array(
            'title'    => '',
            'text'     => '',
            'textarea' => '',
            'checkbox' => '',
            'select'   => '',
        );

        extract(wp_parse_args(( array ) $instance, $defaults)); ?>
	<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['textarea'] = isset($new_instance['textarea']) ? wp_kses_post($new_instance['textarea']) : '';
        return $instance;
    }

    public function widget($args, $instance)
    {
        extract($args);
        global $wpdb;
        $email = &$_GET['email'];
        $categorie = &$_GET['categorie'];
        $check = $wpdb->get_results("SELECT email, valide FROM utilisateurs WHERE email = '${email}'", ARRAY_A);
        $count = $wpdb->get_results("SELECT COUNT(*) as 'count' FROM question WHERE name_quiz = '${categorie}'", ARRAY_A);
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $checkAgent = $wpdb->get_results("SELECT agent FROM visiteurs WHERE agent = '{$agent}'", ARRAY_A);
        if (count($checkAgent) == 0) {
            $wpdb->insert(
                'visiteurs',
                array(
              'agent' => $_SERVER['HTTP_USER_AGENT'],
              'date_visite' => date("Y-m-d H:i:s"),
            )
            );
        }

        if (count($check) !== 0 && isset($_GET['email']) && is_valid($_GET['email']) == 0) {
            if (!isset($_GET['question']) && !isset($_GET['poser']) && !isset($_GET['categorie'])) :
            ?>

          <form class="listeButtonQ" action="" method="get">
              <button type="submit" name="poser" value="hey" class="poser"><div class="posertxt"><span>Je préfère poser les questions</span></div></button>
              <button type="submit" name="categorie" value="1" class="question"><div class="questiontxt"><span>Je préfère donner les réponses</span></div></button>
              <input type="hidden" name="email" value="<?= $_GET['email'] ?>"/>
          </form>

        <?php
      endif;
                if (current_user_can('administrator')) {
                    global $wpdb;
                    $results = $wpdb->get_results("SELECT email FROM `utilisateurs`", ARRAY_A);
                    echo "<div class='emails'>";
                    foreach ($results as $key => $value) {
                        ?>
        <a href="<?="?article=".$value['email']."&email=".$email?>"><?=$value['email']?></a>
        <?php
                    }
                    echo "</div>";
                    echo "<div class='article'>";
                    if (isset($_GET['article'])) {
                        $article = $_GET['article'];

                        echo "<h1>Reponses de <em>" . preg_replace('/(@\[?(.*))/', '', $article) . "</em></h1>";
                        echo "<br>";
                        global $wpdb;
                        $listeCategorie = $wpdb->get_results("SELECT name_quiz.name, COUNT(name_quiz.name) FROM historique INNER JOIN name_quiz ON name_quiz.name = historique.name_quiz INNER JOIN question ON question.id = historique.id_question WHERE email = '{$article}' GROUP by name_quiz.id HAVING COUNT(name_quiz.name) >1", ARRAY_A);
                        for ($i=0; $i < count($listeCategorie); $i++) {
                          echo "<h3>".$listeCategorie[$i]['name']."</h3>";
                          $results = $wpdb->get_results("SELECT * FROM historique INNER JOIN name_quiz ON name_quiz.name = historique.name_quiz INNER JOIN question ON question.id = historique.id_question WHERE email = '{$article}' AND name = '{$listeCategorie[$i]['name']}'", ARRAY_A);
                          foreach ($results as $key => $value) {
                            echo "<h4>".$value['question']."</h4>";
                            echo "<p>".$value['reponse']."</p>";
                            echo "<br>";
                          }
                        }
                        $img = $wpdb->get_results("SELECT image FROM `image` WHERE email = '{$article}'", ARRAY_A);
                        foreach ($results as $key => $value) {
                            ?>
        <?php
                        }
                        if (count($img) !== 0) {
                          ?>
                          <img src="<?= $img[0]['image'] ?>" alt="img">
                          <?php
                        } else {
                          echo "<p>La personne n'as pas encore envoyer une image de sa soirée";
                        }
                    }
                    echo "</div>";
                }

            ?>
            <?php
            if (isset($_GET['categorie']) && !isset($_GET['question'])) {
              $cat = $wpdb->get_results("SELECT id,name FROM name_quiz", ARRAY_A);
  $ima = ['cauch','vampire','sang'];
  echo "<div class='listeButton'>";
  foreach ($cat as $x => $value) {
    ?>
    <div class="<?=$ima[$x]?>">
      <form class="catChoix" action="" method="get">
        <input type="hidden" name="email" value="<?=$_GET['email']?>">
        <input type="hidden" name="categorie" value="<?=$value['name']?>">
        <input type="hidden" name="question" value="1">
        <button class='questiontxtCat'><?=$value['name']?></button></div>
      </form>
    <?php
  }
  echo "</div>";
            }
            elseif (isset($_GET['question']) && $_GET['question'] +1 !== $count[0]['count'] +1) {
                $storeQ = addslashes(read($_GET['question'], $_GET['categorie']));
                $nbrQ = $wpdb->get_results("SELECT COUNT(name_quiz) FROM question WHERE name_quiz = '{$storeQ}'", ARRAY_A);
                $idQ = $wpdb->get_results("SELECT id FROM question WHERE question = '{$storeQ}' ", ARRAY_A);
                if (isset($_GET['reponse'])) {
                    $wpdb->insert('historique',
                    array( 'email' => $_GET['email'],
                    'id_question' => $idQ[0]['id'],
                    'reponse' => $_GET['reponse'],
                    'name_quiz' => $_GET['categorie'
                    ]));
                    $_GET['question']=$_GET['question'] +1;
                }
                ?>
							<div class="column">
								<div class="col-sm-4">
									<div class="card" >
										<div class="card-body">
											<h5 class="card-title"><?= read($_GET['question'], $_GET['categorie']); ?>
											</h5>
											<form class="" action="" method="get">
												<textarea autofocus="true" class="widefat" name="reponse"></textarea>
												<input type="hidden" name="email" value="<?= $_GET['email'] ?>">
												<input type="hidden" name="question" value="<?= $_GET['question'] ?>">
												<input type="hidden" name="id" value="<?= $idQ[0]['id'] ?>">
												<input type="hidden" name="categorie" value="<?= $_GET['categorie'] ?>">
												<button type="submit">Valider</button>
											</form>
										</div>
									</div>
								</div>
							</div>
<?php
            } elseif (isset($_GET['question'])) {
              $storeQ = addslashes(read($_GET['question'], $_GET['categorie']));
              $idQ = $wpdb->get_results("SELECT id FROM question WHERE question = '{$storeQ}' ", ARRAY_A);
                update($_GET['email']);
                update_quiz($_GET['email']);
                $wpdb->insert('historique', array( 'email' => $_GET['email'], 'id_question' => $idQ[0]['id'] , 'reponse' => $_GET['reponse'], 'name_quiz' => $_GET['categorie']));
                ?>
                <div class="fin">
                  <h1>Dernier mission</h1><p>Envoyer nous une photo spectaculaire de votre déguisement !<p>
                    <p><em>Nous allons vous envoyer un mail 📨</em>
                      <form action="">
                        <button type="submit">Terminé</button>
                      </form>
                    </div>
  <?php
            } elseif (isset($_GET['poser'])) {
                if (isset($_GET['poser']) && !isset($_GET['questionambarassante'])) {
                    ?>
                    <form class="qa" action="" method="get">
                      <h2>Pose moi une question ambarrasante !</h2>
                      <textarea name="questionambarassante" rows="8" cols="80"></textarea>
                      <input type="hidden" name="poser" value="">
                      <input type="hidden" name="email" value="<?= $_GET['email']?>">
                      <br>
                      <button type="submit">OK</button>
                    </form>
  <?php
                } else {
                    if (isset($_GET['questionambarassante'])) {
                        create_question_db($_GET['questionambarassante']); ?>
      <form class="qa" action="<?= $_SERVER['PHP_SELF']?>" method="get">
      <h1>🎃 Rien ne m'embarasse ! 🎃</h1>
      <input type="hidden" name="email" value="<?= $_GET['email']?>">
      <button type="submit">Retour</button>
      </form>
    <?php
                    }
                }
            }
} elseif (isset($_GET['inscription'])) {
    if (isset($_GET['emailinscription']) && isset($_GET['nominscription'])) {
        create_user_db($_GET['emailinscription'], $_GET['nominscription']); ?>

  <div class="blockis">
     <h1>Vous êtes désormais inscrit</h1>
              <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                  <button type="submit">Se connecter</button>
              </form>
  </div>
              <?php
    } else {
        ?>
        <div class="blockis">
          <form action="" class="is">
            <h1>Inscription</h1>
            <input type="email" name="emailinscription" placeholder="Email">
            <input type="text" name="nominscription" placeholder="Nom" value="">
            <input type="hidden" name="inscription">
            <button type="submit">Enregistrer</button>
          </form>
        </div>

  <?php
    }
} else {
    ?>
            <div class="sidebar">
						<form class="inscription" action="" method="get">
                <input type="text" name="email" placeholder="VOTRE EMAIL"/>
                <button type="submit">Entrer</button>
            </form>
							<em>Pas d'invitation ?</em>
              <form class="" action="" method="get">
                  <button type="submit" name="inscription" value="test">S'inscrire</button>
              </form>

            <div>
  <?php
}
        echo $before_widget;
        echo '<div class="widget-text wp_widget_plugin_box">';
        echo '</div>';
        echo $after_widget;
    }
}

function my_register_custom_widget()
{
    register_widget('My_Custom_Widget');
}
add_action('widgets_init', 'my_register_custom_widget');
