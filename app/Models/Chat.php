<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Chat extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $guarded =['id'];
    public $sortable = [
        'id',
        'user_id',
        'event_id',
        'body',
        'create_at',
        'updated_at',
    ];
    
    public static $rules = [
        'user_id' => 'required|exists:users,id',
        'event_id' => 'required|exists:events,id',
        'body' => 'required',
    ];
    
    public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
