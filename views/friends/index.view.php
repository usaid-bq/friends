<?php  view('partials/head.php') ?>
<?php  view('partials/nav.php', [
    'page' => $page,
])?>
<?php  view('partials/banner.php', [
    'heading' => $heading,
])?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <p class="mt-6 mb-6">
            <span class="inline-flex items-center rounded-md bg-gray-50 px-6 py-3 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">
                <a href="/friends/create" class="text-blue-500 hover:underline">New Friend</a>
            </span>
        </p>

        <ul role="list" class="divide-y divide-gray-100">
            <?php foreach ($friends as $friend) : ?>
                <li class="flex justify-between gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">
                            <a href="/friend?id=<?=$friend['id']?>">
                                <?=htmlspecialchars($friend['first_name'])?>
                            </a>
                        </p>
                        <p class="mt-1 truncate text-xs leading-5 text-gray-500"><?=htmlspecialchars($friend['email'])?></p>
                    </div>
                    </div>
                    <!-- <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                    <p class="text-sm leading-6 text-gray-900">Co-Founder / CEO</p>
                    <p class="mt-1 text-xs leading-5 text-gray-500">Last seen <time datetime="2023-01-23T13:23Z">3h ago</time></p>
                    </div> -->
                    <div class="flex gap-5">
                        
                        <a href="/friends/edit?id=<?=$friend['id']?>"><button class="text-sm text-gray-500">Edit</button></a>
                        
                        <form method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="text-sm text-red-500" name="delete" value="<?=$friend['id']?>">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

    </div>
</main>    

<?php  view('partials/foot.php') ?>