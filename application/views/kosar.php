<div class="container">

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

<div style="text-align: right;">
<button class="btn btn-primary">Kosár frissítése</button>
<button class="btn btn-primary">Megrendel</button>
</div>

 </div>

 
</body>
</html>