</div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?=base_url();?>design/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?=base_url();?>design/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?=base_url();?>design/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?=base_url();?>design/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="<?=base_url();?>design/assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="<?=base_url();?>design/dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?=base_url();?>design/dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="<?=base_url();?>design/dist/js/custom.min.js"></script>
    <!-- this page js -->
    <script src="<?=base_url();?>design/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url();?>design/assets/libs/magnific-popup/meg.init.js"></script>

    
    <script src="<?=base_url();?>design/dist/js/jquery.ui.touch-punch-improved.js"></script>
    <script src="<?=base_url();?>design/dist/js/jquery-ui.min.js"></script>        
    <!-- this page js -->
    
    <script src="<?=base_url();?>design/assets/libs/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="<?=base_url();?>design/dist/js/pages/calendar/cal-init.js"></script>

    <!-- this page js -->
    <script src="<?=base_url();?>design/assets/extra-libs/multicheck/datatable-checkbox-init.js"></script>
    <script src="<?=base_url();?>design/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
    <script src="<?=base_url();?>design/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script>       
        $('#zero_config').DataTable();
    </script>
    <script>
        $('.addProduct').click(function(){
            document.getElementById('product_id').value = '';
            document.getElementById('product_description').value = '';
            document.getElementById('product_category').value = '';
            document.getElementById('product_unitcost').value = '';
            document.getElementById('product_sellingprice').value = '';
            document.getElementById('product_status').value = '';
        });
        $('.editProduct').click(function(){
            var data=$(this).data('id');
            var id=data.split('_');
            document.getElementById('product_id').value = id[0];
            document.getElementById('product_description').value = id[1];
            document.getElementById('product_category').value = id[2];
            document.getElementById('product_unitcost').value = id[3];
            document.getElementById('product_sellingprice').value = id[4];
            document.getElementById('product_status').value = id[5];
        });
        $('.addQuantity').click(function(){
            var id=$(this).data('id');
            document.getElementById('quantity_id').value = id;
        });
        $('.addProductImage').click(function(){
            var id=$(this).data('id');
            document.getElementById('image_id').value = id;            
        });
    </script>
</body>

</html>