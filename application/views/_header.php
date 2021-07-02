<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petrik Webshop</title>
    <!-- Latest compiled and minified CSS -->
    
    <?php if ($this->session->userdata('szin_tema')): ?>
      <link rel="stylesheet" href="<?php echo base_url() ?>util/css/bootstrap/bootstrap.min_<?php echo $this->session->userdata('szin_tema') ?>.css">
    <?php else: ?>
      <link rel="stylesheet" href="<?php echo base_url() ?>util/css/bootstrap/bootstrap.min_0.css">
    <?php endif; ?>
    <link rel="stylesheet" href="<?php echo base_url() ?>util/css/custom.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="<?php echo base_url(); ?>">Petrik webshop</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li id="nav_home" class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>">Főoldal</a>
      </li>
      <li id="nav_termekek" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>termekek">Termékek</a>
      </li>
      
      <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 0): ?>
      <li id="nav_termek_hozzaadasa" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>termekek/termek_hozzaadasa">Termék hozzáadása</a>
      </li>
      <?php endif; ?>
      
      <?php if ($this->session->userdata('user') != null && $this->session->userdata('user')['jogosultsag'] > 1): ?>
      <li id="nav_felhasznalo" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>felhasznalo">Felhasználók</a>
      </li>
      <?php endif; ?>

      <?php if ($this->session->userdata('user') != null): ?>
      <li id="nav_felhasznaloi_beallitasok" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>felhasznalo/felhasznaloi_beallitasok">Felhasználói Beállítások</a>
      </li>
      <?php endif; ?>
      <?php if ($this->session->userdata('user') != null): ?>
      <li id="nav_rendeles" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>rendeles">Rendelések</a>
      </li>
      <?php endif; ?>

    </ul>
    <ul class="navbar-nav navbar-right">
      <li id="nav_kosar" class="nav-item">
        <a class="nav-link" href="<?php echo base_url() ?>kosar"><i class="fas fa-shopping-cart"></i></a>
      </li>      
    </ul>
    <form action="<?php echo base_url() ?>home/tema_valtasa" method="POST" class="form-inline my-2 my-lg-0">
      <?php if (isset($active_page)): ?>
      <input type="hidden" name="active_page" value="<?php echo $active_page ?>">
      <?php endif; ?>
      <button class="btn btn-primary" type="submit">Téma váltása</button>
    </form>

    <?php if ($this->session->userdata('user') != null): ?>
        
    <form action="<?php echo base_url() ?>home/kijelentkezes" class="form-inline my-2 my-lg-0">
      <button class="btn btn-primary" type="submit">Kijelentkezés</button>
    </form>

    <?php else: ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#regisztracio_modal">
    Regisztráció
    </button>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bejelentkezes_modal">
    Bejelentkezés
    </button>
    <?php endif; ?>
    <!--
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
    </form>
    -->
  </div>
</nav>

<div class="modal fade" id="regisztracio_modal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Regisztráció</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form method="POST" action="<?php base_url() ?>home/regisztracio">
      <div class="modal-body">
          <div class="form-group">
              <label for="reg_email">Email cím</label>
              <input type="email" name="email" class="form-control" id="reg_email" placeholder="Email cím"
              <?php if ($this->session->userdata('last_request') != null && array_key_exists('email', $this->session->userdata('last_request')) ): ?>
                value="<?php echo ($this->session->userdata('last_request')['email']) ?>"
              <?php endif; ?>
              >
          </div>
          <div class="form-group">
              <label for="reg_felh_nev">Felhasználónév</label>
              <input type="text" name="felh_nev" class="form-control" id="reg_felh_nev" placeholder="Felhasználónév"
              <?php if ($this->session->userdata('last_request') != null && array_key_exists('felh_nev', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['felh_nev']) ?>"
              <?php endif; ?>>
          </div>
          <div class="form-group">
              <label for="reg_jelszo">Jelszó</label>
              <input type="password" name="jelszo" class="form-control" id="reg_jelszo" placeholder="Jelszó"
              <?php if ($this->session->userdata('last_request') != null && array_key_exists('jelszo', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['jelszo']) ?>"
              <?php endif; ?>
              >
          </div>
          <div class="form-group">
              <label for="reg_telj_nev">Teljes név</label>
              <input type="text" name="telj_nev" class="form-control" id="reg_telj_nev" placeholder="Teljes név"
              <?php if ($this->session->userdata('last_request') != null && array_key_exists('telj_nev', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['telj_nev']) ?>"
              <?php endif; ?>>
          </div>
          <div class="form-group">
              <label for="reg_cim">Cím</label>
              <input type="text" name="cim" class="form-control" id="reg_cim" placeholder="Cím"
              <?php if ($this->session->userdata('last_request') != null && array_key_exists('cim', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['cim']) ?>"
              <?php endif; ?>>
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Regisztráció</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
      </div>
      </form>
      </div>
  </div>
</div>

<div class="modal fade" id="bejelentkezes_modal">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">Bejelentkezés</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <form method="POST" action="<?php base_url() ?>home/bejelentkezes">
      <div class="modal-body">
          <div class="form-group">
              <label for="login_felh_nev">Felhasználónév vagy email</label>
              <input type="text" name="felh_nev" class="form-control" id="login_felh_nev" placeholder="Felhasználónév vagy email"
              <?php if ($this->session->userdata('last_request') != null&& array_key_exists('felh_nev', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['felh_nev']) ?>"
              <?php endif; ?>>
          </div>
          <div class="form-group">
              <label for="login_jelszo">Jelszó</label>
              <input type="password" name="jelszo" class="form-control" id="login_jelszo" placeholder="Jelszó"
              <?php if ($this->session->userdata('last_request') != null&& array_key_exists('jelszo', $this->session->userdata('last_request'))): ?>
                value="<?php echo ($this->session->userdata('last_request')['jelszo']) ?>"
              <?php endif; ?>
              >
          </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Bejelentkezés</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mégse</button>
      </div>
      </form>
      </div>
  </div>
</div>

<?php if ($this->session->userdata('errors') != null): ?>
  <div class="alert alert-dismissible alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo 
    $this->session->userdata('errors');
      ?>
  </div>
<?php endif; ?>
<?php if ($this->session->userdata('success') != null): ?>
  <div class="alert alert-dismissible alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
    <?php echo 
    $this->session->userdata('success');
      ?>
  </div>
<?php endif; ?>

<script>
<?php if (isset($active_page)): ?>
    $("#nav_<?php echo $active_page ?>").addClass("active");
<?php endif; ?>
</script>