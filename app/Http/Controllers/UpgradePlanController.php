<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UpgradePlan;

class UpgradePlanController extends Controller
{
    public function userPlan(){
        $plans = UpgradePlan::where('is_deleted', 0)->get();
        return view('user.plan', compact('plans'));
    } 
}
