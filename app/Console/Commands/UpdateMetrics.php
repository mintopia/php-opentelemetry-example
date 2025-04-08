<?php

namespace App\Console\Commands;

use App\Helpers\OpenTelemetry;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class UpdateMetrics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-metrics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Metrics';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $counter = (int)Cache::get('metrics.counter', 0);
        $counterMetric = OpenTelemetry::getMeter()->createCounter('widget-count', 'widgets');
        $counterMetric->add($counter);
        $this->output->writeln("Sending metric widget-count: {$counter}");
        Log::debug("Sending metric widget-count: {$counter}");

        $updown = (int)Cache::get('metrics.updown', 0);
        $upDownMetric = OpenTelemetry::getMeter()->createUpDownCounter('widget-numbers', 'widgets');
        $upDownMetric->add($updown);
        $this->output->writeln("Sending metric widgets: {$updown}");
        Log::debug("Sending metric widgets: {$updown}");

        $load = (int)Cache::get('metrics.load', 0);
        $loadMetric = OpenTelemetry::getMeter()->createGauge('load', 'load');
        $loadMetric->record($load);
        $this->output->writeln("Sending load: {$load}");
        Log::debug("Sending metric load: {$load}");

        return Command::SUCCESS;
    }
}
