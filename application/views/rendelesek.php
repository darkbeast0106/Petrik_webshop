<div class="container">
    <table class="table table-striped">
        <thead >
            <tr>
                <th>Szállítási cím</th>
                <th>Rendelés időpontja</th>
                <th>Megjegyzés</th>
                <th>Termékek száma</th>
            </tr>
        </thead>
        <tbody>
        <?php $count = 0; ?>
        <?php foreach ($rendelesek as $rendeles): ?>
            <tr>
                <th><?php echo $rendeles['szallitasi_cim'] ?></th>
                <td><?php echo $rendeles['rendeles_idopontja'] ?></td>
                <?php if ($rendeles['megjegyzes'] == ""): ?>
                <td>-</td>
                <?php else: ?>
                <td><?php echo $rendeles['megjegyzes'] ?></td>
                <?php endif; ?>
                <td>
                <a tabindex="<?php echo $count ?>" role="button" data-toggle="popover" data-placement="top" title="Termékek" data-html="true"
                data-content="<?php echo $rendeles['termek_lista'] ?>">
                <?php echo $rendeles['tetel_szam'] ?></a>
                </td>
            </tr>
            <?php $count++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$("[data-toggle=popover]").popover();
</script>

</body>
</html>