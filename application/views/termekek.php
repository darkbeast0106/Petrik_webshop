    <div class="container">
        <div class="row">
            <?php foreach ($termekek as $termek): ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="img-container card-header">
                            <img class="card-img-top" src="<?php echo base_url().'util/img/upload/'.$termek['kep']; ?>" alt="Card image cap">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $termek['nev'] ?></h5>
                            <p class="card-text"><?php echo strlen($termek['leiras']) > 75 ? substr($termek['leiras'],0,75)."..." : $termek['leiras']  ?></p>
                        </div>
                        <div class="card-footer">
                            <p><?php echo $termek['ar'] ?> Ft</p>

                            <div class="row">
                            <button onclick="kosarba(<?php echo $termek['id'] ?>, `<?php echo $termek['nev'] ?>`, <?php echo $termek['ar'] ?>)" class="btn btn-primary col-6">Kosárba</button>
                            <a href="<?php echo base_url()."termekek/termek_reszletek/".$termek['id'] ; ?>" class="btn btn-success col-6">Részletek</a>
                            <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 0): ?>
                                <form class="col-6 p-0" action="<?php echo base_url() ?>termekek/termek_arhivalasa" method="post" onsubmit="return confirm('Biztosan szeretné törölni a terméket?')">
                                <input type="hidden" name="termek_id" value="<?php echo $termek['id'] ?>">
                                <button style="width: 100%;" class="btn btn-danger">Törlés</button>
                                </form>

                                <a href="<?php echo base_url()."termekek/termek_modositasa/".$termek['id'] ; ?>"  class="btn btn-warning col-6">Módosít</a> 
                                <?php if ($termek['kiemelt'] == 0): ?>
                                <form class="col-12 p-0" action="<?php echo base_url() ?>termekek/termek_kiemeles" method="post" onsubmit="return confirm('Biztosan szeretné kiemelni a terméket?')">
                                <input type="hidden" name="termek_id" value="<?php echo $termek['id'] ?>">
                                <input type="hidden" name="kiemelt" value="1">
                                <input type="hidden" name="reszletek" value="0">
                                <button style="width: 100%;" class="btn btn-info">Kiemelés</button>                                    
                                <?php else: ?>
                                <form class="col-12 p-0" action="<?php echo base_url() ?>termekek/termek_kiemeles" method="post" onsubmit="return confirm('Biztosan szeretné megszüntetni a termék kiemelését?')">
                                <input type="hidden" name="termek_id" value="<?php echo $termek['id'] ?>">
                                <input type="hidden" name="kiemelt" value="0">
                                <input type="hidden" name="reszletek" value="0">
                                <button style="width: 100%;" class="btn btn-info">Kiemelés megszüntetése</button>       
                                <?php endif; ?>
                        </form>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<script>
function kosarba(id, nev, ar) {
    var url = "<?php echo base_url(); ?>kosar/kosar_insert"
    $.post(url, 
        {
            id : id,
            nev : nev,
            ar : ar
        },
        function (data, textStatus) {
            if (textStatus == "success") {
                console.log(data);
            }
        },
        "json"
    );
}
</script>
</body>
</html>