@extends('layouts.default')
@section('content')

        <!-- @yield('content') -->

        @if ( ! empty($tweets) ) 
<div >                
        @foreach ($tweets as $tweet )
<blockquote class="twitter-tweet" lang="en">
{{$tweet->text}}<p>
<a href="https://twitter.com/{{$tweet->user->screen_name}}/statuses/{{$tweet->id_str}}">{{$tweet->created_at}}</a>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
</blockquote>

        @endforeach
</div>
                

        @else
                
        <p>No recent tweets found.</p>

                
        @endif  

@stop

