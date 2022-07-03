<?= $this->extend('templates/layout') ?>

<?= $this->section('head') ?>
<script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" />
<style>
    #mapRMSView {
        height: 500px;
    }

    #mapRMGView {
        height: 500px;
    }

    #mapRMKView {
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
<h3 class="mb-0 text-center"> Visualisasi Data </h3>
<p class="mb-0 text-center" id="labelRMS">Pada halaman ini menunjukkan rasio jumlah murid per kecamatan terhadap jumlah sekolah di kecamatan tersebut pada tahun 2020</p>
<p class="mb-0 text-center" id="labelRMG">Pada halaman ini menunjukkan rasio jumlah murid per kecamatan terhadap jumlah guru di kecamatan tersebut pada tahun 2020</p>
<p class="mb-0 text-center" id="labelRMK">Pada halaman ini menunjukkan rasio jumlah murid per kecamatan terhadap jumlah kelas di kecamatan tersebut</p>
<div class="nav-wrapper position-relative end-0">
    <ul class="nav nav-pills nav-fill p-1" role="tablist">
        <li class="nav-item">
            <a id="tabMapsRMS" class="nav-link mb-0 px-0 py-1 text-white" data-bs-toggle="tab" href="#mapRMSView" role="tab" aria-controls="profile" aria-selected="true">
                RMS
            </a>
        </li>
        <li class="nav-item">
            <a id="tabMapsRMG" class="nav-link mb-0 px-0 py-1 text-white" data-bs-toggle="tab" href="#mapRMGView" role="#mapRMG" aria-controls="dashboard" aria-selected="false">
                RMG
            </a>
        </li>
        <li class="nav-item">
            <a id="tabMapsRMK" class="nav-link mb-0 px-0 py-1 text-white" data-bs-toggle="tab" href="#mapRMKView" role="tab" aria-controls="dashboard" aria-selected="false">
                RMK
            </a>
        </li>
    </ul>
</div>
<div id="mapRMSView" class="mb-1"></div>
<div id="mapRMGView" class="mb-1"></div>
<div id="mapRMKView" class="mb-1"></div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var mapRMSView = document.getElementById('mapRMSView')
    mapRMSView.style.display = 'block';
    var mapRMGView = document.getElementById('mapRMGView')
    mapRMGView.style.display = 'none';
    var mapRMKView = document.getElementById('mapRMKView')
    mapRMKView.style.display = 'none';
    var labelRMS = document.getElementById('labelRMS')
    labelRMS.style.display = 'block';
    var labelRMG = document.getElementById('labelRMG')
    labelRMG.style.display = 'none';
    var labelRMK = document.getElementById('labelRMK')
    labelRMK.style.display = 'none';

    document.getElementById('tabMapsRMS').onclick = function() {
        mapRMSView.style.display = 'block';
        mapRMGView.style.display = 'none';
        mapRMKView.style.display = 'none';

        labelRMS.style.display = 'block';
        labelRMG.style.display = 'none';
        labelRMK.style.display = 'none';
    }
    document.getElementById('tabMapsRMG').onclick = function() {
        mapRMSView.style.display = 'none';
        mapRMGView.style.display = 'block';
        mapRMKView.style.display = 'none';

        labelRMS.style.display = 'none';
        labelRMG.style.display = 'block';
        labelRMK.style.display = 'none';

        var mapRMG = L.map('mapRMGView').setView({
            lat: -6.9175,
            lon: 107.6191
        }, 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(mapRMG);

        <?php foreach ($kecamatan as $row => $data) : ?>
            L.geoJSON(<?= $data['geoJSON'] ?>, {
                style: {
                    fillColor: getColorRMG(<?= $data['rmg'] ?>),
                    fillOpacity: 0.5,
                    color: '#555555',
                    weight: 2,
                    opacity: 1
                },
            }).addTo(mapRMG).bindTooltip('<?= $data['name_kecamatan'] ?> <?= '<br\>Rasio Murid:Guru : ' ?> <?= $data['rmg'] ?>');
        <?php endforeach; ?>

        // Color depending on RMG population density value
        function getColorRMG(d) {
            return d > 15 ? '#FF0000' :
                d > 13 ? '#FFFF00' :
                d > 0 ? '#00b050' : '#00b050';
        }

        var legendRMG = L.control({
            position: 'bottomleft'
        });

        legendRMG.onAdd = function(mapRMG) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 13, 15],
                labels = [];

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColorRMG(grades[i] + 1) + '"></i> ' +
                    grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
            }

            return div;
        };

        legendRMG.addTo(mapRMG);
    }
    document.getElementById('tabMapsRMK').onclick = function() {
        mapRMSView.style.display = 'none';
        mapRMGView.style.display = 'none';
        mapRMKView.style.display = 'block';

        labelRMS.style.display = 'none';
        labelRMG.style.display = 'none';
        labelRMK.style.display = 'block';

        var mapRMK = L.map('mapRMKView').setView({
            lat: -6.9175,
            lon: 107.6191
        }, 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
        }).addTo(mapRMK);

        <?php foreach ($kecamatan as $row => $data) : ?>
            L.geoJSON(<?= $data['geoJSON'] ?>, {
                style: {
                    fillColor: getColorRMK(<?= $data['rmk'] ?>),
                    fillOpacity: 0.5,
                    color: '#555555',
                    weight: 2,
                    opacity: 1
                },
            }).addTo(mapRMK).bindTooltip('<?= $data['name_kecamatan'] ?> <?= '<br\>Rasio Murid:Kelas : ' ?> <?= $data['rmk'] ?>');
        <?php endforeach; ?>

        // Color depending on RMK population density value
        function getColorRMK(d) {
            return d > 27 ? '#FF0000' :
                d > 23 ? '#FFFF00' :
                d > 0 ? '#00b050' : '#00b050';
        }

        var legendRMK = L.control({
            position: 'bottomleft'
        });

        legendRMK.onAdd = function(mapRMK) {

            var div = L.DomUtil.create('div', 'info legend'),
                grades = [0, 23, 27],
                labels = [];

            // loop through our density intervals and generate a label with a colored square for each interval
            for (var i = 0; i < grades.length; i++) {
                div.innerHTML +=
                    '<i style="background:' + getColorRMK(grades[i] + 1) + '"></i> ' +
                    grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
            }

            return div;
        };

        legendRMK.addTo(mapRMK);
    }

    var mapRMS = L.map('mapRMSView').setView({
        lat: -6.9175,
        lon: 107.6191
    }, 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(mapRMS);

    <?php foreach ($kecamatan as $row => $data) : ?>
        L.geoJSON(<?= $data['geoJSON'] ?>, {
            style: {
                fillColor: getColorRMS(<?= $data['rms'] ?>),
                fillOpacity: 0.5,
                color: '#555555',
                weight: 2,
                opacity: 1
            },
        }).addTo(mapRMS).bindTooltip('<?= $data['name_kecamatan'] ?> <?= '<br\>Jumlah Sekolah : ' ?> <?= $data['jml_sekolah'] ?> <?= '<br\>Rasio Murid:Sekolah : ' ?> <?= $data['rms'] ?>');
    <?php endforeach; ?>

    // Color depending on RMS population density value
    function getColorRMS(d) {
        return d > 389 ? '#FF0000' :
            d > 317 ? '#FFFF00' :
            d > 0 ? '#00b050' : '#00b050';
    }

    var legendRMS = L.control({
        position: 'bottomleft'
    });

    legendRMS.onAdd = function(mapRMS) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, 317, 389],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColorRMS(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legendRMS.addTo(mapRMS);
</script>
<?= $this->endSection() ?>