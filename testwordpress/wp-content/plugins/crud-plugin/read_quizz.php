
<?php
function read_quizz() {
    ?>
    <style>
        table {
            border-collapse: collapse;
        }
        table, td, th {
            border: 1px solid black;
            padding: 20px;
            text-align: center;
        }
    </style>
    <div class="wrap">
        <table>
            <thead>
                <tr>
                   
                    <th>quiz</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            global $wpdb;
            $table_name ='name_quiz';
            $quizs = $wpdb->get_results("SELECT id,name from $table_name");
            
            //$compteur=count($quizs);
            

            foreach ($quizs as $quiz) {
            ?>
                <tr id=<?php echo $quiz->id?>>
                    <td><?= $quiz->name; ?></td>            
                    <td><button onclick="location.href='<?php echo admin_url('admin.php?page=quizz_update&name=' . $quiz->name.'&nb_question_add=throw');?>';">Update</button> </td>
                    <td ><button class="delete" type="submit"  name=<?php echo $quiz->id?>>delete</button></td>
                </tr>

            <?php
            }
            wp_enqueue_script( 'handle', plugin_dir_url( __FILE__ ) . '/js/supprimerquizz.js' );
            ?>
            </tbody>
        </table>
    </div>
    <?php
}