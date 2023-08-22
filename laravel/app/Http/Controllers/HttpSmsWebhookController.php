<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use CloudEvents\Serializers\JsonDeserializer;

class HttpSmsWebhookController extends Controller
{
    /**
     * Receive webhook events from httpsms.com
     * You can find the documentation at https://docs.httpsms.com/webhooks/introduction
     *
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        Log::info("httpsms.com webhook event received with type [{$request->header('X-Event-Type')}]");
        try {
            $event = JsonDeserializer::create()->deserializeStructured($request->getContent());
            $eventData = json_encode($event->getData(), JSON_PRETTY_PRINT);
            Log::info("decoded [{$event->getId()}] with id [{$event->getId()} and data [$eventData]");
        } catch (Exception $exception) {
            Log::error($exception);
        }
    }
}
