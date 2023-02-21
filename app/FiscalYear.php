<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ClcEvidences;

class FiscalYear extends Model
{
    protected $table = 'fiscal_years';
    protected $connection = 'mysql';

    // public function search_fiscal_year_details(){
    //     return $this->hasMany(ClcEvidences::class, 'fiscal_year', 'fiscal_year');
    // }
}
