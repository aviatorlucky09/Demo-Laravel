@extends('layouts.guest.master')
@section('content')
 @include('homepage.maina_search')
 @include('homepage.boats_trending')
 @include('homepage.boat_in_few_clicks')

 @include('homepage.book_by_boat_types')
 @include('homepage.rental_marketplace')

 @include('homepage.popular_destinations')
 @include('homepage.words_from_operators')
 
@endsection
@section('footer_script')

<script>
    $(document).ready(function(){
         $('#check-in-date').datepicker({
            autoclose: true,
            orientation: "auto left"
        });
    });
    </script>
@endsection
