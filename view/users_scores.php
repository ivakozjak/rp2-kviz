<?php require_once __DIR__ . '/_header.php'; ?>
<h2>Rezultati kvizova</h2>
<table>
    <tr>
        <?php  
        for($i = 1; $i < 16; $i++){
            $q = 'kviz' . $i;
            echo '<th>' .  $q . '</th>';
        }
        ?>
    </tr>
    <?php
     echo '<tr>';
     echo '<td>' . $allscores->kviz1 . '</td>';
     echo '<td>' . $allscores->kviz2 . '</td>';
     echo '<td>' . $allscores->kviz3 . '</td>';
     echo '<td>' . $allscores->kviz4 . '</td>';
     echo '<td>' . $allscores->kviz5 . '</td>';
     echo '<td>' . $allscores->kviz6 . '</td>';
     echo '<td>' . $allscores->kviz7 . '</td>';
     echo '<td>' . $allscores->kviz8 . '</td>';
     echo '<td>' . $allscores->kviz9 . '</td>';
     echo '<td>' . $allscores->kviz10 . '</td>';
     echo '<td>' . $allscores->kviz11 . '</td>';
     echo '<td>' . $allscores->kviz12 . '</td>';
     echo '<td>' . $allscores->kviz13 . '</td>';
     echo '<td>' . $allscores->kviz14 . '</td>';
     echo '<td>' . $allscores->kviz15 . '</td>';

    echo '</tr>';
    ?>
    
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>