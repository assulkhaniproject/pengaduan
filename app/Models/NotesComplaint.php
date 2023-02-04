<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotesComplaint extends Model
{
    use HasFactory;

    protected $fillable = [
'pengaduan_id','user_id','notes','tindakan'
    ];

    // public function pemeliharaan(): BelongsTo {
    //     return $this->belongsTo(PemeliharaanBarang::class);
    // }
    // public function status(): BelongsTo {
    //     return $this->belongsTo(StatusPengaduan::class);
    // }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
