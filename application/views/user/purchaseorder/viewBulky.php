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
    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/extensions/flatpickr/flatpickr.min.css">
    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <link rel="stylesheet" href="<?= base_url() . '/' ?>assets/compiled/css/table-datatable-jquery.css">
</head>

<style>
    .select2-container {
        width: 100% !important;
    }
</style>

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
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <form id="purchaseorderForm">
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label for="first_name">
                                                            <h4>Customer</h4>
                                                        </label>

                                                        <select name="customer" id="customer" class="form-select">
                                                            <?php foreach ($customer->result_array() as $customer1) { ?>
                                                                <option value="<?= $customer1['id_customer'] ?>"><?= $customer1['nama_customer'] ?></option>
                                                            <?php } ?>
                                                        </select>

                                                    </div>
                                                </div>
                                                <table class="table" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Barang</th>
                                                            <th>Batch</th>
                                                            <th>Quantity</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-body">
                                                        <?php foreach ($po as $po1) { ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="text" name="barang[]" value="<?= $po1['id_barang'] ?>" hidden>
                                                                    <span><b><?= $po1['sku'] ?></b></span><br>
                                                                    <span><?= $po1['nama_barang'] ?></span>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="batch[]" value="<?= $po1['id_batch'] ?>" hidden>
                                                                    <span><b><?= $po1['batchnumber'] ?></b></span> <br>
                                                                    <span><?= $po1['ed'] ?></span>

                                                               </td>
                                                                <td>
                                                                    <input type="number" class="form-control qty" name="qty[]" value="<?= $po1['qty'] ?>" readonly>
                                                                </td>
                                                                <td>
                                                                    <!-- button for remove row  -->
                                                                    <button type="button" class="btn btn-danger remove-row">Remove</button>

                                                                </td>


                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="3">
                                                                <button type="button" id="add-row-btn" class="btn btn-secondary">Add Row</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </form>
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



    <script src="<?= base_url() . '/' ?>assets/static/js/components/dark.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/horizontal-layout.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="<?= base_url() . '/' ?>assets/compiled/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/datatables.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/flatpickr/flatpickr.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/static/js/pages/date-picker.js"></script>
    <!-- select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="<?= base_url() . '/' ?>assets/extensions/sweetalert2/sweetalert2.all.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {

            initSelect2AndFlatpickr();

            $('#add-row-btn').on('click', function() {
                var newRow = `
                <tr>
                    <td><select name="barang[]" class="form-control selectBarang"></select></td>
					 <td><select class="form-control selectBatch" name="batch[]"><option selected value="-">Select Batch</option></select></td>
					<td><input type="text" class="form-control qty" name="qty[]"></td>
					<td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                   
                   
                </tr>`;
                $('#table-body').append(newRow);


                initSelect2AndFlatpickr();


            });

            $('#purchaseorderForm').on('submit', function(e) {
                e.preventDefault();

                const barang = $('select[name="barang[]"]');
                for (let i = 0; i < barang.length; i++) {
                    if (barang[i].value === '-' || barang[i].value.trim() === '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Barang tidak boleh kosong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
                }

                const batchInputs = $('select[name="batch[]"]');
                for (let i = 0; i < batchInputs.length; i++) {
                    if (batchInputs[i].value === '-' || batchInputs[i].value.trim() === '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Batch tidak boleh kosong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
                }

                const qtyInputs = $('input[name="qty[]"]');
                for (let i = 0; i < qtyInputs.length; i++) {
                    if (qtyInputs[i].value.trim() === '') {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Quantity tidak boleh kosong!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                        return;
                    }
                }

                Swal.fire({
                    title: 'Please wait...',
                    html: 'Loading...',
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                $.ajax({
                    url: "<?= base_url('user/purchaseorder/insertPurchaseorder') ?>",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        Swal.fire({
                            title: response.status === 'success' ? 'Success' : 'Error',
                            text: response.message,
                            icon: response.status === 'success' ? 'success' : 'error',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            if (response.status === 'success') {
                                $('#purchaseorderForm')[0].reset();
                                window.location.href = "<?= base_url('user/purchaseorder') ?>";
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong: ' + textStatus,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });


            function initSelect2AndFlatpickr() {
                $('.selectBarang').select2({
                    ajax: {
                        url: '<?= base_url('user/purchaseorder/getDataBarangSelect') ?>',
                        type: "POST",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                searchTerm: params.term || ''
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 0,
                    placeholder: "Pilih barang",
                    allowClear: true
                });

                $('.flatpickrDate').flatpickr({
                    dateFormat: "d-m-Y"
                });

                $('.selectBarang').on('change', function() {
                    var barangId = $(this).val();
                    var row = $(this).closest('tr'); // Get the current row
                    var batchSelect = row.find('.selectBatch'); // Get the selectBatch element in the current row
                    var inputEd = row.find('.inputEd');
                    $.ajax({
                        url: '<?= base_url('user/purchaseorder/getBatch') ?>',
                        type: 'POST',
                        data: {
                            barangId: barangId
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            var batchOptions = response.batch_options;
                            batchSelect.empty();
                            batchSelect.append($('<option>', {
                                value: '-',
                                text: 'Select Batch'
                            }));
                            $.each(batchOptions, function(index, batch) {
                                batchSelect.append($('<option>', {
                                    value: batch.id,
                                    text: batch.name
                                }));
                            });

                            batchSelect.select2({
                                width: '100%',
                                placeholder: 'Select batch'
                            });
                        }
                    });
                });
                $('.qty').on('keyup', function() {
                    var qty = parseInt($(this).val());
                    var row = $(this).closest('tr'); // Get the current row
                    var barangId = row.find('.selectBarang');
                    var batchId = row.find('.selectBatch'); // Get the selectBatch element in the current row
                    var lastqty = row.find('.qty');

                    $.ajax({
                        url: '<?= base_url('user/purchaseorder/checkQty') ?>',
                        type: 'POST',
                        data: {
                            barangId: barangId.val(),
                            batchId: batchId.val()
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);
                            if (qty > response) {
                                lastqty.val(response);


                            }
                        }
                    });
                });
            }
        });
    </script>

    <script>
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
    </script>



</body>

</html>