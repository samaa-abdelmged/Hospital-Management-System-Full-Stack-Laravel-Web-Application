<?php

namespace App\Models;

use App\Mail\loginMail;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Section extends Model
{
    use Translatable; // 2. To add translation methods
    protected $fillable = ['name', 'description'];
    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name', 'description'];
    use HasFactory;

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }


}