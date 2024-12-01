<?php

namespace Rooberthh\FlashMessage\Domain\Stores;

use Illuminate\Support\Str;
use Rooberthh\FlashMessage\Domain\Models\FlashMessage as FlashMessageModel;
use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageStoreContract;

class DatabaseStore implements FlashMessageStoreContract
{
    public function getAll(): array
    {
        return FlashMessage::all()->toArray();
    }

    public function get($id): FlashMessage
    {
        $message = FlashMessageModel::where('reference', $id)->firstOrFail();

        return FlashMessage::fromModel($message);
    }

    public function store(CreateFlashMessage $message): FlashMessage
    {
        $flashMessage = new FlashMessageModel();
        $flashMessage->reference = $message->reference ?? Str::uuid();
        $flashMessage->parent_id = $message->parentId;
        $flashMessage->channel = $message->channel;
        $flashMessage->status = $message->status;
        $flashMessage->title = $message->title;
        $flashMessage->description = $message->description;
        $flashMessage->save();

        return FlashMessage::fromModel($flashMessage);
    }

    public function delete($id): void
    {
        // TODO: Implement delete() method.
    }

    public function purge(): void
    {
        // TODO: Implement purge() method.
    }
}
