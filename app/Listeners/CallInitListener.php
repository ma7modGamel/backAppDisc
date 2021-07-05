<?php

namespace App\Listeners;

use App\Events\CallInitEvent;
use App\Events\StartCall;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CallInitListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CallInitEvent  $event
     * @return void
     */
    public function handle(CallInitEvent $event)
    {
        $signal_data = null;        
        broadcast(new StartCall([
            'callId'=>$event->call->id,
            'users' => $event->call->users()->take(2)->get(),
            'type' => 'incomingCall',
            'signalData' => $signal_data,
        ]))->toOthers();
    }
}
