<style>
.size{ width:290px}
</style>
<?php //echo form_open('school_settings/insert_comment');?>
<?php //echo $message;?>
<div class="m-content">
<div class="flex-grid">
<form  method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true" action="insert_comment">
		<div class="input-control text" style="display:none">
<input type="text" readonly="readonly" name="comment_category" value="PRINCIPAL">
</div>
<div class="row flex-just-sb">
<div class="cell colspan7">
<div class="input-control text full-size">
<input type="text" name="comment" size="50"  data-validate-hint-position="bottom"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div>
<div class="cell colspan2">
<input type="submit" name="submit" value="Submit">
</div>
</div>
</form>
</div>

     
         <div>
                <table class="table striped hovered cell-hovered border bordered">
                 <thead>
                 <tr>
                 <th width="2%">No</th>
                 <th width="20%" >Principal's Comments</th>
                 
                 <th width="3%">Change/Delete</th>
                <!-- <th>Class Division</th>-->
                 </tr>
                </thead>
                <tbody>
                <?php 
                 $i =0;
                foreach($comments->result() as $val){
                	$i+=1;
				
               ?>
                 <tr>
                 <td  width="2%" class="" ><?php echo $i; ?>
                 <input type="hidden" id="id" value="<?php echo $val->comment_id;?>" /></td>
                 <td width="20%" class="comment"><?php echo $val->principal_comment; ?>
                 <input type="hidden" id="type" name="type" value="<?php //echo $type ?>" /></td>
                 
                 <td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
                 </tr>
                 <?php
					}               
                  ?>
                
                 </tbody>
                 </table>
				 </div>
                 </div>
				 </body> 
				 
				 
				 <script>
        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
    </script>