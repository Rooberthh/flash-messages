<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Rooberthh\FlashMessage\Domain\Models\FlashMessage;
use Rooberthh\FlashMessage\Domain\Services\FlashMessageService;
use Rooberthh\FlashMessage\Domain\Stores\DatabaseStore;
use Rooberthh\FlashMessage\Domain\Stores\SessionStore;
use Rooberthh\FlashMessage\Domain\Support\Objects\CreateFlashMessage;
use Rooberthh\FlashMessage\Tests\FlashMessageTestCase;

uses(FlashMessageTestCase::class);
uses(RefreshDatabase::class);

it('can store flash-message using a database store', function () {
    $service = new FlashMessageService();

    $service->store(new DatabaseStore());

    $uuid = Str::uuid();

    $newMessage = new CreateFlashMessage(
        reference: $uuid,
        parentId: null,
        channel: 'default',
        status: 'warning',
        title: 'Title',
        description: 'Description',
    );

    $newMessage = $service->flash($newMessage);

    $message = $service->get($newMessage->reference);

    expect($message)->not->toBeNull()
        ->and($message->title)
        ->toBe('Title')
        ->and(FlashMessage::query()->where('reference', $uuid)->firstOrFail())
        ->toBeInstanceOf(FlashMessage::class);
});

it('can swap store for the flash messages', function () {
    $service = new FlashMessageService();

    $service->store(new SessionStore());

    expect($service->getStore())->toBeInstanceOf(SessionStore::class);

    $newMessage = new CreateFlashMessage(
        reference: Str::uuid(),
        parentId: null,
        channel: 'default',
        status: 'warning',
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
