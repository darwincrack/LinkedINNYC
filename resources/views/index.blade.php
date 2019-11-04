@extends('layouts.template')



@push('css')


<link rel="stylesheet" href="{{ URL::asset('assets/css/plugins/datapicker/datepicker3.css') }}">
@endpush

@section('title', 'Contact Information')




@section('content')

    <main role="main" class="container">
    <div class="jumbotron">
        <h3>Contact Information</h3>
        <p>Mandatory fields are marked with an asterisk {{env('STRIPE_SECRET')}}</p>


       @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="flash-message">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
        @endforeach
    </div> <!-- end .flash-message -->

            <form  method="post" action="{{ URL::asset('/') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}

            <div class="form-group">
                <label>First name <span class="text-danger">*</span></label>

                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}"  required> 
                @if ($errors->has('first_name'))
                <span class="text-danger">
            <strong>{{ $errors->first('first_name') }}</strong>
        </span> @endif

            </div>


            <div class="form-group">
                <label>Last name <span class="text-danger">*</span></label>

                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}"  required> 
                @if ($errors->has('last_name'))
                <span class="text-danger">
            <strong>{{ $errors->first('last_name') }}</strong>
        </span> @endif

            </div>

         <div class="form-group">
                <label>Email <span class="text-danger">*</span></label>

                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}" required> 
                @if ($errors->has('email'))
                <span class="text-danger">
            <strong>{{ $errors->first('email') }}</strong>
        </span> @endif

            </div>

              <div class="form-group">
                <label>Street Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="street_address" name="street_address" value="{{ old('street_address') }}"  maxlength="60" required> 
                @if ($errors->has('street_address'))
                <span class="text-danger">
            <strong>{{ $errors->first('street_address') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>Address Line 2</label>
                <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="{{ old('address_line_2') }}"> 
                @if ($errors->has('address_line_2'))
                <span class="text-danger">
            <strong>{{ $errors->first('address_line_2') }}</strong>
        </span> @endif

            </div>

            <div class="form-group">
                <label>City <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" required> 
                @if ($errors->has('city'))
                <span class="text-danger">
            <strong>{{ $errors->first('city') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>State / Province / Region <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" required> 
                @if ($errors->has('state'))
                <span class="text-danger">
            <strong>{{ $errors->first('state') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>Postal / Zip Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required> 
                @if ($errors->has('postal_code'))
                <span class="text-danger">
            <strong>{{ $errors->first('zip_code') }}</strong>
        </span> @endif
            </div>

        <div class="form-group">
                <label>Country <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="country" name="country" value="{{ old('country') }}" required> 
                @if ($errors->has('country'))
                <span class="text-danger">
            <strong>{{ $errors->first('country') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>Mobile Number <small>(Country code / City Code / Number)</small> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required> 
                @if ($errors->has('mobile_number'))
                <span class="text-danger">
            <strong>{{ $errors->first('mobile_number') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>Birthday <span class="text-danger">*</span></label>

                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="birthday" id="birthday" class="form-control" value="{{ old('birthday') }}" placeholder="MM/DD/YYYY" required autocomplete="off"> 
                    @if ($errors->has('birthday'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span> @endif
                </div>

            </div>

            <br>
            <h3>Web & Social Medias</h3>

            <div class="form-group">
                <label>Artist Name <small>(how appears in
LinkedIn profile)</small> <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="artist_name" name="artist_name" value="{{ old('artist_name') }}" required> 
                @if ($errors->has('artist_name'))
                <span class="text-danger">
            <strong>{{ $errors->first('artist_name') }}</strong>
        </span> @endif
            </div>

            <h5>Social promotions will link to your public art accounts</h5>

            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram') }}"> 
                @if ($errors->has('instagram'))
                <span class="text-danger">
            <strong>{{ $errors->first('instagram') }}</strong>
        </span> @endif
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook') }}"> 
                @if ($errors->has('facebook'))
                <span class="text-danger">
            <strong>{{ $errors->first('facebook') }}</strong>
        </span> @endif
            </div>


            <div class="form-group">
                <label>Website</label>
                <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}"> 
                @if ($errors->has('website'))
                <span class="text-danger">
            <strong>{{ $errors->first('website') }}</strong>
        </span> @endif
            </div>

<br>
 <h3>Presentation of Artwork</h3>

  
<br>
<p>Category Allowed: Painting only</p>
<p>Painting size allowed: 10” height x 8” width inches - Vertical oriented</p>
<p>Technique allowed: Mixed media, oil, acrylic on canvas</p>


            <div class="form-group">
                <label>Upload <small>(Curriculum & Bio or Statement of the artwork, only PDF) </small> <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="upload_file" name="upload_file" value="{{ old('upload_file') }}" required> 
                @if ($errors->has('upload_file'))
                <span class="text-danger">
            <strong>{{ $errors->first('upload_file') }}</strong>
        </span> @endif
            </div>




            <div class="form-group">
                <label>¿First time exhibiting? </label>
                
                     <label class="radio-inline"><input type="radio" name="exhibiting_option" value="yes">Yes</label>
                
                
                     <label class="radio-inline"><input type="radio" name="exhibiting_option" value="no">No</label>
                
            </div>


            <div class="form-group">
                <label>If no, please mention the most recent exhibition including name of the place, city and country</label>
                <input type="text" class="form-control" id="exhibiting_text" name="exhibiting_text" value="{{ old('exhibiting_text') }}"> 
                @if ($errors->has('exhibiting_text'))
                <span class="text-danger">
            <strong>{{ $errors->first('exhibiting_text') }}</strong>
        </span> @endif
            </div>




            <br>
            <h3>Artwork Shipping</h3>

<p>SUGGESTED WAY TO SHIP the Artwork</p>
          <!--  <div class="form-group">
                <label>SUGGESTED WAY TO SHIP the Artwork</label>

                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" name="suggested_day" id="suggested_day" class="form-control" value="{{ old('suggested_day') }}" autocomplete="off"> 
                    @if ($errors->has('suggested_day'))
                    <span class="help-block">
                                        <strong>{{ $errors->first('suggested_day') }}</strong>
                                    </span> @endif
                </div>

            </div> -->


            <br>
            <h3>Shipment Address</h3>

            <p>South Art Dealer
                <br>℅ Gotham Mini Storage
                <br>501 10th Ave.
                <br>NY NY 10018</p>

            <img src="{{ URL::asset('assets/img/example.png') }}" class="img-responsive" alt="Example">

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="conditions_terms" name="conditions_terms" required>
                <label class="form-check-label">I have read the 
                    <a href="{{url('terms-conditions')}}" target="_blank">General Conditions & Terms</a></label><br>
                @if ($errors->has('conditions_terms'))
                <span class="text-danger">
            <strong>{{ $errors->first('conditions_terms') }}</strong>
        </span> @endif
            </div>

            <div class="row">
                <div class="col">
                    <div class="mx-auto w-50 p-3  text-center">
                        <button type="submit" class="btn btn-success btn-lg">Submit</button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</main>

@stop





@push('scripts')

<script src="{{ URL::asset('assets/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
        $('.date').datepicker({

        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

</script>
@endpush