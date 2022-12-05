<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Subtype extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_subjenis', 'subjenis', 'warna_subjenis', 'skin_subjenis'
    ];
    protected $primaryKey = 'id_subjenis';
    protected $keyType = 'bigInteger';
    public $incrementing = false;
}