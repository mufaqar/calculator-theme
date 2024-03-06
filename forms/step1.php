<h3 class="fs-4 mb-4 lh-sm">
                  Claim Details
               </h3>

<div class="row gx-md-3 gy-4 mb-4">
    <div class="col-md-3 col-12">
        <label for="first_name"> First Name</label>
        <input type="text" name="first_name" class="form-control fs-6 fw-normal" id="first_name"
            placeholder="First Name">
    </div>
    <div class="col-md-3 col-12">
        <label for="last_name"> Last Name</label>
        <input type="text" name="last_name" class="form-control fs-6 fw-normal" id="last_name" placeholder="Last Name">
    </div>

    <div class="col-md-3 col-12">
        <label for="birthdate"> Email</label>
        <input type="text" name="birthdate" class="form-control fs-6 fw-normal" id="email" value="mufaqar2@gmail.com"
            placeholder="Enter Email Address">

    </div>
    <div class="col-md-3 col-12">
        <label for="birthdate"> Birthdate</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" data-date-format="DD MMMM YYYY" value="2015-08-09"
            name="dob" class="form-control fs-6 fw-normal" id="dob" placeholder="Birth Date">

    </div>
    <div class="col-md-3 col-12">
        <label for="age"> Age Today</label>
        <input type="number" name="age" class="form-control fs-6 fw-normal" id="age" placeholder="Age">
    </div>
    <div class="col-md-3 col-12">
        <label for="date_loss">Date of Loss (DOL)</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="date_loss" class="form-control fs-6 fw-normal"
            id="date_loss" placeholder="Date of Loss (DOL)">
    </div>
    <div class="col-md-3 col-12">
        <label for="age_loss"> Age on DOL</label>
        <input type="number" name="age_loss" class="form-control fs-6 fw-normal" id="age_loss" placeholder="40">
    </div>
    <div class="col-md-3 col-12">
        <label for="calc_date">Calculation Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="calc_date" class="form-control fs-6 fw-normal"
            id="calc_date" placeholder="Calculation Date">
    </div>
    <div class="col-md-3 col-12">
        <label for="age_calc"> Age on Calculation Date</label>
        <input type="number" name="age_calc" class="form-control fs-6 fw-normal" id="age_calc"
            placeholder="  Age on Calculation Date">
    </div>
    <div class="col-md-3 col-12">
        <label for="insurer">Insurer</label>
        <input type="text" name="insurer" class="form-control fs-6 fw-normal" id="insurer" placeholder="Insurer">
    </div>
    <div class="col-md-3 col-12">
        <label for="policy_no">Policy no</label>
        <input type="text" name="policy_no" class="form-control fs-6 fw-normal" id="policy_no" placeholder="Policy no">
    </div>
    <div class="col-md-3 col-12">
        <label for="claim_no">Claim no</label>
        <input type="text" name="claim_no" class="form-control fs-6 fw-normal" id="claim_no" placeholder="Claim no">
    </div>
    <div class="col-md-3 col-12">
        <label for="empl_status">Employment Status on the DOL</label>
        <select id="empl_status" name="empl_status" class="form-select" aria-label="empl_status">
            <option value="employed">Employed</option>
            <option value="self_employed">Self employed</option>
        </select>
    </div>
    <div class="col-md-3 col-12">
        <label for="irb_policy">Max IRB per Policy</label>
        <select id="irb_policy" name="irb_policy" class="form-select" aria-label="irb_policy">
            <option value="$400">$400</option>
            <option value="$800">$800</option>
            <option value="$1000">$1000</option>
        </select>
    </div>
    <div class="col-md-3 col-12 ps-5">
        <label for="gender"> Gender</label>
        <div class="d-flex align-items-end">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male">
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check ps-5">
                <input class="form-check-input" type="radio" name="gender" id="female" checked>
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
        </div>
    </div>
</div>