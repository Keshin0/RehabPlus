<?php $pageTitle = 'Schedule Appointment – RehabPlus'; ?>
<?= view('layouts/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">
            Schedule Appointment
        </h2>

        <p class="page-subtitle mb-0">
            Create a new therapy session
        </p>
    </div>

</div>

<div class="card">

    <div class="card-body">

        <form action="<?= site_url('appointments/store') ?>"
              method="post">

            <div class="row g-3">

                <div class="col-md-6">

                    <label class="form-label">
                        Patient Name
                    </label>

                    <input type="text"
                           name="patient"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Therapist
                    </label>

                    <input type="text"
                           name="therapist"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Appointment Date
                    </label>

                    <input type="date"
                           name="date"
                           class="form-control"
                           required>

                </div>

                <div class="col-md-6">

                    <label class="form-label">
                        Appointment Time
                    </label>

                    <input type="time"
                           name="time"
                           class="form-control"
                           required>

                </div>

            </div>

            <div class="mt-4">

                <button class="btn btn-primary">

                    <i class="bi bi-check-circle me-1"></i>
                    Save Appointment

                </button>

            </div>

        </form>

    </div>

</div>

<?= view('layouts/footer') ?>