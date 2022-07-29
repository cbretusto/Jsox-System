<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserManagement;
use App\PlcCategory;

class PLCModule extends Model
{
    protected $table = 'tbl_plc_modules';
    protected $connection = 'mysql';

    public function rapidx_user_details()
    {
    	return $this->hasOne(UserManagement::class, 'id', 'process_owner');
    }

    public function rapidx_user_details1()
    {
    	return $this->hasOne(RapidXUser::class, 'id', 'rapidx_id');
    }

    public function plc_category_details()
    {
    	return $this->hasOne(PlcCategory::class, 'id', 'category');
    }
    // public function rapidx_user_name()
    // {
    // 	return $this->hasOne(RapidXUser::class, 'process_owner', 'rapidx_name');
    // }
}
