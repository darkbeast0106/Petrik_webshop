
    <div class="jumbotron">
    <h1 class="display-3">Köszöntelek a petrik webshop oldalán</h1>
    <p class="lead">A termékeket a termékek fülön tudod böngészni</p>
    <hr class="my-4">
    <?php if ($this->session->userdata('user') == null): ?>
        <p>Rendeléshez kérlek regisztrálj vagy jelentkezz be</p>
    <?php endif; ?>
    </div>
</body>
</html>