<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeigniter 4</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="<?=base_url('/css/bootstrap.css')?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script src="<?=base_url('/js/bootstrap.bundle.js')?>"></script>
    <script src="<?=base_url('/js/jquery.js')?>"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- STYLES -->
</head>
<body>
    <div class="app">
        <?=$this->include('layouts/inc/navbar.php')?>

        <div class="container mb-5 mt-5">
            <?=$this->renderSection('script')?>
            <?=$this->renderSection('content')?>
        </div>
        
    </div>

    <?=$this->renderSection('script')?>
</body>
</html>