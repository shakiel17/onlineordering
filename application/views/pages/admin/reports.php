<div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
              <h4 class="page-title"><?=$title;?></h4>
              <div class="ml-auto text-right">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url();?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Reports
                    </li>
                  </ol>
                </nav>
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
            <div class="col-md-4">
              <div class="card">
                <?=form_open(base_url()."daily_sales",array("class" => "form-horizontal"));?>                
                  <div class="card-body">
                    <h4 class="card-title">Daily Sales</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Run Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="rundate"
                        />
                      </div>
                    </div>                   
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Generate
                      </button>
                    </div>
                  </div>
                <?=form_close();?>
              </div>              
            </div> 
            
            <div class="col-md-4">
              <div class="card">
                <?=form_open(base_url()."weekly_sales",array("class" => "form-horizontal"));?>                
                  <div class="card-body">
                    <h4 class="card-title">Weekly Sales</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Start Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="startdate"
                        />
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >End Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="enddate"
                        />
                      </div>
                    </div>                  
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Generate
                      </button>
                    </div>
                  </div>
                <?=form_close();?>
              </div>              
            </div>

            <div class="col-md-4">
              <div class="card">
                <?=form_open(base_url()."monthly_sales",array("class" => "form-horizontal"));?>                
                  <div class="card-body">
                    <h4 class="card-title">Monthly Sales</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Start Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="startdate"
                        />
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >End Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="enddate"
                        />
                      </div>
                    </div>                  
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Generate
                      </button>
                    </div>
                  </div>
                <?=form_close();?>
              </div>              
            </div>

            <div class="col-md-4">
              <div class="card">
                <?=form_open(base_url()."monthly_disposal",array("class" => "form-horizontal"));?>                
                  <div class="card-body">
                    <h4 class="card-title">Monthly Disposal</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Start Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="startdate"
                        />
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >End Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="enddate"
                        />
                      </div>
                    </div>                  
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Generate
                      </button>
                    </div>
                  </div>
                <?=form_close();?>
              </div>              
            </div>

            <div class="col-md-4">
              <div class="card">
                <?=form_open(base_url()."monthly_manufacture",array("class" => "form-horizontal"));?>                
                  <div class="card-body">
                    <h4 class="card-title">Monthly Manufacture Cost</h4>
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >Start Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="startdate"
                        />
                      </div>
                    </div> 
                    <div class="form-group row">
                      <label
                        for="fname"
                        class="col-sm-3 text-end control-label col-form-label"
                        >End Date</label
                      >
                      <div class="col-sm-9">
                        <input
                          type="date"
                          class="form-control"
                          id="fname"
                          placeholder="First Name Here"
                          name="enddate"
                        />
                      </div>
                    </div>                  
                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary">
                        Generate
                      </button>
                    </div>
                  </div>
                <?=form_close();?>
              </div>              
            </div>
          </div>
          <!-- editor -->
        
          <!-- ============================================================== -->
          <!-- End PAge Content -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Right sidebar -->
          <!-- ============================================================== -->
          <!-- .right-sidebar -->
          <!-- ============================================================== -->
          <!-- End Right sidebar -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->       
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>