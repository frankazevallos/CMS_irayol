$("#show_enable_custom_link").hide();

$("#enable_custom_link").click(function() {
      if($(this).is(":checked")) {
          $("#show_enable_custom_link").show();
      } else {
          $("#show_enable_custom_link").hide();
      }
  });