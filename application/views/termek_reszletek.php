    <div class="container">
            <div class="card">
                <div class="img-container-large card-header">
                    <img class="card-img-top" src="<?php echo base_url().'util/img/upload/'.$termek['kep']; ?>" alt="Card image cap">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $termek['nev'] ?></h5>
                    <p class="card-text"><?php echo $termek['leiras'] ?></p>
                </div>
                <div class="card-footer">
                    <p><?php echo $termek['ar'] ?> Ft</p>

                    <div class="row">
                    <button onclick="kosarba(<?php echo $termek['id'] ?>, `<?php echo $termek['nev'] ?>`, <?php echo $termek['ar'] ?>)" class="btn btn-primary col-12">Kosárba</button>
                    <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 0): ?>
                        <a href="#" class="btn btn-danger col-6">Törlés</a>
                        <a href="<?php echo base_url()."termekek/termek_modositasa/".$termek['id'] ; ?>"  class="btn btn-warning col-6">Módosít</a>
                    <?php endif; ?>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>