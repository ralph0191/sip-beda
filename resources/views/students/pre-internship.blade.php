@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h4>Pre-Internship Requirements</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Desc</th>
                <th scope="col">Files</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                    <label class="form-check-label" for="defaultCheck1">
                      Default checkbox
                    </label>
                  </div>
                </td>
                {{-- <input type="checkbox" style="padding-left: 15px;" class="form-check-input" id="exampleCheck1">Mark</td></td> --}}
                <td>Otto</td>
            </tr>
            <tr>
                
                <td>Jacob</td>
                <td>Thornton</td>
            </tr>
            <tr>
                <td colspan="2">Larry the Bird</td>
            </tr>
            </tbody>
        </table>
    @else
    
    @endif
    
    
@endsection
