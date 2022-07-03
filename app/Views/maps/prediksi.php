<?= $this->extend('templates/layout') ?>

<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" />
<script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<style>
    #mapView {
        height: 500px;
    }

    .info {
        padding: 6px 8px;
        font: 14px/16px Arial, Helvetica, sans-serif;
        background: white;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
    }

    .info h4 {
        margin: 0 0 5px;
        color: #777;
    }

    .legend {
        text-align: left;
        line-height: 18px;
        color: #555;
    }

    .legend i {
        width: 18px;
        height: 18px;
        float: left;
        margin-right: 8px;
        opacity: 0.7;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h3 class="mb-0 text-center"> Hasil Prediksi Data </h3>
<p class="mb-0 text-center">Hasil prediksi tingkat kualitas pendidikan sekolah pada 30 kecamatan di kota Bandung dengan menggunakan Ekspansi SAR adalah sebagai berikut:</p>
<?php
$session = session();
if ($session->get('isLoggedIn') == TRUE) {
    if (session()->has('message')) {
        echo ('<div class="mt-2"><div class="alert '
            . session()->getFlashdata('alert-class') . '">'
            . session()->getFlashdata('message') .
            '</div></div>');
    }
    $validation = \Config\Services::validation();
    echo ('<div class="pt-1 mb-2 mt-2"><button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#uploadModal">Upload</button></div>');
}
?>
<div id="mapView" class="mb-0 mt-1"></div>

<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>Upload CSV File</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action=" <?= site_url('import-csv') ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <div class="mb-3">
                            <input type="file" name="file" class="form-control-file" id="file">
                        </div>
                    </div>
                    <div class="d-grid">
                        <input type="submit" name="submit" value="Upload" class="btn btn-dark" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var mapPrediksi = L.map('mapView').setView({
        lat: -6.9175,
        lon: 107.6191
    }, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(mapPrediksi);

    <?php foreach ($prediksi as $row => $data) : ?>

        <?php if ($data['name_kecamatan'] == 'Kec. Mandalajati' || $data['name_kecamatan'] == 'Kec. Rancasari') : ?>

            L.geoJSON(<?= $data['geoJSON'] ?>, {
                style: {
                    fillColor: getColorPrediction(0),
                    fillOpacity: 0.5,
                    color: '#555555',
                    weight: 2,
                    opacity: 1
                },
            }).addTo(mapPrediksi).bindTooltip('<?= $data['name_kecamatan'] ?> <?= '<br\>Nilai UN : 0' ?> <?= '<br\>Rasio Murid:Sekolah : 0' ?> <?= '<br\>Rasio Murid:Guru : 0' ?> <?= '<br\>Rasio Murid:Kelas : 0' ?>');

        <?php else : ?>

            L.geoJSON(<?= $data['geoJSON'] ?>, {
                style: {
                    fillColor: getColorPrediction(<?= $data['nilai_un_updated'] ?>),
                    fillOpacity: 0.5,
                    color: '#555555',
                    weight: 2,
                    opacity: 1
                },
            }).addTo(mapPrediksi).bindTooltip('<?= $data['name_kecamatan'] ?> <?= '<br\>Nilai UN : ' ?> <?= $data['nilai_un_updated'] ?> <?= '<br\>Rasio Murid:Sekolah : ' ?> <?= $data['rms'] ?> <?= '<br\>Rasio Murid:Guru : ' ?> <?= $data['rmg'] ?> <?= '<br\>Rasio Murid:Kelas : ' ?> <?= $data['rmk'] ?>');

        <?php endif; ?>

    <?php endforeach; ?>

    // Color depending on SAR Prediction population density value
    function getColorPrediction(d) {
        return d > 59 ? '#00b050' :
            d > 54 ? '#FFFF00' :
            d > 0 ? '#FF0000' : '#FFFFFF';
    }

    var legendPrediction = L.control({
        position: 'bottomleft'
    });

    legendPrediction.onAdd = function(mapPrediksi) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 54, 59],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColorPrediction(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legendPrediction.addTo(mapPrediksi);
</script>
<?= $this->endSection() ?>