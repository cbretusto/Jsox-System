<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\UserManagement;
use App\PlcCategory;
use App\RevisionHistoryReasonForRevision;
use App\RevisionHistoryDetailsOfRevision;
use App\RevisionHistoryConcernDeptSectIncharge;

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

    public function reason_for_revision_details(){
    	return $this->hasMany(RevisionHistoryReasonForRevision::class, 'plc_module_id', 'id');
    }
    public function details_of_revision_details(){
    	return $this->hasMany(RevisionHistoryDetailsOfRevision::class, 'plc_module_id', 'id');
    }
    public function concern_dept_sect_inchanrge_details(){
    	return $this->hasMany(RevisionHistoryConcernDeptSectIncharge::class, 'plc_module_id', 'id');
    }

}
