</div>
</div>
</div>

<!-- End Contain Section -->
<!-- Main Content End -->
<!-- Start Footer Section -->
<!--  End Site Right Setting Section -->        <!-- End Footer Section -->
<!-- Global Plugin JavaScript -->
<!-- Jquery -->
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<!-- Jquery UI -->
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<!-- CUSTOM JS -->
<script src="public/js/app.js"></script>
<!-- <script src="<?= Config::get('root/root'); ?>assets/js/global/jquery.min.js"></script> -->
<script class="nor-js" src="<?= Config::get('root/root'); ?>assets/js/global/bootstrap.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/plugin/bootstrap-tour/js/bootstrap-tour.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/global/waves.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/switchery/jQuery.switchery.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/full-screen-page/screenfull.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/home-page/jquery-slidePanel.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/home-page/sidebar.min.js"></script>
<!-- Page Plugin JavaScript -->
<script src="<?= Config::get('root/root'); ?>assets/js/peity-charts/jquery.peity2.min.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/echarts/echarts-all.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/c3-chart/d3.min.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/c3-chart/c3.min.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/float-chart/flot.jquery.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/float-chart/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/weather/skycons.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/plugin/magnific-popup/js/jquery.magnific-popup.min.js"></script>
<!-- Global Template JavaScript -->
<script src="<?= Config::get('root/root'); ?>assets/js/global/site.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/sitesettings/site-settings.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/custom/custom-side-menu.js"></script>
<!-- Page JavaScript -->
<script src="<?= Config::get('root/root'); ?>assets/js/media/media.min.js"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/calendar/calendar-custom.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/dashboard/dashboard_v3.js" type="text/javascript"></script>
<script src="<?= Config::get('root/root'); ?>assets/js/global/site_menu_left.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/b-1.2.4/r-2.1.0/rr-1.2.0/datatables.min.js"></script><script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#jobs').DataTable({
        	responsive: true,
            "initComplete": function (settings, json) {
                $('.loading').hide(300);
                $('#jobs').show(400);
            },
        	"order": [[ 0, 'desc' ]],
            // rowReorder: true
        });

        $('.dataTable').DataTable({
            responsive: true,
            paging: false,
            "initComplete": function (settings, json) {
                $('.loading').hide(300);
                $('#jobs').show(400);
            },
            "order": [[ 0, 'asc' ]],
            // rowReorder: true
        });

        tinymce.init({
            selector:'textarea',
            selector: "textarea:not(.noMce)"
        });
    });
</script>
</body>
</html>