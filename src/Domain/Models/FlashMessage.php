<?php

namespace Rooberthh\FlashMessage\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Rooberthh\FlashMessage\Domain\Support\Enums\Status;

class FlashMessage extends Model
{
    protected $fillable = [
        'channel',
        'parent_id',
        'status',
        'title',
        'description',
        'temporary',
    ];

    public function casts()
    {
        return [
            'flashed_at' => 'datetime',
            'status' => Status::class,
            'temporary' => 'boolean',
        ];
    }

    public function __construct(array $attributes = [])
    {
        if (! isset($this->connection)) {
            $this->setConnection(config('flash-message.database_connection'));
        }

        parent::__construct($attributes);
    }
}
