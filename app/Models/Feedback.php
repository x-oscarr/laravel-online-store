<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    const TYPE_CALL_ME = 'call_me';
    const TYPE_REVIEW = 'review';
    const TYPE_COMPLAINT = 'complaint';
    const TYPE_PAYMENT = 'payment';

    const TYPES = [
        self::TYPE_CALL_ME => 'model.feedback.type.call_me',
        self::TYPE_REVIEW => 'model.feedback.type.review',
        self::TYPE_COMPLAINT => 'model.feedback.type.complaint',
        self::TYPE_PAYMENT => 'model.feedback.type.payment',
    ];

    protected $fillable = ['type', 'is_processed', 'comment', 'is_displayed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getTypeNameAttribute()
    {
        return trans(self::TYPES[$this->type]);
    }
}
