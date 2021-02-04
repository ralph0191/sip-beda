<?php 

namespace App\Constants;

Class SipStatus {
    const NOT_STARTED = 0;
    const PENDING = 1;
    const APPROVED = 2;
    const APPROVED_BOTH = 3;
    const DISAPPROVED = 4;


    const STUDENT = 0;
    const SIP = 1;
    const DEPT_CHAIR = 2;

    const PRE_INTENT_FORM = 0;
    const PRE_ENDORSEMENT_FORM = 1;
    const PRE_RESUME = 2;
    const PRE_INTERNSHIP_EXPECTATION = 3;
    const PRE_PHOTOCOPY_GRADES = 4;
    const PRE_BIRTH_CERT = 5;
    const PRE_MED_CERT = 6;
    const PRE_INTERN_AGREEMENT = 7;
    const PRE_WRITTING_CONSENT = 8;
    const PRE_COR = 9;
    const PRE_ATTENDANCE = 10;

    const DURING_WEEKLY = 14;

    const PRE_INTERNSHIP = 0;
    const DURING_INTERNSHIP = 1;
    const END_INTERNSHIP = 2;
    
    const ACCEPTED = 1;
    const DECLINED = 2;

    const FIRST_OJT = 0;
    const SECOND_OJT = 1;

    const PRE_INTERNSHIP_REQUIREMENTS = 11;

    const PRE_INTERNSHIP_ARRAY = [
        1, 2 ,3 ,4 ,5 ,6, 7, 8, 9, 10, 11
    ];

    const DURING_INTERNSHIP_REQUIREMENTS = 3;

    const DURING_INTERNSHIP_ARRAY = [
        12, 13, 14
    ];

    const END_INTERNSHIP_REQUIREMENTS = 3;

    const END_INTERNSHIP_ARRAY = [
        15, 16, 17
    ];

}