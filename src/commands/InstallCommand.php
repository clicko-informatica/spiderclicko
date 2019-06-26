<?php

namespace Clicko\SpiderClicko;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'spiderclicko:install {--user=} {--pass=} {--passphrase=}';

    protected $description = 'Install package';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $clickoLog = new ClickoLog();

        $this->info($clickoLog->register($this->option('user'), $this->option('pass'), $this->option('passphrase')));
    }
}
