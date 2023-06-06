<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Admin</title>

                    <form action="{{url('admin/createAdmin')}}" hidden id="myFormy" method="POST" enctype="multipart/form-data">
                        @csrf


                        <input type="text" hidden value="{{$admin->id}}" name="info">
                        @php
                        // Set a session variable
                        Session::flash('failAdded', 'Your input data in not complete');
                        @endphp
                        <button type="submit" class="btn btn-primary">Back to Edit</button>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



                <!-- Bootstrap core JavaScript-->
                <script>
                    const form = document.querySelector('#myFormy');

                    form.submit();

                    $(document).ready(function() {
        $('#myformy').submit(function(event) {
            // Prevent the form from submitting normally
            event.preventDefault();

            // Get the form data
            const formData = $(this).serialize();

            // Send an AJAX request to the server
            $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            success: function(response) {
                // Handle the server's response here
                console.log(response);

                // Optional: hide the form after it's submitted
                $('#myformy').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors here
                console.log(textStatus, errorThrown);
            }
            });
        });
        });
            </script>
</body>

</html>
