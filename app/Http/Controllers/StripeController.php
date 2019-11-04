<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\Input;
use Session;
use Stripe;
use Stripe_Error; 



class StripeController extends Controller
{
    

    public function store(Request $request)
    {




            $this->validate($request, [
                'first_name' => 'required|max:60',
                'last_name' => 'required|max:60',
				'email' => 'required|max:60',
				'street_address' => 'required|max:60',
				'city' => 'required|max:60',
				'state' => 'required|max:60',
				'zip_code' => 'required|max:60',
 				'mobile_number' => 'required|max:60',
 				'birthday' => 'required|max:60',
 				'artist_name' => 'required|max:60',
 				'exhibiting_text' => 'max:300',
 				'upload_file' => 'required|mimetypes:application/pdf|max:10000',
 				'conditions_terms' => 'required',

            ]
            );




       $data['first_name']        	=   encrypt(trim($request->input("first_name")));
       $data['last_name']        	=   encrypt(trim($request->input("last_name")));
       $data['email']        		=   encrypt(trim($request->input("email")));
       $data['street_address']      =   encrypt($request->input("street_address"));
       $data['address_line_2']      =   encrypt($request->input("address_line_2"));
       $data['city']        		=   encrypt($request->input("city"));
       $data['state']        		=   encrypt($request->input("state"));
       $data['zip_code']        	=   encrypt($request->input("zip_code"));
       $data['country']        		=   encrypt($request->input("country"));
       $data['mobile_number']       =   encrypt($request->input("mobile_number"));
       $data['birthday']        	=   encrypt($request->input("birthday"));
       $data['artist_name']         =   encrypt($request->input("artist_name"));
       $data['instagram']        	=   encrypt($request->input("instagram"));
       $data['facebook']        	=   encrypt($request->input("facebook"));
       $data['website']        	    =   encrypt($request->input("website"));
       $data['exhibiting_option']   =   encrypt($request->input("exhibiting_option"));
       $data['exhibiting_text']     =   encrypt($request->input("exhibiting_text"));


       $file  =   $request->file('upload_file');



         if($request->hasFile('upload_file')){
            $nombre_logo=encrypt($file->getClientOriginalName());
            $file->move('assets/img/form',$file->getClientOriginalName());
        }


			session(['first_name' => $data['first_name']]);
			session(['last_name' => $data['last_name']]);
			session(['email' => $data['email']]);
			session(['street_address' => $data['street_address']]);
			session(['address_line_2' => $data['address_line_2']]);
			session(['city' => $data['city']]);
			session(['state' => $data['state']]);
			session(['zip_code' => $data['zip_code']]);
			session(['country' => $data['country']]);
			session(['mobile_number' => $data['mobile_number']]);
			session(['birthday' => $data['birthday']]);
			session(['artist_name' => $data['artist_name']]);
			session(['instagram' => $data['instagram']]);
			session(['facebook' => $data['facebook']]);
			session(['website' => $data['website']]);
			session(['exhibiting_option' => $data['exhibiting_option']]);
			session(['exhibiting_text' => $data['exhibiting_text']]);

			session(['upload_file' =>  $nombre_logo]);
			session(['token' =>  	$request->input("_token")]);
		



	   		return redirect("stripe");




	   



 

		//email al administrador con los datos cargados en el  formulario

      /*  Mail::send('emails.email', $data, function($message) use($data, $input){
 
           $message->to('erudito_good@hotmail.com', 'women.linkedinnyc');
             
  	       $message->subject('LINKED INNYC women of the world');

  	       if ( isset($input['upload_file'])){

	  	       		$message->	attach('assets/img/form/screen.png', [
	            		'as' => 'screen.png', 
	            		'mime' => 'application/pdf'
	        		]);

					
  	       		            $message->attach($input['upload_file']->getRealPath(), array(
							'as' 	=> $input['upload_file']->getClientOriginalName(), 
        					'mime' 	=> $input['upload_file']->getMimeType()));

  	       }
            
        });



		//email al usuario que envio el formulario
          Mail::send('emails.usuario', $data, function($message) use($data, $input){
 
           $message->to($data['email'], $data['first_name']." ".$data['last_name']);
             
  	       $message->subject('LINKED INNYC women of the world');

            

        });






 
        if (Mail::failures()) {

        	$request->session()->flash('alert-error', 'Sorry! Please try again latter' );

         	return redirect('error');
         }else{
           
           $request->session()->flash('alert-success', 'Great! Successfully send in your mail' );

         	return redirect('success');

         }
 

        return redirect('/');*/
    }


    public function stripe()
    {

    	
        if(Session::has('token')){
        	return view('stripe');
        }
        else{
        	return redirect('/');
        }
        
    }



        public function success()
    {

    	
        if(Session::has('token')){

        	$stripe_token = Session::get('stripe-token');
        	Session::flush();
        	return view('success',['stripe_token'=>$stripe_token]);
        }
        else{
        	return redirect('/');
        }
        
    }


        public function error()
    {

    	
        if(Session::has('token')){

        	$stripe_token = Session::get('stripe-token');
        	Session::flush();
        	return view('error',['stripe_token'=>$stripe_token]);

        }
        else{
        	return redirect('/');
        }
        
    }

    public function borrar()
    {
        Session::flush();
        return "borrado";
    }



      /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {








			try {


 		

	   $data['first_name']        	=   decrypt(trim($request->input("first_name")));
       $data['last_name']        	=   decrypt(trim($request->input("last_name")));
       $data['email']        		=   decrypt(trim($request->input("email")));
       $data['street_address']      =   decrypt($request->input("street_address"));
       $data['address_line_2']      =   decrypt($request->input("address_line_2"));
       $data['city']        		=   decrypt($request->input("city"));
       $data['state']        		=   decrypt($request->input("state"));
       $data['zip_code']        	=   decrypt($request->input("zip_code"));
       $data['country']        		=   decrypt($request->input("country"));
       $data['mobile_number']       =   decrypt($request->input("mobile_number"));
       $data['birthday']        	=   decrypt($request->input("birthday"));
       $data['artist_name']         =   decrypt($request->input("artist_name"));
       $data['instagram']        	=   decrypt($request->input("instagram"));
       $data['facebook']        	=   decrypt($request->input("facebook"));
       $data['website']        	    =   decrypt($request->input("website"));
       $data['exhibiting_option']   =   decrypt($request->input("exhibiting_option"));
       $data['exhibiting_text']     =   decrypt($request->input("exhibiting_text"));

	   $data['upload_file']         =   decrypt($request->input("upload_file"));







			  Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
			       $response= Stripe\Charge::create ([
			                "amount" => env('STRIPE_AMOUNT') *100,
			                "currency" => "usd",
			                "source" => $request->stripeToken,
			                "description" => "Linked INNYC women of the world" 
			        ]);





				$data['stripe_token'] = $response['id'];


		//email al administrador con los datos cargados en el  formulario

        Mail::send('emails.email', $data, function($message) use($data){
 
           $message->to('erudito_good@hotmail.com', 'women.linkedinnyc');
             
  	       $message->subject('LINKED INNYC women of the world');

  	       if ( $data['upload_file']!=""){

	  	       		$message->	attach('assets/img/form/'.$data['upload_file'], [
	            		'as' => $data['upload_file'], 
	            		'mime' => 'application/pdf'
	        		]);

					
  	       		           

  	       }
            
        });



		//email al usuario que envio el formulario
          Mail::send('emails.usuario', $data, function($message) use($data){
 
           $message->to($data['email'], $data['first_name']." ".$data['last_name']);
             
  	       $message->subject('LINKED INNYC women of the world');

            

        });






 
        if (Mail::failures()) {

        	//se envio el pago pero no se envio el correo

        	$request->session()->flash('stripe-token', $response['id'] );
             
  

         	return redirect('error');
         }else{
           
          // $request->session()->flash('alert-success', 'Great! Successfully send in your mail' );

         

         	$request->session()->flash('stripe-token', $response['id'] );

         	

         	return redirect('success');

         }









			  
			  
			 
			      

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

    }




}
