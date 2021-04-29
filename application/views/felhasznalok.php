<div class="container">
    <table class="table table-striped">
        <thead >
            <tr>
                <th>ID</th>
                <th>Felhasználónév</th>
                <th>Teljes név</th>
                <th>E-mail</th>
                <th>Cím</th>
                <th colspan="2">Jogosultság</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($felhasznalok as $felhasznalo): ?>
            <tr>
                <th><?php echo $felhasznalo['id'] ?></th>
                <td><?php echo $felhasznalo['felh_nev'] ?></td>
                <td><?php echo $felhasznalo['telj_nev'] ?></td>
                <td><?php echo $felhasznalo['email'] ?></td>
                <td><?php echo $felhasznalo['cim'] ?></td>
                <td><?php switch ($felhasznalo['jogosultsag'] ) {
                    case '0':
                        echo "vásárló";
                        break;
                    case '1':
                        echo "dolgozó";
                        break;
                    case '2':
                        echo "admin";
                        break;
                    
                    default:
                        echo "ISMERETLEN (ELLENŐRIZD AZ ADATBÁZIST)";
                        break;
                }?></td>
                <td>
                <?php if ($felhasznalo['jogosultsag'] < 2): ?>
                    <a class="btn btn-primary" href="<?php echo base_url() ?>felhasznalo/jogosultsag_modositasa/<?php echo $felhasznalo['id'] ?>">Módosít</a>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>