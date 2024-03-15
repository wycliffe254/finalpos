<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Safaricom\Daraja\Daraja;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Use Safaricom Daraja API to initiate payment
        $daraja = new Daraja();

        // Assuming you have a form with input fields for the phone number and amount
        $phoneNumber = $request->input('phone_number');
        $amount = $request->input('amount');

        // Generate a unique transaction reference
        $transactionReference = time() . '_' . uniqid();

        try {
            // Initiate payment
            $response = $daraja->lipaNaMpesaOnline($phoneNumber, $amount, $transactionReference);

            // Process the response, update your database, etc.
            if ($response->success) {
                // Payment was initiated successfully
                // Store relevant information in your database or handle as needed
                return response()->json(['message' => 'Payment initiated successfully']);
            } else {
                // Payment initiation failed
                // Handle the error and provide feedback to the user
                return response()->json(['error' => $response->errorMessage]);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that may occur during the payment initiation
            return response()->json(['error' => $e->getMessage()]);
        }
    }
    public function initiateMpesaStkPush(Request $request)
{
    $phoneNumber = $request->input('phoneNumber');
    $amount = $request->input('amount');
    $transactionReference = 'YOUR_GENERATED_REFERENCE';

    // Use Safaricom Daraja API to initiate STK Push
    $daraja = new Daraja();
    $response = $daraja->initiateStkPush($phoneNumber, $amount, $transactionReference);

    // Process the response, update your database, etc.
    if ($response->success) {
        // Payment request initiated successfully
        return response()->json(['message' => 'Payment request initiated successfully']);
    } else {
        // Payment request initiation failed
        return response()->json(['error' => $response->errorMessage]);
    }
}

    public function handleCallback(Request $request)
    {
        // Handle callback from Safaricom Daraja API
        // This is where you verify the payment status and update your application state

        // Assuming the callback contains transaction details
        $transactionDetails = $request->all();

        // Verify the payment status using the details from the callback
        $paymentStatus = $this->verifyPaymentStatus($transactionDetails);

        // Update your database or application state based on the payment status
        if ($paymentStatus === 'completed') {
            // Payment was successful
            // Update your database, mark the order as paid, etc.
            // Return a response to Safaricom Daraja API indicating successful processing
            return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Payment successful']);
        } else {
            // Payment was not successful
            // Handle accordingly and return an appropriate response
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Payment failed']);
        }
    }

    private function verifyPaymentStatus($transactionDetails)
    {
        // Assuming the callback contains necessary information like transaction status
        $transactionStatus = $transactionDetails['TransactionStatus'];
        $resultCode = $transactionDetails['ResultCode'];
    
        // Check the transaction status and result code to determine payment status
        if ($resultCode == 0 && strtoupper($transactionStatus) === 'COMPLETED') {
            // Payment was successful
            return 'completed';
        } else {
            // Payment was not successful
            return 'failed';
        }
    }
    
}

