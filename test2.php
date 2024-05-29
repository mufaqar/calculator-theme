<?php
/*
Template Name: Test2
*/
get_header();

?>


<div class="row gx-md-3 gy-4 mb-4 add_prejob">
    <div class="col-md-4">
        <label for="pre_job1_title">Add Job </label>
        <input type="text" name="pre_job1_title" class="form-control fs-6 fw-normal" id="pre_job1_title"
            placeholder="Job 1">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJob">
            Add PreJob
        </button>
    </div>
</div>
<div id="jobsContainer"></div>

<script>



let jobs = [];
let jobIdCounter = 1;
let paystubIdCounter = 1;

document.getElementById('addPreJob').addEventListener('click', addJob);

function addJob() {
    const jobTitleInput = document.getElementById('pre_job1_title');
    const jobTitle = jobTitleInput.value.trim();

    if (jobTitle) {
        // Capture current data
        captureData();
        
        // AJAX request to create a new job in WordPress
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'create_new_job',
                job_title: jobTitle
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    const job = {
                        postId: res.job_id,
                        title: jobTitle,
                        jobData: [{
                            paystubId: paystubIdCounter++,
                            fromDate: '',
                            toDate: '',
                            grossEarnings: '',
                            specialCondition: ''
                        }]
                    };
                    jobs.push(job);
                    jobTitleInput.value = '';
                    renderJobs();
                } else {
                    alert('Failed to create job.');
                }
            }
        });
    } else {
        alert('Please enter a job title.');
    }
}

function addPaystub(postId) {
    // Capture current data
    captureData();

    const job = jobs.find(j => j.postId === postId);
    if (job) {
        const newPaystub = {
            paystubId: paystubIdCounter++,
            fromDate: '',
            toDate: '',
            grossEarnings: '',
            specialCondition: ''
        };
        job.jobData.push(newPaystub);

        // AJAX request to update the job with the new paystub
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'update_job_with_paystub',              
                job_id: postId,
                from_date: newPaystub.fromDate,
                to_date: newPaystub.toDate,
                gross_earnings: newPaystub.grossEarnings,
                special_condition: newPaystub.specialCondition
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    renderJobs();
                } else {
                    alert('Failed to add paystub.');
                }
            }
        });
    }
}

function removePaystub(postId, paystubId) {
    // Capture current data
    captureData();

    const job = jobs.find(j => j.postId === postId);
    if (job) {
        job.jobData = job.jobData.filter(p => p.paystubId !== paystubId);
        renderJobs();

        // AJAX request to remove the paystub from the job in WordPress
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'removePaystub',            
                job_id: postId,
                paystub_id: paystubId
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (!res.success) {
                    alert('Failed to remove paystub.');
                }
            }
        });
    }
}




function removeJob(postId) {
    // Capture current data
    captureData();
    jobs = jobs.filter(j => j.postId !== postId);
    renderJobs();

    // AJAX request to remove the job from WordPress
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'remove_job',
            job_id: postId
        },
        success: function(response) {
            const res = JSON.parse(response);
            if (!res.success) {
                alert('Failed to remove job.');
            }
        }
    });
}

function captureData() {
    jobs.forEach(job => {
        job.jobData.forEach(paystub => {
            const fromDateInput = document.querySelector(`#from_date_${paystub.paystubId}`);
            const toDateInput = document.querySelector(`#to_date_${paystub.paystubId}`);
            const grossEarningsInput = document.querySelector(`#gross_earnings_${paystub.paystubId}`);
            const specialConditionInput = document.querySelector(`#special_condition_${paystub.paystubId}`);

            if (fromDateInput) paystub.fromDate = fromDateInput.value;
            if (toDateInput) paystub.toDate = toDateInput.value;
            if (grossEarningsInput) paystub.grossEarnings = grossEarningsInput.value;
            if (specialConditionInput) paystub.specialCondition = specialConditionInput.value;
        });
    });
}

function renderJobs() {
    const jobsContainer = document.getElementById('jobsContainer');
    jobsContainer.innerHTML = '';
    jobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.textContent = `Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.addEventListener('click', () => addPaystub(job.postId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.addEventListener('click', () => removeJob(job.postId));
        jobDiv.appendChild(removeJobButton);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                <div class="col-md-3">
                    <label for="from_date_${paystub.paystubId}">From Date</label>
                    <input type="text" name="f_date[]" id="from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" value="${paystub.fromDate}">
                </div>
                <div class="col-md-3">
                    <label for="to_date_${paystub.paystubId}">To Date</label>
                    <input type="text" name="t_date[]" id="to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" value="${paystub.toDate}">
                </div>
                <div class="col-md-3">
                    <label for="gross_earnings_${paystub.paystubId}">Gross Earnings</label>
                    <input type="text" name="g_earning[]" id="gross_earnings_${paystub.paystubId}" placeholder="Gross Earnings" class="form-control fs-6 fw-normal" value="${paystub.grossEarnings}">
                </div>
                <div class="col-md-2">
                    <label for="special_condition_${paystub.paystubId}">Special Condition</label>
                    <input type="text" name="sp[]" id="special_condition_${paystub.paystubId}" placeholder="Special Condition" class="form-control fs-6 fw-normal" value="${paystub.specialCondition}">
                </div>
                <img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />
            `;

            const removePaystubButton = paystubDiv.querySelector('.remove-row');
            removePaystubButton.addEventListener('click', () => removePaystub(job.postId, paystub.paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        jobsContainer.appendChild(jobDiv);
    });

    console.log(jobs);
}

renderJobs();



</script>

<?php wp_footer(); ?>