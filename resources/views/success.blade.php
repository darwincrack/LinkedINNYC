@extends('layouts.template')



@push('css')

@endpush

@section('title', 'Success')




@section('content')

    <main role="main" class="container">
        <div class="jumbotron text-center">
               <h3>Payment successful</h3>
                <p>your payment token is:</p>
                 <strong>{{ $stripe_token}}</strong> 
                <br>
                <p>a confirmation email has been sent. </p>

                <p><a href="https://www.southartdealer.com/linked-innyc/">Back to Linked INNYC news</a></p>

        </div>
    </main>




@stop





@push('scripts')





@endpush