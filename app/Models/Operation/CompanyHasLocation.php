<?php

namespace App\Models\Operation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyHasLocation extends Model
{
    use HasFactory;

    protected $table = 'tb_company_has_locations';
    
    protected $fillable = [
        'company_id', 
        
        'location_name', 
        'location_address'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
