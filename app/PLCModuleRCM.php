<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//MODEL
use App\PLCModuleSA;
use App\PLCModuleRCMInternalControl;

class PLCModuleRCM extends Model
{
    protected $table = 'tbl_plc_module_rcm';
    protected $connection = 'mysql';

    public function plc_categories_details(){
        return $this->hasOne(PlcCategory::class, 'id', 'category');
    }

    public function rcm_info(){
        return $this->hasMany(PLCModuleRCMInternalControl::class, 'rcm_id', 'id');
    }

    public function sa_data_record(){
        return $this->hasMany(PLCModuleSA::class, 'rcm_id', 'id');
    }
}
