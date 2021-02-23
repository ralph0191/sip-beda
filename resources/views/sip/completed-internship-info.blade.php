@extends('layouts.app')

@section('content')
    @if (Auth::user())
        <div class="card-header ">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Completed Internship</h4>
                        <h5 class="card-category">{{$student->user->last_name . ' ' . $student->user->first_name}}</h5>
                        <h5 class="card-category">{{$student->course->name}}</h5>
                    </div>
                    <div class="col-md-6">
                        <img src="{{asset('storage/photo/'. $student->user->picture)}}" style=" max-width: 4.5vw;
                        height: auto;" alt="SIP SBCA" class="profilepic">
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="card-body">          
                            <div class="table-full-width table-responsive">  
                                <table class="table table-bordered table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" width="500">Desc</th>
                                            <th scope="col">Files</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date Submitted</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($internshipData as $data)
                                        <tr>
                                            <td>
                                                {{$data->internshipRequirements->desc}}
                                            </td>
                                            <td>
                                                @if (count($data->internshipFiles) > 0)
                                                    @foreach ($data->internshipFiles as $file)
                                                        <a href="{{'/sip/pre-internship/download-file/' . $file->id}}">{{$file->file_name }}</a>
                                                    @endforeach
                                                @endif
                                                
                                            </td>
                                            <td>{{$data->remarks}}</td>
                                            <td>
                                                @if ($data->status == Status::NOT_STARTED)
                                                    No Data
                                                @elseif ($data->status == Status::PENDING)
                                                    Pending
                                                @elseif ($data->status == Status::APPROVED)
                                                    Approved
                                                @elseif ($data->status == Status::DISAPPROVED)
                                                    Declined
                                                @endif
                                            </td>
                                            <td>
                                                {{ $data->updated_at != null ? \Carbon\Carbon::parse($data->updated_at)->format('M d, Y g:i:A') : ''}}
                                            </td>
                                            <td>
                                                @if ($data->status == Status::PENDING)
                                                    <button class="btn btn-danger decline-listener" data-id="{{$data->id}}" data-toggle="modal" data-target="#exampleModal">Declined</button> 
                                                    <button class="btn btn-primary approve-listener" data-toggle="modal" data-target="#exampleModal" data-id="{{$data->id}}">Approved</button> 
                                                @endif
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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

    <script type="text/javascript" src="{{ asset('js/custom-js/sip/during-internship-view.js') }}"> </script>

@endsection
