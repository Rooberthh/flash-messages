<?php

namespace Rooberthh\FlashMessage\Domain\Support\Objects;

use Rooberthh\FlashMessage\Domain\Models\FlashMessage as FlashMessageModel;
use Rooberthh\FlashMessage\Domain\Support\Enums\Status;

class FlashMessage
{
    public function __construct(
        public string $reference,
        public null|string $parentId,
        public string $channel,
        public Status $status,
        public string $title,
        public string $description,
        public bool $temporary,
    ) {}

    public static function fromModel(FlashMessageModel $message)
    {
        return new FlashMessage(
            reference: $message->reference,
            parentId: $message->parent_id,
            channel: $message->channel,
            status: $message->status,
            title: $message->title,
            description: $message->description,
            temporary: $message->temporary,
        );
    }

    public static function fromArray($data)
    {
        return new FlashMessage(
            reference: $data['reference'],
            parentId: $data['parent_id'],
            channel: $data['channel'],
            status: Status::from($data['status']),
            title: $data['title'],
            description: $data['description'],
            temporary: $data['temporary'],
        );
    }

    public function flash()
    {
        $this->flashed_at = now();
    }
}
