        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>

        <!-- JQUERY JS -->
        <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>

        <!-- BOOTSTRAP JS -->
        <script src="{{asset('assets/plugins/bootstrap/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script>

        <!-- SIDE-MENU JS -->
        <script src="{{asset('assets/plugins/sidemenu/sidemenu.js')}}"></script>

        <!-- Perfect SCROLLBAR JS-->
{{--        <script src="{{asset('assets/plugins/p-scroll/perfect-scrollbar.js')}}"></script>--}}
{{--        <script src="{{asset('assets/plugins/p-scroll/pscroll.js')}}"></script>--}}

        <!-- STICKY JS -->
        <script src="{{asset('assets/js/sticky.js')}}"></script>

        @yield('scripts')

        <!-- COLOR THEME JS -->
        <script src="{{asset('assets/js/themeColors.js')}}"></script>

        <!-- CUSTOM JS -->
        <script src="{{asset('assets/js/custom.js')}}"></script>

        <script>
        function readURL(input) {
        if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        $('#imagePreview').css('background-image', 'url('+e.target.result +')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
        }
        }
        $(document).on('change', '#imageUpload', function () {
        readURL(this);
        })

        function ajaxFormModalSubmit(formElement) {
            var url = formElement.attr('action');
            var method = formElement.find('input[name="_method"]').val() || 'POST';
            var formData = new FormData(formElement[0]);
            var submitButton = formElement.find(':submit');
            var originalButtonText = submitButton.html();
            submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status === 'success'){
                        if (typeof table !== 'undefined') {
                            table.ajax.reload();
                        }
                        $.growl.notice({ title: "Success", message: data.message });
                        formElement.closest('.modal').modal('hide');
                    }
                    submitButton.html(originalButtonText).prop('disabled', false);
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseJSON.message;
                    $.growl.error({ title: "Error", message: errorMessage });
                    submitButton.html(originalButtonText).prop('disabled', false);
                }
            });
        }
          $(document).on('submit', '.ajax-modal-form', function(e) {
            e.preventDefault();
            ajaxFormModalSubmit($(this));
        });
        </script>
