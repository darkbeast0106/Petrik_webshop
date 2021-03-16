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
                            <a href="#" class="btn btn-primary col-6">Kosárba</a>
                            <a href="#" class="btn btn-success col-6">Részletek</a>
                            <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 0): ?>
                                <a href="#" class="btn btn-danger col-6">Törlés</a>

                                <a href="#" class="btn btn-warning col-6">Módosít</a>
                            <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<!--
    <div class="jumbotron">
    <h1 class="display-3">Work in progress</h1>
    <p class="lead">Itt lesznek majd a termékek</p>
    <hr class="my-4">
    <?php if ($this->session->userdata('user') == null): ?>
        <p>Rendeléshez kérlek regisztrálj vagy jelentkezz be</p>
    <?php endif; ?>
    </div>
-->

</body>
</html>