<h3 class="fs-4 mb-4 lh-sm">POST-ACCIDENT INCOME</h3>
<div class="row gx-md-3 gy-4 mb-4 add_postjob">
    <div class="col-md-4">
        <label for="post_job1_title">Add Job </label>
        <input type="text" name="post_job1_title" class="form-control fs-6 fw-normal" id="post_job1_title"
            placeholder="Enter Job Title">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addPostJob">
            Add PostJob
        </button>
    </div>
</div>
<div id="postJobsContainer"></div>

<script>
let dbPostJobs = [];
let postJobs = [];
let postPaystubIdCounter = 0;

fetchExistingPostJobs();

document.addEventListener('DOMContentLoaded', function() {
    fetchExistingPostJobs();
});

function fetchExistingPostJobs() {
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'get_existing_jobs'
        },
        success: function(response) {
            try {
                const res = JSON.parse(response);
                if (res.jobs) {
                    dbPostJobs = res.jobs.map(job => {
                        job.jobData = job?.paystubs.map(paystub => {
                            return {
                                paystubId: postPaystubIdCounter++, // Ensure unique paystubId
                                fromDate: paystub?.from_date,
                                toDate: paystub?.to_date,
                                grossEarnings: paystub?.gross_earnings,
                                specialCondition: paystub?.special_condition
                            };
                        });
                        return job;
                    });

                    // Transfer dbPostJobs to postJobs
                    postJobs = dbPostJobs.map(job => {
                        return {
                            title: job.job_title,
                            postId: job.job_id,
                            jobData: job.jobData
                        };
                    });

                    renderDbPostJobs();
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

function renderDbPostJobs() {
    const dbPostJobsContainer = document.getElementById('postJobsContainer');
    if (!dbPostJobsContainer) {
        console.error('DbPostJobsContainer element not found.');
        return;
    }

    dbPostJobsContainer.innerHTML = '';
    postJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Post-Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addPostPaystub(job.postId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removePostJob(job.postId));
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
            removePaystubButton.addEventListener('click', () => removePostPaystub(job.postId, paystub.paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        dbPostJobsContainer.appendChild(jobDiv);
    });
}

document.getElementById('addPostJob').addEventListener('click', addPostJob);

function addPostJob() {
    const jobTitleInput = document.getElementById('post_job1_title');
    const jobTitle = jobTitleInput.value.trim();

    if (jobTitle) {
        capturePostData();

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'create_new_job',
                job_title: jobTitle,
                type: "post-income"
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    const job = {
                        postId: res.job_id,
                        title: jobTitle,
                        jobData: [{
                            paystubId: postPaystubIdCounter++,
                            fromDate: '',
                            toDate: '',
                            grossEarnings: '',
                            specialCondition: ''
                        }]
                    };
                    postJobs.push(job);
                    jobTitleInput.value = '';
                    renderPostJobs();
                } else {
                    alert('Failed to create job.');
                }
            }
        });
    } else {
        alert('Please enter a job title.');
    }
}

function addPostPaystub(postId) {
    capturePostData();
    const job = postJobs.find(j => j.postId === postId);
    if (job) {
        const newPaystub = {
            paystubId: postPaystubIdCounter++,
            fromDate: '',
            toDate: '',
            grossEarnings: '',
            specialCondition: ''
        };
        job.jobData.push(newPaystub);
        renderPostJobs();
    }
}

function removePostPaystub(postId, paystubId) {
    capturePostData();

    const job = postJobs.find(j => j.postId === postId);
    if (job) {
        job.jobData = job.jobData.filter(p => p.paystubId !== paystubId);
        renderPostJobs();

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'remove_post_paystub',
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

function removePostJob(postId) {
    capturePostData();
    postJobs = postJobs.filter(j => j.postId !== postId);
    renderPostJobs();

    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'remove_post_job',
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

function capturePostData() {
    postJobs.forEach(job => {
        job.jobData.forEach(paystub => {
            const fromDateInput = document.querySelector(`#from_date_${paystub.paystubId}`);
            const toDateInput = document.querySelector(`#to_date_${paystub.paystubId}`);
            const grossEarningsInput = document.querySelector(`#gross_earnings_${paystub.paystubId}`);
            const specialConditionInput = document.querySelector(`#special_condition_${paystub.paystubId}`);

            paystub.fromDate = fromDateInput ? fromDateInput.value : '';
            paystub.toDate = toDateInput ? toDateInput.value : '';
            paystub.grossEarnings = grossEarningsInput ? grossEarningsInput.value : '';
            paystub.specialCondition = specialConditionInput ? specialConditionInput.value : '';
        });
    });
}

function renderPostJobs() {
    const postJobsContainer = document.getElementById('postJobsContainer');
    if (!postJobsContainer) {
        console.error('postJobsContainer element not found.');
        return;
    }

    postJobsContainer.innerHTML = '';
    postJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Post-Job: ${job.title} (ID: ${job.postId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addPostPaystub(job.postId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removePostJob(job.postId));
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
            removePaystubButton.addEventListener('click', () => removePostPaystub(job.postId, paystub.paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        postJobsContainer.appendChild(jobDiv);
    });

    // Reinitialize datepickers for new inputs
    reinitializeDatepickers();
}

function reinitializeDatepickers() {
    jQuery('.datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: '1900:2100'
    });
}
</script>
