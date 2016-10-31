<body>
  <div class="container">
    <h2> CRUD By Usman </h2>

        <form class="form-horizontal" id="myform" method="POST" >
        <!-- action="<?php echo base_url('index.php/home/save_data')?>"> -->
          <fieldset>
            <div class="form-group label-floating is-empty">
              <label for="i5" class="control-label">New Task</label>
              <input type="text" class="form-control" name="task" id="i5">
              <span class="help-block">Please input new task</span>
            </div>
            <div class="form-group label-floating is-empty">
            <button id="btnSave" class="btn btn-primary btn-raised" type="sumbit" onclick="save()"> Sumbit </button>
            </div>
          </fieldset>
        </form>


        <div class="well">
        <table id="table" class="table table-striped table-hover ">
          <thead>
          <tr>
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
  $(document).ready(function() {
      //datatables
      table = $('#table').DataTable({
          // Load data for the table's content from an Ajax source
          "ajax": {
              "url": "<?php echo site_url('home/show')?>",
              "type": "POST"
          },

      });
    });

  function reload_table()
  {
      table.ajax.reload(null,false); //reload datatable ajax
  }

  function save()
  {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable

    // ajax adding data to database
    $.ajax({
        url : "<?php echo site_url('home/save_data'); ?>",
        type: "POST",
        data: $('#myform').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                alert('Success Post opportunity');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
  }

  function edit(id)
  {
    save_method = 'update';
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
            $('[name="task_name"]').val(data.task);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Task'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

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
                          <input type="text" class="form-control" name="task_name" id="i5">
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
