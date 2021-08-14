
<?php
function employee_list() {
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
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Role</th>
                <th>Contact</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            global $wpdb;
            $table_name ='utilisateurs';
            $employees = $wpdb->get_results("SELECT id,email,nom from $table_name");
            foreach ($employees as $employee) {
                ?>
                <tr>
                    <td><?= $employee->email; ?></td>
                    <td><?= $employee->nom; ?></td>
                    <td><a href="<?php echo admin_url('admin.php?page=Employee_Update&id=' . $employee->id); ?>">Update</a> </td>
                   
                    <td><a href="<?php echo admin_url('admin.php?page=Employee_Delete&id=' . $employee->id); ?>"> Delete</a></td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>
    <?php
}
 add_shortcode('short_employee_list', 'employee_list');
?>
