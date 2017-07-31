<h2>Recherche Par Nom</h2>

<table class="table table-bordered">
    <!--Affichage dynamique de colonnes-->
    <thead>
    <?php if (isset($catalogue[0])): ?>
        <?php $cols = array_keys($catalogue[0]) ?>
        <tr>
            <?php foreach ($cols as $colName): ?>
                <th><?= $colName ?></th>
            <?php endforeach; ?>
        </tr>
    <?php endif; ?>
    </thead>

    <!--Affichage des donnees-->
    <tbody>
    <?php foreach ($catalogue as $livre): ?>
        <tr>
            <?php foreach ($livre as $colData): ?>
                <td> <?= $colData ?> </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>

</table>
