<?php

namespace Rooberthh\FlashMessage\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class FlashMessage extends Model
{
    protected $fillable = [
        'channel',
        'parent_id',
        'status',
        'title',
        'description',
        'flashed_at',
    ];

    public function casts()
    {
        return [
            'flashed_at' => 'datetime',
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
