<?php require_once __DIR__ . '/_header.php'; ?>

<table>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>Is admin</th>
        <?php
        for($i = 1; $i < 16; $i++){
            $q = 'kviz' . $i;
            echo '<th>' .  $q . '</th>';
        }
        ?>
    </tr>
    <?php
    foreach ($userList as $user) {
        echo '<tr>' .
            '<td>' . $user->username . '</td>' .
            '<td>' . $user->email . '</td>' .
            '<td>' . $user->is_admin . '</td>' .
            '<td>' . $user->kviz1 . '</td>' .
            '<td>' . $user->kviz2 . '</td>' .
            '<td>' . $user->kviz3 . '</td>' .
            '<td>' . $user->kviz4 . '</td>' .
            '<td>' . $user->kviz5 . '</td>' .
            '<td>' . $user->kviz6 . '</td>' .
            '<td>' . $user->kviz7 . '</td>' .
            '<td>' . $user->kviz8 . '</td>' .
            '<td>' . $user->kviz9 . '</td>' .
            '<td>' . $user->kviz10 . '</td>' .
            '<td>' . $user->kviz11 . '</td>' .
            '<td>' . $user->kviz12 . '</td>' .
            '<td>' . $user->kviz13 . '</td>' .
            '<td>' . $user->kviz14 . '</td>' .
            '<td>' . $user->kviz15 . '</td>' .

            '</tr>';
    }
    ?>
</table>

<?php require_once __DIR__ . '/_footer.php'; ?>