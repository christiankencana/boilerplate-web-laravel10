<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidTrait;

class Client extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'tb_clients';

    // uuid
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'client_code', 
        'client_name',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class, 'client_id');
    }
}
