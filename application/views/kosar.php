<div class="container">
<form action="<?php echo base_url() ?>kosar/kosar_frissit" method="post">
<table class="table" cellpadding="6" cellspacing="1" style="width:100%" border="0">
<thead>
<tr>
    <th>Termék neve</th>
    <th style="text-align:right">Egységár</th>
    <th style="text-align:right">Db</th>
    <th style="text-align:right">Részösszeg</th>
</tr>
</thead>

<tbody>
<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

    <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

    <tr>
        <td>
        <?php echo $items['name']; ?>

            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                <p>
                    <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                    <?php endforeach; ?>
                </p>

            <?php endif; ?>

        </td>
        <td style="text-align:right"><?php echo $items['price']; ?> Ft</td>
        
        <td  style="text-align:right"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
        <td style="text-align:right"><?php echo $items['subtotal']; ?> Ft</td>
    </tr>

<?php $i++; ?>

<?php endforeach; ?>
</tbody>

<tfoot>
<tr>
    <td colspan="2"></td>
    <td class="right"  style="text-align:right"><strong>Total</strong></td>
    <td class="right"  style="text-align:right"><?php echo $this->cart->total(); ?>  Ft</td>
</tr>
</tfoot>
</table>

    <?php if (count($this->cart->contents()) > 0): ?>
    
    <div style="text-align: right;">
        <button class="btn btn-primary">Kosár frissítése</button>
        <button class="btn btn-primary" data-toggle="modal" data-target="#rendeles_modal">Megrendel</button>
    </div>
    <?php endif; ?>
    </form>
</div>

<!-- The Modal -->
<div class="modal" id="rendeles_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Rendelési adatok</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form method="post" action="<?php echo base_url() ?>rendeles/rendeles_felvetele">
      <!-- Modal body -->
      <div class="modal-body">
            <div class="form-group">
                <label class="col-form-label mt-4" for="szallitasi_cim">Szállítási cím</label>
                <input type="text" class="form-control" placeholder="Szállítási cím" id="szallitasi_cim" name="szallitasi_cim" required maxlength="200">
            </div>
            <div class="form-group">
            <label for="megjegyzes" class="form-label mt-4">Megjegyzes</label>
            <textarea class="form-control" id="megjegyzes" rows="3" name="megjegyzes"></textarea>
            </div> 
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <!-- TODO: kosár frissítése javascripttel -->
        <button type="submit" class="btn btn-primary">Megrendel</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Mégse</button>
      </div>
    
      </form>
    </div>
  </div>
</div>
 
 
</body>
</html>
