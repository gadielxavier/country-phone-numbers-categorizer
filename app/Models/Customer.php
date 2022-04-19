<?php

namespace App\Models;

use App\Classes\PhoneNumber;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = ['id', 'name', 'phone'];

    public $timestamps = false;

    protected $phoneNumber;

    public static function boot() {
        parent::boot();
        static::retrieved(function ($model) {
            $model->phoneNumber = new PhoneNumber($model->phone);
        });
    }

    public function getPhoneNumber(){
        return $this->phoneNumber;
    }

}
