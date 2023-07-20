<?php

namespace App;
use App\PlcCategory;
use App\PlcCapaStatementOfFindings;
use App\PLCModuleSADicAssessmentDetailsAndFindings;
use App\PLCModuleSAOecAssessmentDetailsAndFindings;
use App\PLCModuleSARfAssessmentDetailsAndFindings;
use App\PLCModuleRCMInternalControl;

use Illuminate\Database\Eloquent\Model;

class PlcCapa extends Model
{
    protected $table = 'tbl_plc_capa';
    protected $connection = 'mysql';

    public function plc_category_info(){
        return $this->hasOne(PlcCategory::class, 'id', 'category');
    }

    public function plc_sa_info(){
        return $this->hasOne(PLCModuleSA::class, 'id', 'sa_id');
    }

    public function plc_rev_history(){
        return $this->hasOne(PLCModule::class, 'id', 'sa_id');
    }

    public function plc_sa_dic_assessment_details_findings_details(){
        return $this->hasMany(PLCModuleSADicAssessmentDetailsAndFindings::class, 'sa_id', 'sa_id')->where('dic_status', 'NG')->where('logdel', 0);
    }
    public function plc_sa_oec_assessment_details_findings_details(){
        return $this->hasMany(PLCModuleSAOecAssessmentDetailsAndFindings::class, 'sa_id', 'sa_id')->where('oec_status', 'NG')->where('logdel', 0);
    }
    public function plc_sa_rf_assessment_details_findings_details(){
        return $this->hasMany(PLCModuleSARfAssessmentDetailsAndFindings::class, 'sa_id', 'sa_id')->where('rf_status', 'NG')->where('logdel', 0);
    }

    public function capa_details(){
        return $this->hasMany(PlcCapaStatementOfFindings::class, 'plc_capa_id', 'id')->where('logdel', 0);
    }

    public function control_id(){
        return $this->hasMany(PLCModuleRCMInternalControl::class,'rcm_id','rcm_id')->where('status', '0')->where('logdel', 0);
    }

    // public function plc_sa_capa_analysis_details(){
    //     return $this->hasMany(PLCCAPACapaAnalysis::class, 'plc_capa_id', 'id');
    // }

    // public function plc_sa_corrective_action_details(){
    //     return $this->hasMany(PLCCAPACorrectiveAction::class, 'plc_capa_id', 'id');
    // }

    // public function plc_sa_preventive_action_details(){
    //     return $this->hasMany(PLCCAPAPreventiveAction::class, 'plc_capa_id', 'id');
    // }
}
