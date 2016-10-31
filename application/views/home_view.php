<style media="screen">
.fo
{
  margin-left: 2%;
  margin-right: 2%;
}
</style>
<body>
  <div class="container">
    <!-- <div class="progress">
    <div class="progress-bar progress-bar-info" style="width: 100%"></div>
  </div> -->
  <div class="panel panel-default">
    <div class="panel-heading"><h2>CRUD By Usman</h2></div>
    <!-- show alert -->
    <div id="alt" class="alert alert-dismissible alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Well done!</strong> You successfully add or edit task
    </div>

    <div id="err" class="alert alert-dismissible alert-danger">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>Oh snap!</strong>
      <a href="javascript:void(0)" class="alert-link">Change a few things up</a> and try submitting again.
    </div>

    <div class="panel-body">
      <div class="fo">
        <form class="form-horizontal" id="myform" method="POST" >
          <!-- action="<?php echo base_url('index.php/home/save_data')?>"> -->
          <fieldset>
            <div class="form-group label-floating is-empty">
              <label for="i5" class="control-label">New Task</label>
              <input type="text" class="form-control" name="task" id="i5">
              <span class="help-block">Please input new task</span>
            </div>
            <div class="form-group label-floating is-empty">
              <button id="btnSave" class="btn btn-primary btn-raised" type="sumbit" onclick="add()"> Sumbit </button>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <div class="well">
    <table id="table" class="table table-striped table-hover ">
      <thead>
        <tr>
          <th style="width:5%">No </th>
          <th>Task</th>
          <th>Tanggal</th>
          <th>Jam</th>
          <th>Action </th>
        </tr>
      </thead>
      <tbody id="tbody">
      </tbody>
    </table>

  </div>
</div>

<script>
var table;
var form;
var save_method;

//view data to table
$(document).ready(function() {
  $('#alt').hide();
  $('#err').hide();
  //datatables
  table = $('#table').DataTable({
    // Load data for the table's content from an Ajax source
    "ajax": {
      "url": "<?php echo site_url('home/show')?>",
      "type": "POST"
    },

  });
});

//add new task
function add()
{
  save_method='add';
  form='#myform';
  save();
}


function reload_table()
{
  table.ajax.reload(null,false); //reload datatable ajax
}

// function for save data ajax
function save()
{
  $('#alt').hide();
  var url;
  if(save_method=='update')
  {
    url="<?php echo site_url('home/get_data'); ?>";
  }
  else
  {
    url="<?php echo site_url('home/save_data'); ?>"
  }
  $('#btnSave').text('saving...'); //change button text
  $('#btnSave').attr('disabled',true); //set button disable

  // ajax adding data to database
  $.ajax({
    url : url,
    type: "POST",
    data: $(form).serialize(),
    dataType: "JSON",
    success: function(data)
    {

      if(data.status) //if success close modal and reload ajax table
      {
        $('#modal_form').modal('hide');
        $('#alt').show(100);
        reload_table();

      }

      $('#btnSave').text('save'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable


    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      $('#err').show(100);
      $('#btnSave').text('save'); //change button text
      $('#btnSave').attr('disabled',false); //set button enable

    }
  });
}

// function for uodate task by id
function edit(id)
{
  save_method = 'update';
  form='#form';
  $('#form')[0].reset(); // reset form on modals
  $('.form-group').removeClass('has-error'); // clear error class
  $('.help-block').empty(); // clear error string

  //Ajax Load data from ajax
  $.ajax({
    url : "<?php echo site_url('home/edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      $('[name="id"]').val(data.id);
      $('#task_val').val(data.task);
      $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
      $('.modal-title').text('Edit Task'); // Set title to Bootstrap modal title

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
      alert('Error get data from ajax');
    }
  });

}

// function for delete task
function delete_task(id)
{
  if(confirm('Are you sure delete this data?'))
  {
    // ajax delete data to database
    $.ajax({
      url : "<?php echo site_url('home/delete')?>/"+id,
      type: "POST",
      dataType: "JSON",
      success: function(data)
      {
        //if success reload ajax table
        $('#modal_form').modal('hide');
        reload_table();
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error deleting data');
      }
    });

  }
}



</script>

<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Person Form</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id"/>
          <div class="form-body">
            <div class="form-group">
              <input type="text" class="form-control" name="task" id="task_val">
              <span class="help-block">Please input new task</span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
