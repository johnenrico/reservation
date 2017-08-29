Number.prototype.formatMoney = function(c, d, t){
  var n = this, 
  c = isNaN(c = Math.abs(c)) ? 2 : c, 
  d = d == undefined ? "." : d, 
  t = t == undefined ? "," : t, 
  s = n < 0 ? "-" : "", 
  i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
  j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$(".btn_print").click(function () {
  $("#print_area").printThis({
    debug: true,
    canvas: true   
  });
});

$(document).ready(function(){
$(".selectize").select2();

$('.daterange-btn').daterangepicker(
{
 maxDate: moment().format("MM/DD/YYYY"),
 ranges: {
  'Today': [moment(), moment()],
  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
  'This Month': [moment().startOf('month'), moment().endOf('month')],
  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
},
startDate: moment(),
endDate: moment()
}
);
$('.daterange-btn').on('apply.daterangepicker', function(ev, picker){
  $(this).attr('data-value', picker.startDate.format('YYYY-MM-DD') + '>' + picker.endDate.format('YYYY-MM-DD'));
  $(this).find('span').html(picker.startDate.format('MMMM D, YYYY') + '-' + picker.endDate.format('MMMM D, YYYY'));

})
    //Date picker
$('.datepicker').datepicker({
      autoclose: true,
      format: 'MM dd, yyyy' ,
      // endDate: new Date(),
});

$('.timepicker').timepicker({
    'minTime': '06:00',
    'maxTime': '24:00',
    'step' : 60,
    'timeFormat': 'h:i a'
});

$('[data-tt="tooltip"]').tooltip(); 


})

base_url = $('body').data('url');

  // FOR ATTACHMENTS
  Dropzone.autoDiscover = false;
  var fileList = new Array;
  var i =0;
  if($(".dropzone").length > 0){
   var filetype = allowed_filetype();
   
 }
 $(".dropzone").dropzone({
  addRemoveLinks: true,
  acceptedFiles: filetype,
  url: base_url+'/evaluation/evaluation/upload_file',
  init: function () {
    var r = $.parseJSON(retrieve_file());
    var arr = $.map(r, function(el) { return el });
    if(arr != null && arr.length > 0){
      for (var i = 0; i < arr.length ; i++) {
        var mockFile = { name: arr[i].name, size: arr[i].size };
        this.options.addedfile.call(this, mockFile);
        if(arr[i].name.match(/.(jpg|jpeg|png|gif)$/i)){
         this.options.thumbnail.call(this, mockFile,$('body').data('url')+'assets/attachments/'+$('input[name="id"]').val()+'/'+arr[i].name);
       }

       mockFile.previewElement.classList.add('dz-success');
       mockFile.previewElement.classList.add('dz-complete');
     }
   }

   $(this.element).addClass("dropzone");
   this.on("success", function(file, serverFileName) {
    fileList[i] = {"serverFileName" : serverFileName, "fileName" : file.name,"fileId" : i };
    i++;
  });
   this.on("removedfile", function(file) {
    $.ajax({
      url: base_url+'evaluation/delete_file',
      type: "POST",
      data: { "filename" : file.name, 'id' : $('input[name="id"]').val() }
    });
  });
 }
});

 $(document).on('submit','.flexi_form', function(e)
 {
  $form = $(this);

  var target = $(this).data('target');
  var modal = $(this).data('modal');
  var datatable = $(this).data('datatable');
  var reload = $(this).data('reload');
  var clear = $(this).data('clear');
  var data = $(this).serialize();
  var callback = $(this).data('callback');
  var params = $(this).data('params');

  if($form.find('.flexi_form').find('.summernote').length > 0)
  {
    data = data + '&text='+ $form.find('.summernote').summernote('code');
  }

  e.preventDefault();
  $.ajax({
   type: 'POST'
   ,dataType: 'json'
   ,data: data
   ,url: $(this).data('url')
   ,success : function(r)
   {
    if(r.status == 'success')
    {
      if(r.redirect != '')
      {
       setTimeout(function(){
        window.location.href = r.redirect;
      }, 2500);

     }
     if(modal != '')
     {
      setTimeout(function(){
        $(modal).modal('hide');
      }, 1000);
    }
    if(datatable != '')
    {
      $(datatable).DataTable().draw();
    }
    if(clear != 'n' || clear == '')
    {
      $form.find('textarea, select, input:not([type="submit"]):not([type="checkbox"]):not([type="hidden"])').val('');
      if($form.find('.summernote').length > 0)
      {
       $form.find('.summernote').summernote('code', '');
     }

   }

   if(typeof callback !== typeof undefined && callback !== false)
   {  

    if(typeof params !== typeof undefined && params !== false)
    { 
     window[callback](params);
    }
    else
    {
     window[callback]();
    }
  }
  toast_update(r.message, 1500);


  if(reload != '' && reload == 'y')
  {
   setTimeout(function(){
    location.reload()
  }, 2500); 
 }
}
else
{

  if(typeof r.message === 'object')
  {
    $.each(r.message, function(k, v){
     $label = $form.find('[name="'+k+'"]').parent().find('.help-block');
     var text = v;
  


   if($label.length > 0)
   {
    $label.html(text).removeClass('hide');
  }
  else
  {
    $form.find('[name="'+k+'"]').parent().append('<span class="help-block">'+text+'</span>');
  }
  $form.find('[name="'+k+'"]').closest('.form-group').addClass('has-error');

});
  }
  else
  {
    toast_update_error(r.message, 1500);  
  }
}
preloader(target,'hide');     
}
,beforeSend: function()
{
  preloader(target,'show');
}
});
});



 function init_datatable(selector = '', url, filters = '', columns, order = '', search = false, form)
 {

  $(selector).DataTable({
    processing: true,
    serverSide: true,
    searching: search,
    lengthChange: false,
    order: order,
    ajax: {
      url: $('body').data('url')+url,
      method: 'POST',
      data: filters
    },
    columns: columns
  });

  $(form).on('submit', function(e) {
   e.preventDefault();
   $(selector).DataTable().draw();
 });
}




function preloader(target = '', action = 'show')
{
  if(target != '')
  {
    if(action == 'show')
    {
     $(target).LoadingOverlay("show", 
     {
       image   : base_url+'/assets/overlay_loading/Bars.gif',
       maxSize  : "70px",
       minSize   : "70px",
       zIndex: 999999999,
     });
   }
   else
   {
    setTimeout(function(){
     $(target).LoadingOverlay("hide");
   }, 1500);
  }

}
else
{
 if(action == 'show')
 {
  $.LoadingOverlay("show", 
  {
    image   : base_url+'/assets/overlay_loading/Bars.gif',
    maxSize  : "70px",
    minSize   : "70px",
    zIndex: 999999999,
  });  
}
else
{
 $.LoadingOverlay("hide");
}
}
}

function toast_update(msg = '', delay = 0)
{
  if(msg == '')
  {
    msg = 'Data has been update';
  }
  setTimeout(function(){
    toast('success', 'Update Success', msg)
  }, delay);

}

function toast_update_error(msg = '', delay = 0)
{
  if(msg == '')
  {
    msg = 'No Data has been update';
  }
  setTimeout(function(){
    toast('error', 'Update Error', msg)
  }, delay);

}

function toast(type = 'success', title = '', message = '')
{
  toastr.options = {
   progressBar: true,
   closeButton: true,
   preventDuplicates : true,
 };

 if(type == 'success')
 {
  toastr.success(message, title);
}
else if(type == 'error')
{
  toastr.error(message, title);
}
else if(type == 'info')
{
 toastr.info(message, title);  
}
else if(type == 'warning')
{
 toastr.warning(message, title);  
}

}

$(document).on('change', '.has-error select, .has-error input, .has-error textarea', function(){
  $(this).closest('.form-group').removeClass('has-error');
  $(this).parent().find('span.help-block').addClass('hide');
})

$(document).on('click', '.show_pass', function()
{

 var val = $(this).find('i').attr('data-value');
 $(this).find('i').text(val);
})


function ajax_wrap(url = '', data, loader = ''){

  var address = $('body').data('url')+'/'+url;
  var jqxhr = 
  $.ajax({
    type: 'post'
    ,data: data
    ,dataType: 'json'
    ,url: address
    ,async:false
    ,success: function(r){
      if(loader != '')
      {
       preloader(loader,'hide');   
     }
      return r;

   }
   ,beforeSend:function()
   {
    if(loader != '')
    {
     preloader(loader,'show');   
   }
 }
}).responseText

  return jqxhr;
}


// THIS SECTION IS FOR MESSAGE APPEND
function general_message(type = '', val =''){
  var message = '';
  if(type == 'error'){
    message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'success'){
    message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'info'){
    message = '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  else if(type == 'warning'){
    message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+val+'</div>';
  }
  return message;

}


$(document).on('click',"[data-href]", function(){
  window.open($(this).data('href'),'_blank');
});

 // DATA HREF

 function retrieve_file(){
  var jqxhr = $.ajax({
    type: 'POST',       
    url: base_url+'/evaluation/evaluation/retrieve_file',
    data: {id:$('input[name="id"]').val()},
    dataType: 'json',
    global: false,
    async:false,
    success: function(data) {
      return data;
    }
  }).responseText;
  return jqxhr;
}


// ADDING READMORE ON TEXT WRAP
function read_more(){
     var showChar = 50;  // How many characters are shown by default
     var ellipsestext = "...";
     var moretext = "Show more >";
     var lesstext = "Show less";

     $('.more').each(function() {
      var content = $(this).html();

      if(content.length > showChar) {

        var c = content.substr(0, showChar);
        var h = content.substr(showChar, content.length - showChar);

        var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

        $(this).html(html);
      }

    });

     $(".morelink").click(function(){
      if($(this).hasClass("less")) {
        $(this).removeClass("less");
        $(this).html(moretext);
      } else {
        $(this).addClass("less");
        $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
    });
   }
