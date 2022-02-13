<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan; 

class BillingController extends Controller
{
    //
    public function billing(Request $request) {
        $plans = Plan::get();
        return view('settings.billing', compact('plans'));
    }

    //
    public function billing_save(Request $request) {
        
        $user = auth()->user();
        try {
            if($user->subscribed('default')) {
                // Update new payment method
                $user->updateDefaultPaymentMethod($request->payment_method);
            } else {
                $plan = Plan::where('name','=',$request->plan)->first();
                $user->plan_id = $plan->id;
                $user->trial_ends_at = null;
                $user->save();

                $user->newSubscription('default', $plan->api_id)->create($request->payment_method);
            }
        } catch(Exception $exception) {
            return back()->with(['alert' => 'Something went wrong submitting your billing info', 'alert_type' => 'error']);
        }
        return back()->with(['alert' => 'Successfully updated your password', 'alert_type' => 'success']);
    }

    public function switch_plan(Request $request) {
        $plan = Plan::where('name','=',$request->plan)->first();
        $user = auth()->user();
        try {
            $user->subscription('default')->swap($plan->api_id);
            $user->plan_id = $plan->id;
            $user->save();
        } catch(Exception $e) {
            return back()->with(['alert' => 'Something went wrong submitting your billing info', 'alert_type' => 'error']);
        }
        return back()->with(['alert'=>'Successfully switched your plan.', 'alert_type' => 'success']);
    }


    public function cancel(Request $request) {
        auth()->user()->subscription('default')->cancel();
        return back()->with(['alert'=>'Successfully canceled your subscriptions.', 'alert_type' => 'success']);
    }

    public function resume(Request $request) {
        auth()->user()->subscription('default')->resume();
        return back()->with(['alert'=>'Successfully resumed your subscriptions.', 'alert_type' => 'success']);
    }


}
