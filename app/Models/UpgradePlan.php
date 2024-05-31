<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpgradePlan extends Model
{
    use HasFactory;

    protected $table = 'upgrade_plans';

    protected $fillable = [
        'name', 'length', 'price', 'is_deleted', 'created_at', 'updated_at'
    ];

    public function userPlans()
    {
        return $this->hasMany(UserPlan::class, 'plan_id');
    }
}
