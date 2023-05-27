<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotUser extends Model
{
    use HasFactory;
    protected $table = 'slot_user';

    // Define relationships with other models, if needed
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
