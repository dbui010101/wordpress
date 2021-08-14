
<?php

function email_insert()
{
    //echo "insert page";
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
    <form name="frm" action="admin-post.php" method="post">
    <input type="hidden" name="action" value="insert">
    <tr>
        <td>email:</td>
        <td><input type="text" name="mail"></td>
    </tr>
    <tr>
        <td>nom:</td>
        <td><input type="text" name="nom"></td>
        <td><input type="submit" value="Envoyer" name="ins"></td>
    </tr>
    </form>
    </tbody>
</table>
<?php
    if (isset($_POST['ins'])  ){
        //echo admin_url()."admin.php?page=email_insert"."\n";

        // function test(){
        //    echo "ok";
        // }
        //include ("../index.php");//dans  plugin
        //get_template_part("aaa.php");

        //test();
        //add_action( 'admin_post_insert', 'test' );

        /*global $wpdb;
        $email=$_POST['email'];
        $nom=$_POST['nom'];

        //$table_name = $wpdb->prefix . 'utilisateurs';
        $wpdb->insert(
            'utilisateurs',
            array(
                'email' => $email,
                'nom' => $nom,
                'valide' => 0,
                'roles' => '[]',
            )
        );
        echo "inserted";*/
       // wp_redirect( admin_url('admin.php?page=page=Employee_List'),301 );
        //header("location:http://localhost/wordpressmyplugin/wordpress/wp-admin/admin.php?page=Employee_Listing");
      //  header("http://google.com");
        ?>

        <?php
        //exit;
    }
}
?>
