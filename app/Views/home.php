<?= $this->extend('templates/layout') ?>

<?= $this->section('content') ?>
<img src="<?= base_url('assets/img_gd_sate.png') ?>" class="img-fluid w-100 h-auto">

<div class="card card-frame mt-5 mb-5">
  <div class="card-body">
    <h3 class="mb-3 text-center">Visi</h3>
    <p class="font-weight-normal my-auto mb-4 text-center">“Terwujudnya Kota Bandung Yang Unggul, Nyaman, Sejahtera & Agamis”</p>
    <h3 class="mb-3 text-center">Misi</h3>
    <ul class="list-unstyled font-weight-normal my-auto mb-4 text-center">
      <li class="font-weight-normal my-auto mb-2 text-center">Membangun masyarakat yang humanis, agamis, berkualitas dan berdaya saing.</li>
      <li class="font-weight-normal my-auto mb-2 text-center">Mewujudkan tata kelola pemerintahan yang efektif, efisien, bersih dan melayani.</li>
      <li class="font-weight-normal my-auto mb-2 text-center">Membangun perekonomian yang mandiri, kokoh, dan berkeadilan.</li>
      <li class="font-weight-normal my-auto mb-2 text-center">Mewujudkan Bandung nyaman melalui perencanaan tata ruang, pembangunan 
          infrastruktur serta pengendalian pemanfaatan ruang yang berkualitas dan bewawasan lingkungan.</li>
      <li class="font-weight-normal my-auto mb-2 text-center">Mengembangkan pembiayaan kota yang partisipatif, kolaboratif, dan terintegrasi.</li>
    </ul>
  </div>
</div>

<div class="card card-frame mt-5 mb-5">
  <div class="card-body">
    <h3 class="mb-3 text-center">Tujuan</h3>
    <p class="font-weight-normal my-auto mb-4 text-center">Tujuan aplikasi ini dibuat agar memudahkan Dinas Pendidikan Kota Bandung dalam 
        memonitoring tingkat kualitas pendidikan sekolah di setiap kecamatan di Kota Bandung serta membantu masyarakat dalam mencari 
        data sekolah yang ada di Kota Bandung.</p>
  </div>
</div>

<div class="card card-frame mt-5 mb-5">
  <div class="card-body">
    <h3 class="mb-3 text-center">About</h3>
    <p class="font-weight-normal my-auto mb-4 text-center">Aplikasi GIS Sekolah merupakan sebuah website yang dimana dapat memberikan 
        informasi mengenai sekolah-sekolah yang ada di setiap kecamatan di Kota Bandung. Aplikasi ini dapat menampilkan tingkat kualitas 
        pendidikan di setiap kecamatan dalam bentuk visual serta membantu masyarakat dalam melihat perbandingan kualitas pendidikan di 
        setiap kecamatan agar tercapainya pendidikan yang merata di setiap daerah. Dalam menentukan tingkat kualitas pendidikan, 
        digunakan 3 faktor yang mempengaruhi kualitas pendidikan yang terdiri dari:</p>
    <ul class="list-unstyled font-weight-normal my-auto mb-4">
      <li class="font-weight-normal my-auto mb-2">RMS (Rasio Murid dan Sekolah), perbandingan jumlah murid per kecamatan terhadap jumlah
           sekolah di kecamatan tersebut.</li>
      <li class="font-weight-normal my-auto mb-2">RMG (Rasio Murid dan Guru), perbandingan jumlah murid per kecamatan terhadap jumlah
           guru di kecamatan tersebut.</li>
      <li class="font-weight-normal my-auto mb-2">RMK (Rasio Murid dan Kelas), perbandingan jumlah murid per kecamatan terhadap jumlah
           kelas di kecamatan tersebut.</li>
    </ul>
  </div>
</div>

<?= $this->endSection() ?>