<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Insert Barang</h4>
                                    <span>Harap isi data dengan lengkap </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Form</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Form</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h5>Basic Form Inputs</h5>
                                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>


                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div> -->
                                <div class="card-block">
                                    <h4 class="sub-title">Form Barang</h4>
                                    <!-- <form  class="form-horizontal" role="form" action="<?php echo $action; ?>" method="POST"> -->
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Pelanggan <span style="color:red">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_pelanggan" value="<?php if( isset($nama_pelanggan)  ) {echo $nama_pelanggan;}?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Nama Barang <span style="color:red">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="nama_barang" value="<?php if( isset($nama_barang)  ) {echo $nama_barang;}?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Qty <span style="color:red">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="number" class="form-control" name="qty" value="<?php if( isset($qty)  ) {echo $qty;}?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Harga <span style="color:red">*</span></label>
                                            <div class="col-sm-10">
                                                <!-- <input type="text" class="form-control money" name="harga"> -->
                                                <div class="input-group">
                                                    <span class="input-group-addon" id="basic-addon2">Rp.</span>
                                                    <input type="text" class="form-control money" name="harga" value="<?php if( isset($harga)  ) {echo $harga;}?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Tanggal Booked <span style="color:red">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="date" class="form-control" name="tgl_booked" value="<?php if( isset($tgl_booked)  ) {echo $tgl_booked;}?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status <span style="color:red">*</span></label>
                                            <div class="col-sm-10 form-radio">
                                                <!-- <input type="text" class="form-control" name="status"> -->
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="status" value="booked" <?= isset($status) && $status == "booked" ? 'checked="checked"': "" ?> >
                                                        <i class="helper"></i>Booked
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="status" value="checkout" <?= isset($status) && $status == "checkout" ? 'checked="checked"': "" ?> >
                                                        <i class="helper"></i>Checkout
                                                    </label>
                                                </div>
                                                <div class="radio radio-inline">
                                                    <label>
                                                        <input type="radio" name="status" value="cancel" <?= isset($status) && $status == "cancel" ? 'checked="checked"': "" ?> >
                                                        <i class="helper"></i>Cancel
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary" style="float:right;" onclick="SaveForm()">Save</button>

                                </div>
                                <!-- </form> -->
                            </div>
                            <!-- Basic Form Inputs card end -->
                            <!-- Input Grid card start -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body end -->
        </div>
    </div>
</div>
<script>
    var aksi = '<?=$aksi?>';
    var aksi_url = "";
    if (aksi == "add") {
        aksi_url = '<?=base_url()?>' + "barang/save";
    }else{
        aksi_url = '<?=base_url()?>' + "barang/update";
    }

    function SaveForm() {
        var nama_pelanggan = $("input[name=nama_pelanggan]").val();
        var nama_barang = $("input[name=nama_barang]").val();
        var qty = $("input[name=qty]").val();
        var harga = $("input[name=harga]").val();
        var tgl_booked = $("input[name=tgl_booked]").val();
        var status = $("input[name=status]").val();
        
        if (nama_pelanggan != '' && nama_barang != '' && qty != '' && harga != '' && tgl_booked != '' && status != '') {
            swal({
                title: "Apakah anda yakin?",
                text: "Harap cek kembali bila anda tidak yakin!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((ya) => {
                if (ya) {
                    $.ajax({
                        type: "POST",
                        url: aksi_url, 
                        data: {
                            nama_pelanggan : nama_pelanggan,
                            nama_barang : nama_barang,
                            qty : qty,
                            harga : harga,
                            tgl_booked : tgl_booked,
                            status : status
                        },success: function(result){
                            if (aksi == "add") {
                                swal("Berhasil!!!", "Data berhasil Diinputkan..", "success");
                                location.reload();
                            }else{
                                swal("Berhasil!!!", "Data berhasil Diubah..", "success");
                                setTimeout('', 5000);
                                window.location.href = '<?=base_url()?>' + "barang/"
                            }
                        },error: function() {
                            swal("Oops...", "Terjadi kesalahan saat input data", "error");
                        }
                    });// you have missed this bracket
                    
                }
            });
        }else{
           swal("Oops...", "Harap isi form dengan lengkap", "error");
        }
    }
</script>
