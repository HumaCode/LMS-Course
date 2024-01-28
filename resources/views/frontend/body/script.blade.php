<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    })

    // wishlist
    function addToWishList(course_id) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "/add-to-wishlist/" + course_id,


            success: function(data) {
                // console.log(data);

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 6000
                })
                if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                    })

                } else {

                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                    })
                }
            }
        })
    }
</script>


<script>
    function wishlist() {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/get-wishlist-course/',

            success: function(response) {

            }
        })
    }
</script>
