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
                                <!-- <div class="card-header">
                                    <h5>Basic Form Inputs</h5>
                                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>


                                    <div class="card-header-right">
                                        <i class="icofont icofont-spinner-alt-5"></i>
                                    </div>

                                </div> -->
                                <div class="card-block">
                                    <h4 class="sub-title">Data Barang</h4>
                                    <table class="table table-striped table-bordered table-check" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Nama Barang</th>
                                                <th>Qty</th>
                                                <th>Tanggal Booked</th>
                                                <th>Total Harga (Rupiah)</th>
                                                <th>Status</th>
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
                                                <td><?=$value->nama_barang?></td>
                                                <td><?=$value->qty?> Pcs</td>
                                                <td><?=$value->tgl_booked?></td>
                                                <td style="text-align: right;"><?=number_format($value->harga)?></td>
                                                <td><?=$value->status?></td>
                                                <td>
                                                    <a href="<?=base_url('barang/update').'/'.$value->id_barang?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                    $no++;
                                        }
                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                                <span><hr/></span>
                                <div class="card-footer">
                                    <center>
                                        <a href="<?=base_url()?>barang/add" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data</a>
                                    </center>
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
$(document).ready(function(){
    $('#myTable').DataTable();
});
</script>
