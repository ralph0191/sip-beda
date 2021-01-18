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
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck0" disabled checked>
                        <label class="form-check-label" for="defaultCheck1">
                            Notice of Intent Form (processed one semester before the scheduled internship)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Request for Endorsement Form
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Resume – 2 copies (1 for school file and 1 for the company, follow the given format)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck3" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Internship Expectations Essay (1 page, computerized, printed on a short bond paper, Arial Font, size 12 and 1.5 line spacing)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck4" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Photocopy of grades (school file)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck5" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Photocopy of Birth Certificate (1 for company and 1 for school file)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck6" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Medical Certificate (Indicating that students is in good health and emotionally fit. The Medical certificate shall be based on a physical and psychological examination conducted, or certified by the Department of Health (DOH) accredited clinics and hospitals.)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck7" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Internship Agreement Form (signed by parents)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck8" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Notarized Written Consent Letter from Parent or Legal Guardian
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Photocopy of COR/Add Drop Registration Form (proof that one is enrolled in the Internship Program in the present semester)
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                        <label class="form-check-label" for="defaultCheck1">
                            Attendance in the SIP Orientation and Seminar
                        </label>
                      </div>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    @else
    
    @endif
    
    
@endsection
