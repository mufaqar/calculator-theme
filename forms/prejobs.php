<h3 class="fs-4 mb-4 lh-sm">PRE-ACCIDENT INCOME</h3>
<div class="row gx-md-3 gy-4 mb-4 add_prejob">
    <div class="col-md-4">
        <label for="pre_job1_title">Add Job </label>
        <input type="text" name="pre_job1_title" class="form-control fs-6 fw-normal" id="pre_job1_title"
            placeholder="Enter Job Title">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPreJob">
            Add PreJob
        </button>
    </div>
</div>
<div id="preJobsContainer"></div>

<script>
let dbJobs = [];
let preJobs = [];
let prePaystubIdCounter = 0;

fetchExistingJobs();

document.addEventListener('DOMContentLoaded', function() {
    fetchExistingJobs();
});

function fetchExistingJobs() {
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'get_existing_jobs',

        },
        success: function(response) {
            try {
                const res = JSON.parse(response);
                // console.log("res.jobs", res.jobs);
                if (res.jobs) {
                    dbJobs = res.jobs.map(job => {
                        job.jobData = job?.paystubs.map(paystub => {
                            return {
                                paystubId: prePaystubIdCounter++, // Ensure unique paystubId
                                fromDate: paystub?.from_date,
                                toDate: paystub?.to_date,
                                grossEarnings: paystub?.gross_earnings,
                                specialCondition: paystub?.special_condition
                            };
                        });
                        return job;
                    });

                    // Transfer dbJobs to preJobs
                    preJobs = dbJobs.map(job => {
                        return {
                            title: job.job_title,
                            postId: job.job_id,
                            jobData: job.jobData
                        };
                    });



                    renderDbJobs();
                } else {
                    alert('Failed to fetch existing jobs.');
                }
            } catch (error) {
                console.error('Error parsing response:', error);
                alert('Error fetching jobs.');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', status, error);
            alert('Error fetching jobs.');
        }
    });
}

function renderDbJobs() {
    const dbJobsContainer = document.getElementById('preJobsContainer');
    if (!dbJobsContainer) {
        console.error('DbJobsContainer element not found.');
        return;
    }

    dbJobsContainer.innerHTML = '';
    preJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Pre-Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                <div class="col-md-3">
                    <label for="from_date_${paystub.paystubId}">From Date</label>
                    <input type="text" name="f_date[]" id="from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.fromDate}">
                </div>
                <div class="col-md-3">
                    <label for="to_date_${paystub.paystubId}">To Date</label>
                    <input type="text" name="t_date[]" id="to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.toDate}">
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
            removePaystubButton.addEventListener('click', () => removePrePaystub(job.postId, paystub
                .paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        dbJobsContainer.appendChild(jobDiv);
    });
}


document.getElementById('addPreJob').addEventListener('click', addPreJob);

function addPreJob() {
    const jobTitleInput = document.getElementById('pre_job1_title');
    const jobTitle = jobTitleInput.value.trim();

    if (jobTitle) {
        capturePreData();

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'create_new_job',
                job_title: jobTitle,
                type: "pre-income"
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    const job = {
                        postId: res.job_id,
                        title: jobTitle,
                        jobData: [{
                            paystubId: prePaystubIdCounter++,
                            fromDate: '',
                            toDate: '',
                            grossEarnings: '',
                            specialCondition: ''
                        }]
                    };
                    preJobs.push(job);
                    jobTitleInput.value = '';
                    renderPreJobs();
                } else {
                    alert('Failed to create job.');
                }
            }
        });
    } else {
        alert('Please enter a job title.');
    }
}


function renderDbJobs() {
    const dbJobsContainer = document.getElementById('preJobsContainer');
    if (!dbJobsContainer) {
        console.error('DbJobsContainer element not found.');
        return;
    }

    dbJobsContainer.innerHTML = '';
    preJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Pre-Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addPrePaystub(job.postId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removePreJob(job.postId));
        jobDiv.appendChild(removeJobButton);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                <div class="col-md-3">
                    <label for="from_date_${paystub.paystubId}">From Date</label>
                    <input type="text" name="f_date[]" id="from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.fromDate}">
                </div>
                <div class="col-md-3">
                    <label for="to_date_${paystub.paystubId}">To Date</label>
                    <input type="text" name="t_date[]" id="to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.toDate}">
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
            removePaystubButton.addEventListener('click', () => removePrePaystub(job.postId, paystub
                .paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        dbJobsContainer.appendChild(jobDiv);
    });
}

renderDbJobs();

function addPrePaystub(postId) {
    capturePreData();
    const job = preJobs.find(j => j.postId === postId);
    const lastObj = job.jobData[job.jobData.length - 1]
    if (job) {
        const newPaystub = {
            paystubId: prePaystubIdCounter++,
            fromDate: '',
            toDate: '',
            grossEarnings: '',
            specialCondition: ''
        };
        job.jobData.push(newPaystub);

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'update_job_with_paystub',
                paystubId: prePaystubIdCounter++,
                job_id: postId,
                from_date: lastObj.fromDate,
                to_date: lastObj.toDate,
                gross_earnings: lastObj.grossEarnings,
                special_condition: lastObj.specialCondition
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    renderPreJobs();
                } else {
                    alert('Failed to add paystub.');
                }
            }
        });
    }
}




function removePrePaystub(postId, paystubId) {
    capturePreData();

    const job = preJobs.find(j => j.postId === postId);
    if (job) {
        job.jobData = job.jobData.filter(p => p.paystubId !== paystubId);
        renderPreJobs();
        console.log(job);

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'removePaystub',
                job_id: postId,
                job: job.jobData
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

function removePreJob(postId) {
    capturePreData();
    preJobs = preJobs.filter(j => j.postId !== postId);
    renderPreJobs();

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

function capturePreData() {
    preJobs.forEach(job => {
        job.jobData.forEach(paystub => {
            const fromDateInput = document.querySelector(`#from_date_${paystub.paystubId}`);
            const toDateInput = document.querySelector(`#to_date_${paystub.paystubId}`);
            const grossEarningsInput = document.querySelector(`#gross_earnings_${paystub.paystubId}`);
            const specialConditionInput = document.querySelector(
                `#special_condition_${paystub.paystubId}`);

            if (fromDateInput) paystub.fromDate = fromDateInput.value;
            if (toDateInput) paystub.toDate = toDateInput.value;
            if (grossEarningsInput) paystub.grossEarnings = grossEarningsInput.value;
            if (specialConditionInput) paystub.specialCondition = specialConditionInput.value;
        });
    });
}

function renderPreJobs() {
    const jobsContainer = document.getElementById('preJobsContainer');
    jobsContainer.innerHTML = '';
    preJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Pre-Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addPrePaystub(job.postId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removePreJob(job.postId));
        jobDiv.appendChild(removeJobButton);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                        <div class="col-md-3">
                            <label for="from_date_${paystub.paystubId}">From Date</label>
                            <input type="text" name="f_date[]" id="from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.fromDate}">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date_${paystub.paystubId}">To Date</label>
                            <input type="text" name="t_date[]" id="to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.toDate}">
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
            removePaystubButton.addEventListener('click', () => removePrePaystub(job.postId, paystub
                .paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        jobsContainer.appendChild(jobDiv);
    });

    console.log(preJobs);
}

renderPreJobs();
</script>