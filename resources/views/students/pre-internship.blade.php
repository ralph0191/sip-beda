@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h4>Pre-Internship Requirements</h4>
        <button class="btn btn-primary float-right" style="margin-right: 50px; margin-bottom:10px;"data-toggle="modal" data-target="#addFileModal">Add Attachment</button>
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
                        @elseif ($data->status == 2)
                            "Approved"
                        @endif
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>

        <div class="modal fade" id="addFileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="fileModalLabel">Add File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <label>Where to put File:</label>
                        <Select type="file" class="form-control" style="margin-bottom: 20px;" id="type" required>
                            <option disabled selected> Choose an option<option>
                            @foreach ($internshipData as $data)
                                <option value="{{$data->internshipRequirements->id}}">{{$data->internshipRequirements->desc}}</option>
                            @endforeach
                        <label>File:</label>
                        <input type="file" class="form-control" id="remarks">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-save" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        
    @else
    
    @endif
    
    
@endsection
