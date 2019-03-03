<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class PaymentsController extends Controller
{

    public function createPayment(Request $request)
    {
    	$apiContext = new \PayPal\Rest\ApiContext(
          	        new \PayPal\Auth\OAuthTokenCredential(
          	            'AeqdFHXOg-V0nHCfbjIjGNBcvZRIdiYfsUVcg-KlXZCU7YrAXn7kJ95fsRyv3nREmSpZFOfU6uvpY-a6',     // ClientID
          	            'EGQp7HnroeqRafSbrhZTJ3z7J6MU-Cqx7iUColYQqIa4kaXAfBWpja6Y14K-RNtQ0CCoOhgTiPXc9nuJ'      // ClientSecret
          	        )
    	);

    	$payer = new Payer();
  		$payer->setPaymentMethod("paypal");

  		$item1 = new Item();
  		$item1->setName('Ground Coffee 40 oz')
  		    ->setCurrency('USD')
  		    ->setQuantity(1)
  		    ->setPrice($request->get('amount'));

  		$itemList = new ItemList();
  		$itemList->setItems(array($item1));

  		$amount = new Amount();
  		$amount->setCurrency("USD")
  		    ->setTotal($request->get('amount'));


  		$transaction = new Transaction();
  		$transaction->setAmount($amount)
  		    ->setItemList($itemList)
  		    ->setDescription("Payment description")
  		    ->setInvoiceNumber(uniqid());


  		$redirectUrls = new RedirectUrls();
  		$redirectUrls->setReturnUrl("http://localhost:8000/execute-payment")
  		    ->setCancelUrl("http://localhost:8000/cancel");


  		$payment = new Payment();
  		$payment->setIntent("sale")
  			    ->setPayer($payer)
  			    ->setRedirectUrls($redirectUrls)
  			    ->setTransactions(array($transaction));

  		$payment->create($apiContext);

  		return redirect($payment->getApprovalLink());
	}



	public function executePayment()
	{
		Session::put('success', 'You have paid successfully');
		return redirect('/');
	}


	public function cancel()
	{
		Session::put('error', 'Sorry! Something went wrong.');
		return redirect('/');
	}



}
