<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationsController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('livewire.login');
    }

    // Handle login
    public function loginPerform(Request $request)
    {
        
        // Validate the request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check user status (optional, depending on your use case)
        // $credentials['status'] = 1;
        
        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Regenerate the session to avoid session fixation
            session()->regenerate();

            // Redirect the user based on their role
            // $user = Auth::user();
            // $role = $user->roles->first()->name;
            // if ($role == "Creator") {
            //     $this->checkSubscriptionStatus($user);
            // }
            return redirect('dashboard')->with('success', 'Login successful!');
        }

        // If authentication fails
        return back()->withErrors([
            'email' => 'Your provided credentials could not be verified.',
        ]);
    }

    // Check subscription status for the Creator role
    private function checkSubscriptionStatus($user)
    {
        $tributors = $user->tributors()->with('selectedPlan', 'tributorCoupons')->get();

        foreach ($tributors as $tributor) {
            $isExpired = false;
            $subscriptionEndDate = null;
            $expirationDate = null;

            // Coupon and plan expiration logic (as per your existing code)
            $tributorCoupon = $tributor->tributorCoupons;
            $selectedPlan = $tributor->selectedPlan;
            $customerToken = $selectedPlan->stripe_customer_token ?? $tributorCoupon->stripe_customer_token;

            $subscriptions = getCustomerSubscriptions($customerToken);
            $subscriptionData = $subscriptions->data;

            // Extract subscription end date
            foreach ($subscriptionData as $subscription) {
                $endDate = $subscription->current_period_end;
                $subscriptionEndDate = \Carbon\Carbon::createFromTimestamp($endDate);
                break;
            }

            // Check coupon and plan validity
            $isExpired = $this->checkCouponAndPlanValidity($tributor, $subscriptionEndDate);
            
            // Update status if expired
            if (empty($subscriptionData) || $isExpired) {
                $tributor->update(['status' => 'expired']);
            }
        }
    }

    private function checkCouponAndPlanValidity($tributor, $subscriptionEndDate)
    {
        $isExpired = false;

        // Coupon check logic
        $tributorCoupon = $tributor->tributorCoupons;
        if ($tributorCoupon) {
            $expirationDate = \Carbon\Carbon::parse($tributorCoupon->created_at)
                ->addDays($tributorCoupon->coupon->user_validity ?? 0);

            if ($expirationDate && $expirationDate->isPast()) {
                $isExpired = true;
            }
        }

        // Plan check logic
        $selectedPlan = $tributor->selectedPlan;
        if (!$isExpired && $selectedPlan) {
            $expirationDate = \Carbon\Carbon::parse($selectedPlan->created_at)
                ->addDays($selectedPlan->plan->validity_in_days ?? 0);

            if ($expirationDate && $expirationDate->isPast()) {
                $isExpired = true;
            }
        }

        // Subscription end date check
        if ($subscriptionEndDate && $subscriptionEndDate->isPast()) {
            $isExpired = true;
        }

        return $isExpired;
    }

    // Show registration form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 1,  // Set default status, adjust as needed
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to dashboard
        return redirect('dashboard')->with('success', 'Registration successful!');
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/login')->with('success', 'You have been logged out.');
    }
}
