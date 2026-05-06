<?php

namespace Orian\Framework\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class OriansSyncCommand extends Command
{
    protected $signature = 'orians:sync';
    protected $description = 'Sync Orians frontend generated files';

    public function handle(): int
    {
        $process = new Process(['npx', 'orians', 'sync'], base_path());
        $process->setTimeout(300);
        $process->run(function ($type, $buffer) {
            $this->output->write($buffer);
        });

        return $process->isSuccessful() ? self::SUCCESS : self::FAILURE;
    }
}