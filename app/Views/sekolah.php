<?= $this->extend('templates/layout') ?>
<?= $this->section('content') ?>
<div class="card mb-5 col-12">
    <div class="card-body overflow-auto">
        <h3 class="mb-3">Daftar Sekolah</h3>
        <table id="school-table" class="table align-items-center table-striped table-bordered table-hover table-responsive">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">No</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Nama Sekolah</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Alamat</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Jumlah Guru</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Jumlah Ruang Kelas</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Jumlah Siswa</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Rasio Murid Guru</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Rasio Murid Kelas</th>
                    <th class="text-uppercase text-secondary text-xs font-weight-bolder">Nilai UN</th>
                </tr>
            </thead>
            <tbody class="align-middle text-center text-sm">
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#school-table').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?php echo base_url('sekolah/ajaxList') ?>",
                "type": "POST"
            },
            "language": {
                "paginate": {
                    "previous": "Prev",
                    "next": "Next"
                }
            },
            "columnDefs": [{
                "targets": [],
                "orderable": false,
            }, ],
        });
    });
</script>

<?= $this->endSection() ?>