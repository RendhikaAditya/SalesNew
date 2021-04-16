  <!-- BEGIN: Vendor JS-->
  <script src="/assets/vendors/js/vendors.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
      $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
  </script>
  <script>
    let kategori = document.getElementById("kategori");
    let editor = document.getElementById("editor")

    addEventListener("DOMContentLoaded", (e) => {
        let nama_paket = kategori.value.split("-")[1];
        nama_paket === "paket" ? editor.style.display="initial" : editor.style.display="none"
    })

    kategori.addEventListener("change", e => {
        let nama_paket = e.target.value.split("-")[1];
        nama_paket === "paket" ? editor.style.display="initial" : editor.style.display="none"
     })

  </script>
  @stack('editor')
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

  <script>
      let page = window.location.pathname;
        if (page === "/laporan-transaksi") {
            setTimeout(() => {
                window.location.href="/admin"
            }, 3500);
        }
    </script>

</body>
<!-- END: Body-->

</html>
