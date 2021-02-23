
    <div class="jumbotron">
    <h1 class="display-3">Work in progress</h1>
    <p class="lead">Itt lesznek majd a termékek</p>
    <hr class="my-4">
    <?php if ($this->session->userdata('user') == null): ?>
        <p>Rendeléshez kérlek regisztrálj vagy jelentkezz be</p>
    <?php endif; ?>
    </div>
</body>
</html>