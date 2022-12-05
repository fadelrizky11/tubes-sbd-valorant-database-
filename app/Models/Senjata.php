<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Senjata extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_senjata', 'nama_senjata','harga','id_subjenis','id_jenis'
    ];
    protected $primaryKey = 'id_senjata';
    protected $KeyType = 'bigInteger';
    public $incrementing = false;
}