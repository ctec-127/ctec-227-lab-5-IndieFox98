<?php
    require_once "inc/ctec_functions.php";

    // Declare errors array for function 16
    $errors = [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>rifcbanuk</title>
</head>
<body>
    <!-- Function 1 -->
    <h2 id="function1">Test Function 1: is_post_request()</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <input type="submit" value="Post It!">
    </form>
    <!-- End form -->
    <p><?= is_post_request() ? 'Twas posted!' : 'Twas NOT posted!'; ?></p>

    <!-- Function 2 -->
    <h2 id="function2">Test Function 2: is_get_request()</h2>
    <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>">Reload Page</a>
    <p><?= is_get_request() ? 'If no post, then GET!' : 'If post, then NO GET!'; ?></p>

    <!-- Function 3 -->
    <h2 id="function3">Test Function 3: h($string="")</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function1">
        Enter text here: <input type="text" name="func3" value="<?= isset($_POST['func3']) ? $_POST['func3'] : ''; ?>">
        <input type="submit" value="Test">
        <p>Text w/o function: <?= $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func3']) ? $_POST['func3'] : ''; ?></p>
        <p>Text w/ function: <?= $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func3']) ? h($_POST['func3']) : ''; ?></p>
    </form>
    <!-- End form -->

    <!-- Function 4 -->
    <h2 id="function4">Test Function 4: u($string="")</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function2">
        Original text: <input type="text" name="func4" value="<?= isset($_POST['func4']) ? $_POST['func4'] : ''; ?>">
        <input type="submit" value="Convert">
        <p>New text: <?= $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func4']) ? u($_POST['func4']) : ''; ?></p>
    </form>
    <!-- End form -->

    <!-- Function 5 -->
    <h2 id="function5">Test Function 5: raw_u($string="")</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function3">
        Original text: <input type="text" name="func5" value="<?= isset($_POST['func5']) ? $_POST['func5'] : ''; ?>">
        <input type="submit" value="Convert">
        <p>New text: <?= $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func5']) ? raw_u($_POST['func5']) : ''; ?></p>
    </form>
    <!-- End form -->

    <!-- Function 6 -->
    <h2 id="function6">Test Function 6: is_blank($value)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function4">
        Enter text here: <input type="text" name="func6" value="<?= isset($_POST['func6']) ? $_POST['func6'] : ''; ?>">
        <input type="submit" value="Is It Blank?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func6'])) { ?>
        <p><?= is_blank($_POST['func6']) ? 'Ay, tis blank!' : 'Nein, no tis blank!'; ?></p>
        <?php } ?>
    </form>
    <!-- End form -->

    <!-- Function 7 -->
    <h2 id="function7">Test Function 7: has_presence($value)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function5">
        Enter text here: <input type="text" name="func7" value="<?= isset($_POST['func7']) ? $_POST['func7'] : ''; ?>">
        <input type="submit" value="Has Presence?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func7'])) { ?>
        <p><?= has_presence($_POST['func7']) ? 'Si, hay presence!' : 'No, it lacks presents (err, presence)!'; ?></p>
        <?php } ?>
    </form>
    <!-- End form -->

    <!-- Function 8 -->
    <h2 id="function8">Test Function 8: has_length_greater_than($value, $min)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function6">
        Is <input type="text" name="func8_str" value="<?= isset($_POST['func8_str']) ? $_POST['func8_str'] : ''; ?>"> longer than <input type="number" name="func8_num" value="<?= isset($_POST['func8_num']) ? $_POST['func8_num'] : ''; ?>"> characters?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func8_str']) && isset($_POST['func8_num'])) {
            // Check if both fields are filled in
            if (has_presence($_POST['func8_str']) && has_presence($_POST['func8_num'])) { ?>
        <p><?= has_length_greater_than(trim($_POST['func8_str']), $_POST['func8_num']) ? 'It, in fact, is longer than ' . $_POST['func8_num'] . ' characters.' : 'No, it is not. What a short string.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 8.')
            // display message below if fields are not filled in ?>
        <p>There is a field missing, dombo.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 9 -->
    <h2 id="function9">Test Function 9: has_length_less_than($value, $max)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function7">
        Is <input type="text" name="func9_str" value="<?= isset($_POST['func9_str']) ? $_POST['func9_str'] : ''; ?>"> shorter than <input type="number" name="func9_num" value="<?= isset($_POST['func9_num']) ? $_POST['func9_num'] : ''; ?>"> characters?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func9_str']) && isset($_POST['func9_num'])) {
            // Check if both fields are filled in
            if (has_presence($_POST['func9_str']) && has_presence($_POST['func9_num'])) { ?>
        <p><?= has_length_greater_than(trim($_POST['func9_str']), $_POST['func9_num']) ? 'It, in fact, is shorter than ' . $_POST['func9_num'] . ' characters.' : 'No, it is not. Tis loooooong.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 9.')
            // display message below if fields are not filled in ?>
        <p>In case you didn't know, a field is missing. Please fill it in.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 10 -->
    <h2 id="function10">Test Function 10: has_length_exactly($value, $exact)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function8">
        Is <input type="text" name="func10_str" value="<?= isset($_POST['func10_str']) ? $_POST['func10_str'] : ''; ?>"> equal to <input type="number" name="func10_num" value="<?= isset($_POST['func10_num']) ? $_POST['func10_num'] : ''; ?>"> characters?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func10_str']) && isset($_POST['func10_num'])) {
            // Check if both fields are filled in
            if (has_presence($_POST['func10_str']) && has_presence($_POST['func10_num'])) { ?>
        <p><?= has_length_exactly(trim($_POST['func10_str']), $_POST['func10_num']) ? 'Why, yes. It is ' . $_POST['func10_num'] . ' characters long.' : 'No, it is not. Stupid string.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 10.')
            // display message below if fields are not filled in ?>
        <p>At least one field is missing, like your mind.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 11 -->
    <h2 id="function11">Test Function 11: has_length($value, $options)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function9">
        Enter string here: <input type="text" name="func11_str" value="<?= isset($_POST['func11_str']) ? $_POST['func11_str'] : ''; ?>"><br><br>
        Is it <select name="func11_comp">
            <option value="" <?= isset($_POST['func11_comp']) && $_POST['func11_comp'] == "" ? 'selected' : '' ?>>-- PLEASE SELECT --</option>
            <option value="min" <?= isset($_POST['func11_comp']) && $_POST['func11_comp'] == "min" ? 'selected' : '' ?>>greater than</option>
            <option value="max" <?= isset($_POST['func11_comp']) && $_POST['func11_comp'] == "max" ? 'selected' : '' ?>>less than</option>
            <option value="exact" <?= isset($_POST['func11_comp']) && $_POST['func11_comp'] == "exact" ? 'selected' : '' ?>>equal to</option>
        </select>
        <input type="number" name="func11_num" value="<?= isset($_POST['func11_num']) ? $_POST['func11_num'] : ''; ?>"> characters in length?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func11_str']) && isset($_POST['func11_num'])) {
            // Check if all fields are filled in
            if (has_presence($_POST['func11_str']) && has_presence($_POST['func11_num']) && has_presence($_POST['func11_comp'])) { ?>
        <p><?= has_length($_POST['func11_str'], [$_POST['func11_comp'] => $_POST['func11_num']]) ? 'Why, yes it is!' : 'Why, anti-yes it is not!' ; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 11.')
            // display message below if fields are not filled in ?>
        <p>At least one field is left out. The Mariners will have significantly better defense now.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 12 -->
    <h2 id="function12">Test Function 12: has_inclusion_of($value, $set)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function10">
        Is <input type="number" name="func12" value="<?= isset($_POST['func12']) ? $_POST['func12'] : ''; ?>"> part of the set [1, 3, 5, 7, 9]?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func12'])) {
            // Check if field is filled in
            if (has_presence($_POST['func12'])) { ?>
        <p><?= has_inclusion_of($_POST['func12'], [1, 3, 5, 7, 9]) ? 'Uh-huh, it sure is.' : 'Nope. What a loser.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 12.')
            // display message below if field is not filled in ?>
        <p>Please enter a number, ding-dong.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 13 -->
    <h2 id="function13">Test Function 13: has_exclusion_of($value, $set)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function11">
        Is <input type="number" name="func13" value="<?= isset($_POST['func13']) ? $_POST['func13'] : ''; ?>"> outside of the set [1, 3, 5, 7, 9]?
        <input type="submit" value="Well, Is It?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func13'])) {
            // Check if field is filled in
            if (has_presence($_POST['func13'])) { ?>
        <p><?= has_exclusion_of($_POST['func13'], [1, 3, 5, 7, 9]) ? 'Yes. I like a good rebel.' : 'No. It is on the single-digit odd number bandwagon.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 13.')
            // display message below if field is not filled in ?>
        <p>ENTER, A, NUMBER.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 14 -->
    <h2 id="function14">Test Function 14: has_string($value, $required_string)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function12">
        Is <input type="text" name="func14_str" value="<?= isset($_POST['func14_str']) ? $_POST['func14_str'] : ''; ?>"> a part of <input type="text" name="func14_text" value="<?= isset($_POST['func14_text']) ? $_POST['func14_text'] : ''; ?>">?
        <input type="submit" value="Well, Is It Now?!">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func14_str']) && isset($_POST['func14_text'])) {
            // Check if all fields are filled in
            if (has_presence($_POST['func14_str']) && has_presence($_POST['func14_text'])) { ?>
        <p><?= has_string($_POST['func14_text'], $_POST['func14_str']) ? 'Yes, it fits!' : 'Nyope. I am afraid not.'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 14.')
            // display message below if fields are not filled in ?>
        <p>These fields are now up for lease.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 15 -->
    <h2 id="function15">Test Function 15: has_valid_email_format($value)</h2>
    <!-- Begin form -->
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>#function13">
        Enter text here: <input type="text" name="func15" value="<?= isset($_POST['func15']) ? $_POST['func15'] : ''; ?>">
        <input type="submit" value="Is It An Email Address?">
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['func15'])) {
            // Check if field is filled in
            if (has_presence($_POST['func15'])) { ?>
        <p><?= has_valid_email_format($_POST['func15']) ? 'Definitely email address!' : 'NO, IMPOSTOR!'; ?></p>
        <?php } else {
            array_push($errors, 'Field(s) missing for function 15.');
            // display message below if field is not filled in ?>
        <p>For sure, it's not an email address. There isn't even text in the field.</p>
        <?php }} ?>
    </form>
    <!-- End form -->

    <!-- Function 16 -->
    <h2 id="function16">Test Function 16: display_errors($errors=array())</h2>
    <?= display_errors($errors); ?>
</body>
</html>