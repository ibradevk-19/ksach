<script src="{{asset('assets/libs/sweetalert2/sweetalert2.all.min.js')}}"></script>
<script src="{{asset('assets/libs/axios/dist/axios.min.js')}}"></script>
<script>
    function DeleteItem(id) {
        console.log('asdasd');
        Swal.fire({
                title: 'هل تريد حذف العنصر',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'نعم قم بالحذف',
                cancelButtonText: 'لا, إلغاء الامر!',
                reverseButtons: true,

                showLoaderOnConfirm: true,
                preConfirm: () => {
                    // Make a request for a user with a given ID
                      return axios.delete('{{$route_delete}}/'+id)
                    // .then(function (response) {
                    // handle success
                    // console.log(response);
                    // })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                $("#datatable").DataTable().ajax.reload()
                if (result.isConfirmed) {
                    // table.ajax.reload();
                    Swal.fire({
                        icon: "success",
                        title: "تمت العملية بنجاح!",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'
                        // html: JSON.stringify(result),
                    })
                }else {
                    Swal.fire({
                        icon: "error",
                        title: "لم يتم الحذف!",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'
                        // html: JSON.stringify(result),
                    })
                }
            })
}

</script>
