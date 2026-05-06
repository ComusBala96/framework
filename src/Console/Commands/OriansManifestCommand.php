<?php

namespace Orian\Framework\Console\Commands;

use Illuminate\Console\Command;

class OriansManifestCommand extends Command
{
    protected $signature = 'orians:manifest';
    protected $description = 'Generate Orians frontend manifest';

    public function handle(): int
    {
        exec('npx orians manifest', $output, $status);

        foreach ($output as $line) {
            $this->line($line);
        }

        return $status === 0 ? self::SUCCESS : self::FAILURE;
    }
}
