<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="<?php echo __SITE_URL . '/ebuy.php?rt=quizzes/info' ?>">
    <table>
        <tr>
            <th>Vrsta</th>
        </tr>
        <?php
        foreach ($quizList as $quiz) {
            echo '<tr>' .
                '<td>' . $quiz->name . '<form>' . '</a>' .  '</td>' .
                '</tr>';
        }
        ?>
    </table>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>