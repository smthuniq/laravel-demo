<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Comment extends Model
{
    /**
     * The attributes that should be visible in arrays.
     *
     * @var array
     */
    protected $visible = ['id', 'user', 'content'];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeUserFieldStartsWith($query, $valueToSearch, $fieldToSearch = 'id') {
        $query->whereHas('user', function ($userQuery) use ($valueToSearch, $fieldToSearch) {
            $userQuery->where($fieldToSearch, 'LIKE', "$valueToSearch%");
        });
        return $query;
    }
}
