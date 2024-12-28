<?php

namespace Rooberthh\FlashMessage\Domain\Support\Objects;

use Rooberthh\FlashMessage\Domain\Support\Enums\Status;

readonly class CreateFlashMessage
{
    public function __construct(
        public string $reference,
        public null|string $parentId,
        public string $channel,
        public Status $status = Status::SUCCESS,
        public string $title,
        public string $description,
    ) {
        //
    }

    public function toArray()
    {
        return [
            'reference' => $this->reference,
            'parent_id' => $this->parentId,
            'channel' => $this->channel,
            'status' => $this->status->value,
            'title' => $this->title,
            'description' => $this->description,
            'flashed_at' => null,
        ];
    }
}
