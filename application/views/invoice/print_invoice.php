<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">

                    <!-- Page body start -->
                    <div class="page-body">
                        <!-- Container-fluid starts -->
                        <div class="container">
                            <!-- Main content starts -->
                            <div>
                                <!-- Invoice card start -->
                                <div class="card">
                                    <div class="row invoice-contact">
                                        <div class="col-md-8">
                                            <div class="invoice-box row">
                                                <div class="col-sm-12">
                                                    <table class="table table-responsive invoice-table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td><img src="<?php echo base_url();?>asset/images/AFH.jpg" class="m-b-10" alt="" style="width:100px;"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>AFH_SHOP</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Jl. Ujung Berung No.35</td>
                                                            </tr>
                                                            <tr>
                                                                <td>afh_shop@gmail.com
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>+62 891-1234-1234</td>
                                                            </tr>
                                                            <!-- <tr>
                                            <td><a href="#" target="_blank">www.demo.com</a>
                                            </td>
                                        </tr> -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row invoive-info">
                                            <div class="col-md-4 col-xs-12 invoice-client-info">
                                                <h6>Client Information :</h6>
                                                <p class="m-0">Josephin Villa</p>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6>Order Information :</h6>
                                                <table class="table table-responsive invoice-table invoice-order table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th>Status :</th>
                                                            <td>
                                                                <span class="label label-warning">Booked</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-4 col-sm-6">
                                                <h6 class="m-b-20">Invoice Number <span>#<?=str_replace("-","",date("Y-m-d"))?></span></h6>
                                                <h6 class="text-uppercase text-primary">Total :
                                                    <span>Rp. <?=number_format(90000000)?></span>
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="thead-default">
                                                                <th>Nama Barang</th>
                                                                <th>Tanggal Checkout</th>
                                                                <th>Quantity</th>
                                                                <th>Harga</th>
                                                                <th>Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                    <?php
                                                    ?>
                                                            <tr>
                                                                <td>jaket</td>
                                                                <td></td>
                                                                <td>6</td>
                                                                <td>$200.00</td>
                                                                <td>$1200.00</td>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-responsive invoice-table invoice-total">
                                                    <tbody>
                                                        <tr>
                                                            <th>Sub Total :</th>
                                                            <td>$4725.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Taxes (10%) :</th>
                                                            <td>$57.00</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Discount (5%) :</th>
                                                            <td>$45.00</td>
                                                        </tr>
                                                        <tr class="text-info">
                                                            <td>
                                                                <hr>
                                                                <h5 class="text-primary">Total :</h5>
                                                            </td>
                                                            <td>
                                                                <hr>
                                                                <h5 class="text-primary">$4827.00</h5>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h6 style="text-align:center">--TERIMA KASIH TELAH ORDER--</h6>
                                                <h6 style="text-align:center">AFH_SHOP</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Invoice card end -->
                                <div class="row text-center">
                                    <div class="col-sm-12 invoice-btn-group text-center">
                                        <button type="button" class="btn btn-primary btn-print-invoice m-b-10 btn-sm waves-effect waves-light m-r-20">Print</button>
                                        <button type="button" class="btn btn-danger waves-effect m-b-10 btn-sm waves-light">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container ends -->
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
            <!-- Warning Section Starts -->

            <div id="styleSelector">

            </div>
        </div>
    </div>
</div>