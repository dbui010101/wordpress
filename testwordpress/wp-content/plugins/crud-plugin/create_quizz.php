
<?php

function create_quizz()
{
    if(!isset($_POST['nombre']) && empty($_POST['nombre']))
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
    <td>name quizz:</td>
        <td><input type="text" name="name_quiz" value=name_quiz></td>          
    </tr>
    <tr>
        <td>nb question:</td>
        <td><input type="text" name="nombre"></td>
    </tr>
    <tr>
    <tr> 
        <td><input type="submit" value="Envoyer" name="number"></td>
    </tr>

    </form>
    </tbody>
    </table>
    <?php }     


    if(isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['name_quiz']) && !empty($_POST['name_quiz']) 
    ){ ?>

    <table>
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <form name="frm" action="admin-post.php?" method="post">
    <input type="hidden" name="action" value="quizz">
    <?php
        for($i=1;$i<=$_POST['nombre'];$i++){?> 
         <tr>   
        <td><?php echo "question ".$i." :"?></td>
        <td><input type="text" name=<?php echo "question".$i?>></td>
        
        </tr>
    <?php   
        } 





        ?>

    <tr>
        <input type="hidden" name="nombre" value=<?php echo $_POST['nombre']?>>
        <input type="hidden" name="name_quiz" value=<?php echo $_POST['name_quiz']?>>
        <td><input type="submit" value="Envoyer" name="quizz"></td>
    </tr>
    </form>
    </tbody>
    </table>


  
<?php   }
}
?>