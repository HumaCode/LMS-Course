$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        ).then(() => {
                          // Ketika tombol OK di Swal.fire ditekan, halaman akan di-reload
                          window.location.href = link;
                      });
                  }
                  }) 
    });
  });


//////////////////////// confirn
  $(function(){
    $(document).on('click','#confirm',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Confirm This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, confirm it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      Swal.fire(
                        'Confirmed Success!',
                        'Your file has been Confirm.',
                        'success'
                        ).then(() => {
                          // Ketika tombol OK di Swal.fire ditekan, halaman akan di-reload
                          window.location.href = link;
                      });
                  }
                  }) 
    });
  });