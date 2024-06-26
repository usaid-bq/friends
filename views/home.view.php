<?php  view('partials/head.php') ?>
<?php  view('partials/nav.php', [
    'page' => $page,
])?>
<?php  view('partials/banner.php', [
    'heading' => $heading,
])?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        Welcome to the home page, <?= $name ?> !
    </div>
</main>    

<?php  view('partials/foot.php') ?>