<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>

    <link rel="shortcut icon" href="<?= base_url() . '/' ?>assets/compiled/svg/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC" type="image/png" />

    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app.css" />
    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/app-dark.css" />
    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/iconly.css" />
    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">


    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/table-datatable-jquery.css">
</head>

<body>
    <script src="<?= base_url() . '/' ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="main" class="layout-horizontal">
            <header class="mb-5">
                <?php $this->load->view('templates/header') ?>
                <?php $this->load->view('templates/navbar') ?>
            </header>

            <div class="content-wrapper container">
                <div class="page-heading">
                    <h3><?= $subtitle ?></h3>
                </div>
                <div class="page-content">
                    <!-- Basic Vertical form layout section start -->
                    <section id="basic-vertical-layouts">
                        <div class="row match-height">

                            <div class="col">
                                <!-- Minimal jQuery Datatable end -->
                                <!-- Basic Tables start -->

                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">
                                            <?= $subtitle2 ?>
                                        </h5>

                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table" id="tblpickingslip">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>No PS</th>
                                                        <th>Customer</th>
                                                        <th>Status</th>
                                                        <th>Created At</th>
                                                        <th>Notes</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($ps->result_array() as $ps1) { ?>

                                                        <?php if ($this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 1|| $this->session->userdata('role_id') == 3) { ?>
                                                            <tr>
                                                                <td></td>
                                                                <td><?= $ps1['no_pickingslip'] ?><br><?= $ps1['no_purchaseorder'] ?></td>

                                                                <td><?= getNamaCustomer($ps1['customer']) ?></td>
                                                                <td><?= getStatusPickingslip($ps1['status']) ?> <br>
                                                                    <?php if ($ps1['status'] == 0) {  ?>
                                                                        <span class="badge bg-primary">Assigned To <?= $ps1['nama_picker'] ?></span>
                                                                    <?php } ?>

                                                                </td>
                                                                <td><?= dateindo($ps1['created_at']) ?></td>
                                                                <td><?= $ps1['notes'] ?></td>
                                                                <td>
                                                                    <?php if ($ps1['status'] == 0) { ?>
                                                                        <!-- role 4  -->
                                                                        <?php if ($this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 1) { ?>
                                                                            <a href="<?= base_url('user/Pickingslip/pick/' . $ps1['uuid']) ?>" class="btn btn-warning btn-sm mb-1">Pick</a>
                                                                        <?php } ?>
                                                                        <?php if ($this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 1) { ?>
                                                                            <!-- button modal change picker  -->
                                                                            <button type="button" class="btn btn-primary btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#modalChangePicker" data-id_pickingslip="<?= $ps1['id_pickingslip'] ?>" data-id_picker="<?= $ps1['picker'] ?>">
                                                                                Change Picker
                                                                            </button>


                                                                        <?php } ?>

                                                                    <?php  } else { ?>
                                                                        <a href="<?= base_url('user/Pickingslip/detail/' . $ps1['uuid']) ?>" class="btn btn-primary btn-sm mb-1">Detail</a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php } else {
                                                            if ($this->session->userdata('role_id') == 4 && $this->session->userdata('id_users') == $ps1['picker']) { ?>
                                                                <tr>
                                                                    <td></td>
                                                                    <td><?= $ps1['no_pickingslip'] ?><br><?= $ps1['no_purchaseorder'] ?></td>
                                                                    <td><?= getNamaCustomer($ps1['customer']) ?></td>
                                                                    <td><?= getStatusPickingslip($ps1['status']) ?></td>
                                                                    <td><?= dateindo($ps1['created_at']) ?></td>
                                                                    <td><?= $ps1['notes'] ?></td>
                                                                    <td>
                                                                        <?php if ($ps1['status'] != 6) { ?>
                                                                            <?php if ($ps1['status'] == 0) { ?>
                                                                                <!-- role 4  -->
                                                                                <?php if ($this->session->userdata('role_id') == 4 || $this->session->userdata('role_id') == 6 || $this->session->userdata('role_id') == 1) { ?>
                                                                                    <a href="<?= base_url('user/Pickingslip/pick/' . $ps1['uuid']) ?>" class="btn btn-warning btn-sm mb-1">Pick</a>
                                                                                <?php } ?>



                                                                            <?php  } else { ?>
                                                                                <a href="<?= base_url('user/Pickingslip/detail/' . $ps1['uuid']) ?>" class="btn btn-primary btn-sm mb-1">Detail</a>
                                                                        <?php }
                                                                        } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php }
                                                            ?>

                                                        <?php } ?>


                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                                <!-- Basic Tables end -->
                            </div>
                        </div>
                    </section>
                    <!-- // Basic Vertical form layout section end -->
                </div>
            </div>

            <?php $this->load->view('templates/footer') ?>
        </div>
    </div>

    <!-- Modal Change Picker -->
    <div class="modal fade" id="modalChangePicker" tabindex="-1" aria-labelledby="modalChangePickerLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChangePickerLabel">Change Picker</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="changePicker">
                    <div class="modal-body">
                        <input type="hidden" name="id_pickingslip" id="id_pickingslip">
                        <div class="mb-3">
                            <label for="picker" class="form-label">Picker</label>
                            <select class="form-select" name="picker" id="picker">
                                <option value="">-- Select Picker --</option>
                                <?php foreach ($picker->result_array() as $picker1) { ?>
                                    <option value="<?= $picker1['id_users'] ?>"><?= $picker1['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Change</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/jquery/jquery.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
    <!-- sweetalert  -->
    <script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.min.js"></script>
    <script>
        // tblpickingslip datatable
        $(document).ready(function() {
            $('#tblpickingslip').DataTable({
                "order": [],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }],
                rowCallback: function(row, data, index) {
                    $('td:eq(0)', row).html(index + 1);
                }
            });


        });
    </script>

    <script>
        // modal change picker
        $('#modalChangePicker').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id_pickingslip = button.data('id_pickingslip');
            var id_picker = button.data('id_picker');
            var modal = $(this);
            modal.find('.modal-body #id_pickingslip').val(id_pickingslip);
            modal.find('.modal-body #picker').val(id_picker);
        });
        // change picker
        $('#changePicker').submit(function(e) {
            e.preventDefault();
            var id_pickingslip = $('#id_pickingslip').val();
            var picker = $('#picker').val();
            // if picker value is empty
            if (picker == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Picker is required',
                });
                return false;
            }
            // swal loading 
            Swal.fire({
                title: 'Please Wait..!',
                html: 'Change Picker',
                didOpen: () => {
                    Swal.showLoading()
                },
                showConfirmButton: false,
                allowOutsideClick: false
            });
            console.log(picker);

            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({

                url: "<?= base_url('user/Pickingslip/changePicker') ?>",
                type: 'POST',
                data: formData,
                dataType: 'json',
              
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                        }).then(function() {
                            // swal loading 
                            Swal.fire({
                                title: 'Please Wait..!',
                                html: 'Reloading Page',
                                didOpen: () => {
                                    Swal.showLoading()
                                },
                                showConfirmButton: false,
                                allowOutsideClick: false
                            });
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });
        });
    </script>


</body>

</html>