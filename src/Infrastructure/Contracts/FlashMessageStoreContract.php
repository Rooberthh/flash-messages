<?php

namespace Rooberthh\FlashMessage\Infrastructure\Contracts;

use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;

interface FlashMessageStoreContract
{
    public function getAll(): array;

    public function get(string $id): FlashMessage;

    public function store(CreateFlashMessage $message): FlashMessage;

    public function delete(string $id): void;

    public function purge(): void;
}
