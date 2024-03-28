<script src="{{asset('dash/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('dash/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('dash/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	
	<!-- Chart piety plugin files -->
    <script src="{{asset('dash/vendor/peity/jquery.peity.min.js')}}"></script>
	
	<!-- Apex Chart -->
	<script src="{{asset('dash/vendor/apexchart/apexchart.js')}}"></script>
	
	<!-- Dashboard 1 -->
	<script src="{{asset('dash/js/dashboard/dashboard-1.js')}}"></script>
	
	<script src="{{asset('dash/vendor/owl-carousel/owl.carousel.js')}}"></script>
    <script src="{{asset('dash/js/custom.min.js')}}"></script>
	<script src="{{asset('dash/js/deznav-init.js')}}"></script>
    <script src="{{asset('dash/js/search.js')}}"></script>
    <script src="{{asset('dash/js/demo.js')}}"></script>
    <script src="{{asset('dash/js/styleSwitcher.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
    function redirectToAdmin() {
        // Ganti URL dengan URL halaman admin yang diinginkan
        window.location.href = "/admin";
    }
	</script>
    <script>
    function redirectToGuruu() {
        // Ganti URL dengan URL halaman admin yang diinginkan
        window.location.href = "/guruu";
    }
	</script>
    <script>
    function redirectToSiswa() {
        // Ganti URL dengan URL halaman admin yang diinginkan
        window.location.href = "/siswaa";
    }
	</script>
	
{{-- <script>
    $(document).ready(function() {
        // Submit form on input change
        $('#searchInput').on('input', function() {
            $('#searchForm').submit();
        });

        $('.delete-btn').click(function() {
            // Your existing delete button click event handler
        });
    });
</script> --}}
