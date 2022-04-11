<?php

namespace Modules\Storage\Models;

use Hexters\Ladmin\LadminLoggable;
use Hexters\Ladmin\UuidGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Mark extends Model
{
    use HasFactory, UuidGenerator, LadminLoggable, Searchable;

    protected $table = 'ladmin_storage_marks';

    protected $fillable = [
        'uuid',
        'parent_id',
        'user_id',
        'base_path',
        'file_path',
        'body',
        'type',
        'state',
    ];


    public function user() {
        return $this->belongsTo(ladmin()->admin(), 'user_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Mark::class, 'parent_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Mark::class, 'parent_id', 'id');
    }

    public function scopeCustomSearch( $query, $search) {
        if($search) {
            $query->whereFullText('file_path', $search)
                ->orWhere('file_path', 'LIKE', '%' . $search . '%');
        }
    }
    
}
