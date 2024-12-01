<?php

namespace Rooberthh\FlashMessage\Domain\Services;

use InvalidArgumentException;
use Rooberthh\FlashMessage\Domain\Stores\DatabaseStore;
use Rooberthh\FlashMessage\Domain\Stores\SessionStore;
use Rooberthh\FlashMessage\Domain\Support\Enums\Driver;
use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageServiceContract;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageStoreContract;

class FlashMessageService implements FlashMessageServiceContract
{
    protected FlashMessageStoreContract $store;

    public function __construct()
    {
        $this->store = match (config('flash-message.driver', Driver::SESSION)) {
            Driver::DATABASE => new DatabaseStore(),
            Driver::SESSION => new SessionStore(),
            default => throw new InvalidArgumentException('Wrong driver passed in'),
        };
    }

    public function flash(CreateFlashMessage $message): FlashMessage
    {
        $storedMessage = $this->store->store($message);

        return $storedMessage;
    }

    public function getAll(): array
    {
        return $this->store->getAll();
    }

    public function getStore()
    {
        return $this->store;
    }

    public function store(FlashMessageStoreContract $store): FlashMessageServiceContract
    {
        $this->store = $store;

        return $this;
    }

    public function get(string $id): FlashMessage
    {
        return $this->store->get($id);
    }

    public function delete(string $id): void
    {
        $this->store->delete($id);
    }

    public function purge(): void
    {
        $this->store->purge();
    }
}
