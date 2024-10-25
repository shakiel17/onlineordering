<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title"><?=$title;?></h4>                    
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <?php
                        if($this->session->success){
                            ?>
                            <div class="alert alert-success"><?=$this->session->success;?></div>
                            <?php
                        }
                        ?>
                        <?php
                        if($this->session->failed){
                            ?>
                            <div class="alert alert-danger"><?=$this->session->failed;?></div>
                            <?php
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <table width="100%" border="0">
                                    <tr>
                                        <td><h5 class="card-title">Tranaction List</h5></td>
                                        <td align="right"><a href="<?=base_url();?>new_disposal" class="btn btn-primary">New Disposal</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-body">                                                                
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%">No.</th>
                                                <th>Ref No</th>
                                                <th>Date Created</th>
                                                <th>Time Created</th>                                                
                                                <th width="15%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php                                            
                                            $x=1;
                                            foreach($items as $item){                                                                                                                                                
                                                echo "<tr>";
                                                    echo "<td>$x.</td>";                                                    
                                                    echo "<td>$item[refno]</td>";                                                    
                                                    echo "<td align='right'>".date('m/d/Y',strtotime($item['datearray']))."</td>";
                                                    echo "<td align='right'>".date('h:i A',strtotime($item['timearray']))."</td>";                                                                                                        
                                                    ?>
                                                    <td>
                                                        <a href="<?=base_url();?>edit_disposal/<?=$item['refno'];?>" class="btn btn-warning btn-sm">Manage</a>                                                        
                                                    </td>
                                                    <?php
                                                echo "</tr>";
                                                $x++;
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>No.</th>
                                                <th>Ref No</th>
                                                <th>Date Created</th>
                                                <th>Time Created</th>                                                
                                                <th width="15%">Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
   
            </div>
            
        </div>