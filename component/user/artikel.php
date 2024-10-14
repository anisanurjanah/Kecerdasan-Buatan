<?php

$articles = array(
  array(
    'title' => 'Segala yang Perlu Anda Ketahui Seputar Penyakit Kulit',
    'image' => '../../assets/user/img/artikel-1.jpg',
    'alt' => 'hellosehat.com',
    'content' => 'Penyakit kulit adalah kondisi saat lapisan luar tubuh mengalami masalah baik iritasi atau meradang. Penyakit ini terdiri dari berbagai..',
    'link' => 'https://hellosehat.com/penyakit-kulit/pengertian-penyakit-kulit/'
  ),
  array(
    'title' => 'Penyakit Kulit: Jenis, Penyebab, dan Cara Mengatasinya',
    'image' => '../../assets/user/img/artikel-2.jpg',
    'alt' => 'alodokter.com',
    'content' => 'Penyakit kulit ada beragam dengan penyebab yang bervariasi pula. Ada penyakit kulit yang disebabkan oleh reaksi alergi, ada pula..',
    'link' => 'https://www.alodokter.com/macam-macam-penyakit-kulit-dan-cara-mengatasinya'
  ),
  array(
    'title' => '10 Jenis Penyakit Kulit, Penyebab, dan Cara Mengatasinya',
    'image' => '../../assets/user/img/artikel-3.jpg',
    'alt' => 'halodoc.com',
    'content' => 'Kulit rentan mengalami berbagai masalah kesehatan karena mudah terpapar kotoran, bakteri, hingga virus. Salah satu masalah..',
    'link' => 'https://www.halodoc.com/artikel/10-jenis-penyakit-kulit-dan-cara-mengatasinya'
  ),
  array(
    'title' => 'Jenis-Jenis Penyakit Kulit, Penyebab, dan Cara Mencegahnya',
    'image' => '../../assets/user/img/artikel-4.jpg',
    'alt' => 'katadata.co.id',
    'content' => 'Penyakit kulit dapat menyerang siapa saja dalam gejala dan tingkat keparahan yang bervariasi. Gangguan kulit dapat bersifat..',
    'link' => 'https://katadata.co.id/safrezi/berita/6170f0f37bca8/jenis-jenis-penyakit-kulit-penyebab-dan-cara-mencegahnya'
  )
);

?>

<!-- Menampilkan artikel -->
<div class="row">
  <?php foreach ($articles as $article) { ?>
    <div class="col-lg-6">
      <!-- Card with an image on top -->
      <div class="card">
        <img src="<?php echo $article['image']; ?>" class="card-img-top" alt="<?php echo $article['alt']; ?>">
        <div class="card-body">
          <a href="<?php echo $article['link']; ?>">
            <h5 class="card-title"><?php echo $article['title']; ?></h5>
          </a>
          <p class="card-text">
            <?php echo $article['content']; ?>
            <a href="<?php echo $article['link']; ?>">baca selengkapnya..</a>
          </p>
        </div>
      </div>
    </div>
  <?php } ?>
</div>