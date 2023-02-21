<?php

namespace App;
use App\PlcCapa;

use Illuminate\Database\Eloquent\Model;

class PlcCapaStatementOfFindings extends Model
{
    protected $table = 'plc_capa_statement_of_findings';
    protected $connection = 'mysql';
}
