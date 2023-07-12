$(document).ready(function(){

    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");

    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#brands').DataTable();
    $('#products').DataTable();
    $('#banners').DataTable();
    

    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div> <input type="text" name="paket[]" placeholder="Paket" style="width: 120px;"/>&nbsp;<input type="text" name="harga[]" placeholder="Harga" style="width: 120px;"/>&nbsp;<input type="text" name="keterangan[]" placeholder="Keterangan" style="width: 120px;"/>&nbsp;<a href="javascript:void(0);" class="remove_button">Hapus</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

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

    $(document).on("click",".updateattributeStatus", function(){
        var status = $(this).children("i").attr("status");
        var attribute_id = $(this).attr("attribute_id");
        alert(status);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:'/admin/update-attribute-status',
            data:{'status':status,'attribute_id':attribute_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#attribute-"+attribute_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#attribute-"+attribute_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    $(document).on("click",".updateimagesStatus", function(){
        var status = $(this).children("i").attr("status");
        var image_id = $(this).attr("image_id");
        alert(status);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/admin/update-images-status',
            data:{'status':status,'image_id':image_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#banner-"+image_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#banner-"+image_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

    $(document).on("click",".updatebannerstatus", function(){
        var status = $(this).children("i").attr("status");
        var banner_id = $(this).attr("banner_id");
        alert(status);
        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'POST',
            url:'/admin/update-banner-status',
            data:{'status':status,'banner_id':banner_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#image-"+banner_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-check' status='Inactive'></i>");
                    location.reload();
                }else if(resp['status']==1){
                    $("#image-"+banner_id).html("<i style='font-size:30px;' class='mdi mdi-bookmark-outline' status='Active'></i>");
                    location.reload();
                }
            }, error:function(){
                alert("Error");
            }
        })            
    });

});