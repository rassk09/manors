<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManorText extends BaseModel
{
    protected $table = 'manors_texts';
    protected $fillable = [
        'manor_id', 'title', 'content', 'position'
    ];

    public function initializeAdminForm() {}
    public function initializeAdminList() {}

    public function manor()
    {
        return $this->belongsTo(Manor::class, 'manor_id');
    }

}
