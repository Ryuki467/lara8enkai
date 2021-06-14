<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Event extends Model
{
    use HasFactory;
    use Sortable;
    
    protected $guarded =['id'];
    public $sortable = [
        'id',
        'name',
        'detail',
        'max_participant',
        'category_id',
        'user_id',
        'create_at',
        'updated_at',
    ];
    
    public static $rules = [
        'name' => 'required',
        'detail' => 'required',
        'max_participant' => 'required|integer|min:1',
        'category_id' => 'required|exists:categories,id',
        'user_id' => 'required|exists:users,id',
    ];
    
    public function eventuser(){
        return $this->hasMany('App\Models\Eventuser','Event_id');
    }
    
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }
    
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
