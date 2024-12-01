<?php

namespace Rooberthh\FlashMessage\Domain\Support\Objects;

readonly class CreateFlashMessage
{
    public function __construct(
        public string $reference,
        public null|string $parentId,
        public string $channel,
        public string $status,
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
            'status' => $this->status,
            'title' => $this->title,
            'description' => $this->description,
            'flashed_at' => null,
        ];
    }
}
