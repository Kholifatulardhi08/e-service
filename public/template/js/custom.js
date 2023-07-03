$(document).ready(function(){

    // tables class script
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#brands').DataTable();


    // display in layouting
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    // check admin current password
    $("#current_ password").keyup(function(){
        var current_password = $("#current_password").val();
        // alert(current_password);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/check_current_password',
            data:{current_password:current_password},
            success:function(resp){
                if(resp=="false"){
                    $("#check_password").html("<font color='red'> Current Password is Incorrect! </font>");
                }else if(resp=="true"){
                    $("#check_password").html("<font color='green'> Current Password is Correct! </font>");
                }
            }, error:function(){
                alert('Error');
            }
        });
    })

    $(document).on("click",".updateAdminStatus", function(){
        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");
        alert(admin_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'admin/update-admin-status',
            data:{'status':status,'admin_id':admin_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#admin-"+admin_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#admin-"+admin_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    $(document).on("click",".updateSectionStatus", function(){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section_id");
        alert(section_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'admin/update-section-status',
            data:{'status':status,'section_id':section_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#section-"+section_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#section-"+section_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    $(document).on("click",".updatebrandStatus", function(){
        var status = $(this).children("i").attr("status");
        var brand_id = $(this).attr("brand_id");
        alert(brand_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'admin/update-brand-status',
            data:{'status':status,'brand_id':brand_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#brand-"+brand_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#section-"+brand_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    $(".confirmDelete").click(function(){
        var module = $(this).attr('module');
        var moduleid = $(this).attr('moduleid');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
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
              )
              window.location = "/admin/delete-"+module+"/"+moduleid;
            }
        })
    });

    $(document).on("click",".updatecategoriesStatus", function(){
        var status = $(this).children("i").attr("status");
        var categories_id = $(this).attr("categories_id");
        alert(status);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'admin/update-category-status',
            data:{'status':status,'categories_id':categories_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#category-"+categories_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#category-"+categories_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    // Append Category in blade
    $('#section_id').change(function(){
        var section_id = $(this).val();
        alert(section_id);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'get',
            url:'admin/append-category-level',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoryLevel").html(resp);
            },error:function(){
                alert("Error");
            }
        })
    });

    $(document).on("click",".updateproductStatus", function(){
        var status = $(this).children("i").attr("status");
        var product_id = $(this).attr("product_id");
        alert(status);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'admin/update-product-status',
            data:{'status':status,'product_id':product_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#product-"+product_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#product-"+product_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

});