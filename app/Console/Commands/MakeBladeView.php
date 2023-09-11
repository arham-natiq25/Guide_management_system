<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;

class MakeBladeView extends Command
{
    protected $signature = 'make:blade-view {name}';

    protected $description = 'Create a new Blade view file';

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $fileName = Str::kebab($name) . '.blade.php';
        $filePath = resource_path('views') . '/' . $fileName;

        if ($this->filesystem->exists($filePath)) {
            $this->error('View already exists!');
            return;
        }

        $this->filesystem->put($filePath, '');

        $this->info('Blade view created: ' . $fileName);
    }
}
