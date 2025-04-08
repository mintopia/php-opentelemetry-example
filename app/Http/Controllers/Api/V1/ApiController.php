<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\OpenTelemetry;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\LoadRequest;
use App\Http\Resources\Api\V1\LoadResource;
use App\Http\Resources\Api\V1\MetricValueResource;
use App\Http\Resources\Api\V1\PingResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use OpenTelemetry\API\Trace\Span;

class ApiController extends Controller
{
    public function delay(): Response
    {
        $span = OpenTelemetry::startSpan('delay');
        sleep(1);
        $span->end();
        return response()->noContent();
    }

    public function ping(): PingResource
    {
        return new PingResource(null);
    }

    public function event(): Response
    {
        Log::info("Registering event");
        Span::getCurrent()->addEvent("Event Triggered");
        return response()->noContent();
    }

    public function up(): MetricValueResource
    {
        Log::debug("Increasing Up/Down Metric");
        Cache::increment('metrics.updown');
        return new MetricValueResource(Cache::get('metrics.updown'));
    }

    public function down(): MetricValueResource
    {
        Log::debug("Decreasing Up/Down Metric");
        Cache::decrement('metrics.updown');
        return new MetricValueResource(Cache::get('metrics.updown'));
    }

    public function count(): MetricValueResource
    {
        Log::debug("Increasing counter");
        Cache::increment('metrics.counter');
        return new MetricValueResource(Cache::get('metrics.counter'));
    }

    public function load(LoadRequest $request): LoadResource
    {
        $load = $request->input('load');
        Log::info("Setting scaling value to {$load}");
        Cache::set('metrics.load', $load);
        return new LoadResource(Cache::get('metrics.load'));
    }
}
