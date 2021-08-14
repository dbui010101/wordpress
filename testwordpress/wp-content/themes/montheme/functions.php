<?php



function montheme_supports(){
     add_theme_support('title-tag');
     add_theme_support('post-thumbnails');

}

function montheme_register_asset(){



    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js',['popper'],false,true);
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js',[],false,true);
    wp_enqueue_style('bootstrap');
    /*wp_enqueue_style('nomaupif', get_stylesheet_uri(), array(),null);/* ajoute style.css et met aussi <?php wp_head()?> dans header */
    wp_enqueue_style('cssnomTheme', get_theme_file_uri('nomTheme.css'), array(),null,false);// mettre false sinon en bas et donc erreur
    wp_enqueue_script('jsnomTheme', get_theme_file_uri('js/nomTheme.js'), array(),null,true);// ajouter un script js avec true qui va mettre la balise  script en bas
    wp_enqueue_script('bootstrap');
    wp_localize_script( 'capitaine', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

    // wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css');
    // wp_register_script('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js',['popper','jquery'], false ,true);
    // wp_register_script('popper','https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js',[],false,true);
    wp_deregister_script('jquery');
    wp_register_script('jquery','https://code.jquery.com/jquery-3.5.1.slim.min.js',[],false,true);

    // wp_enqueue_style('bootstrap');
    // wp_enqueue_script('bootstrap');

}


function desktop_register_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'textdomain' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'desktop_register_widgets_init' );
add_action('after_setup_theme','montheme_supports');
add_action('wp_enqueue_scripts','montheme_register_asset');

function insert() {
    //status_header(200);
    if( (isset($_POST["mail"])) &&  (isset ($_POST["nom"])) && (!empty($_POST["mail"])) && (!empty($_POST["nom"]))
        && (isset($_POST['ins'])) &&  (!empty($_POST['ins']))
    ){
        global $wpdb;
        $email=$_POST['mail'];
        $nom=$_POST['nom'];
        $wpdb->insert(
            'utilisateurs',
            array(
                'email' => $email,
                'nom' => $nom,
                'valide' => 0,
                'agent' => $_SERVER['HTTP_USER_AGENT'],
                'roles' => '[]',
            )
        );
    }
    $adminurl=admin_url();
    header('Location: '.$adminurl.'');


}

add_action( 'admin_post_insert', 'insert' );

//this next action version allows users not logged in to submit requests
//if you want to have both logged in and not logged in users submitting, you have to add both actions!
//add_action( 'admin_post_nopriv_insert', 'insert' );



function mettre_a_jour() {
    //status_header(200);
    if( (isset($_POST["email"])) &&  (isset ($_POST["nom"])) && (!empty($_POST["email"])) && (!empty($_POST["nom"]))
        && (isset($_POST['upd'])) &&  (!empty($_POST['upd']))
    ){
        global $wpdb;
        $table_name='utilisateurs';
        $id=$_POST['id'];
        $nom=$_POST['nom'];
        $email=$_POST['email'];
        $wpdb->update(
            $table_name,
            array(
                'nom'=>$nom,
                'email'=>$email,
            ),
            array(
                'id'=>$id
            )

        );
    }
    $adminurl=admin_url();
    header('Location: '.$adminurl.'');



}

add_action( 'admin_post_update', 'mettre_a_jour' );


add_action( 'wp_ajax_load_comments', 'capitaine_load_comments' );

function capitaine_load_comments() {
    if( (isset($_POST['id'])) &&  (!empty($_POST['id']))
    ){
    global $wpdb;
    $table_name='utilisateurs';
    $id=$_POST['id'];
    $wpdb->delete(
        $table_name,
        array(
            'id'=>$id
        )

    );
}
    wp_die();
}

function add_quizz() {

    if( (isset($_POST["nombre"])) &&  (!empty($_POST["nombre"])) && (isset($_POST['name_quiz'])) && (!empty($_POST['name_quiz']))
        && (isset($_POST['quizz'])) &&  (!empty ($_POST['quizz']))
    ){


        global $wpdb;
        for($i=1;$i<=$_POST['nombre'];$i++){
            $question=$_POST['question'.$i];
            $name_quiz=$_POST['name_quiz'];
            $wpdb->insert(
                'question',
                array(
                    'question' => stripslashes($question),
                    'name_quiz' => $name_quiz,
                )
            );
        }
        $wpdb->insert(
            'name_quiz',
            array(
                'name' => $name_quiz,
            )
        );

    }
    $adminurl=admin_url();
    header('Location: '.$adminurl.'');


}

add_action( 'admin_post_quizz', 'add_quizz' );

function mettre_a_jour_quizz() {

    if(  (isset($_POST['upd_quizz'])) &&  (!empty ($_POST['upd_quizz']))
    ){
        global $wpdb;
        $table_name='question';
        $id=$_POST['id'];


        for($i=1;$i<=$id;$i++){
            if(isset($_POST['question'.$i])  && (!empty($_POST['question'.$i])) && empty($_POST['delete'.$i]) ){
            $question=$_POST['question'.$i];
            $wpdb->update(
                $table_name,
                array(
                    'question'=>$question,
                ),
                array(
                    'id'=>$i
                )

            );
            }elseif(isset($_POST['delete'.$i]) && $_POST['delete'.$i]=="on" ){
                $wpdb->delete(
                    $table_name,
                    array(
                        'id'=>$i
                    )

                );
            }


        }


        for($i=1;$i<=$_POST['nb_question_add'];$i++){
            $question=$_POST['question_add'.$i];
            $name_quiz=$_POST['name_quiz'];
            $wpdb->insert(
                'question',
                array(
                    'question' => $question,
                    'name_quiz' => $name_quiz,
                )
            );
        }

    }
    $adminurl=admin_url();
    header('Location: '.$adminurl.'');



}
add_action( 'admin_post_update_quizz', 'mettre_a_jour_quizz' );




add_action( 'wp_ajax_delete_quizz', 'deletequizz' );

function deletequizz() {
    if( (isset($_POST['id_quizz'])) &&  (!empty ($_POST['id_quizz']))
    ){
        global $wpdb;
        $table_name='name_quiz';
        $id=$_POST['id_quizz'];
        $result=$wpdb->get_results("SELECT name from $table_name where id=$id");
        $name_quiz=$result[0]->name;
        $wpdb->delete(
            'question',
            array(
                'name_quiz'=>$name_quiz
            )
        );


        $wpdb->delete(
            $table_name,
            array(
                'id'=>$id
            )
        );
        $wpdb->delete(
          'historique',
        array(
        'name_quiz'=>$name_quiz
      )
    );


    }
    wp_die();
}



add_action( 'admin_post_mail', 'envoi_mail' );

function envoi_mail()
{
require("mail/sendgrid-php.php");
global $wpdb;

  switch ($_POST['envoie']) {
    case 'mailquizfait':
    $utilisateurs = $wpdb->get_results("SELECT email FROM utilisateurs WHERE valide = 1", ARRAY_A);
      break;
    case 'mailquizpasfait':
    $utilisateurs = $wpdb->get_results("SELECT email FROM utilisateurs WHERE valide = 0", ARRAY_A);
      break;
    case 'mailconnecte':
    $utilisateurs = $wpdb->get_results("SELECT email from utilisateurs WHERE date_quiz >=NOW() - INTERVAL 1 MONTH", ARRAY_A);
      break;
    case 'mailpasconnecte':
    $utilisateurs = $wpdb->get_results("SELECT email from utilisateurs WHERE date_quiz <=NOW() - INTERVAL 1 MONTH", ARRAY_A);
      break;
  }
$email = new \SendGrid\Mail\Mail();
$email->setFrom("timothee.hennequin@epitech.eu", "Timothée");
$email->setSubject("PHOTO SOIRÉE");
foreach ($utilisateurs as $utilisateur) {
$email->addTo($utilisateur['email'], "Pi");
}
$email->addContent("text/plain", "SOIRÉE");
$email->addContent(
    "text/html", "<strong>Envoyé nous une photo spectaculaire de votre déguisement de la soirée !</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
    echo "hello<br>";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}

$adminurl="admin.php?page=my_scam";
header('Location: '.$adminurl.'');

}


add_action( 'admin_post_image', 'upload_image' );

function upload_image()
{
  require_once(ABSPATH.'wp-admin/includes/file.php');
  $image = base64_encode(file_get_contents($_FILES['img']['tmp_name']));
  $email = $_POST['utilisateur'];
  global $wpdb;
    $wpdb->insert(
      'image',
      array(
          'email' => $email,
          'image' => "data:image/png;base64,".$image
      )
  );
  $adminurl="admin.php?page=Hello_World";
  header('Location: '.$adminurl.'');
}
