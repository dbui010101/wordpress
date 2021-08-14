<?php
//echo "update page";
function quizz_update(){
    //echo "update page in";
    
    if(!isset($_POST['number']) )
    {
        
    ?>
    <table>
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <form name="frm" action="" method="post">      
    </tr>
    <tr>
        <td>nb question à ajouter:</td>
        <td><input type="text" name="nb_question_add" value="0"></td>
    </tr>
    <tr>
    <tr> 
        <td><input type="submit" value="Envoyer" name="number"></td>
    </tr>

    </form>
    </tbody>
    </table>
    <?php }     
    
    
    
    
    
    
    if(isset($_POST['number'])   ){
    $name=$_GET['name'];
    
    global $wpdb;
    $table_name ='question';
    $resultat = $wpdb->get_results("SELECT id,question,name_quiz from $table_name where name_quiz='{$name}'");

   
    ?>
    <table>
        <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <form name="frm" action="admin-post.php" method="post">
        <input type="hidden" name="action" value="update_quizz">
        <?php foreach($resultat as $row){?>
            <input type="hidden" name="id" value="<?= $row->id; ?>">
            <tr>
                <td>question:</td>
                
                <td><input type="text" name="<?= "question".$row->id?>" value="<?= $row->question; ?>"></td>
                <td><div><input type="checkbox"  name="<?="delete".$row->id?>"><label for="delete">delete</label></div></td>
            </tr>
            <tr>

        <?php      
            }
            if($_POST['nb_question_add']!="0"){
                
                for($i=1;$i<=$_POST['nb_question_add'];$i++){?>
                <tr>
                <td>add question:</td>
                <td><input type="text" name=<?php echo "question_add".$i?>></td>
                </tr>
                <tr>
        <?php            
                }
            }
        ?>
                <input type="hidden" name="nb_question_add" value="<?=$_POST['nb_question_add']?>">
                <input type="hidden" name="name_quiz" value="<?=$name?>">
                <td><input type="submit" value="Update" name="upd_quizz"></td>
            </tr>
        </form>
        </tbody>
    </table>
    <?php
    }
}
?>