@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h4>Pre-Internship Requirements</h4>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Desc</th>
                <th scope="col">Remarks</th>
                <th scope="col">Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($internshipData as $data)
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="{{'defaultCheck' . $data->id}}" disabled {{$data->status == 2 ? 'checked' : ''}}>
                        <label class="form-check-label">
                            {{$data->internshipRequirements->desc}}
                        </label>
                      </div>
                    </td>
                    <td></td>
                    <td>
                        @if ($data->status == 0)
                            "No Data"
                        @elseif ($data->status == 1)
                            "Pending"
                        @elseif ($data->status->approved)
                            "Approved"
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>

        <h4>Attachments</h4>
        
    @else
    
    @endif
    
    
@endsection
