<h1>Bonjour <?=$name?></h1>


    <?php foreach ($list as $fileName): ?>
        <li>
            <a href="download.php?file=<?=$fileName?>" >
            <?=$fileName?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>