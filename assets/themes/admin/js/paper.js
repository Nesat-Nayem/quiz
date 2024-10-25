(function ($) {
    "use strict";
  
    $(document).ready(function () {
      $("#table").DataTable();
  
      $("body").on("click", ".common_delete", function (e) {
        var link = $(this).attr("href");
        e.preventDefault(false);
        swal({
            title: "Are you sure?",
            text: "This will be permanently deleted!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
          },
          function (isConfirm) {
            if (isConfirm) {
              window.location.href = link;
            }
          }
        );
      });
    });
  })(jQuery);
  