<div class="button-items">
    <a href="{{ route('actors.edit', ['actor' => $id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        تعديل
    </a>
    <!-- <a href="javascript:void(0)" class=" btn btn-danger waves-effect waves-light btn-sm " id="delete-item-{{ $id }}">
        <i class=" ri-delete-bin-line align-middle me-2"></i>
        حذف
    </a> -->
</div>
<script type="text/javascript">
    $(document).ready(() => {
        $("#delete-item-{{ $id }}").click(function () {
            Swal.fire({
                title: 'هل تريد حذف العنصر',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'نعم قم بالحذف',
                cancelButtonText: 'لا, إلغاء الامر!',
                reverseButtons: true,

                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    // Make a request for a user with a given ID


                    return axios.delete(`{{route('actors.destroy',['actor'=>$id])}}`)
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
                        // html: JSON.stringify(result),
                    })
                }
            })
        })
    })

</script>