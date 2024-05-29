<h3 class="fs-4 mb-4 lh-sm">
    BENEFITS
</h3>
<div class="row gx-md-3 gy-4 mb-4 add_benjob">
    <div class="col-md-4">
        <label for="ben_job_title">Add Job </label>
        <input type="text" name="ben_job_title" class="form-control fs-6 fw-normal" id="ben_job_title" placeholder="Enter Job Title">
    </div>
    <div class="col-md-2 align-self-end">
        <button class="add_btn text-white border-0 fs-6 fw-bold mt-2 w-fit" type="button" id="addBenJob">
            Add BeneJob
        </button>
    </div>
</div>
<div id="benJobsContainer"></div>




  <script>
    let beniJobs = [];
    let beniJobIdCounter = 1;
    let beniPaystubIdCounter = 1;

    document.getElementById('addBenJob').addEventListener('click', addBeniJob);

    function addBeniJob() {
        const jobTitleInput = document.getElementById('ben_job_title');
        const jobTitle = jobTitleInput.value.trim();

        if (jobTitle) {
            // Capture current data
            captureBeniData();

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
                                paystubId: beniPaystubIdCounter++,
                                fromDate: '',
                                toDate: '',
                                grossEarnings: '',
                                specialCondition: ''
                            }]
                        };
                        beniJobs.push(job);
                        jobTitleInput.value = '';
                        renderBeniJobs();
                    } else {
                        alert('Failed to create job.');
                    }
                }
            });
        } else {
            alert('Please enter a job title.');
        }
    }

    function addBeniPaystub(postId) {
        // Capture current data
        captureBeniData();

        const job = beniJobs.find(j => j.postId === postId);
        if (job) {
            const newPaystub = {
                paystubId: beniPaystubIdCounter++,
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
                        renderBeniJobs();
                    } else {
                        alert('Failed to add paystub.');
                    }
                }
            });
        }
    }

    function removeBeniPaystub(postId, paystubId) {
        // Capture current data
        captureBeniData();

        const job = beniJobs.find(j => j.postId === postId);
        if (job) {
            job.jobData = job.jobData.filter(p => p.paystubId !== paystubId);
            renderBeniJobs();

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

    function removeBeniJob(postId) {
        // Capture current data
        captureBeniData();
        beniJobs = beniJobs.filter(j => j.postId !== postId);
        renderBeniJobs();

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

    function captureBeniData() {
        beniJobs.forEach(job => {
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

    function renderBeniJobs() {
        const jobsContainer = document.getElementById('benJobsContainer');
        jobsContainer.innerHTML = '';
        beniJobs.forEach(job => {
            const jobDiv = document.createElement('div');
            jobDiv.className = 'job';

            const jobTitle = document.createElement('h3');
            jobTitle.textContent = `Job: ${job.title} (ID: ${job.postId})`;
            jobDiv.appendChild(jobTitle);

            const addPaystubButton = document.createElement('button');
            addPaystubButton.textContent = 'Add Paystub';
            addPaystubButton.classList.add("add_btn", "mr-2");
            addPaystubButton.addEventListener('click', () => addBeniPaystub(job.postId));
            jobDiv.appendChild(addPaystubButton);

            const removeJobButton = document.createElement('button');
            removeJobButton.textContent = 'Remove Job';
            removeJobButton.classList.add("add_btn", "pl-2");
            removeJobButton.addEventListener('click', () => removeBeniJob(job.postId));
            jobDiv.appendChild(removeJobButton);

            const paystubsList = document.createElement('div');
           
            job.jobData.forEach(paystub => {
                const paystubDiv = document.createElement('div');
                paystubDiv.className = 'stub row gx-md-3 gy-4 align-items-center mb-4';

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
                removePaystubButton.addEventListener('click', () => removeBeniPaystub(job.postId, paystub.paystubId));

                paystubsList.appendChild(paystubDiv);
            });

            jobDiv.appendChild(paystubsList);
            jobsContainer.appendChild(jobDiv);
        });

        console.log(beniJobs);
    }

    renderBeniJobs();
</script>

