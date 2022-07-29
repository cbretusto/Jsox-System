<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserManagement;

class PLCModuleFlowChart extends Model
{
    protected $table = 'tbl_plc_module_flow_charts';
    protected $connection = 'mysql';

    public function rapidx_user_details()
    {
    	return $this->hasOne(UserManagement::class, 'id', 'process_owner');
    }

    public function plc_module(){
        return $this->hasOne(PLCModule::class, 'id', 'rev_history_id');
    }

    public function plc_categories_details(){
        return $this->hasOne(PlcCategory::class, 'id', 'category');
    }
}
