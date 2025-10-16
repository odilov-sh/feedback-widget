<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback Widget</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
        }

        .widget-container {
            max-width: 100%;
            margin: auto;
        }
    </style>
</head>
<body>
<div class="widget-container">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="mb-3 text-center">Send us your feedback</h4>

            <div id="alert-success" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none">
                <div class="alert-body">
                    Feedback sent successfully!
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div id="alert-error" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none">
                <div class="alert-body">
                    Something went wrong
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <form id="feedbackForm" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-2">
                            <label class="form-label">Name</label>
                            <input name="name" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input name="phone" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input name="subject" class="form-control" required>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Message (optional)</label>
                    <textarea name="text" class="form-control" rows="4"></textarea>
                    <div class="invalid-feedback"></div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Attach files</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                    <div class="invalid-feedback"></div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Send Feedback</button>
            </form>
        </div>
    </div>
</div>

<script>
    function showErrorAlert(message = null) {
        hideSuccessAlert()

        let errorAlert = $("#alert-error");
        if (message) {
            errorAlert.find(".alert-body").html(message);
        }

        errorAlert.show()
    }

    function showSuccessAlert(message = null) {
        hideErrorAlert()

        let errorAlert = $("#alert-success");
        if (message) {
            errorAlert.find(".alert-body").html(message);
        }

        errorAlert.show()
    }

    function hideErrorAlert() {
        $('#alert-error').hide();
    }

    function hideSuccessAlert() {
        $('#alert-success').hide();
    }

    $(function () {
        $('#feedbackForm').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let formData = new FormData(this);
            form.find('.form-control').removeClass('is-invalid');
            form.find('.invalid-feedback').text('');

            $.ajax({
                url: "{{ route('tickets.store') }}",
                method: "POST",
                processData: false,
                contentType: false,
                data: formData,
                headers: {
                    'Accept': 'application/json',
                },
                success: function (response) {
                    form[0].reset();
                    showSuccessAlert(response.message);
                },
                error: function (xhr) {
                    showErrorAlert(xhr.responseJSON.message)

                    const errors = xhr.responseJSON.errors;

                    // Clear old error states
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').text('').hide();

                    // Handle file errors separately
                    let fileErrorShown = false;

                    for (const field in errors) {
                        if (field.startsWith('files.')) {
                            if (!fileErrorShown) {
                                const input = $('[name="files[]"]');
                                input.addClass('is-invalid');
                                input.next('.invalid-feedback')
                                    .text(errors[field][0]) // ✅ show only first error message
                                    .show();
                                fileErrorShown = true;
                            }
                        } else {
                            const input = $(`[name="${field}"]`);
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback')
                                .text(errors[field][0])
                                .show();
                        }
                    }
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
