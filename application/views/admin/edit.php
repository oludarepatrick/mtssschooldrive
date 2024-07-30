<div class="well">
    <div class="errorresponse">
        
    </div>
    <form class="form" id="frmupdate" role="form" action="<?php echo base_url() ?>home/update" method="POST">
    <?php foreach($query->result() as $row):?>
                        
                            <div class="form-group">
                            <label for="exampleInputEmail2">Full name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $row->name?>">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail2">Email</label>
                            <input class="form-control" name="email" type="email" value="<?php echo $row->email?>" >
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword2">Contact</label>
                            <input type="text" class="form-control" name="contact" value="<?php echo $row->contact?>">
                          </div>
                            <div class="form-group">
                            <label for="exampleInputPassword2">facebook link</label>
                            <input type="text" name="facebook" class="form-control" value="<?php echo $row->facebook_link?>">
                          </div>
                            <div class="form-group">
                                <input type="hidden" name="hidden" value="<?php echo $id ?>"/>
                            <input type="submit" class="btn btn-success" id="exampleInputPassword2" value="update">
                          </div>
        <?php endforeach;?>
                        </form>
                    </div>
</div>

<script>
$(document).ready(function (){
    $("#frmupdate").submit(function(e){
        e.preventDefault();
        $.ajax({
            url:'<?php echo base_url() ?>home/update',
            type:'POST',
            dataType:'json',
            data: $("#frmupdate").serialize()
        }).done(function (data){
            window.mydata = data;
                if(mydata['error'] !=""){
                    $(".errorresponse").html(mydata['error']);
                }
                else{
                $(".errorresponse").text('');
                $('#frmupdate')[0].reset();
                $("#response").html(mydata['success']);
                
                $.colorbox.close();
                $("#response").html(mydata['success']);
                }
        });
    });    
});

    
</script>
</body>
</html>