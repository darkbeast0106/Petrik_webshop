    <div class="container">
    <form action="<?php echo base_url(); ?>termekek/termek_edit_post" method="post"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="id" value="<?php echo $termek['id'] ?>">
        <div class="form-group">
            <label for="nev">Termék név</label>
            <input type="text" name="nev" class="form-control" id="nev" value="<?php echo $termek['nev'] ?>" placeholder="Termék név">
        </div>
        <div class="form-group">
            <label for="leiras">Leírás</label>
            <textarea name="leiras" class="form-control" id="leiras" rows="3"><?php echo $termek['leiras'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="ar">Termék ár (Ft)</label>
            <input type="number" name="ar" class="form-control" id="ar" placeholder="Termék ár (Ft)" value="<?php echo $termek['ar'] ?>">
        </div>
        <div class="form-group">
            <label for="kep">Kép</label>
            <input type="file" class="form-control-file" id="kep" name="kep" accept=".jpg,.jpeg,.png,.bmp,.gif">
            <img src="<?php echo base_url().'util/img/upload/'.$termek['kep']; ?>" alt="Feltöltendő kép" class="img-thumbnail" id="kepnez"
                width="300"
                onerror="this.src='<?php echo base_url() ?>/util/img/no_image_found.jpg'"
            >
        </div>

        
        <button type="submit" class="btn btn-primary">Módosít</button>
    </form>
    </div>
</body>
</html>

<script>
$("#kep").change(function () { 
    if (fileExtValidate(this)) {
        if (fileSizeValidate(this)) {
            kepnezes(this);
        }
    }
});

    function fileExtValidate(fdata) {
		var validExt = ".png, .gif, .jpeg, .jpg, .bmp";
		var filePath = fdata.value;
		var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
		var pos = validExt.indexOf(getFileExt);
		if(pos < 0) {
			alert("A fájlkiterjesztés nem megfelelő.");
			return false;
		} else {
			return true;
		}
	}

	function fileSizeValidate(fdata) {
		
		var maxSize = '5120';
		if (fdata.files && fdata.files[0]) {
			var fsize = fdata.files[0].size/1024;
			if(fsize > maxSize) {
				alert('Túllépte a maximálisan engedélyezett fájlméretet (5MB)');
				return false;
			} else {
				return true;
			}
		}
	}

    function kepnezes(input) {
        if (input.files && input.files[0])
        {
            var filerdr = new FileReader();
            filerdr.onload = function(e) {
                $('#kepnez').attr('src', e.target.result);
            };
            filerdr.readAsDataURL(input.files[0]);
        }
    }

</script>