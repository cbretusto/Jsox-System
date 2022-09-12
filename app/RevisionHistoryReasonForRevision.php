<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevisionHistoryReasonForRevision extends Model
{
    protected $table = 'revision_history_reason_for_revisions';
    protected $connection = 'mysql';
}
