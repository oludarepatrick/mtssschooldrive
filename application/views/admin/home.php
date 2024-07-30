
<?php include 'header.php'; ?>
<div class="row clear_fix">
    <div class="col-md-12">

        <div id="response"></div>

        <div class="well">
            <form class="form-inline" role="form" id="frmadd" action="<?php echo base_url() ?>home/create" method="POST">
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Full name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail2" placeholder="name">
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">@</div>
                        <input class="form-control" name="email" type="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">Contact</label>
                    <input type="text" class="form-control" name="contact" id="exampleInputPassword2" placeholder="contact number">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword2">facebook link</label>
                    <input type="text" name="facebook" class="form-control" id="exampleInputPassword2" placeholder="http://facebook.com/pariharvikram1989">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="submit">
                </div>
            </form>
        </div>

        <table class="table">
            <thead><tr><th>Name</th><th>Email</th><th>Contact</th><th>facebook link</th><th>created</th><th>Action</th></tr></thead>
            <tbody id="fillgrid">
            
            </tbody>
            <tfoot></tfoot>
        </table>


    </div>
</div>
</div>



<script>
$(document).ready(function (){
    //fill data
    var btnedit='';
    var btndelete = '';
        fillgrid();
        // add data
        $("#frmadd").submit(function (e){
            e.preventDefault();
            $("#loader").show();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.ajax({
                url:url,
                type:'POST',
                data:data
            }).done(function (data){
                $("#response").html(data);
                $("#loader").hide();
                fillgrid();
            });
        });
    
    
    
    function fillgrid(){
        $("#loader").show();
        $.ajax({
            url:'<?php echo base_url() ?>home/fillgrid',
            type:'GET'
        }).done(function (data){
            $("#fillgrid").html(data);
            $("#loader").hide();
            btnedit = $("#fillgrid .btnedit");
            btndelete = $("#fillgrid .btndelete");
            var deleteurl = btndelete.attr('href');
            var editurl = btnedit.attr('href');
            //delete record
            btndelete.on('click', function (e){
                e.preventDefault();
                var deleteid = $(this).data('id');
                if(confirm("are you sure")){
                    $("#loader").show();
                    $.ajax({
                    url:deleteurl,
                    type:'POST' ,
                    data:'id='+deleteid
                    }).done(function (data){
                    $("#response").html(data);
                    $("#loader").hide();
                    fillgrid();
                    });
                }
            });
            
            //edit record
            btnedit.on('click', function (e){
                e.preventDefault();
                var editid = $(this).data('id');
                $.colorbox({
                href:"<?php echo base_url()?>home/edit/"+editid,
                top:50,
                width:500,
                onClosed:function() {fillgrid();}
                });
            });
            
        });
    }
    
});
</script>
</body>
</html>
