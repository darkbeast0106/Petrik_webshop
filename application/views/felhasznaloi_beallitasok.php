
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Felhasználói adatok módosítása</h5>
                <form method="POST" action="<?php echo base_url() ?>/felhasznalo/felhasznaloi_adatok_modositasa">
                    <div class="form-group">
                        <label for="cim">Cím</label>
                        <input type="text" class="form-control" id="cim" name="cim" placeholder="<?php echo $user['cim'] ?>" value="<?php echo $user['cim'] ?>">
                    </div>
                        <button type="submit" class="btn btn-primary">Módosít</button>
                </form>
            </div>
            </div>
        </div>

        <div class="col-md-6">
        
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Jelszó módosítása</h5>
                    <form method="POST" action="<?php echo base_url() ?>/felhasznalo/jelszo_modositasa">
                        <div class="form-group">
                            <label for="jelenlegi_jelszo">Jelenlegi jelszó</label>
                            <input type="password" class="form-control" id="jelenlegi_jelszo" name="jelenlegi_jelszo" placeholder="Jelenlegi jelszó">
                        </div>
                        <div class="form-group">
                            <label for="jelszo">Új jelszó</label>
                            <input type="password" class="form-control" id="jelszo" name="jelszo" placeholder="Új jelszó">
                        </div>
                        <div class="form-group">
                            <label for="jelszo_megerosites">Jelszó megerősítés</label>
                            <input type="password" class="form-control" id="jelszo_megerosites" name="jelszo_megerosites" placeholder="Jelszó megerősítés">
                        </div>
                            <button type="submit" class="btn btn-primary">Módosít</button>
                    </form>
                </div>
                </div>
            </div>
    </div>
</div>

</body>
</html>