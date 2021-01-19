@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h2>Pre-Internship Requirements</h2>

        <h4>Downloadable Files</h4>
        <a href="pre-internship/download-file/SIP-Endorsement">Endorsement Form</a>
        <br/>
        <a href="pre-internship/download-file/SIP-Agreement">Internship Agreement Form</a>

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
                        <label id="{{'label-' . $data->internshipRequirements->id}}">
                        @if ($data->status == Status::NOT_STARTED)
                            No Data
                        @elseif ($data->status == Status::PENDING)
                            Pending
                        @elseif ($data->status == Status::APPROVED)
                            Approved
                        @elseif ($data->status == Status::DISAPPROVED)
                            Declined
                        @endif
                        </label>
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
                        <Select class="form-control" style="margin-bottom: 20px;" id="type" required>
                            <option disabled selected> Choose an option</option>
                            @foreach ($internshipRequirements as $requirement)
                                <option value="{{$requirement->id}}">{{$requirement->desc}}</option>
                            @endforeach
                        <label>File:</label>
                        <input type="file" class="form-control" multiple="multiple" id="file">
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
    <script type="text/javascript" src="{{ asset('js/custom-js/students/pre-intern.js') }}"> </script>
@endsection
