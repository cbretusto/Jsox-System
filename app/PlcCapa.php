<?php

namespace App;
use App\PLCModuleSADicAssessmentDetailsAndFindings;
use App\PLCModuleSAOecAssessmentDetailsAndFindings;
use App\PLCCAPACapaAnalysis;
use App\PLCCAPACorrectiveAction;
use App\PLCCAPAPreventiveAction;

use Illuminate\Database\Eloquent\Model;

class PlcCapa extends Model
{
    protected $table = 'tbl_plc_capa';
    protected $connection = 'mysql';

    public function plc_sa_info(){
        return $this->hasOne(PLCModuleSA::class, 'id', 'sa_id');
    }

    public function plc_rev_history(){
        return $this->hasOne(PLCModule::class, 'id', 'sa_id');
    }

    public function plc_sa_dic_assessment_details_findings_details(){
        return $this->hasMany(PLCModuleSADicAssessmentDetailsAndFindings::class, 'sa_id', 'sa_id');
    }
    public function plc_sa_oec_assessment_details_findings_details(){
        return $this->hasMany(PLCModuleSAOecAssessmentDetailsAndFindings::class, 'sa_id', 'sa_id');
    }

    public function plc_sa_capa_analysis_details(){
        return $this->hasMany(PLCCAPACapaAnalysis::class, 'plc_capa_id', 'id');
    }

    public function plc_sa_corrective_action_details(){
        return $this->hasMany(PLCCAPACorrectiveAction::class, 'plc_capa_id', 'id');
    }
    
    public function plc_sa_preventive_action_details(){
        return $this->hasMany(PLCCAPAPreventiveAction::class, 'plc_capa_id', 'id');
    }
}
