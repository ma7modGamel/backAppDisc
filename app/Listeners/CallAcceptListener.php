<?php

namespace App\Listeners;

use App\Events\CallAcceptEvent;
use App\Events\StartCall;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CallAcceptListener implements ShouldQueue
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
     * @param  CallAcceptEvent  $event
     * @return void
     */
    public function handle(CallAcceptEvent $event)
    {
        $signal_data = null;
        broadcast(new StartCall([
            'callId'=>$event->call->id,
            'users' => $event->call->users()->take(2)->get(),
            'type' => 'callAccepted',
            'signalData' => $signal_data,
        ]))->toOthers();
    }
}
