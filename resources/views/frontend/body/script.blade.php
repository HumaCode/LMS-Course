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
    function wishlist(page = 1) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/get-wishlist-course?page=' + page,

            success: function(response) {

                if (response.wishlist.length === 0) {
                    $('#wishlist').html(
                        '<div class="col-lg-12 responsive-column-half text-center">  <div class="alert alert-danger" role="alert"> No wishlist items found.</div></div>'
                    );
                    $('#paginate').html('');
                    return;
                }

                $('#wishQty').text(response.wishQty);

                var rows = "";
                $.each(response.wishlist,
                    function(key, value) {
                        rows += `
                        
                            <div class="col-lg-4 responsive-column-half">
                                <div class="card card-item">
                                    <div class="card-image">
                                        <a href="/course/details/${value.course.id}/${value.course.course_name_slug}" class="d-block">
                                            <img class="card-img-top" src="/${value.course.course_image}" alt="Card image cap">
                                        </a>
                                        
                                    </div><!-- end card-image -->
                                    <div class="card-body">
                                        <h6 class="ribbon ribbon-blue-bg fs-14 mb-3">${value.course.label}</h6>
                                        <h5 class="card-title"><a href="/course/details/${value.course.id}/${value.course.course_name_slug}">${value.course.course_name}</a>
                                        </h5>
                                    
                                        <div class="d-flex justify-content-between align-items-center">

                                            ${value.course.discount_price == null ? 
                                                `<p class="card-price text-black font-weight-bold">$${value.course.selling_price}</p>`
                                            : `<p class="card-price text-black font-weight-bold">$${value.course.discount_price} <span
                                                    class="before-price font-weight-medium">$${value.course.selling_price}</span></p>`
                                            }
                                    
                                            <div class="icon-element icon-element-sm shadow-sm cursor-pointer bg-danger" data-toggle="tooltip"
                                                data-placement="top" title="Remove from Wishlist" id="${value.id}" onclick="wishlistRemove(this.id)"><i class="la la-trash text-white"></i></div>
                                        
                                            </div>

                                    </div>
                                </div>
                            </div>
                       
                        `
                    });

                $('#wishlist').html(rows);



                // Tambahkan navigasi halaman
                var pagination = `
                    <nav aria-label="Page navigation example" class="pagination-box">
                        <ul class="pagination justify-content-center">
                `;
                for (var i = 1; i <= response.pagination.total_pages; i++) {
                    pagination += `
                    <li class="page-item ${i === response.pagination.current_page ? 'active' : ''}" aria-label="Previous">
                        <a class="page-link" href="#" onclick="wishlist(${i})">${i}</a>
                        <span class="sr-only">Previous</span>
                    </li>
                `;
                }
                pagination += `
                        </ul>
                    </nav>
                `;
                $('#paginate').html(pagination);

                // Tampilkan informasi jumlah hasil
                $('#paginate').append(
                    `<p class="fs-14 pt-2">Showing ${response.pagination.from}-${response.pagination.to} of ${response.pagination.total} results</p>`
                );
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                // Handle error
            }

        })
    }

    wishlist();


    // wishlish remove
    function wishlistRemove(id) {

        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/wishlist-remove/" + id,

            success: function(data) {
                wishlist();

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


{{-- add card --}}
<script>
    function addToCart(courseId, courseName, instructorId, slug) {

        $.ajax({
            type: "POST",
            dataType: 'json',
            data: {
                _token: '{{ csrf_token() }}',
                course_name: courseName,
                course_name_slug: slug,
                instructor: instructorId
            },
            url: "/cart/data/store/" + courseId,
            success: function(data) {

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
        });

    }
</script>


<script>
    function miniCart() {
        $.ajax({
            type: "GET",
            url: '/course/mini/cart/',
            dataType: 'json',

            success: function(response) {

                $('span[id="cartSubTotal"]').text(response.cartTotal);
                $('#cartQty').text(response.cartQty);

                var miniCart = "";

                $.each(response.carts, function(key, value) {
                    miniCart += `
                        <li class="media media-card">
                            <a href="/course/details/${value.id}/${value.options.slug}" class="media-img">
                                <img src="/${value.options.image}"
                                    alt="Cart image">
                            </a>
                            <div class="media-body">
                                <h5><a href="/course/details/${value.id}/${value.options.slug}">${value.name}</a></h5>
                                <span class="d-block fs-14">$${value.price}</span>
                            </div>
                        </li>
                    `
                });

                $('#miniCart').html(miniCart)
            }
        })
    }

    miniCart();
</script>
