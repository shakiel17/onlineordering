<div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Admin Dashboard</h4>
                        <div class="ml-auto text-right">
                            <!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Library</li>
                                </ol>
                            </nav> -->
                        </div>
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
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4">
                        <a href="<?=base_url();?>manage_product">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                                    <h6 class="text-white">Products</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                     <!-- Column -->
                    <div class="col-md-6 col-lg-4">
                        <a href="<?=base_url();?>manage_order">
                            <div class="card card-hover">
                                <div class="box bg-warning text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                                    <h6 class="text-white">Pending Orders</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- Column -->
                    <div class="col-md-6 col-lg-4">
                        <a href="<?=base_url();?>manage_report">
                            <div class="card card-hover">
                                <div class="box bg-danger text-center">
                                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                                    <h6 class="text-white">Total Sales</h6>
                                </div>
                            </div>
                        </a>
                    </div>                                 
                </div>   
                <div class="row col-12">
                    <div class="card col-4">
                        <div class="card-body">
                            <h5 class="card-title">Full Level</h5>
                            <div class="table-responsive">
                                <table
                                id="full_level"
                                class="table table-striped table-bordered"
                                >
                                <thead>
                                    <tr>
                                    <th>Description</th>                                                                        
                                    <th width="10%">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query=$this->Ordering_model->getLevel();
                                    foreach($query as $item){
                                        $max=$item['max_level'];
                                        $min=$item['critical_level'];
                                        $soh=$item['soh'];
                                        $mid=($max+$min)/2;
                                        $full=($max+$mid)/2;
                                        $half=($mid+$min)/2;
                                        if($soh >= $full){
                                        ?>
                                        <tr>
                                            <td><?=$item['description'];?></td>
                                            <td align="center"><?=$item['soh'];?></td>                                    
                                        </tr>                            
                                        <?php
                                        }
                                    }
                                    ?>                                    
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Description</th>                                                                        
                                    <th>Quantity</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div> 
                    </div>


                    <div class="card col-4">
                        <div class="card-body">
                            <h5 class="card-title">Half Level</h5>
                            <div class="table-responsive">
                                <table
                                id="half_level"
                                class="table table-striped table-bordered"
                                >
                                <thead>
                                    <tr>
                                    <th>Description</th>                                                                        
                                    <th width="10%">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query=$this->Ordering_model->getLevel();
                                    foreach($query as $item){
                                        $max=$item['max_level'];
                                        $min=$item['critical_level'];
                                        $soh=$item['soh'];
                                        $mid=($max+$min)/2;
                                        $full=($max+$mid)/2;
                                        $half=($mid+$min)/2;
                                        if($soh < $full && $soh >= $min){
                                        ?>
                                        <tr>
                                            <td><?=$item['description'];?></td>
                                            <td align="center"><?=$item['soh'];?></td>                                    
                                        </tr>                            
                                        <?php
                                        }
                                    }
                                    ?>                            
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Description</th>                                                                        
                                    <th>Quantity</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div> 
                    </div>
                    
                    <div class="card col-4">
                        <div class="card-body">
                            <h5 class="card-title">Critical Level</h5>
                            <div class="table-responsive">
                                <table
                                id="critical_level"
                                class="table table-striped table-bordered"
                                >
                                <thead>
                                    <tr>
                                    <th>Description</th>                                                                        
                                    <th width="10%">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $query=$this->Ordering_model->getLevel();
                                    foreach($query as $item){
                                        $max=$item['max_level'];
                                        $min=$item['critical_level'];
                                        $soh=$item['soh'];
                                        $mid=($max+$min)/2;
                                        $full=($max+$mid)/2;
                                        $half=($mid+$min)/2;
                                        if($soh <= $min){
                                        ?>
                                        <tr>
                                            <td><?=$item['description'];?></td>
                                            <td align="center"><?=$item['soh'];?></td>                                    
                                        </tr>                            
                                        <?php
                                        }
                                    }
                                    ?>                        
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Description</th>                                                                        
                                    <th>Quantity</th>
                                    </tr>
                                </tfoot>
                                </table>
                            </div>
                        </div> 
                    </div>
                </div>
                
            </div>          
        </div>