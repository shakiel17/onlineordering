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
                <a href="<?=base_url();?>user_logout" class="btn btn-danger">Yes</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="AddtoCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <?=form_open(base_url()."add_to_cart");?>
            <input type="hidden" name="id" id="cart_id">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add to Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                            
                <div class="form-group row">
                    <label for="fname" class="col-sm-3 control-label col-form-label">Quantity</label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" name="quantity" value="1" required>
                    </div>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </div>            
        </div>
        <?=form_close();?>
    </div>
</div>