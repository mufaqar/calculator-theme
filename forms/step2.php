<h3 class="fs-4 mb-4 lh-sm">
    PRE-ACCIDENT INCOME
</h3>


<div class="row gx-md-3 gy-4 mb-4">
    <div class="col-md-2">
        <label for="pre_job1_title">Job 1</label>
        <input type="text" name="pre_job1_title" class="form-control fs-6 fw-normal" id="pre_job1_title"
            placeholder="Job 1">
    </div>
    <div class="col-md-2">
        <label for="pre_job1_from_date">From Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_from_date"
            class="form-control fs-6 fw-normal" id="pre_job1_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
        <label for="pre_job1_to_date">To Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="pre_job1_to_date"
            class="form-control fs-6 fw-normal" id="pre_job1_to_date" placeholder="To Date">
    </div>
    <div class="col-md-1 col">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="pre_job1_4_weeks" id="pre_job1_4_weeks">
            <label class="form-check-label" for="pre_job1_4_weeks">
                Prior 4-weeks
            </label>
        </div>
    </div>
    <div class="col-md-2 col">
        <div class="form-check ps-md-5">
            <input class="form-check-input" type="checkbox" name="pre_job1_52_weeks" id="pre_job1_52_weeks" checked>
            <label class="form-check-label" for="pre_job1_52_weeks">
                Prior 52-weeks
            </label>
        </div>
    </div>
    <div class="col-md-2">
        <label for="pre_job1_earning">Gross Earnings</label>
        <input type="number" name="pre_job1_earning" class="form-control fs-6 fw-normal" id="pre_job1_earning"
            placeholder="Gross Earnings">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJob">
            <?xml version="1.0" ?>
            <!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
            <svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1"
                viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect fill="none" height="50" width="50" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25"
                    y2="25" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9"
                    y2="41" />
            </svg>
        </button>
    </div>
</div>
<div id="pre_accident_form">

</div>




<!-- Step2 POST-ACCIDENT INCOME -->
<h3 class="fs-4 mb-4 lh-sm">
    Post-accident Income
</h3>

<div id="post_accident_form_pre">

</div>



<div class="row gx-md-3 gy-4 mb-4">
    <div class="col-md-2">
        <label for="post_job1_title">Job 1</label>
        <input type="text" name="post_job1_title" class="form-control fs-6 fw-normal" id="post_job1_title"
            placeholder="Job 1">
    </div>
    <div class="col-md-2">
        <label for="post_job1_from_date">From Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_from_date"
            class="form-control fs-6 fw-normal" id="post_job1_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
        <label for="post_job1_to_date">To Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_job1_to_date"
            class="form-control fs-6 fw-normal" id="post_job1_to_date" placeholder="To Date">
    </div>
    <div class="col-md-2">
        <label for="post_job1_earning">Gross Earnings</label>
        <input type="number" name="post_job1_earning" class="form-control fs-6 fw-normal" id="post_job1_earning"
            placeholder="Gross Earnings">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJob">
            <?xml version="1.0" ?>
            <!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
            <svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1"
                viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect fill="none" height="50" width="50" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25"
                    y2="25" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9"
                    y2="41" />
            </svg>
        </button>
    </div>
</div>
<div id="post_accident_form">

</div>

<!-- Step3 Post Form Benfits -->
<h3 class="fs-4 mb-4 lh-sm">
    Post-accident Benefits
</h3>
<div class="row gx-md-3 gy-4 mb-4">
    <div class="col-md-3">
        <label for="post_ben1">Post-accident Benefits 1</label>
        <input type="text" name="post_ben1_title" class="form-control fs-6 fw-normal" id="post_ben1_title"
            placeholder="Post-accident Benefits 1">
    </div>
    <div class="col-md-2">
        <label for="post_ben1_from_date">From Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_from_date"
            class="form-control fs-6 fw-normal" id="post_ben1_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
        <label for="post_ben1_to_date">To Date</label>
        <input type="date" value="<?php echo date('Y-m-d'); ?>" name="post_ben1_to_date"
            class="form-control fs-6 fw-normal" id="post_ben1_to_date" placeholder="To Date">
    </div>
    <div class="col-md-2">
        <label for="post_ben1_earning">Gross BENEFIT</label>
        <input type="number" name="post_ben1_earning" class="form-control fs-6 fw-normal" id="post_ben1_earning"
            placeholder="Gross BENEFIT">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJobBenifit">
            <?xml version="1.0" ?>
            <!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'>
            <svg enable-background="new 0 0 50 50" height="26px" width="30px" id="Layer_1" version="1.1"
                viewBox="0 0 50 50" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <rect fill="none" height="50" width="50" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="9" x2="41" y1="25"
                    y2="25" />
                <line fill="none" stroke="#ffffff" stroke-miterlimit="10" stroke-width="4" x1="25" x2="25" y1="9"
                    y2="41" />
            </svg>
        </button>
    </div>
</div>
<div id="post_job_benifit_form">

</div>