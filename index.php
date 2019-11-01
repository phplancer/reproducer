<?php

function bg_exec($cmd)
{
    exec($cmd.' > /dev/null &');
}

var_dump($_POST);

echo "Hello Reproducer!!";

echo '<pre>';
echo exec('ls -al').PHP_EOL;
echo '</pre>';

?>
<hr>
<form action="/" method="post">
    <input type="text" name="name">
    <button type="submit">mkdir</button>
</form>
