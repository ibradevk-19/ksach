<div class="button-items">
    <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light btn-sm"
        id="delete-item-{{ $id }}">
        <i class="ri-eye-lin align-middle me-2"></i>
        Approval
    </a>
</div>
<script type="text/javascript">
    $(document).ready(() => {
        $("#delete-item-{{ $id }}").click(function () {
            Swal.fire({
                title: 'هل تريد اعتماد الفائز',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'نعم قم باعتماد',
                cancelButtonText: 'لا, إلغاء الامر!',
                reverseButtons: true,

                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    // Make a request for a user with a given ID
                     axios.delete(`{{ route('levels.winners-approval',['level_id'=>$id]) }}`)
                    .then(function (response) {
                        Swal.fire({
                        icon: "success",
                        title: "تمت العملية بنجاح!",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'
                        // html: JSON.stringify(result),
                    })

                    }).catch(function (error) {

                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                $("#datatable").DataTable().ajax.reload()
                if (!result.isConfirmed) {
                    // table.ajax.reload();
                    Swal.fire({
                        icon: "error",
                        title: "لم تتم عملية الاعتماد",
                        confirmButtonColor: "#5664d2",
                        confirmButtonText: 'حسناً'

                        // html: JSON.stringify(result),
                    })
                }
            })
        })
    })
</script>

