<?php require_once __DIR__ . '/_header.php'; ?>

<form method="post" action="<?php echo __SITE_URL . '/ebuy.php?rt=quizzes/info' ?>">
    <table>
        <tr>
            <th>More info</th>
            <th>Name</th>
            <th>Type1</th>
            <th>Type2</th>
            <th>Type3</th>
        </tr>
        <?php
        foreach ($quizList as $quiz) {
            echo '<tr>' .
                '<td><button class="comm" type="submit" name="quiz_id" value="' . $quiz->id . '">Info</button></td>' .
                '<td>' . $quiz->name . '<form>' . '</a>' .  '</td>' .
                '<td>' . $quiz->is_type1 . '</td>' .
                '<td>' . $quiz->is_type2 . '</td>' .
                '<td>' . $quiz->is_type3 . '</td>' .
                '</tr>';
        }
        ?>
    </table>
</form>

<?php require_once __DIR__ . '/_footer.php'; ?>