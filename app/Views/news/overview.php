<h1><?=esc($title);?></h1>
<main>
    <?php foreach ($news as $newsItem) : ?>
        <ul>
            <li><?= esc($newsItem['id']) ?></li>
            <li><?= esc($newsItem['title']) ?></li>
            <li><?= esc($newsItem['body']) ?></li>
            <li><?= esc($newsItem['slug']) ?></li>
            <li><a href="/news/<?=esc($newsItem['slug'])?>">go to view</a></li>
        </ul>
    <?php endforeach ?>
</main>