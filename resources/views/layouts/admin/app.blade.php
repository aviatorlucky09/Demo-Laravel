<!DOCTYPE html>
<html lang="en">
<!--<![endif]-->
@include('layouts.admin.header')
<body>
    <!-- begin #page-loader -->
    <div id="page-loader" class="fade show"><span class="spinner"></span></div>
    <!-- end #page-loader -->
    
    <!-- begin #page-container -->
    <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
        <!-- begin #header -->
        @include('layouts.admin.top_nav')
        <!-- end #header -->
        <!-- begin #sidebar -->
        
        @include('layouts.admin.sidebar')
       
        <!-- end #sidebar -->
        <!-- begin #content -->
        <div id="content" class="content">

        </div>
        <!-- end #content -->
        
        <!-- begin scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
        <!-- end scroll to top btn -->
    </div>
    
<!-- modals -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- end modal -->
    <!-- end page container -->
    
    <!-- ================== BEGIN BASE JS ================== -->
    @include('layouts.admin.footer')
     
    <!-- ================== END BASE JS ================== --> 
    <script>
        $(document).ready(function() {
            App.init({
                ajaxMode: true,
                ajaxDefaultUrl: '#nwh-master/dashboard',
                ajaxType: 'GET',
                ajaxDataType: 'html'
            });
        });
    </script>
      <style type="text/css">
     .tabs .active{
        background: #fff;
        font-weight: bold;
    }
    </style>
</body>
</html>
 
