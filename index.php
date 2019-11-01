<?php

//function bg_exec($cmd)
//{
//    exec($cmd.' > /dev/null &');
//}

echo "Hello Reproducer!!";

echo exec('whoami').PHP_EOL;
echo exec('ls -al').PHP_EOL;
