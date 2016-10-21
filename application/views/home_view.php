<body>
  <div class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="javascript:void(0)">Brand</a>
      </div>
      <div class="navbar-collapse collapse navbar-responsive-collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="javascript:void(0)">Active</a></li>
          <li><a href="javascript:void(0)">Link</a></li>
          <li class="dropdown">
            <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
              <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0)">Action</a></li>
                <li><a href="javascript:void(0)">Another action</a></li>
                <li><a href="javascript:void(0)">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Dropdown header</li>
                <li><a href="javascript:void(0)">Separated link</a></li>
                <li><a href="javascript:void(0)">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control col-md-8" placeholder="Search">
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:void(0)">Link</a></li>
            <li class="dropdown">
              <a href="bootstrap-elements.html" data-target="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown
                <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="javascript:void(0)">Action</a></li>
                  <li><a href="javascript:void(0)">Another action</a></li>
                  <li><a href="javascript:void(0)">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="javascript:void(0)">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container">
        <form class="form-horizontal" id="myform" method="POST" >
        <!-- action="<?php echo base_url('index.php/home/save_data')?>"> -->
          <fieldset>
            <legend>Legend</legend>
            <div class="form-group label-floating is-empty">
              <label for="i5" class="control-label">Task</label>
              <input type="text" class="form-control" name="task" id="i5">
              <span class="help-block">please input task</span>
            </div>
            <!-- <div class="form-group label-floating is-empty">
              <label for="i5" class="control-label">Date</label>
              <input type="date" class="form-control" name="date" id="i5">
              <span class="help-block">This is a hint as a <code>span.help-block.hint</code></span>
            </div>
            <div class="form-group label-floating is-empty">
              <label for="i5" class="control-label">Time</label>
              <input type="text" class="form-control" name="date" id="i5">
              <span class="help-block">This is a hint as a <code>span.help-block.hint</code></span>
            </div> -->
            <div class="form-group label-floating is-empty">
            <button id="btnSave" class="btn btn-primary btn-raised" type="sumbit" onclick="save()"> Sumbit </button>
            </div>
          </fieldset>
        </form>
          </div>

<script>
  function save()
  {
    // $.ajax({
    //   url : "<?php echo base_url('index.php/home/save_data')?>",
    //   type : "POST",
    //   data  : $('#myform').serialize(),
    //   dataType : "JSON",
    //   success : function(data)
    //   {
    //     if(data.status)
    //     {
    //       alert('task success save to data bases');
    //     }
    //   },
    //   error: function (jqXHR, textStatus, errorThrown)
    //   {
    //       alert('Error adding / update data');
    //
    //   }
    // });

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
            }
            // else
            // {
            //     for (var i = 0; i < data.inputerror.length; i++)
            //     {
            //         $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
            //         $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
            //     }
            // }
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
</script>
