jQuery(document).ready(function ($) {
  $('#cfa-form').on('submit', function (e) {
      e.preventDefault(); // Prevent the form from submitting normally

      // Get form data
      var formData = {
          firstName: $('#cfaFirstName').val(),
          lastName: $('#cfaLastName').val(),
          email: $('#cfaEmail').val(),
          nonce: cfa_ajax_object.nonce // Include the nonce for security
      };

      // Send AJAX request
      $.ajax({
          url: cfa_ajax_object.ajax_url,
          type: 'POST',
          data: {
              action: 'cfa_submit_form',
              ...formData
          },
          success: function (response) {
              if (response.success) {
                  $('#cfa-response').html(`<div class='success'>${response.data.message}</div>`);
              } else {
                  $('#cfa-response').html(`<div class='error'>${response.data.message}</div>`);
              }
              //clear inputs
              $('input', '#cfa-form').val('');
          },
          error: function () {
              $('#cfa-response').html(`<div class='error'>AJAX request failed. Please try again.</div>`);
          }
      });
  });
});

