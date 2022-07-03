<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/logo_gissekolah.png') ?>">
    <link rel="icon" type="image/png" href="<?= base_url('assets/logo_gissekolah.png') ?>">
    <title>
        GIS Sekolah
    </title>
</head>

<body style="background-color: #1A407A;">
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0 align-items-center">
                            <div class="col-md-6 col-lg-5 d-md-block text-center">
                                <img src="<?= base_url('assets/logo_bandung.png') ?>" alt="login form" class="w-100 h-100" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <?php if (session()->getFlashdata('msg')) : ?>
                                    <div class="alert alert-warning">
                                        <?= session()->getFlashdata('msg') ?>
                                    </div>
                                <?php endif; ?>
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form action="<?php echo base_url(); ?>/Signin/loginAuth" method="post">
                                        <h2 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Admin Login</h2>
                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" value="<?= set_value('email') ?>" class="form-control form-control-lg" />
                                            <label class="form-label">Email address</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" class="form-control form-control-lg" />
                                            <label class="form-label">Password</label>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button type="submit" class="btn btn-success">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</body>

</html>