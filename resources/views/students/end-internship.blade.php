@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <div class="card-header ">
            <h4 class="card-title">End of Internship Requirements</h4>
        </div> 
        
        <div class="content">
            <div class="row">
                <div class="col-md-9">
                    <div class="card-header">
                        <div class="card-body">          
                            <div class="table-full-width table-responsive">
                                <table class="table">
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
                                                @if ($data->status == Status::APPROVED)
                                                <i class="fas fa-check-square"></i>
                                                @else
                                                <i class="fas fa-times"></i>
                                                @endif

                                                <label class="form-check-label">
                                                    {{$data->internshipRequirements->desc}}
                                                </label>
                                            </div>
                                            </td>
                                            <td>
                                            {{$data->remarks}}
                                            </td>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding-top:70px; padding-right:70px;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Downloadable Files</h4>
                        </div>
                        <div class="card-body">
                            <a href="pre-internship/download-file/supervisors-evaluation">Supervisor's Evaluation of Student Internship Performance</a>
                             <br/>
                            <a href="pre-internship/download-file/completion-report-reflection">Internship Completion Report and Reflection</a>
                        </div>
                        <div class="card-header">
                            <h4 class="card-title">File Submission</h4>
                        </div>
                        <div class="card-body">
                        <button class="btn btn-primary" style="margin-right: 50px; margin-bottom:10px;"data-toggle="modal" data-target="#addFileModal">Add Attachment</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            
                            @foreach ($internshipData as $data)
                                <option {{$data->status == Status::APPROVED ? 'disabled' : ''}} value="{{$data->internshipRequirements->id}}">{{$data->internshipRequirements->desc}}</option>
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
