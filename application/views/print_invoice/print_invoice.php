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
                                        <div class="col-md-5">
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
                                        <div class="col-md-7">
                                            <div class="row">
                                                <div class="col-md-6">
                                                <h6><b>Order Information :</b></h6>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Total Berat Beban : </td>
                                                                <td><b><?=$ttl_berat?> Kg</b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status Link : </td>
                                                                <td><b><?=$link?></b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-md-6">
                                                <h6><b>Client Information :</b></h6>
                                                    <table style="width:100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>Nama Pelanggan : </td>
                                                                <td><b><?=$nama_pelanggan?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status : </td>
                                                                <td><span class="label label-success">Checkout</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="padding: 2px 20px;">
                                    <h6>Catatan :</h6><br/>
                                        <div class="col-md-12">
                                            <p><?=$catatan?></p>
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
                                                    <th>Tanggal Checkout</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        <?php
                                        $no=1;
                                            $total = 0;
                                            foreach ($data_barang->result() as $key => $value) {
                                                $total += $value->harga;
                                        ?>
                                                <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$value->nama_barang?></td>
                                                    <td><?=$value->qty?> Pcs</td>
                                                    <td><?=tanggal($value->tgl_booked)['tgl']."-".tanggal($value->tgl_booked)['bulan']."-".tanggal($value->tgl_booked)['thn']?></td>
                                                    <td><?=tanggal($value->tgl_checkout)['tgl']."-".tanggal($value->tgl_checkout)['bulan']."-".tanggal($value->tgl_checkout)['thn']?></td>
                                                    <td style="text-align: right;"><?=number_format($value->harga)?></td>
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
                                    <button class="btn btn-danger btn-sm" style="float:right;" ><i class="fa fa-print"></i> Print</button>
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