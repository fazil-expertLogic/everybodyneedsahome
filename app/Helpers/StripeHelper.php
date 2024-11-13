<?php



namespace App\Helpers;

use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;


class StripeHelper
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function charge($stripeToken, $amount)
    {
        try {
            $charge = $this->stripe->charges->create([
                'amount' => 100 * $amount, // Replace with actual amount in cents
                'currency' => 'usd', // Replace with appropriate currency code
                'source' => $stripeToken,
                'description' => 'Agreatwoman ',
            ]);
            return $charge->id;
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw new \Exception('Failed to charge card.');
        }
    }
    public function createCustomer($email, $name, $stripeToken)
    {
        try {
            $customer = $this->stripe->customers->create([
                'name' => $name,
                'email' => $email,
                'source' => $stripeToken
            ]);
            return $customer->id;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            dd($e->getMessage());
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw $e; // Throw the original Stripe exception
        }
    }

    public function createSubscription($customerToken, $priceId, $couponCode = null)
    {
        try {
            $customerSubscription = $this->stripe->subscriptions->create([
                'customer' => $customerToken,
                'items' => [
                    ['price' => $priceId]
                ],
                'coupon' => $couponCode
            ]);
            return $customerSubscription;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            dd("asdasd",$e->getMessage());
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw $e; // Throw the original Stripe exception
        }
    }

    public function createMultipleSubscriptions($customerToken, $priceId1, $priceId2, $couponCode = null)
    {
        try {
            // Create first subscription
            $subscription1 = $this->stripe->subscriptions->create([
                'customer' => $customerToken,
                'items' => [['price' => $priceId1]],
                'coupon' => $couponCode
            ]);

            // Create second subscription
            $subscription2 = $this->stripe->subscriptions->create([
                'customer' => $customerToken,
                'items' => [['price' => $priceId2]],
                'coupon' => $couponCode
            ]);

            return [
                'subscription1' => $subscription1,
                'subscription2' => $subscription2
            ];
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            \Log::error('Stripe Invalid Request Exception: ' . $e->getMessage());
            throw new \Exception('Invalid request parameters.');
        } catch (\Stripe\Exception\AuthenticationException $e) {
            \Log::error('Stripe Authentication Exception: ' . $e->getMessage());
            throw new \Exception('Authentication with Stripe failed.');
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            \Log::error('Stripe API Connection Exception: ' . $e->getMessage());
            throw new \Exception('Network error while communicating with Stripe.');
        } catch (\Stripe\Exception\ApiErrorException $e) {
            \Log::error('Stripe API Error Exception: ' . $e->getMessage());
            throw new \Exception('Stripe API error occurred.');
        } catch (\Exception $e) {
            \Log::error('General Error: ' . $e->getMessage());
            throw new \Exception('Failed to create subscriptions.');
        }
    }



    public function cancelSubscriptionAtPeriodEnd($subscriptionId)
    {
        try {
            $subscription = $this->stripe->subscriptions->update(
                $subscriptionId,
                ['cancel_at_period_end' => true]
            );
            return $subscription;
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw new \Exception('Failed to cancel subscription at period end.');
        }
    }

    public function couponRetrieve($coupon)
    {
        try {
            $coupon = $this->stripe->coupons->retrieve($coupon, ['expand' => ['applies_to']]);
            return $coupon;
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw new \Exception('Failed to retrieve coupon.');
        }
    }

    public function getCustomerSubscriptions($customerId)
    {
        try {
            $subscriptions = $this->stripe->subscriptions->all(['customer' => $customerId]);
            return $subscriptions;
        } catch (ApiErrorException $e) {
            \Log::error('Stripe API error: ' . $e->getMessage());
            throw new \Exception('Failed to retrieve subscriptions.');
        }
    }
    public function cancelSubscriptions($subId)
    {
        try {
            // Retrieve the subscription object
            $subscription = \Stripe\Subscription::retrieve($subId);

            // Cancel the subscription
            $cancelled = $subscription->cancel();

            return $cancelled;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle Stripe API errors
            error_log("Error cancelling subscription: " . $e->getMessage());
            return null; // or handle the error as needed
        } catch (Exception $e) {
            // Handle other exceptions
            error_log("Error cancelling subscription: " . $e->getMessage());
            return null; // or handle the error as needed
        }
    }
}
