<h3 class="fs-4 mb-4 lh-sm">BENEFITS JOBS</h3>
<div class="row gx-md-3 gy-4 mb-4 add_benjob">
    <div class="col-md-4">
        <label for="ben_job1_title">Add Job </label>
        <input type="text" name="ben_job1_title" class="form-control fs-6 fw-normal" id="ben_job1_title" placeholder="Enter Job Title">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addBenJob">Add BenJob</button>
    </div>
</div>
<div id="benJobsContainer"></div>

<script>
let dbBenJobs = [];
let benJobs = [];
let benPaystubIdCounter = 0;

fetchExistingBenJobs();

document.addEventListener('DOMContentLoaded', function() {
    fetchExistingBenJobs();
});

function fetchExistingBenJobs() {
    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'get_existing_jobs',
            type: "post-benefits"
        },
        success: function(response) {
            try {
                const res = JSON.parse(response);
                if (res.jobs) {
                    dbBenJobs = res.jobs.map(job => {
                        job.jobData = job?.paystubs.map(paystub => {
                            return {
                                paystubId: benPaystubIdCounter++, // Ensure unique paystubId
                                fromDate: paystub?.from_date,
                                toDate: paystub?.to_date,
                                grossEarnings: paystub?.gross_earnings,
                                specialCondition: paystub?.special_condition
                            };
                        });
                        return job;
                    });

                    // Transfer dbBenJobs to benJobs
                    benJobs = dbBenJobs.map(job => {
                        return {
                            title: job.job_title,
                            benId: job.job_id,
                            jobData: job.jobData
                        };
                    });

                    renderDbBenJobs();
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

function renderDbBenJobs() {
    const dbBenJobsContainer = document.getElementById('benJobsContainer');
    if (!dbBenJobsContainer) {
        console.error('dbBenJobsContainer element not found.');
        return;
    }

    dbBenJobsContainer.innerHTML = '';
    benJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Ben-Job: ${job.title} (ID: ${job.benId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addBenPaystub(job.benId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removeBenJob(job.benId));
        jobDiv.appendChild(removeJobButton);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                <div class="col-md-3">
                    <label for="ben_from_date_${paystub.paystubId}">From Date</label>
                    <input type="text" name="ben_f_date[]" id="ben_from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.fromDate}">
                </div>
                <div class="col-md-3">
                    <label for="ben_to_date_${paystub.paystubId}">To Date</label>
                    <input type="text" name="ben_t_date[]" id="ben_to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.toDate}">
                </div>
                <div class="col-md-3">
                    <label for="ben_gross_earnings_${paystub.paystubId}">Gross Earnings</label>
                    <input type="text" name="ben_g_earning[]" id="ben_gross_earnings_${paystub.paystubId}" placeholder="Gross Earnings" class="form-control fs-6 fw-normal" value="${paystub.grossEarnings}">
                </div>
                <div class="col-md-2">
                    <label for="ben_special_condition_${paystub.paystubId}">Special Condition</label>
                    <input type="text" name="ben_sp[]" id="ben_special_condition_${paystub.paystubId}" placeholder="Special Condition" class="form-control fs-6 fw-normal" value="${paystub.specialCondition}">
                </div>
                <img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />
            `;

            const removePaystubButton = paystubDiv.querySelector('.remove-row');
            removePaystubButton.addEventListener('click', () => removeBenPaystub(job.benId, paystub.paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        dbBenJobsContainer.appendChild(jobDiv);
    });
}

document.getElementById('addBenJob').addEventListener('click', addBenJob);

function addBenJob() {
    const jobTitleInput = document.getElementById('ben_job1_title');
    const jobTitle = jobTitleInput.value.trim();

    if (jobTitle) {
        captureBenData();

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'create_new_job',
                job_title: jobTitle,
                type: "post-benefits"
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    const job = {
                        benId: res.job_id,
                        title: jobTitle,
                        jobData: [{
                            paystubId: benPaystubIdCounter++,
                            fromDate: '',
                            toDate: '',
                            grossEarnings: '',
                            specialCondition: ''
                        }]
                    };
                    benJobs.push(job);
                    jobTitleInput.value = '';
                    renderBenJobs();
                } else {
                    alert('Failed to create job.');
                }
            }
        });
    } else {
        alert('Please enter a job title.');
    }
}

function addBenPaystub(benId) {
    captureBenData();
    const job = benJobs.find(j => j.benId === benId);
    const lastObj = job.jobData[job.jobData.length - 1];
    
    if (job) {
        const newPaystub = {
            paystubId: benPaystubIdCounter++,
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
                paystubId: benPaystubIdCounter++,
                job_id: benId,
                from_date: lastObj.fromDate,
                to_date: lastObj.toDate,
                gross_earnings: lastObj.grossEarnings,
                special_condition: lastObj.specialCondition
            },
            success: function(response) {
                const res = JSON.parse(response);
                if (res.success) {
                    renderBenJobs();
                } else {
                    alert('Failed to add paystub.');
                }
            }
        });
    }
}

function removeBenPaystub(benId, paystubId) {
    captureBenData();

    const job = benJobs.find(j => j.benId === benId);
    if (job) {
        job.jobData = job.jobData.filter(p => p.paystubId !== paystubId);
        renderBenJobs();
        console.log(job);

        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            method: 'POST',
            data: {
                action: 'removePaystub',
                job_id: benId,
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

function removeBenJob(benId) {
    captureBenData();
    benJobs = benJobs.filter(j => j.benId !== benId);
    renderBenJobs();

    jQuery.ajax({
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        method: 'POST',
        data: {
            action: 'remove_job',
            job_id: benId
        },
        success: function(response) {
            const res = JSON.parse(response);
            if (!res.success) {
                alert('Failed to remove job.');
            }
        }
    });
}

function captureBenData() {
    benJobs.forEach(job => {
        job.jobData.forEach(paystub => {
            const fromDateInput = document.querySelector(`#ben_from_date_${paystub.paystubId}`);
            const toDateInput = document.querySelector(`#ben_to_date_${paystub.paystubId}`);
            const grossEarningsInput = document.querySelector(`#ben_gross_earnings_${paystub.paystubId}`);
            const specialConditionInput = document.querySelector(`#ben_special_condition_${paystub.paystubId}`);

            paystub.fromDate = fromDateInput ? fromDateInput.value : '';
            paystub.toDate = toDateInput ? toDateInput.value : '';
            paystub.grossEarnings = grossEarningsInput ? grossEarningsInput.value : '';
            paystub.specialCondition = specialConditionInput ? specialConditionInput.value : '';
        });
    });
}

function renderBenJobs() {
    const benJobsContainer = document.getElementById('benJobsContainer');
    if (!benJobsContainer) {
        console.error('benJobsContainer element not found.');
        return;
    }

    benJobsContainer.innerHTML = '';
    benJobs.forEach(job => {
        const jobDiv = document.createElement('div');
        jobDiv.className = 'job';

        const jobTitle = document.createElement('h3');
        jobTitle.classList.add("job_title");
        jobTitle.textContent = `Ben-Job: ${job.title} (ID: ${job.benId})`;
        jobDiv.appendChild(jobTitle);

        const addPaystubButton = document.createElement('button');
        addPaystubButton.textContent = 'Add Paystub';
        addPaystubButton.classList.add("add_btn", "mr-2", "add-paystub");
        addPaystubButton.addEventListener('click', () => addBenPaystub(job.benId));
        jobDiv.appendChild(addPaystubButton);

        const removeJobButton = document.createElement('button');
        removeJobButton.textContent = 'Remove Job';
        removeJobButton.classList.add("add_btn", "pl-2", "remove-job");
        removeJobButton.addEventListener('click', () => removeBenJob(job.benId));
        jobDiv.appendChild(removeJobButton);

        const paystubsList = document.createElement('div');
        job.jobData.forEach(paystub => {
            const paystubDiv = document.createElement('div');
            paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center';

            paystubDiv.innerHTML = `
                <div class="col-md-3">
                    <label for="ben_from_date_${paystub.paystubId}">From Date</label>
                    <input type="text" name="ben_f_date[]" id="ben_from_date_${paystub.paystubId}" placeholder="Choose From Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.fromDate}">
                </div>
                <div class="col-md-3">
                    <label for="ben_to_date_${paystub.paystubId}">To Date</label>
                    <input type="text" name="ben_t_date[]" id="ben_to_date_${paystub.paystubId}" placeholder="Choose To Date" class="form-control fs-6 fw-normal datepicker" readonly value="${paystub.toDate}">
                </div>
                <div class="col-md-3">
                    <label for="ben_gross_earnings_${paystub.paystubId}">Gross Earnings</label>
                    <input type="text" name="ben_g_earning[]" id="ben_gross_earnings_${paystub.paystubId}" placeholder="Gross Earnings" class="form-control fs-6 fw-normal" value="${paystub.grossEarnings}">
                </div>
                <div class="col-md-2">
                    <label for="ben_special_condition_${paystub.paystubId}">Special Condition</label>
                    <input type="text" name="ben_sp[]" id="ben_special_condition_${paystub.paystubId}" placeholder="Special Condition" class="form-control fs-6 fw-normal" value="${paystub.specialCondition}">
                </div>
                <img class="remove-row col-md-1 rm_btn" src="<?php bloginfo('template_directory'); ?>/images/cross.png" width="48" height="48" />
            `;

            const removePaystubButton = paystubDiv.querySelector('.remove-row');
            removePaystubButton.addEventListener('click', () => removeBenPaystub(job.benId, paystub.paystubId));

            paystubsList.appendChild(paystubDiv);
        });

        jobDiv.appendChild(paystubsList);
        benJobsContainer.appendChild(jobDiv);
    });

  
}


</script>
