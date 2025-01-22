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


    table {
        table-layout: fixed;
        word-wrap: break-word;
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
                                            <form id="adjuststockForm">
                                                <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label for="first_name">
                                                            <h4><?= $subtitle ?></h4>
                                                        </label>
                                                    </div>
                                                </div>
                                                <table class="table" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50px;">No</th>
                                                            <th style="width: 400px;">Barang</th>
                                                            <th style="width: 200px;">Batch</th>
                                                            <th style="width: 100px;">Sloc</th>
                                                            <th style="width: 60px;" >Qty on Rack</th>
                                                            <th style="width: 100px;">Qty (pcs)</th>
                                                            <th style="width: 100px;">NOTES</th>
                                                            

                                                        </tr>
                                                    </thead>
                                                    <tbody id="table-body">
                                                    
                                                        <?php $no = 1; foreach ($data as $data1) {
                                                            
                                                            ?>
                                                            
                                                        <tr>
                                                            <td>
                                                                <b><?= $no ?></b>
                                                            </td>
                                                            <td>
                                                                <b><?= $data1['sku'] ?></b><br>
                                                                <?= $data1['nama_barang'] ?>
                                                                <input type="number" name="barang[]" value="<?= $data1['id_barang']  ?>" class="form-control">
                                                            </td>
                                                            <td>
                                                            <b><?= $data1['batch'] ?></b>
                                                                <input type="number" name="batch[]" value="<?= $data1['id_batch'] ?>" class="form-control">
                                                            </td>
                                                           
                                                            <td>
                                                                <input type="text" class="form-control" value="<?= $data1['sloc'] ?>" name="sloc[]">
                                                            </td>
                                                            <td>
                                                                <?= $data1['quantity_rack'] ?>
                                                            </td>

                                                            <td>
                                                                <input type="text" class="form-control" value="<?= $data1['quantity'] ?>" name="qty[]">
                                                            </td>
                                                            <td>
                                                                <textarea  class="form-control"  name="notes[]"><?= $data1['notes'] ?></textarea>
                                                            </td>

                                                        </tr>
                                                        <?php $no++; } ?>
                                                    </tbody>
                                                    <tfoot>
                                                        
                                                        
                                                        <tr>
                                                            <td colspan="3">
                                                            <button type="button" id="add-row-btn" class="btn btn-secondary">Add Row</button>
                                                                <button type="submit" class="btn btn-primary float-right">Save</button>
                                                                
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
                        <td style="width: 20%;">
                            <select name="barang[]" class="form-select selectBarang"></select>
                        </td>
                        <td style="width: 20%;">
                            <select name="batch[]" class="form-select selectBatch">
                                <option selected value="-">Select Batch</option>
                            </select>
                        </td>
                        <td style="width: 10%;">
                            <!-- button recommended rack  -->
                            <button type="button" class="btn btn-primary recommendedRack">List Rack</button>
                            <div class="dataRecommendedRack"></div>
                        </td>
                        <td style="width: 20%;">
                            <input type="text" class="form-control from" name="sloc[]">
                        </td>
                       
                        <td style="width: 20%;">
                            <input type="text" class="form-control qty" name="qty[]">
                        </td>
                        <td style="width: 20%;">
                            <input type="text" class="form-control notes" name="notes[]">
                        </td>
                        <td>
                            <!-- button remove row  -->
                            <button type="button" class="btn btn-danger remove-row">Remove</button>
                    </tr>
                `;

                $('#table-body').append(newRow);


                initSelect2AndFlatpickr();


            });

            $('#adjuststockForm').on('submit', function(e) {
                e.preventDefault();
                console.log('DATA FORM :' + $(this).serialize());
                $.ajax({
                    // swal loading 
                    beforeSend: function() {
                        Swal.fire({
                            title: 'Please Wait..',
                            html: 'Saving data',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                        });
                    },
                    url: "<?= base_url('user/adjuststock/insertAdjuststock') ?>",
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
                                $('#adjuststockForm')[0].reset();
                                window.location.href = "<?= base_url('user/adjuststock') ?>";
                            }
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong: ' + textStatus + jqXHR.responseText + errorThrown,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });


            function initSelect2AndFlatpickr() {
                $('.selectBarang').select2({
                    ajax: {
                        url: '<?= base_url('user/adjuststock/getDataBarangSelect') ?>',
                        type: "POST",
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return {
                                searchTerm: params.term
                            };
                        },
                        processResults: function(response) {
                            return {
                                results: response
                            };
                        },
                        cache: true
                    }
                });

                // remove row 
                $(document).on('click', '.remove-row', function() {
                    $(this).closest('tr').remove();
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
                        url: '<?= base_url('user/adjuststock/getBatch') ?>',
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



                // recommended rack
                $('.recommendedRack').on('click', function() {
                    var row = $(this).closest('tr'); // Get the current row
                    var id_barang = row.find('.selectBarang').val();
                    var id_batch = row.find('.selectBatch').val();
                    var qty = row.find('.qty').val();
                    var dataRecommendedRack = row.find('.dataRecommendedRack');
                    console.log(id_barang, id_batch, qty);
                    // show loading on button
                    $(this).html('Loading...');
                    dataRecommendedRack.empty();

                    $.ajax({
                        url: '<?= base_url('user/adjuststock/get_rack_recommendations') ?>',
                        type: 'POST',
                        data: {
                            id_barang: id_barang,
                            id_batch: id_batch,
                        },
                        dataType: 'json',
                        success: function(response) {
                            console.log(response);

                            dataRecommendedRack.empty();
                            $.each(response, function(index, rack) {
                                // using li 
                                dataRecommendedRack.append('<li>' + rack.sloc + ': ' + rack.quantity + 'Pcs</li>');
                                // change button text back to normal
                                row.find('.recommendedRack').html('List Rack');

                            });

                        }
                    });
                });
            }
        });
    </script>

    <script></script>



</body>

</html>