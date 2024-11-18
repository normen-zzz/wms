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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



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
                                            <?= $subtitle2 ?> <?= $adjuststock->no_adjuststock ?>
                                        </h5>

                                    </div>

                                    <div class="card-body">
                                        <form id="processAdjuststock">
                                            <input type="hidden" name="id_adjuststock" value="<?= $adjuststock->id_adjuststock ?>">
                                            <div class="table-responsive">
                                                <table class="table" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th># <br><button class="btn btn-primary" type="button" id="checkAllBtn">Check All</button></th>
                                                            <th>SKU</th>

                                                            <th>Batch</th>
                                                            <th>Sloc</th>
                                                            <th>Qty</th>
                                                            <th>Status</th>
                                                            <th>Notes </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($adjuststockDetail->result_array() as $adjuststockDetail1) { ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input id_dataadjuststock" type="checkbox" value="<?= $adjuststockDetail1['id_dataadjuststock'] ?>" id="id_dataadjuststock">

                                                                    </div>
                                                                </td>
                                                                <td><?= $adjuststockDetail1['sku'] ?> <br><?= $adjuststockDetail1['nama_barang'] ?></td>

                                                                <td><?= $adjuststockDetail1['batchnumber'] ?> <br><?= $adjuststockDetail1['expiration_date'] ?></td>
                                                                <td><?= $adjuststockDetail1['sloc'] ?></td>
                                                                <td><?= $adjuststockDetail1['quantity'] ?></td>

                                                                <td><?php if ($adjuststockDetail1['status'] == 0) {
                                                                        echo '<span class="badge bg-warning">Wait Approve Super Admin</span>';
                                                                    } else {
                                                                        echo '<span class="badge bg-success">Approved By ' . $adjuststock->approved_by . '</span>';
                                                                    } ?>
                                                                </td>

                                                                <td><?= $adjuststockDetail1['notes'] ?></td>

                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="form-group">
                                                <label for="notes">Notes</label>
                                                <textarea class="form-control" id="notes_approved" name="notes_approved" rows="3"></textarea>
                                            </div>
                                            <button class="btn btn-success" type="submit">Process</button>
                                        </form>

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



    <script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // checkAllBtn
        $(document).ready(function() {
            $('#checkAllBtn').click(function() {
                // id_dataadjuststock all checked
                if ($(this).text() == 'Check All') {
                    $('.id_dataadjuststock').prop('checked', true);
                    $(this).text('Uncheck All');
                } else {
                    $('.id_dataadjuststock').prop('checked', false);
                    $(this).text('Check All');
                }

            });
        });
    </script>

    <script>
        // processAdjuststock
        $('#processAdjuststock').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to process this adjust stock.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, process it',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id_adjuststock = $('input[name="id_adjuststock"]').val();
                    var notes_approved = $('textarea[name="notes_approved"]').val();
                    var id_dataadjuststock = [];
                    $('.id_dataadjuststock:checked').each(function() {
                        id_dataadjuststock.push($(this).val());
                    });
                    if (id_dataadjuststock.length == 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select at least 1 item',
                        });
                    } else {
                        // swal loading 
                        Swal.fire({
                            title: 'Please Wait..!',
                            html: 'Process Adjust Stock',
                            didOpen: () => {
                                Swal.showLoading()
                            },
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        $.ajax({
                            url: '<?= base_url('user/adjuststock/processAdjuststock') ?>',
                            type: 'POST',
                            data: {
                                id_adjuststock: id_adjuststock,
                                notes_approved: notes_approved,
                                id_dataadjuststock: id_dataadjuststock
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                if (response.status == 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success',
                                        text: response.message,
                                    }).then(function() {
                                        Swal.fire({
                                            title: 'Please Wait..!',
                                            html: 'Process Adjust Stock',
                                            didOpen: () => {
                                                Swal.showLoading()
                                            },
                                            showConfirmButton: false,
                                            allowOutsideClick: false
                                        });
                                        window.location.href = '<?= base_url('user/adjuststock') ?>';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: response.message,
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Something went wrong!',
                                });
                            }
                        });
                    }
                }
            });
        });
    </script>





</body>

</html>