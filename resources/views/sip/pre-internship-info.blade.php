@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h3>Pre-Internship Requirements</h3>

        <h4>{{$student->last_name . ' ' . $student->first_name}}<h4>
        <h5>{{$student->course->name}}<h5>
        <button class="btn btn-success float-right" data-id="{{$student->id}}" id="complete-btn">Complete User</button>
        <br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col" width="800">Desc</th>
                <th scope="col">Files</th>
                <th scope="col">Remarks</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($internshipData as $data)
                <tr>
                    <td>
                        {{$data->internshipRequirements->desc}}
                    </td>
                    <td>
                        {{$data->file_url}}
                    </td>
                    <td>{{$data->remarks}}</td>
                    <td>
                        @if ($data->status == 0)
                            No Data
                        @elseif ($data->status == 1)
                            Pending
                        @elseif ($data->status == 2)
                            Approved
                        @elseif ($data->status == 4)
                            Declined
                        @endif
                    </td>
                    
                    <td>
                        @if ($data->status == 1 || $data->status == 0)
                            <button class="btn btn-danger decline-listener" data-id="{{$data->id}}" data-toggle="modal" data-target="#exampleModal">Declined</button> 
                            <button class="btn btn-primary approve-listener" data-toggle="modal" data-target="#exampleModal" data-id="{{$data->id}}">Approved</button> 
                        @endif
                        
                    </td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a Remark for the user</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <label>Remarks:</label>
                        <input type="text" class="form-control" id="remarks">
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn-save" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" id="data-id">
        <input type="hidden" id="status">
        <input type="hidden" id="id" value="{{$student->id}}">
    @else
    
    @endif

    <script type="text/javascript" src="{{ asset('js/custom-js/sip/pre-internship-view.js') }}"> </script>

@endsection
