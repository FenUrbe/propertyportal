<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use App\Models\UpgradePlan;
use App\Models\UserPlan;
use Carbon\Carbon;

class PayPalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret')
            )
        );

        $this->apiContext->setConfig([
            'mode' => config('paypal.mode'),
        ]);
    }

    public function create(Request $request)
    {
        $plan = UpgradePlan::findOrFail($request->plan_id);

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item->setName($plan->name)
            ->setCurrency('PHP')
            ->setQuantity(1)
            ->setPrice($plan->price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $amount = new Amount();
        $amount->setCurrency('PHP')
            ->setTotal($plan->price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($plan->length);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('paypal.execute'))
            ->setCancelUrl(route('paypal.cancel'));

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function execute(Request $request)
    {      
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');

        $payment = Payment::get($paymentId, $this->apiContext);

        //dd($payment->getLinks());

        $approvalLink = null;
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $approvalLink = $link->getHref();
                    break;
                }
            }

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        try {
            $result = $payment->execute($execution, $this->apiContext);
            
            $planName = $payment->getTransactions()[0]->getItemList()->getItems()[0]->getName();
            $planLength = $payment->getTransactions()[0]->getDescription();

            $plan = UpgradePlan::where('name', $planName)->where('length', $planLength)->first();

            $userPlan = new UserPlan();
            $userPlan->plan_id = $plan->id;
            $userPlan->user_id = Auth::id();
            $userPlan->start_at = Carbon::now();

            if ($plan->length === 'Monthly') {
                $userPlan->expires_at = Carbon::now()->addMonth();
            } elseif ($plan->length === 'Annual') {
                $userPlan->expires_at = Carbon::now()->addYear();
            }

            $userPlan->status = 1;
            $userPlan->paid_amount = $plan->price;
            $userPlan->payer_id = $payment->getPayer()->getPayerInfo()->getPayerId();
            $userPlan->payment_id = $payment->getId();

            $parsedUrl = parse_url($approvalLink);
            parse_str($parsedUrl['query'], $queryParams);
            $token = $queryParams['token'];
            
            $userPlan->token = $token;

            $userPlan->approval_url = $approvalLink;
            $userPlan->payment_success = 1;
            $userPlan->save();

            return redirect()->route('welcome')->with('success', 'Purchase Successful');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function cancel()
    {
        return view('notif.invalid');
    }
}
