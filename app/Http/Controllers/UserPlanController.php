<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPlan;
use App\Models\UpgradePlan;
use Auth;

class UserPlanController extends Controller
{
    public function create(Request $request)
    {
        $plans = UpgradePlan::where('is_deleted', 0)->get();
        return view('user_plans.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:upgrade_plans,id',
            'paid_amount' => 'required|numeric',
            'payer_id' => 'required|string',
            'payment_id' => 'required|string',
            'token' => 'required|string',
            'approval_url' => 'required|string',
        ]);

        $userPlan = UserPlan::create([
            'plan_id' => $request->plan_id,
            'user_id' => Auth::id(),
            'paid_amount' => $request->paid_amount,
            'payer_id' => $request->payer_id,
            'payment_id' => $request->payment_id,
            'token' => $request->token,
            'approval_url' => $request->approval_url,
            'payment_success' => 1,
            'start_at' => now(),
            'expires_at' => $request->length === 'Annual' ? now()->addYear() : now()->addMonth(),
        ]);
        

        return redirect()->route('plans.show', $userPlan->id)->with('success', 'Plan purchased successfully.');
    }
}
