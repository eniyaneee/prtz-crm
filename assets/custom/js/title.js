$(document).ready(function () {
    var mode, JSON, res_DATA, access_id;

  
    getTitle();
  
    $.when(getTitle()).done(function () {
      dispTitle(JSON);
    });
  
    function refreshDetails() {
      $.when(getTitle()).done(function (brandDetails) {
        var table = $("#datatable").DataTable();
        table.clear();
        table.rows.add(brandDetails);
        table.draw();
        window.location.reload();
      });
    }
  
    $("#addData").click(function () {
      mode = "new";
      $("#model-data").val("");
      $("#model-data").modal("show");
    });
  
  
  
    // *************************** [get Data] *************************************************************************
    function getTitle() {
      $.ajax({
        type: "POST",
        url: base_Url + "navbartitle",
        dataType: "json",
        success: function (data) {
          res_DATA = data;
  
          dispTitle(res_DATA);
        },
        error: function () {
          console.log("Error");
        },
      });
    }
    // *************************** [Display Data] *************************************************************************
  
    function dispTitle(JSON) {
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
            mDataProp: "navbar_title",
          },
  
          {
            mDataProp: function (data, type, full, meta) {
                return `
                  <a id="${meta.row}" class="btn btnEdit text-info fs-14 lh-1" idd="${data.navbar_title_id}">
                    <i class="ri-edit-line"></i>
                  </a>`;
              }
              
          },
        ],
      });
    }
  
    // *************************** [Edit Data] *************************************************************************
  
    $(document).on("click", ".btnEdit", function () {
      $("#model-data").modal("show");
      mode = "edit";
  
      var id = $(this).attr("idd");

      $.ajax({
        type: "POST",
        url: base_Url + "navbartitleedit",
        data: {
            id: id
        },
        cache: false,
        success:function(data){  
            JSON = $.parseJSON(data);    
            if(JSON.status=='Success')
			{
                location.reload();
			} else {
                location.reload();
            }	
        },      
        error: function() {
            console.log("Error"); 
            $("#loadder").hide(); 
        }
    });
  
  
    });
  
  });
  