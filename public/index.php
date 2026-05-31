<?php

$alumni_trending = [
    [
        'nama' => 'Farida Farichah',
        'role' => 'Admin',
        'tanggal' => '01 Maret 2026',
        'views' => 602,
        'foto' => 'alumni-farida.jpg',
        'tags' => ['PEMERINTAH', 'MAGISTER', '2006-2010'],
        'tag_colors' => ['orange', 'yellow', 'cyan']
    ],
    [
        'nama' => 'Sutarjo',
        'role' => 'Admin',
        'tanggal' => '16 Juli 2020',
        'views' => 3213,
        'foto' => 'alumni-sutarjo.jpg',
        'tags' => ['FAPERTA', 'WIRAUSAHA'],
        'tag_colors' => ['red', 'cyan']
    ]
];

$alumni_terbaru = [
    ['nama' => 'Minda Melinda', 'tanggal' => '30 Mei 2026', 'views' => 36, 'foto' => 'alumni-minda.jpg'],
    ['nama' => 'Abdul Aziz Fauzi', 'tanggal' => '30 Mei 2026', 'views' => 34, 'foto' => 'alumni-abdul.jpg'],
    ['nama' => 'Bambang Winarso', 'tanggal' => '29 Mei 2026', 'views' => 40, 'foto' => 'alumni-bambang.jpg'],
    ['nama' => 'Dwi Graha Pangestu', 'tanggal' => '29 Mei 2026', 'views' => 43, 'foto' => 'alumni-dwi.jpg'],
    ['nama' => 'Yusuf Rahadian', 'tanggal' => '26 Mei 2026', 'views' => 85, 'foto' => 'alumni-yusuf.jpg'],
    ['nama' => 'Beatrice M.', 'tanggal' => '24 Mei 2026', 'views' => 77, 'foto' => 'alumni-beatrice.jpg']
];

$alumni_populer = [
    ['nama' => 'Rachmat Pambudy', 'tanggal' => '21 Agustus 2023', 'foto' => 'alumni-thumb-rachmat.jpg'],
    ['nama' => 'Said Didu', 'tanggal' => '03 Agustus 2020', 'foto' => 'alumni-thumb-said.jpg'],
    ['nama' => 'Susilo Bambang Yudhoyono', 'tanggal' => '15 April 2021', 'foto' => 'alumni-thumb-sby.jpg']
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Alumni IPB Pedia</title>
    <link rel="stylesheet" href="../asset/css/style.css">
</head>

<body>

    <header class="main-header">
        <div class="container header-content">
            <div class="logo">
                <img src="../asset/img/logo.png" alt="Logo" class="logo-img">
                <span class="logo-text">alumniipbpedia</span>
            </div>
            <nav class="main-nav">
                <ul>
                    <li><a href="#" class="active">BERANDA</a></li>
                    <li><a href="#">UPDATE DATA</a></li>
                    <li><a href="#">LOGIN</a></li>
                    <li><a href="#">PROFIL</a></li>
                </ul>
            </nav>
            <div class="header-search">
                <select>
                    <option>Semua Nama</option>
                </select>
                <input type="text" placeholder="Tulis & Tekan Enter...">
                <button type="submit">🔍</button>
            </div>
        </div>
    </header>

    <main class="container">



        <div class="content-middle-grid">

            <section class="section-terbaru">
                <h2 class="section-title">TERBARU</h2>
                <div class="alumni-grid">

                    <?php foreach ($alumni_terbaru as $baru): ?>
                        <div class="card-alumni">
                            <img src="../asset/img/<?php echo $baru['foto']; ?>" alt="<?php echo $baru['nama']; ?>"
                                loading="lazy">
                            <h3>
                                <?php echo $baru['nama']; ?>
                            </h3>
                            <p class="meta small-meta"> 📅
                                <?php echo $baru['tanggal']; ?> | 👁️
                                <?php echo $baru['views']; ?>
                            </p>
                        </div>
                    <?php endforeach; ?>

                </div>
            </section>
        </div>
    </main>

</body>

</html>