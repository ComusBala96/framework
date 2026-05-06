<?php

namespace Orian\Framework\Console\Commands;

use Illuminate\Console\Command;

class OriansInstallCommand extends Command
{
    protected $signature = 'orians:install';
    protected $description = 'Install Orians Laravel bridge';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--tag' => 'orians-config'
        ]);

        $this->info('Orians installed successfully.');
        return self::SUCCESS;
    }
}
