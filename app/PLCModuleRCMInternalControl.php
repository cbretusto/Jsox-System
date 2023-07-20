<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PLCModuleRCMInternalControl extends Model
{
    protected $table = 'plc_module_rcm_internal_controls';
    protected $connection = 'mysql';

    public function rcm_module(){
        return $this->hasOne(PLCModuleRCM::class, 'id', 'rcm_id');
    }
}
