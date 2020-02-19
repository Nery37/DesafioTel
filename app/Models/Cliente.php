<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cliente
 * @package App\Models
 * @version February 19, 2020, 4:09 am UTC
 *
 * @property string nome
 * @property string cpf
 * @property string rg
 * @property string|\Carbon\Carbon created_at
 * @property string|\Carbon\Carbon updated_at
 * @property integer created_by
 * @property integer updated_by
 * @property string data_nascimento
 * @property integer telefone
 * @property string local_nascimento
 */
class Cliente extends Model
{
    use SoftDeletes;

    public $table = 'clientes';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nome',
        'cpf',
        'rg',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'data_nascimento',
        'telefone',
        'local_nascimento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'cpf' => 'string',
        'rg' => 'string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'data_nascimento' => 'date',
        'telefone' => 'integer',
        'local_nascimento' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    //    'nome' => 'required',
    //    'cpf' => 'required',
    //    'rg' => 'required',
    //    'created_at' => 'required',
    //    'created_by' => 'required',
    //    'updated_by' => 'required',
    //    'data_nascimento' => 'required',
    //    'local_nascimento' => 'required'
    ];

    
}
