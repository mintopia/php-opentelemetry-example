<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate docs for the current API version';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $version = config('app.version');
        if (!$version) {
            $this->output->error('No API version specified');
            return Command::FAILURE;
        }
        $this->output->block("API Documentation Generator: {$version}");

        $this->build((string)$version);
        return Command::SUCCESS;
    }

    protected function build(string $version): void
    {
        $this->output->info("Generating HTML docs");
        $filename = app()->basePath("resources/docs/v{$version}.html");
        if (file_exists($filename)) {
            $this->output->warning("HTML docs already exist: {$filename}");
            unlink($filename);
        }
        passthru("npm run docs:build");
        copy(app()->basePath('docs/html/public.html'), $filename);
        $this->output->info("Docs written to {$filename}");
    }
}
