@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
    <div class="container-fluid">
        <h1 class="mt-4">Intent Form</h1>
        <p>Voluptate tempor duis tempor cillum. Sint officia tempor nisi quis officia irure Lorem et adipisicing eu qui est nulla. Tempor ullamco laborum aute eiusmod consectetur cupidatat nulla minim aliquip et sit elit. Pariatur minim voluptate consequat culpa mollit. Enim nostrud occaecat cillum laborum fugiat id amet esse amet incididunt excepteur culpa minim.</p>
    </div>
    @else
    
    @endif
    
    
@endsection
