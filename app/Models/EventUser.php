<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class EventUser extends Model{
    use HasFactory;
    use Sortable;
    
    protected $guarded =['id'];
    public $sortable = [
        'id',
        'event_id',
        'user_id',
        'create_at',
        'updated_at',
    ];
    
    public static $rules = [
        'event_id' => 'required|exists:events,id',
        'user_id' => 'required|exists:users,id',
    ];
    
    public function event(){
        return $this->belongsTo('App\Models\Event','event_id');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
