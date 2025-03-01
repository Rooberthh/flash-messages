<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Rooberthh\FlashMessage\Domain\Services\FlashMessageService;
use Rooberthh\FlashMessage\Domain\Stores\DatabaseStore;
use Rooberthh\FlashMessage\Domain\Stores\SessionStore;
use Rooberthh\FlashMessage\Domain\Support\Enums\Status;
use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Domain\Support\Objects\FlashMessage;
use Rooberthh\FlashMessage\Infrastructure\Contracts\FlashMessageStoreContract;
use Rooberthh\FlashMessage\Tests\FlashMessageTestCase;

uses(FlashMessageTestCase::class);
uses(RefreshDatabase::class);

it('can store flash-message using a store', function (FlashMessageStoreContract $store) {
    $service = new FlashMessageService();

    $service->store($store);

    $uuid = Str::uuid();

    $newMessage = new CreateFlashMessage(
        reference: $uuid,
        parentId: null,
        channel: 'default',
        status: Status::WARNING,
        title: 'Title',
        description: 'Description',
    );

    $newMessage = $service->flash($newMessage);

    $message = $service->get($newMessage->reference);

    expect($message)->not->toBeNull()
        ->and($message->title)
        ->toBe('Title')
        ->and($message)
        ->toBeInstanceOf(FlashMessage::class);
})->with([new DatabaseStore(), new SessionStore()]);

it('can delete a flash-message using a database store', function (FlashMessageStoreContract $store) {
    $service = new FlashMessageService();
    $service->store($store);

    $newMessage = new CreateFlashMessage(
        reference: Str::uuid(),
        parentId: null,
        channel: 'default',
        status: Status::WARNING,
        title: 'Title',
        description: 'Description',
    );

    $newMessage = $service->flash($newMessage);

    $service->delete($newMessage->reference);

    expect($service->getAll())->toBeEmpty();
})->with([new DatabaseStore(), new SessionStore()]);

it('can purge all flash-message using a database store', function (FlashMessageStoreContract $store) {
    $service = new FlashMessageService();

    $service->store($store);

    $newMessage = new CreateFlashMessage(
        reference: Str::uuid(),
        parentId: null,
        channel: 'default',
        status: Status::WARNING,
        title: 'Title',
        description: 'Description',
    );

    $newMessage2 = new CreateFlashMessage(
        reference: Str::uuid(),
        parentId: null,
        channel: 'default',
        status: Status::WARNING,
        title: 'Title',
        description: 'Description',
    );

    $newMessage = $service->flash($newMessage);
    $newMessage2 = $service->flash($newMessage2);

    $service->purge();

    expect($service->getAll())->toBeEmpty();
})->with([new DatabaseStore(), new SessionStore()]);

it('can swap store for the flash messages', function () {
    $service = new FlashMessageService();

    $service->store(new SessionStore());

    expect($service->getStore())->toBeInstanceOf(SessionStore::class);

    $newMessage = new CreateFlashMessage(
        reference: Str::uuid(),
        parentId: null,
        channel: 'default',
        status: Status::INFO,
        title: 'Title',
        description: 'Description',
    );

    $newMessage = $service->flash($newMessage);

    $message = $service->get($newMessage->reference);

    expect($message)->not->toBeNull()
        ->and($message->title)
        ->toBe('Title')
        ->and(count(session(SessionStore::SESSION_KEY)))->toBe(1);
});
