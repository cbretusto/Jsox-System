<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuditFinding extends Model
{
    //
    protected $table = "audit_findings";
    protected $connection = "mysql";
}
