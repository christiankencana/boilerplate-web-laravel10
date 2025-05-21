<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Traits\UuidTrait;

class Company extends Model
{
    use HasFactory, UuidTrait;

    protected $table = 'tb_companies';

    // uuid
    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'client_id',
        
        'company_code', 
        'company_main_name', 
        'company_alternative_name'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function locations()
    {
        return $this->hasMany(CompanyHasLocation::class, 'company_id');
    }
}
