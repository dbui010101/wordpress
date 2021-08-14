
<?php
function list_user() {
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
                    <th>email</th>
                    <th>Nom</th>
                    <th>update</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
            global $wpdb;
            $table_name ='utilisateurs';
            $users = $wpdb->get_results("SELECT id,email,nom from $table_name");
            foreach ($users as $user) {
                ?>
                <tr id=<?php echo $user->id?>>
                    <td><?= $user->email; ?></td>
                    <td><?= $user->nom; ?></td>
                    <td><button onclick="location.href='<?php echo admin_url('admin.php?page=employee_update&id=' . $user->id);?>';">Modifier</button> </td>
                    <td ><button class="delete" type="submit"  name=<?php echo $user->id?>>Supprimer</button></td>
                </tr>
            <?php
            }
            wp_enqueue_script( 'handle', plugin_dir_url( __FILE__ ) . '/js/delete.js' );
            ?>
            </tbody>
        </table>
    </div>
    <?php
}

add_shortcode('short_employee_list', 'list_user');
