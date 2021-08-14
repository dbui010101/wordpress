<?php function my_stats(){
      global $wpdb;
      $table_name ='visiteurs';
      $year=date("Y");
      $month=date("m");
      /*1 : Dimanche
      2 : Lundi
      3 : Mardi
      4 : Mercredi
      5 : Jeudi
      6 : Vendredi
      7 : Samedi*/


      $checkAgent = $wpdb->get_results("SELECT agent from $table_name");
      $allVisiteurs = count($checkAgent);
      $yearVisiteurs = $wpdb->get_results("SELECT date_visite from $table_name WHERE YEAR(date_visite)=$year");
      $yearVisiteurs = count($yearVisiteurs);
      $monthVisiteurs = $wpdb->get_results("SELECT date_visite from $table_name WHERE MONTH(date_visite)=$month AND YEAR(date_visite)=$year");
      $monthVisiteurs = count($monthVisiteurs);
      $weekVisiteurs = $wpdb->get_results("SELECT date_visite from $table_name
      WHERE date_visite >=
      CASE WHEN  DAYOFWEEK(NOW())=1 THEN
      DATE_SUB(NOW(), INTERVAL (DAYOFWEEK(NOW())-6) DAY)
      ELSE
      DATE_SUB(NOW(), INTERVAL (DAYOFWEEK(NOW())-2) DAY)
      END
      ");
      $weekVisiteurs = count($weekVisiteurs);
      $onedayVisiteurs = $wpdb->get_results("SELECT date_visite from $table_name WHERE date_visite >=NOW() - INTERVAL 1 DAY");
      $onedayVisiteurs = count($onedayVisiteurs);





      $table_name ='utilisateurs';
      $year=date("Y");
      $month=date("m");
      $allQuiz = $wpdb->get_results("SELECT date_quiz from $table_name ");
      $allQuiz = count($allQuiz);
      $yearQuiz = $wpdb->get_results("SELECT date_quiz from $table_name WHERE YEAR(date_quiz)=$year");
      $yearQuiz = count($yearQuiz);
      $monthQuiz = $wpdb->get_results("SELECT date_quiz from $table_name WHERE MONTH(date_quiz)=$month AND YEAR(date_quiz)=$year");
      $monthQuiz = count($monthQuiz);
      $weekQuiz = $wpdb->get_results("SELECT date_quiz from $table_name
      WHERE date_quiz >=
      CASE WHEN  DAYOFWEEK(NOW())=1 THEN
      DATE_SUB(NOW(), INTERVAL (DAYOFWEEK(NOW())-6) DAY)
      ELSE
      DATE_SUB(NOW(), INTERVAL (DAYOFWEEK(NOW())-2) DAY)
      END
      ");
      $weekQuiz = count($weekQuiz);
      $onedayQuiz = $wpdb->get_results("SELECT date_quiz from $table_name WHERE date_quiz >=NOW() - INTERVAL 1 DAY");
      $onedayQuiz = count($onedayQuiz);
?>

    <input type="hidden" name="action" id="allVisiteurs" value="<?= $allVisiteurs ?>">
    <input type="hidden" name="action" id="yearVisiteurs" value="<?= $yearVisiteurs ?>">
    <input type="hidden" name="action" id="monthVisiteurs" value="<?= $monthVisiteurs ?>">
    <input type="hidden" name="action" id="weekVisiteurs" value="<?= $weekVisiteurs ?>">
    <input type="hidden" name="action" id="onedayVisiteurs" value="<?= $onedayVisiteurs  ?>">

    <input type="hidden" name="action" id="allQuiz" value="<?= $allQuiz ?>">
    <input type="hidden" name="action" id="yearQuiz" value="<?= $yearQuiz ?>">
    <input type="hidden" name="action" id="monthQuiz" value="<?= $monthQuiz ?>">
    <input type="hidden" name="action" id="weekQuiz" value="<?= $weekQuiz ?>">
    <input type="hidden" name="action" id="onedayQuiz" value="<?= $onedayQuiz  ?>">


<h1>Nb de visiteurs unique</h1>
<canvas id="myChart" width="400" height="400"></canvas>
<h1>Nb de quizz réalisé</h1>
<canvas id="myChartnumberquizz" width="400" height="400"></canvas>

<?php


wp_enqueue_script('chart','https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js',[],false,true);
wp_enqueue_script( 'handle', plugin_dir_url( __FILE__ ) . '/js/canvas.js' );
}
?>
