$(document).on('click', '.btn-destroy', function (e) {
    let id = $(this).attr('data-id');

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: `${HOST_URL}/admin/payment-methods/${id}`,
                type: 'DELETE',
                dataType: "JSON",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    Swal.fire("Deleted!", "Your payment method has been deleted.", "success");
                    window.location.href = `${HOST_URL}/admin/payment-methods`;
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
});
