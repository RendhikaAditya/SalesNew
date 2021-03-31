  <!-- BEGIN: Vendor JS-->
  <script src="/assets/vendors/js/vendors.min.js"></script>
  <!-- BEGIN Vendor JS-->

  <!-- BEGIN: Page Vendor JS-->
  {{-- <script src="/assets/vendors/js/charts/apexcharts.min.js"></script>
  <script src="/assets/vendors/js/extensions/tether.min.js"></script>
  <script src="/assets/vendors/js/extensions/shepherd.min.js"></script> --}}
  <!-- END: Page Vendor JS-->

  {{-- Data Table --}}
  @stack('table-vendor')
  {{-- Data Table --}}

  <!-- BEGIN: Theme JS-->
  <script src="/assets/js/core/app-menu.js"></script>
  <script src="/assets/js/core/app.js"></script>
  <script src="/assets/js/scripts/components.js"></script>
  <!-- END: Theme JS-->

  <!-- BEGIN: Page JS-->
  @stack('table-init-js')
  {{-- <script src="/assets/js/scripts/pages/dashboard-analytics.js"></script> --}}
  <!-- END: Page JS-->

  <script>
    function currency(el) {
        console.log("bisa");
        setTimeout(() => {
            let arrNum = el.value.split(",");
            let newNum = arrNum.length !== 0 ? arrNum.join("") : el.value;
            el.value = new Intl.NumberFormat().format(newNum);
        },150)
    }
  </script>

</body>
<!-- END: Body-->

</html>
