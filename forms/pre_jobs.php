<div class="row gx-md-3 gy-4 mb-4">
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
    <div class="col-md-2">
        <label for="pre_comment">Special Condition</label>
        <input type="text" name="pre_comment" class="form-control fs-6 fw-normal" id="pre_comment"
            placeholder="Special Condition">
    </div>
    <div class="col-md-1 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJobData">
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
<div id="showPreJobData">

</div>