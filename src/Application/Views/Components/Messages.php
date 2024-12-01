<?php

namespace Rooberthh\FlashMessage\Application\Views\Components;

use Illuminate\View\Component;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageServiceContract;

class Messages extends Component
{
    public function __construct(protected FlashMessageServiceContract $service, public string $channel) {}

    public function render()
    {
        $messages = collect($this->service->getAll());

        $messages = $messages->filter(function ($message) {
            return $message->channel === $this->channel && ! $message->flashed_at;
        })
        ->values();

        $messages->each(function ($message) {
            $this->service->delete($message->reference);
        });

        return $this->view('flash-message::components.messages', [
            'messages' => $messages,
        ]);
    }
}
