<?php

namespace Rooberthh\FlashMessage\Domain\Stores;

use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageStoreContract;

class SessionStore implements FlashMessageStoreContract
{
    public const SESSION_KEY = 'flash-message';

    public function getAll(): array
    {
        $messages = session()->get(self::SESSION_KEY);

        return array_map(function ($message) {
            return FlashMessage::fromArray($message);
        }, $messages);
    }

    public function get(string $id): FlashMessage
    {
        $messages = collect(session()->get(self::SESSION_KEY));

        $message = $messages->firstWhere('reference', $id);

        return FlashMessage::fromArray($message);
    }

    public function store(CreateFlashMessage $message): FlashMessage
    {
        $messages = session()->get(self::SESSION_KEY);

        $messages[] = $message->toArray();

        session()->put(self::SESSION_KEY, $messages);

        return FlashMessage::fromArray($message->toArray());
    }

    public function delete(string $id): void
    {
        $messages = session()->get(self::SESSION_KEY);

        $messages = array_filter($messages, function ($message) use ($id) {
            return $message['reference'] !== $id;
        });

        session()->put(self::SESSION_KEY, $messages);
    }

    public function purge(): void
    {
        session()->forget(self::SESSION_KEY);
    }
}
