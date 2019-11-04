

@extends('layouts.template')



@push('css')

<style>
    .jumbotron h1 {
    font-size: 42px;
}

</style>


@endpush

@section('title', 'Stripe Payment Gateway')




@section('content')

    <main role="main" class="container">
        <div class="jumbotron">


    <h1 style="text-align: center">Stripe Payment Gateway </h1>
    <h3 style="text-align: center">Pay Now US$ {{env('STRIPE_AMOUNT')}} </h3>
  
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >                            
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>                    
                </div>
                <div class="panel-body">
  
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
  
                        <form  method="post" id="payment-form" action="{{ route('stripe.post') }}" method="post" class="require-validation">

                             {!! csrf_field() !!}


            <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->



                        <div class="outcome">
                          <div class="error"></div>
                          <div class="success">
                                <span class="token"></span>
                          </div>
                        </div>


                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Name on Card</label> 
                                <input class='form-control name' id="card_name" size='4' type='text' autocomplete='off'>
                            </div>
                        </div>

                          <div class="form-row">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- a Stripe Element will be inserted here. -->
                            </div>
                          </div>

  <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Street Address</label> <input
                                    autocomplete='off' id="address_line1" class='form-control address_line1' size='20'
                                    type='text'>
                            </div>
                     </div>


                     

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card '>
                                <label class='control-label'>Street Address Line 2</label> <input
                                    autocomplete='off' id="address_line2" class='form-control address_line2' size='20'
                                    type='text'>
                            </div>
                      </div>

                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>City</label> <input
                                    autocomplete='off' id="address_city" class='form-control address_city' size='20'
                                    type='text'>
                            </div>
                        </div>

                       <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>State</label> <input
                                    autocomplete='off' id="address_state" class='form-control address_state' size='20'
                                    type='text'>
                            </div>
                       </div>

                         <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Country</label> <input
                                    autocomplete='off' id="address_country" class='form-control address_country' size='20'
                                    type='text'>
                            </div>
                        </div>


                               <div class='form-row row'>                  
                            <div class='col-xs-12 form-group card required'>
                                <label class='control-label'>Zip Code</label> <input
                                    autocomplete='off' id="address_zip" class='form-control address_zip' size='20'
                                    type='text'>
                            </div>
 </div>





                     <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn-submit">Pay Now (US$ {{env('STRIPE_AMOUNT')}})</button>
                            </div>
                            <div  style="text-align: center; display: none" class="text-cargando">Cargando...</div>
                        </div>

<input type="hidden" name="first_name" value="{{Session::get('first_name')}}">
<input type="hidden" name="last_name" value="{{Session::get('last_name')}}">
<input type="hidden" name="email" value="{{Session::get('email')}}">
<input type="hidden" name="street_address" value="{{Session::get('street_address')}}">
<input type="hidden" name="address_line_2" value="{{Session::get('address_line_2')}}">
<input type="hidden" name="city" value="{{Session::get('city')}}">
<input type="hidden" name="state" value="{{Session::get('state')}}">
<input type="hidden" name="zip_code" value="{{Session::get('zip_code')}}">
<input type="hidden" name="country" value="{{Session::get('country')}}">
<input type="hidden" name="mobile_number" value="{{Session::get('mobile_number')}}">
<input type="hidden" name="birthday" value="{{Session::get('birthday')}}">
<input type="hidden" name="artist_name" value="{{Session::get('artist_name')}}">
<input type="hidden" name="instagram" value="{{Session::get('instagram')}}">
<input type="hidden" name="facebook" value="{{Session::get('facebook')}}">
<input type="hidden" name="website" value="{{Session::get('website')}}">
<input type="hidden" name="exhibiting_option" value="{{Session::get('exhibiting_option')}}">
<input type="hidden" name="exhibiting_text" value="{{Session::get('exhibiting_text')}}">

<input type="hidden" name="upload_file" value="{{Session::get('upload_file')}}">


                        </form>



                </div>
            </div>        
        </div>
    </div>


        </div>
    </main>


@stop





@push('scripts')



<script src="https://js.stripe.com/v3/"></script>
  
<script type="text/javascript">

var stripe = Stripe('{{env('STRIPE_KEY')}}',{
  locale: 'en'});
var elements = stripe.elements();

var $form         = $(".require-validation");


var card = elements.create('card', {
hidePostalCode: true,
style: {
 base: {


  lineHeight: '40px',
   fontWeight: 500,
   fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
   fontSize: '17px',

   '::placeholder': {
          color: 'black',
        }
  }, 
 } 
});

card.mount('#card-element');


function setOutcome(result) {

$("#btn-submit").attr("disabled", false);
$(".text-cargando").hide();
  var successElement = document.querySelector('.success');
  var errorElement = document.querySelector('.error');

  if (result.error) {
    successElement.classList.remove('visible');
    errorElement.textContent = result.error.message;
    errorElement.classList.add('visible');
  } else {
    errorElement.classList.remove('visible');
    // Use the token to create a charge or a customer
    // https://stripe.com/docs/charges
    //successElement.querySelector('.token').textContent = result.token.id;
    //successElement.classList.add('visible');



            // token contains id, last4, and card type
            var token = result.token.id;
            // insert the token into the form so it gets submitted to the server
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();





  }
}

card.on('change', function(event) {
  if (event.error) {
    setOutcome(event);
  }
});

document.querySelector('form').addEventListener('submit', function(e) {
  $(".text-cargando").toggle();
  $("#btn-submit").attr("disabled", true);
  e.preventDefault();
  var card_name = document.getElementById('card_name').value;
  var address_line1 = document.getElementById('address_line1').value;
  var address_line2 = document.getElementById('address_line2').value;
  var address_city = document.getElementById('address_city').value;
  var address_state = document.getElementById('address_state').value;
  var address_country = document.getElementById('address_country').value;
  var address_zip = document.getElementById('address_zip').value;


  stripe.createToken(card, {name: card_name,
                            address_line1: address_line1,
                            address_line2:address_line2,
                            address_city:address_city,
                            address_state:address_state,
                            address_country:address_country,
                            address_zip:address_zip}).then(setOutcome);
});









</script>


@endpush
















































