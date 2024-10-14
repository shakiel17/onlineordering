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
                      Invoice
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
        <?=form_open(base_url()."update_profile");?>
        <input type="hidden" name="username" value="<?=$item['username'];?>">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-body printableArea">
                <h3><b>User Profile</b> <span class="pull-right"></span></h3>
                <hr />
                <div class="row">
                  <div class="col-md-12">
                    <div class="pull-left">
                      <address>
                        <h3>
                          &nbsp;<b class="text-danger"><input type="text" name="fullname" value="<?=$item['fullname'];?>" style="border:0; border-bottom:1px solid black;"></b>
                        </h3>
                        <p class="text-muted ms-1">
                          Address: <b><textarea class="form-control" rows="3" name="address"> <?=$item['address'];?></textarea></b><br>
                          Contact No.: <b><input type="text" class="form-control" name="contactno" value="<?=$item['contactno'];?>"></b><br>
                          Member Since: <b><?=date('m/d/Y',strtotime($item['datearray']));?></b>
                        </p>
                      </address>
                    </div>
                    
                  </div>
                  <div class="col-md-12">
                    <div class="table-responsive mt-5" style="clear: both">
                        <table width="100%" border="0">
                            <tr>
                                <td width="15%">Username:</td>
                                <td><?=$item['username'];?></td>
                            </tr>
                            <tr>
                                <td width="15%">Password:</td>
                                <td><input type="password" name="password" class="form-control" value="<?=$item['password'];?>"></td>
                            </tr>
                        </table>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="pull-right mt-4 text-end">
                      
                      <hr />
                      <h3><input type="submit" class="btn btn-success" value="Update"></h3>
                    </div>
                    <div class="clearfix"></div>                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?=form_close();?>