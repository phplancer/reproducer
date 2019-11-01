<?php

//function bg_exec($cmd)
//{
//    exec($cmd.' > /dev/null &');
//}

echo "Hello Reproducer!!";

echo '<pre>';
echo exec('ls vendor -al').PHP_EOL;
