<div class="row gx-md-3 gy-4 mb-4"> 
    <div class="col-md-2">
    <input type="hidden" value="<?php echo get_the_ID(); ?>" name="job_entry_<?php echo get_the_ID(); ?>"
            class="form-control fs-6 fw-normal" id="job_entry_<?php echo get_the_ID(); ?>" >
        <label for="job_entry_<?php echo get_the_ID(); ?>_1_from_date">From Date 1</label>
        <input type="text" value="<?php echo date('M-d-y'); ?>" name="job_entry_<?php echo get_the_ID(); ?>_1_from_date"
            class="form-control fs-6 fw-normal datepicker" id="job_entry_<?php echo get_the_ID(); ?>_1_from_date" placeholder="From Date">
    </div>
    <div class="col-md-2">
        <label for="job_entry_<?php echo get_the_ID(); ?>_1_to_date">To Date</label>
        <input type="text" value="<?php echo date('M-d-y'); ?>" name="job_entry_<?php echo get_the_ID(); ?>_1_to_date"
            class="form-control fs-6 fw-normal datepicker" id="job_entry_<?php echo get_the_ID(); ?>_1_to_date" placeholder="To Date">
    </div>
    <div class="col-md-2">
        <label for="job_entry_<?php echo get_the_ID(); ?>_1_gross_earning">Gross Earnings</label>
        <input type="number" name="job_entry_<?php echo get_the_ID(); ?>_1_gross_earning" class="form-control fs-6 fw-normal" id="job_entry_<?php echo get_the_ID(); ?>_1_gross_earning"
            placeholder="Gross Earnings">
    </div>
    <div class="col-md-2">
        <label for="job_entry_<?php echo get_the_ID(); ?>_1_pre_comment">Special Condition</label>
        <input type="text" name="job_entry_<?php echo get_the_ID(); ?>_1_pre_comment" class="form-control fs-6 fw-normal" id="job_entry_<?php echo get_the_ID(); ?>_1_pre_comment"
            placeholder="Special Condition">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit dynamic-btn" type="button" id="<?php echo get_the_ID(); ?>">
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
<div id="showPreJobData<?php echo get_the_ID(); ?>">
</div>