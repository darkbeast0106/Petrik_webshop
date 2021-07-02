<div class="container">
    <?php if ($this->session->userdata('user')['jogosultsag'] == 2): ?>
        <?php if ($osszes): ?>
        <a href="<?php echo base_url() ?>rendeles" class="btn btn-lg btn-primary mt-3 mb-3"  style="width: 100%;">Csak a saját rendelések megjelenítése</a>
        <?php else: ?>
        <a href="<?php echo base_url() ?>rendeles/osszes" class="btn btn-lg btn-primary mt-3 mb-3"  style="width: 100%;">Összes megjelenítése</a>
        <?php endif; ?>
    <?php endif; ?>
    <table class="table table-striped">
        <thead >
            <tr>
                <?php if ($osszes): ?>
                <th>Megrendelő</th>
                <?php endif; ?>
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
                <?php if ($osszes): ?>
                <td><?php echo $rendeles['megrendelo_teljes_nev'] ?></td>
                <?php endif; ?>
                <td><?php echo $rendeles['szallitasi_cim'] ?></td>
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