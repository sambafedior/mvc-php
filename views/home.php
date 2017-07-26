<h1>Hello <?= $name ?></h1>
<ul>
    <?php
    foreach ($list as $fileName):
    ?>
    <li>
        <a href="download.php?file=<?= $fileName ?>">
        <?= $fileName ?>
        </a>
    </li>
    <?php endforeach; ?>
</ul>