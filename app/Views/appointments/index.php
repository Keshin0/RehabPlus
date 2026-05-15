<?php $pageTitle = 'Appointments – RehabPlus'; ?>
<?= view('layouts/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="page-title mb-1">Appointments</h2>
        <p class="page-subtitle mb-0">
            Physical Therapy Scheduling
        </p>
    </div>

    <a href="<?= site_url('appointments/create') ?>"
       class="btn btn-primary">

        <i class="bi bi-plus-lg me-1"></i>
        Schedule Appointment

    </a>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <span>
            <i class="bi bi-calendar-check me-2 text-info"></i>
            Appointment Schedule
        </span>

        <div class="input-group" style="width:250px;">

            <span class="input-group-text">
                <i class="bi bi-search"></i>
            </span>

            <input type="text"
                   class="form-control"
                   id="appointmentSearch"
                   placeholder="Search appointment...">

        </div>

    </div>

    <div class="card-body p-0">

        <table class="table table-hover align-middle mb-0"
               id="appointmentTable">

            <thead>
                <tr>
                    <th>Patient</th>
                    <th>Therapist</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($appointments as $a): ?>

                <tr>

                    <td><?= esc($a['patient']) ?></td>

                    <td><?= esc($a['therapist']) ?></td>

                    <td><?= esc($a['date']) ?></td>

                    <td><?= esc($a['time']) ?></td>

                    <td>

                        <?php if($a['status'] === 'Upcoming'): ?>

                            <span class="badge bg-info">
                                Upcoming
                            </span>

                        <?php elseif($a['status'] === 'Completed'): ?>

                            <span class="badge bg-success">
                                Completed
                            </span>

                        <?php else: ?>

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        <?php endif; ?>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<script>

const search = document.getElementById('appointmentSearch');

search.addEventListener('keyup', function () {

    const value = this.value.toLowerCase();

    document.querySelectorAll('#appointmentTable tbody tr')
        .forEach(row => {

            row.style.display =
                row.innerText.toLowerCase().includes(value)
                ? ''
                : 'none';

        });

});

</script>

<?= view('layouts/footer') ?>