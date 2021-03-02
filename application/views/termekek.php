    <div class="container">
        <div class="row">
            <?php foreach ($termekek as $termek): ?>
                <div class="col-md-3 col-6">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="<?php echo base_url().'util/img/upload/'.$termek['kep']; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $termek['nev'] ?></h5>
                            <p class="card-text"><?php echo $termek['leiras'] ?></p>
                            <hr>
                            <p><?php echo $termek['ar'] ?> Ft</p>
                            <div class="row">

                            <a href="#" class="btn btn-primary">Kosárba</a>
                            <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 0): ?>
                                <a href="#" class="btn btn-danger">Törlés</a>

                                <a href="#" class="btn btn-warning">Módosít</a>
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