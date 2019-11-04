@extends('layouts.template')



@push('css')

@endpush

@section('title', 'Error')




@section('content')


   <main role="main" class="container">
        <div class="jumbotron text-center">
                   <h3>Payment successful</h3>
                    <p>your payment token is: </p>
                    <strong>{{ $stripe_token }}</strong> 
                    <br>
                    <p style="color:red">Note: the verification email could not be sent, please save the token number.</p>

        </div>
    </main>




@stop





@push('scripts')





@endpush