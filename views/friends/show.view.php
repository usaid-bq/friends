<?php  view('partials/head.php') ?>
<?php  view('partials/nav.php', [
    'page' => $page,
])?>
<?php  view('partials/banner.php', [
    'heading' => $heading,
])?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <form method="POST" action="/friend?id=<?=$_GET['id']?>">      
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">New Note</label>

                <div class="mt-1">
                    <textarea
                        id="body"
                        name="body"
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="A new note about your friend.."
                    ><?= $_POST['body'] ?? ''?></textarea>

                    <?php if (isset($errors['body'])) : ?>
                        <p class="text-red-500 text-xs mt-2"><?= $errors['body'] ?></p>
                    <?php endif; ?>
                </div>
            </div>
 

            <div class=" px-4 py-3 text-right sm:px-6">
                <button
                    type="submit"
                    class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                    Save
                </button>
            </div>
        </form>

        <ul>
            <?php foreach ($notes as $note) : ?>
                <li class="flex justify-between gap-x-3 py-5">
                    <?=htmlspecialchars($note['body'])?>
                    <div class="flex gap-5">
                        <a href="/friend/edit?friend=<?=$friend['id']?>&note=<?=$note['id']?>"><button class="text-sm text-gray-500 mr-6">Edit</button></a>
                        <form method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <button class="text-sm text-red-500" name="delete" value="<?=$note['id']?>">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>    

<?php  view('partials/foot.php') ?>