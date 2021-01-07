<style>
    .modal{
        z-index: 9999;
    }
</style>
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
                                    <h4>Data Barang</h4>
                                    <span>list data barang </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Data</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Barang</a>
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
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <table class="table table-responsive invoice-table table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <td><img src="<?php echo base_url();?>asset/images/AFH.jpg" class="m-b-10" alt="" style="width:100px;"></td>
                                                        <td>
                                                            <span>AFH_SHOP</span>
                                                            <span>Jl. Ujung Berung No.35</span>
                                                            <span>afh_shop@gmail.com</span>
                                                            <span>+62 891-1234-1234</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <h6>Client Information :</h6>
                                            <div class="col-md-6">
                                                <table style="width:100%">
                                                    <tbody>
                                                        <tr>
                                                            <td>Nama Pelanggan : </td>
                                                            <td><b><?=$nama_pelanggan?></b></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Booked Tanggal : </td>
                                                            <td><b><?=$start_date?> s/d <?=$end_date?></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-check" id="myTable" style="font-size:9pt">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Qty</th>
                                                    <th>Tanggal Booked</th>
                                                    <th>Total Harga</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                        $no=1;
                                            $total = 0;
                                            $id_barang_array = [];
                                            foreach ($data_barang->result() as $key => $value) {
                                                array_push($id_barang_array,$value->id_barang);
                                                
                                        ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$value->nama_barang?></td>
                                                    <td><?=$value->qty?> Pcs</td>
                                                    <td><?=$value->tgl_booked?></td>
                                                    <td style="text-align: right;"><?=number_format($value->harga)?></td>
                                                    <td><?=$value->status?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" onclick="delete_barang('<?=$value->id_barang?>')" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash"></i>Delete</a>
                                                <?php
                                                    if ($value->status == "booked") {
                                                        $total += $value->harga;
                                                ?>
                                                        <!-- <a href="javascript:void(0)" onclick="checkout_barang('<?=$value->id_barang?>')" class="btn btn-primary btn-sm" title="Checout"><i class="fa fa-check"></i>Checkout</a> -->
                                                        <a href="javascript:void(0)" onclick="form_catatan(null,'<?=$value->id_barang?>')" class="btn btn-primary btn-sm" title="Checout"><i class="fa fa-check"></i>Checkout</a>
                                                <?php
                                                    }
                                                ?>
                                                    </td>
                                                </tr>
                                        <?php
                                        $no++;
                                            }
                                        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table table-responsive invoice-table invoice-total">
                                                <tbody>
                                                    <tr>
                                                        <th>Sub Total :</th>
                                                        <td><?=number_format($total)?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Discount :</th>
                                                        <td>-</td>
                                                    </tr>
                                                    <tr class="text-info">
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">Total :</h5>
                                                        </td>
                                                        <td>
                                                            <hr>
                                                            <h5 class="text-primary">Rp. <?=number_format($total)?></h5>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success btn-sm" style="float:right;" onclick="form_catatan('all',null)"><i class="fa fa-check"></i> Checkout All</button>
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


<div class="modal fade" id="myModal" tabindex="-2" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Form Catatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="status_checkout" id="status_checkout">
                <input type="hidden" name="id_barang_one" id="id_barang_one">
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Total Berat Barang :</label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="ttl_berat" placeholder="(Kg)">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Catatan :</label>
                    <div class="col-sm-12">
                        <textarea name="catatan" cols="63" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-form-label">Status Link :</label>
                    <div class="col-sm-12 form-radio">
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="link" value="Ya" >
                                <i class="helper"></i>Ya
                            </label>
                        </div>
                        <div class="radio radio-inline">
                            <label>
                                <input type="radio" name="link" value="Tidak" >
                                <i class="helper"></i>Tidak
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light " onclick="catatan_checkout()">Checkout</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('#myTable').DataTable();
});

function delete_barang(id_barang){
    swal({
        title: "Apakah anda yakin akan menghapus data ini?",
        text: "Harap pastikan kembali!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((ya) => {
        if (ya) {
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>' + "barang/delete/" + id_barang,
                success: function(result){
                    swal("Berhasil!!!", "Data berhasil Dihapus..", "success");
                    location.reload();
                },error: function() {
                    swal("Oops...", "Terjadi kesalahan saat proses data", "error");
                }
            });// you have missed this bracket
            
        }
    });
}

function form_catatan(status = '', id_barang = '') {
    if (status == 'all') {
        $('#status_checkout').val('all');
    }else{
        $('#id_barang_one').val(id_barang);
        $('#status_checkout').val('one');
    }
    $('#myModal').modal();
}

function catatan_checkout() {
    var status = $('#status_checkout').val();
    var id_barang = $('#id_barang_one').val();
    if (status == 'all') {
        checkout_barang(id_barang, 'all');
    }else{
        checkout_barang(id_barang, null);
    }
}

function onlyUnique(value, index, self) {
  return self.indexOf(value) === index;
}
var arr_id_barang = [];
function checkout_barang(id_barang = null,status = null){
    if (status == 'all') {
        arr_id_barang = ['<?=implode("', '", $id_barang_array)?>'];
    }else{
        arr_id_barang.push(id_barang);
    }

    var res_arr_id_barang = arr_id_barang.filter(onlyUnique); //set array unique
    var ttl_berat = $("input[name=ttl_berat]").val();
    var catatan = $("textarea[name=catatan]").val();
    var link = $("input[name=link]").val();
    // console.log(ttl_berat);
    // console.log(catatan);
    // console.log(link);
    
    swal({
        title: "Apakah anda yakin akan checkout barang ini?",
        text: "Harap pastikan kembali!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((ya) => {
        if (ya) {
            $.ajax({
                type: "POST",
                url: '<?=base_url()?>' + "checkout_barang/checkout",
                data: {
                    id_barang:arr_id_barang,
                    ttl_berat:ttl_berat,
                    catatan:catatan,
                    link:link 
                },
                success: function(result){
                    swal("Berhasil!!!", "Data berhasil Checkout..", "success");
                    // if (status == "all") {
                    //     window.location.href = '<?=base_url()?>' + "checkout_barang/"
                    // }else{
                    //     location.reload();
                    // }
                },error: function() {
                    swal("Oops...", "Terjadi kesalahan saat proses data", "error");
                }
            });// you have missed this bracket
        }else{
            arr_id_barang = [];
        }
    });
}
</script>
