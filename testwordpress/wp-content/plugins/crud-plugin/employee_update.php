<?php
//echo "update page";
function employee_update(){
    //echo "update page in";

    $i=$_GET['id'];
    global $wpdb;
    $table_name ='utilisateurs';
    $employees = $wpdb->get_results("SELECT id,nom,email from $table_name where id=$i");
    echo $employees[0]->id;

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
        <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= $employees[0]->id; ?>">
            <tr>
                <td>Nom:</td>
                <td><input type="text" name="nom" value="<?= $employees[0]->nom; ?>"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" value="<?= $employees[0]->email; ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Confirmer" name="upd"></td>
            </tr>
        </form>
        </tbody>
    </table>
    <?php
    if((isset($_POST['upd']))  )
    {
        /*global $wpdb;
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
        echo "updated";*/
        //$url=admin_url('admin.php?page=Employee_List');
        //header("location:http://localhost/wordpressmyplugin/wordpress/wp-admin/admin.php?page=Employee_Listing");
    }
}
?>
