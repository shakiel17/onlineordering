<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Is it goodbye?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you wish to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                <a href="<?=base_url();?>admin_logout" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ManageProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open(base_url()."save_product");?>
            <input type="hidden" name="id" id="product_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Manage Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_description" name="description" placeholder="Product Description">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_category" name="category" placeholder="Product Category">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Unit Cost</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_unitcost" name="unitcost" placeholder="0.00">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">SRP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_sellingprice" name="sellingprice" placeholder="Selling Price">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" id="product_status">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Max Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_max_level" name="max_level" placeholder="Max Level">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Min Level</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="product_min_level" name="min_level" placeholder="Min Level">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>            
        </div>
        <?=form_close();?>
    </div>
</div>

<div class="modal fade" id="AddQty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open(base_url()."add_quantity");?>
            <input type="hidden" name="id" id="quantity_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Quantity</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Quantity</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="quantity" placeholder="Enter Quantity">
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>            
        </div>
        <?=form_close();?>
    </div>
</div>

<div class="modal fade" id="manageProductImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?=form_open_multipart(base_url()."save_product_image");?>
            <input type="hidden" name="id" id="image_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                            
                <div class="form-group row">
                    <label for="fname" class="col-sm-2 control-label col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="file" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>            
        </div>
        <?=form_close();?>
    </div>
</div>