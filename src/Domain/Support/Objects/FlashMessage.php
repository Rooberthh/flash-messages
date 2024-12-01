<?php

namespace Rooberthh\FlashMessage\Domain\Support\Objects;

use DateTimeInterface;
use Rooberthh\FlashMessage\Domain\Models\FlashMessage as FlashMessageModel;

class FlashMessage
{
    public function __construct(
        public null|string $id,
        public string $reference,
        public null|string $parentId,
        public string $channel,
        public string $status,
        public string $title,
        public string $description,
        public null|DateTimeInterface $flashed_at,
    ) {}

    public static function fromModel(FlashMessageModel $message)
    {
        return new FlashMessage(
            id: $message->id,
            reference: $message->reference,
            parentId: $message->parent_id,
            channel: $message->channel,
            status: $message->status,
            title: $message->title,
            description: $message->description,
            flashed_at: $message->flashed_at,
        );
    }

    public static function fromArray($data)
    {
        return new FlashMessage(
            id: $data['reference'],
            reference: $data['reference'],
            parentId: $data['parent_id'],
            channel: $data['channel'],
            status: $data['status'],
            title: $data['title'],
            description: $data['description'],
            flashed_at: $data['flashed_at'],
        );
    }

    public function flash()
    {
        $this->flashed_at = now();
    }
}
