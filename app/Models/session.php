<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'ip_address',
        'user_agent',
        'payload',
        'last_activity',
        'isDesktop',
        'isTablet',
        'isMobile',
        'browserName',
        'platformName',
        'isWindows',
        'isLinux',
        'isMac',
        'isAndroid',
        'isChrome',
        'isFirefox',
        'isOpera',
        'isSafari',
        'isIE',
        'isEdge',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
