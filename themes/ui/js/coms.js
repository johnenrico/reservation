$(document).ready(function(){
  var my_eval = $('#my_evaluation');

  if(my_eval.length > 0){
    var append = '<table id="my_evaluation_table" class="table table-bordered table-striped" cellspacing="0" width="100%"> <thead> <tr> <th>Title</th> <th>Created</th> </tr></thead> <tbody> </tbody> </table>';
    $('#my_evaluation').append(append);

    table = $('#my_evaluation_table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": base_url+'/users/retrieve_my_evaluation',
          "type": "POST",
        },
        "columns": [
        { data: 'title', name: 'title', orderable: false, sortable: false },
        { data: 'created_at', name:'created_at', orderable: false, sortable: false },
        ],

      });
  }
  if($('#topic_charts').length > 0){
   $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,url: base_url+'home/get_evaluation_by_category'
    ,success:function(r){
     var labels = [], datas= [];

     $.each(r, function(s, i){
      labels.push(i.category);
      datas.push(i.numbers);
    })
     console.log(datas);

     var ctx = $("#topic_charts");
     var data = {
      labels: labels,
      datasets: [
      {
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        borderWidth: 1,
        data: datas,
      }
      ]
    };

    var myChart = new Chart(ctx, {
      type: 'pie',
      data: data,

  });

  }
});

 }
 if($('#users_charts').length > 0){



   $.ajax({
    type: 'post'
    ,dataType: 'json'
    ,url: base_url+'home/get_evaluation_by_users'
    ,success:function(r){
     var labels = [], datas= [];

     $.each(r, function(s, i){
      labels.push(i.category);
      datas.push(i.numbers);
    })


     var ctx = $("#users_charts");
     var data = {
      labels: labels,
      datasets: [
      {
        label: "Categories",
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
        borderWidth: 1,
        data: datas,
      }
      ]
    };

    var myChart = new Chart(ctx, {
      type: 'line',
      data: data,

  });

  }
});

 }



})