$(document).ready(function () {
     $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
 
     $(document).on('submit','.ajax-form', function(e){
          e.preventDefault()
          $(".loading").show()
     
          let $this = $(this);
          let formData = new FormData(this);
     
          $this.find(".has-danger").removeClass('has-error');
          $this.find(".form-errors").remove();
 
          $.ajax({
               type: $this.attr('method'),
               url: $this.attr('action'),
               data: formData,
               contentType: false,
               processData: false,
               cache: false,
               success: function (response) {
                    $(".loading").hide()
     
                    if (response.success) {
                         swal("", `${response.success}`, "success");
                    }
                    if (response.warning) {
                         swal("", `${response.warning}`, "warning");
                    }
                    if (response.error) {
                         swal("", `${response.error}`, "error");
                    }
                    if (response.redirect_with_message) {
                         swal("",`${response.redirect_with_message}`,`${response.status}`)
                         return window.location.href = response.redirect_url
                    }

                    if (response.location_reload) {
                         swal("",`${response.location_reload}`,`${response.status}`)
                         return location.reload()
                    }
     
                    console.clear()
               },
               error: function (response) {
                    $(".loading").hide()
     
                    let data = JSON.parse(response.responseText);
                    $.each(data.errors, (key, value) => {
                         swal("", `${value}`, "warning");
                         $("[name^=" + key + "]").parent().addClass('has-error')
                         $("[name^=" + key + "]").parent().append('<small class="danger text-muted form-errors">' + value[0] + '</small>');
                    })
     
                    console.clear()
               }
          })
     })
 
 
})