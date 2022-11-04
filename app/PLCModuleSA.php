<?php

namespace App;

use App\PlcCapa;
use App\PlcCategory;
use App\PLCModuleRCM;
use App\PlcEvidences;
use App\PLCCAPACapaAnalysis;
use App\PLCCAPACorrectiveAction;
use App\PLCCAPAPreventiveAction;
use App\PLCModuleRCMInternalControl;
use App\PLCModuleSADicAssessmentDetailsAndFindings;
use App\PLCModuleSAOecAssessmentDetailsAndFindings;
use Illuminate\Database\Eloquent\Model;

class PLCModuleSA extends Model
{
    protected $table = 'tbl_plc_module_sa';
    protected $connection = 'mysql';

    public function plc_evidences(){
        return $this->hasOne(PlcEvidences::class, 'id', 'internal_control_id');
    }

    public function rcm_module(){
        return $this->hasOne(PLCModuleRCM::class, 'id', 'rcm_id');
    }

    public function plc_categories(){
        return $this->hasOne(PlcCategory::class, 'id', 'category');
    }

    public function plc_sa_dic_assessment_details_finding(){
        return $this->hasMany(PLCModuleSADicAssessmentDetailsAndFindings::class, 'sa_id', 'id');
    }

    public function plc_sa_oec_assessment_details_finding(){
        return $this->hasMany(PLCModuleSAOecAssessmentDetailsAndFindings::class, 'sa_id', 'id');
    }

    public function plc_sa_rf_assessment_details_finding(){
        return $this->hasMany(PLCModuleSARfAssessmentDetailsAndFindings::class, 'sa_id', 'id');
    }

    public function plc_sa_fu_assessment_details_finding(){
        return $this->hasMany(PLCModuleSAFuAssessmentDetailsAndFindings::class, 'sa_id', 'id');
    }

    public function plc_capa_details(){
        return $this->hasMany(PlcCapa::class, 'sa_id', 'id');
    }

    public function rcm_info(){
        return $this->hasMany(PLCModuleRCMInternalControl::class, 'rcm_id', 'rcm_id')->where('status', 0);
    }

    // public function plc_capa_corrective_actions_details(){
    //     return $this->hasMany(PLCCAPACorrectiveAction::class, 'plc_capa_id', 'id');
    // }

    // public function plc_capa_preventive_actions_details(){
    //     return $this->hasMany(PLCCAPAPreventiveAction::class, 'plc_capa_id', 'id');
    // }


    public function plc_rev_history(){
        return $this->hasOne(PLCModule::class, 'id', 'sa_id');
    }
}
