<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->e($title) ?></title>
    <link href="//unpkg.com/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="//unpkg.com/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="container my-3">
    <?= $this->section('content') ?>
</div>
<script src="//unpkg.com/alpinejs" defer></script>
<script src="//unpkg.com/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
