<div class="button-items">

    <a href="{{ route('rooms.episodes.questions.edit', ['room'=>$room_id,'episode'=>$episode_id,'question'=>$id]) }}"
       class=" btn btn-primary waves-effect waves-light btn-sm">
        <i class=" ri-eye-line align-middle me-2"></i>
        عرض
    </a>


    <a href="javascript:void(0)" class=" btn btn-danger waves-effect waves-light btn-sm " id="delete-item-{{ $id }}">
        <i class=" ri-delete-bin-line align-middle me-2"></i>
        حذف
    </a>
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
                    return axios.delete(`{{ route('rooms.episodes.questions.destroy',['room'=>$room_id,'episode'=>$episode_id,'question'=>$id]) }}`)
                    .then(function (response) {
                        Swal.fire({
                        icon: "success",
                        title: "تمت العملية بنجاح!",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'
                        // html: JSON.stringify(result),
                    })

                    }).catch(function (error) {



                        Swal.fire({
                        icon: "error",
                        title: 'لا يمكن الحذف لأن الغرفة فعالة في الوقت الحالي',
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'
                        // html: JSON.stringify(result),
                    })
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                $("#datatable").DataTable().ajax.reload()
                if (!result.isConfirmed) {
                    // table.ajax.reload();
                    Swal.fire({
                        icon: "error",
                        title: "لم تتم عملية الحذف",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'

                        // html: JSON.stringify(result),
                    })
                }
            })
        })
    })
</script>
