$(document).ready(function () {
    var mode, JSON, res_DATA, prod_id;
     
  
    getproductDetails();
  
    $.when(getproductDetails()).done(function () {
      dispproductDetails(JSON);
    });
  
    function refreshDetails() {
      getproductDetails();
    }
  
    $("#addData").click(function () {
      $('#Sub-product')[0].reset();
      $('#product_img').html('')

      mode = "new";
  
      $("#model-data").val("");
      $("#model-data").modal("show");
    });
  
   
    // *************************** [Validation] ********************************************************************
  
    function validateError(data) {
      $.toast({
        icon: "error",
        heading: "Warning",
        text: data,
        position: "bottom-left",
        bgColor: "#red",
        loader: true,
        hideAfter: 2000,
        stack: false,
        showHideTransition: "fade",
      });
    }
  
    $("#btn-submit").click(function () {
     
      $(".error").hide();
      if ($("#navbar_title_id").val() == "" && mode == "new") {
        validateError("Please Select Product Menu");
      } else if ($("#navbar_page_id").val() == "" && mode == "new") {
        validateError("Please Select SubMenu");
      } else if ($("#product_name").val() == "" && mode == "new") {
        validateError("Please Enter Product Name");
      } else if ($("#brand").val() == "" && mode == "new") {
        validateError("Please Enter Brand*");
      } else if ($("#price").val() == "" && mode == "new") {
        validateError("Please Enter Price*");
      } else if ($("#offer_price").val() == "" && mode == "new") {
        validateError("Please Enter Offer Price*");
      } else if ($("#discount_percentage").val() == "" && mode == "new") {
        validateError("Please Enter Discount Percentage*");
      } else if ($("#arrival_status").val() == "" && mode == "new") {
        validateError("Please Select Arrival Status*");
      } else if ($("#stock_status").val() == "" && mode == "new") {
        validateError("Please Select Stock Status ");
      }
  
      // Product Details
      else if ($("#product_img").val() == "" && mode == "new") {
        validateError("Please Select Image*");
      } else if ($("#img_1").val() === "" && mode == "new") {
        validateError("Please Select  Image*");
      } else if ($("#img_2").val() === "" && mode == "new") {
        validateError("Please Select  Image*");
      } else if ($("#img_3").val() === "" && mode == "new") {
        validateError("Please Select  Image*");
      }else {
        insertData();
      } 

        // insertData();
    });
  
    //*************************** [Insert] **************************************************************************
  
    function insertData() {
      var form = $("#Sub-product")[0];
      data = new FormData(form);
  
      var url;
      if (mode == "new") {
        url = base_Url + "insert-product-list";
      } else if (mode == "edit") {
        url = base_Url + "update-product-list";
        data.append("prod_id", prod_id);
      }
  
      $.ajax({
        type: "POST",
        enctype: "multipart/form-data",
        url: url,
        data: data,
        processData: false,
        contentType: false,
        cache: false,
  
        success: function (data) {
          var resultData = $.parseJSON(data);
  
          if (resultData.code == 200) {
            Swal.fire({
              title: "Congratulations!",
              text: resultData["msg"],
              icon: "success",
            });
  
            $("#model-data").modal("hide");
            refreshDetails();
          } else {
            Swal.fire({
              title: "Failure",
              text: resultData["msg"],
              icon: "error",
            });
  
            $("#model-data").modal("hide");
            refreshDetails();
          }
        },
      });
    }
    // *************************** [Prevent modal form closing ] ****************************************************
    $("#model-data").modal({
      backdrop: "static",
      keyboard: false,
    });
  
    // *************************** [Display the image on Modal ] ****************************************************
  
    $(document).on("change", "#product_img", function () {
      dispImg(this, "product_image_url");
    });
  
    $(document).on("change", "#img_1", function () {
      dispImg(this, "img1_url");
    });
    $(document).on("change", "#img_2", function () {
      dispImg(this, "img2_url");
    });
    $(document).on("change", "#img_3", function () {
      dispImg(this, "img3_url");
    });
    $(document).on("change", "#img_4", function () {
      dispImg(this, "img4_url");
    });
  
    function dispImg(input, id) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#" + id).attr("src", e.target.result);
          $("#" + id).css("display", "block");
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    // *************************** [get Data] *************************************************************************
    function getproductDetails() {
      $.ajax({
        type: "POST",
        url: base_Url + "getproduct",
        dataType: "json",
        success: function (data) {
          res_DATA = data;
  
          dispproductDetails(res_DATA);
        },
        error: function () {
          console.log("Error");
        },
      });
    }
    // *************************** [Display Data] *************************************************************************
  
    function dispproductDetails(JSON) {
      var i = 1;
      $("#datatable").DataTable({
        destroy: true,
        aaSorting: [],
        aaData: JSON,
        aoColumns: [
          {
            mDataProp: null,
            render: function (data, type, row, meta) {
              return i++;
            },
          },
          {
            mDataProp: "menu",
          },
          {
            mDataProp: "submenu",
          },
          {
            mDataProp: "product_name",
          },
          {
            mDataProp: "offer_price",
          },
  
          {
            mDataProp: function (data, type, full, meta) {
              if (data.product_img !== null && data.product_img !== "") {
                return (
                  "<img src='" +
                  base_Url +
                  data.product_img +
                  "' alt='not-image' width='100'>"
                );
              } else {
                return "";
              }
            },
          },
  
          {
            mDataProp: function (data, type, full, meta) {
              return (
                
                '<a id="' +
                meta.row +
                '" class="btn btnEdit text-info fs-14 lh-1"> <i class="ri-edit-line"></i></a>' +
                '<a id="' +
                meta.row +
                '" class="btn BtnDelete text-danger fs-14 lh-1"> <i class="ri-delete-bin-5-line"></i></a>'
              );
            },
          },
        ],
      });
    }
  
    $(document).on("click", ".btnEdit", function () {
      
      var index = $(this).attr("id");
      let title_id  = res_DATA[index].navbar_title_id;

      $.ajax({
        type: "POST",
        url: base_Url + "getsubmenu",
        data: {
          id:title_id
        },
        dataType: "json",
        success: function (data) {
          $('#navbar_page_id').html('<option value="">Select</option>' + data);
          $("#navbar_page_id").val(res_DATA[index].navbar_page_id);
        },
        error: function () {
          console.log("Error");
        },
      });












      $("#model-data").modal("show");
      mode = "edit";
  
      $("#navbar_title_id").val(res_DATA[index].navbar_title_id);
      
      $("#access_id").val(res_DATA[index].access_id);
      $("#product_name").val(res_DATA[index].product_name);
      $("#brand").val(res_DATA[index].brand);
      $("#price").val(res_DATA[index].price);
      $("#offer_price").val(res_DATA[index].offer_price);
      $("#discount_percentage").val(res_DATA[index].discount_percentage);
      $("#arrival_status").val(res_DATA[index].arrival_status);
      $("#stock_status").val(res_DATA[index].stock_status);
      $("#product_image_url").attr("src", base_Url + res_DATA[index].product_img);
      $("#product_image_url").addClass("active");
      $("#product_image_url").css("display", "block");
      $("#img1_url").attr("src", base_Url + res_DATA[index].img_1);
      $("#img1_url").addClass("active");
      $("#img1_url").css("display", "block");
      $("#img2_url").attr("src", base_Url + res_DATA[index].img_2);
      $("#img2_url").addClass("active");
      $("#img2_url").css("display", "block");
      $("#img3_url").attr("src", base_Url + res_DATA[index].img_3);
      $("#img3_url").addClass("active");
      $("#img3_url").css("display", "block");
      $("#key_feature").val(res_DATA[index].key_feature);
      $("#details").val(res_DATA[index].details);
      $("#ingredient_details").val(res_DATA[index].ingredient_details);

    
      prod_id = res_DATA[index].product_id;
    });
  
    // *************************** [Delete Data] *************************************************************************
    $(document).on("click", ".BtnDelete", function () {
      mode = "delete";
      var index = $(this).attr("id");
      prod_id = res_DATA[index].product_id;
  
      Swal.fire({
        title: "Are you sure?",
        text: "You want to delete it?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: base_Url + "deleteproduct",
            data: { prod_id: prod_id },
  
            success: function (data) {
              var resData = $.parseJSON(data);
  
              if (resData.code == 200) {
                Swal.fire({
                  title: "Congratulations!",
                  text: resData["message"],
                  icon: "success",
                });
  
                $("#model-data").modal("hide");
                refreshDetails();
              } else {
                Swal.fire({
                  title: "Failure",
                  text: resData["message"],
                  icon: "error",
                });
  
                $("#model-data").modal("hide");
                refreshDetails();
              }
            },
          });
        }
      });
    });
  });
  

  $(document).on('change','#navbar_title_id',function(){

    let id = $(this).val();

    $.ajax({
      type: "POST",
      url: base_Url + "getsubmenu",
      data: {
        id: id
      },
      dataType: "json",
      success: function (data) {
        $('#navbar_page_id').html('<option value="">Select</option>' + data);
      },
      error: function () {
        console.log("Error");
      },
    });
  })