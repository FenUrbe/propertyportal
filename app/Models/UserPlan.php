<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    use HasFactory;

    protected $table = 'user_plans';

    protected $fillable = [
        'plan_id', 'user_id', 'start_at', 'expires_at', 'status', 'paid_amount', 'payer_id', 'payment_id', 'token', 'approval_url', 'payment_success', 'created_at', 'updated_at'
    ];

    public function plan()
    {
        return $this->belongsTo(UpgradePlan::class, 'plan_id');
    }
}
