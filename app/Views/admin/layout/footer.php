</div>
<footer class="bg-dark text-white text-center py-3 mt-auto" id="main-footer">
  &copy; <span id="currentYear"></span> ATTS Jewellary. All rights reserved.
</footer>
  <script>
    $(document).ready(function () {
      $('#toggleSidebar').click(function () {
        $('#sidebarMenu').toggleClass('collapsed show');
      });

      // Optional: Close sidebar when clicking outside on mobile
      /*$(document).click(function (e) {
        if (!$(e.target).closest('#sidebarMenu, #toggleSidebar').length) {
          if ($('#sidebarMenu').hasClass('show')) {
            $('#sidebarMenu').removeClass('show');
          }
        }
      });*/
	  
		if ($(window).width() < 992) {
		  $(document).one('click', function (e) {
			if (!$(e.target).closest('.sidebar, #toggleSidebar').length) {
			  $('.sidebar').removeClass('show');
			}
		  });
		}
		
		document.getElementById('currentYear').textContent = new Date().getFullYear();
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>