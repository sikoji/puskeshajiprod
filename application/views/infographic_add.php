<!-- Page Heading -->
<?php
$judul = "";
$link = "";
$status = 1;
$url = "infographic_save";
$idku = "";
$position = "";

$img = "";
if (count($detail) > 0) {
    $judul = $detail->infographic_title;
    $status = $detail->infographic_selected;
    $url = "infographic_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->infographic_id . "'>";
    $img = $detail->infographic_img_url;
}

$opt_position = array("1" => "Kolom 1", "2" => "Kolom 2", "3" => "Kolom 3", "4" => "Kolom 4");
?>

<script>
    $(function(){
      id  = $("#kategori").val();
      loadnews(id);
      $("#kategori").change(function(){
        id  = $("#kategori").val();
        loadnews(id);
      });

    });

    function loadnews(id){
      var url = '<?=base_url("Hajj/api_news_bycat/");?>' + '/' + id;
        $.ajax({
          type : 'get',
          url  : url,
          success : function(html){
            $("#news").html("");
            $("#news").html(html);
            $("#news").show();
          },
          error : function(){

          }
      });
    }

    </script>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= $idku; ?>
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>Judul</label>
                <input class="form-control" name="title" placeholder="Masukkan Judul" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($judul) ? $judul : set_value("title"); ?>"
                       >
            </div>
            <div class="form-group">
                <label>Kategori Berita </label>
                <?=form_dropdown("kat",$kategori, "","class='form-control' id='kategori'");?>
            </div>
             <div class="form-group">
                <label> Berita </label>
                <select name="news" id="news" class="form-control"></select>
            </div>
            <div class="form-group">
                <label>Gambar (Best Image 850x350)</label>
                <input type="file" name="userfile" id="imgInp">
                <?php if ($img != "") { ?>
                    <p><img src="<?= base_url('assets/infographic_img/' . $img); ?>" id="ingEnv" /></p>
                <?php } ?>

            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
        </form>
    </div>

</div>
<!-- /.row -->
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgEnv').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

</script>