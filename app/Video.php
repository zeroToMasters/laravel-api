<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $visible = ['id', 'titulo', 'descripcion', 'url_video'];

    public function scopeUltimos($query, int $limit, int $page)
    {
        $offset = ($page - 1) * $limit;

        return $query->limit($limit)
            ->offset($offset)
            ->orderBy('created_at', 'DESC');
    }
}
