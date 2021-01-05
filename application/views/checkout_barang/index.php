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
                                    <h4>Checkout Barang</h4>
                                    <span>Pilihlah nama pelanggan yang akan di checkout </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Checkout</a>
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
                                <?php
                                if (isset($message)) {
                                ?>
                                    <div class="alert alert-danger background-danger col-md-6">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled text-white"></i>
                                        </button>
                                        <strong>Danger!</strong> <code> <b>Start date</b></code>&nbsp; tidak boleh lebih dari <code><b>End Date</b></code>
                                    </div>
                                <?php
                                }
                                ?>
                                    <h3>Filter</h3>
                                        <form action="<?=base_url('checkout_barang/');?>" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-form-label">Start Date</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" class="form-control" name="start_date" value="<?php if( isset($start_date)  ) {echo $start_date;}?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label class="col-sm-12 col-form-label">End Date</label>
                                                        <div class="col-sm-12">
                                                            <input type="date" class="form-control" name="end_date" value="<?php if( isset($end_date)  ) {echo $end_date;}?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-success" type="submit">Filter</button>
                                                </div>
                                            </div>
                                        </form>

                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div>
                                <div class="card-block">
                                    <h4 class="sub-title">Checkout Barang</h4>
                                    <table class="table table-striped table-bordered table-check" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Total Harga (Rupiah)</th>
                                                <!-- <th>Status</th> -->
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    <?php
                                    $no=1;
                                        foreach ($data->result() as $key => $value) {
                                    ?>
                                            <tr>
                                                <td><?=$no?></td>
                                                <td><?=$value->nama_pelanggan?></td>
                                                <td><?=$value->qty?> Pcs</td>
                                                <td style="text-align: right;"><?=number_format($value->total_harga)?></td>
                                                <!-- <td><?=$value->status?></td> -->
                                                <td>
                                                    <a href="<?=base_url('checkout_barang/detail').'/'.$value->id_pelanggan."/".$start_date."/".$end_date?>" class="btn btn-primary btn-sm" title="Detail"><i class="fa fa-eye"></i>Detail</a>
                                                </td>
                                            </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- <div class="card-footer">
                                    <button class="btn btn-primary" style="float:right;" onclick="SaveForm()">Save</button>

                                </div> -->
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
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
