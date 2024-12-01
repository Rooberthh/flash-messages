<?php

namespace Rooberthh\FlashMessage\Infrastructure\Contracts;

use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;

interface FlashMessageServiceContract
{
    public function flash(CreateFlashMessage $message): FlashMessage;
    public function get(string $id): FlashMessage;
    public function getAll(): array;
    public function store(FlashMessageStoreContract $store): FlashMessageServiceContract;
    public function delete(string $id): void;
    public function purge(): void;
}
