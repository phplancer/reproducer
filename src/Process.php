<?php

namespace App;

class Process
{
    private $pid;
    private $command;

    public function __construct(bool $cmd = false)
    {
        if (false !== $cmd) {
            $this->command = $cmd;
            $this->runCom();
        }
    }

    private function runCom(): void
    {
        $command = 'nohup '.$this->command.' > /dev/null 2>&1 & echo $!';
        exec($command, $op);
        $this->pid = (int) $op[0];
    }

    public function setPid($pid): void
    {
        $this->pid = $pid;
    }

    public function getPid()
    {
        return $this->pid;
    }

    public function isRunning(): bool
    {
        exec('ps -p '.$this->pid, $op);

        return isset($op[1]);
    }

    public function start(): void
    {
        if ('' !== $this->command) {
            $this->runCom();
        }
    }

    public function stop(): bool
    {
        $command = 'kill '.$this->pid;
        exec($command);

        return !$this->isRunning();
    }
}
