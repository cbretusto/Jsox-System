<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RevisionHistoryDeptSectConformance;

class RevisionHistoryConformance extends Model
{
    protected $table = 'revision_history_conformances';
    protected $connection = 'mysql';


    public function conformance_details(){
    	return $this->hasMany(RevisionHistoryDeptSectConformance::class, 'conformance_id', 'id');
    }

}
