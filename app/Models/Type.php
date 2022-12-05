<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_type', 'type' ,'Abilities', 'Armor'
    ];
    protected $primaryKey = 'id_type';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}