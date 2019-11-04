<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe_Error; 
   
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        
        return view('stripe');
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {





try {
  Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
       $response= Stripe\Charge::create ([
                "amount" => 4400,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Linked INNYC women of the world" 
        ]);
  
  
 
      Session::flash('alert-success', 'Payment successful, Your token is: '.$response['id']);
    return  redirect("stripe");

} catch(\Stripe\Exception\CardException $e) {
  // Since it's a decline, \Stripe\Exception\CardException will be caught
  /*echo 'Status is:' . $e->getHttpStatus() . '\n';
  echo 'Type is:' . $e->getError()->type . '\n';
  echo 'Code is:' . $e->getError()->code . '\n';
  // param is '' in this case
  echo 'Param is:' . $e->getError()->param . '\n';
  echo 'Message is:' . $e->getError()->message . '\n';*/

Session::flash('alert-danger', 'Payment declined. ['.$e->getMessage().']');
    return  redirect("stripe");

} catch (\Stripe\Exception\RateLimitException $e) {
  // Too many requests made to the API too quickly

     Session::flash('alert-danger', 'Too many requests made to the API too quickly. ['.$e->getMessage().']');
    return  redirect("stripe");

} catch (\Stripe\Exception\InvalidRequestException $e) {
  // Invalid parameters were supplied to Stripe's API
     Session::flash('alert-danger', 'Invalid parameters were supplied to Stripe API. ['.$e->getMessage().']');
    return  redirect("stripe");
} catch (\Stripe\Exception\AuthenticationException $e) {
  // Authentication with Stripe's API failed
  // (maybe you changed API keys recently)

     Session::flash('alert-danger', 'Authentication with Stripe API failed. ['.$e->getMessage().']');
    return  redirect("stripe");


} catch (\Stripe\Exception\ApiConnectionException $e) {
  // Network communication with Stripe failed

     Session::flash('alert-danger', 'Network communication with Stripe failed. ['.$e->getMessage().']');
    return  redirect("stripe");


} catch (\Stripe\Exception\ApiErrorException $e) {
  // Display a very generic error to the user, and maybe send
  // yourself an email

 Session::flash('alert-danger', 'Error!!. ['.$e->getMessage().']');
    return  redirect("stripe");

} catch (Exception $e) {
  // Something else happened, completely unrelated to Stripe

 Session::flash('alert-danger', 'Something else happened, completely unrelated to Stripe. ['.$e->getMessage().']');
     return  redirect("stripe");

}



































try {



} catch (\Stripe\Error\Base $e) {

        Session::flash('error',  $e->getMessage());
 
        redirect("public/stripe");

  // Code to do something with the $e exception object when an error occurs
 


}

 catch (\Stripe_CardError $e) {

        Session::flash('error',  $e->getMessage());
 
        redirect("public/stripe");

  // Code to do something with the $e exception object when an error occurs
 


} 
 catch (Exception $e) {

        Session::flash('success', 'Intente de Nuevo por favor');
 
        redirect("public/stripe");

  // Catch any other non-Stripe exceptions
}








        

     //  return dd( $prueba);
          
        //return back();
    }
}