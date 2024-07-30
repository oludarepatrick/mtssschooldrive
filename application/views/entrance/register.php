<html>
    <head>
        <title>New Registration</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            
            #container {
                margin: 0 auto;
                position: relative;
                width: 80%;
                /*left: 240px;*/
                /*right: 20px;*/
            }
            
            #header {
                background-color: #3366CC;
                color: #fff;
                padding: 10px;
                text-align: left;
            }
            
            #content {
                background-color: #F4F4F4;
                padding: 20px;
                border: 1px solid #ccc;
            }
            
            #registration-form {
                width: 70%;
                margin: 0 auto;
            }
            
            .form-row {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }
            
            .column {
                width: calc(33.33% - 20px);
                margin-bottom: 20px;
            }
            
            label {
                display: block;
                margin-bottom: 5px;
            }
            
            input[type="text"],input[type="date"],input[type="email"],textarea,select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }
            
            .btn1 {
                padding: 10px 100px;
                background-color: #3366CC;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin: 0 auto;
            }
            .btn2 {
                padding: 10px 30px;
                background-color: green;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin: 0 auto;
            }
            .btn3 {
                padding: 10px 30px;
                background-color: red;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin: 0 auto;
            }
            button:hover {
                background-color: #0078d4;
            }
            
            /* Media Query for smaller screens */
            @media screen and (max-width: 768px) {
                .form-row {
                    flex-direction: column;
                }
            
                .column {
                    width: 100%;
                }
            }
            .kerr,.reqerror{
                color:red;
                font-size:14px;
                font-style:italic; 
            }
        </style>
    </head>
    <body>
    <?php 
    	$css = array('id'=> 'form');
	 	echo form_open_multipart('entrance/regExec', $css);
		$star = array( 'src'=> 'asset/images/star.gif');
		$alert = array('src' => 'asset/image/alert.png','height'=>'50', 'width'=>'50' );
    ?>
    <div id="border_1j" class="bgrdu">
        <div id="container">
            <div align="center" class="girl">
                    <a href="">
                    <?php echo img(array('src'=>'asset/images/mtss.png', 'width'=>100, 'heigth'=>10))?></a>
            </div>
            <div id="header">
                <h3>
                
                <span class="title">
                    <span class="mif-user icon"></span>
                    Student Registration (Form No.: <?php echo $record->appno; ?>)
                </span>
                </h3>
                <input type="hidden" name="uuid" value="<?php echo $record->uuid; ?>">
                <input type="hidden" name="oldstatus" value="<?php echo $record->status; ?>">
                <div class="row" align="center">
                    All fields mark with asterisck (<strong style="color:red; font-size:16px">*</strong>) are required
                </div>
            </div>
            <div id="content">
                <!--<form id="registration-form" action="<?php //echo base_url('receipt/client_registration');?>" method="post">-->
                    
                    <div class="form-row">
                        <div class="column">
                            <label for="sname">
                                Surname<span class="reqerror">*</span>
                            </label>
                            <input type="text" id="sname" name="sname" value="<?php echo $record->sname; ?>" required/>
                            <span class="kerr">
                                <?php echo form_error('sname');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="fname">
                                First Name<span class="reqerror">*</span>
                            </label>
                            <input type="text" id="fname" name="fname" value="<?php echo $record->fname; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('fname');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="oname">
                                Othername
                            </label>
                            <input type="text" id="oname" name="oname" value="<?php echo $record->oname; ?>" >
                        </div>
                        <div class="column">
                            <label for="gender">
                                Gender<span class="reqerror">*</span>
                            </label>
                            <select id="gender" name="gender" class="select" value="<?php echo $record->gender; ?>" required>
                                
                                <option value="<?php echo !empty($record->gender)?$record->gender:''; ?>"<?php echo set_select('sex', '', TRUE); ?>><?php echo !empty($record->gender)?$record->gender:'--SELECT--'; ?></option>
                                <?php if($record->gender!=="Male"){ ?>
                                <option value="Male">Male</option>
                                <?php } ?>
                                <?php if($record->gender!=="Female"){ ?>
                                <option value="Female">Female</option>
                                <?php } ?>
                            </select>
                            <span class="kerr">
                                <?php echo form_error('sex');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="dob">
                                Date of Birth<span class="reqerror">*</span>
                            </label>
                            <input type="date" id="dob" name="dob" value="<?php echo $record->dob; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('dob');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="nationality">
                                Nationality <span class="reqerror">*</span>
                            </label>
                            <input type="text" id="nationality" name="nationality" value="<?php echo $record->nationality; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('nationality');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="contact-person">
                                State of Origin<span class="reqerror">*</span>
                            </label>
                            <select id="state" name="state" class="select" value="<?php echo $record->state; ?>" required>
                                
                                <option value="<?php echo !empty($record->state)?$record->state:''; ?>"<?php echo set_select('state', '', TRUE); ?>><?php echo !empty($record->state)?$record->state:'--SELECT--'; ?></option>
                              <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
                              <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
                              <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
                              <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
                              <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
                              <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
                              <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
                              <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
                              <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
                              <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
                              <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
                              <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
                              <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
                              <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
                              <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
                              <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
                              <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
                              <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
                              <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
                              <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
                              <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
                              <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
                              <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
                              <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
                              <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
                              <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
                              <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
                              <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
                              <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
                              <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
                              <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
                              <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
                              <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
                              <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
                              <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
                              <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
                        	  <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
                                <option  value="Zamfara"<?php  echo set_select('state', 'None-Nigerian'); ?>>None-Nigerian</option>                    
                            </select>
                            <span class="kerr">
                                <?php echo form_error('state');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="city">
                                Local Govt. Area <span class="reqerror">*</span>
                            </label>
                            <input type="text" id="lga" name="lga" value="<?php echo $record->lga; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('lga');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="religion">
                                Religion<span class="reqerror">*</span>
                            </label>
                            <input type="text" id="religion" name="religion" value="<?php echo $record->religion; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('religion');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="denomination">
                                Denomination<span class="reqerror">*</span>
                            </label>
                            <input type="text" id="denomination" name="denomination" value="<?php echo $record->denomination; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('denomination');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="address">
                                Home Address<span class="reqerror">*</span>
                            </label>
                            <textarea type="text" id="address" name="address" required><?php echo $record->address; ?></textarea>
                            <span class="kerr">
                                <?php echo form_error('address');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="lastclass">
                                Last Class<span class="reqerror">*</span>
                            </label>
                            <select id="lastclass" name="lastclass" class="select" value="<?php echo $record->lastclass; ?>" required>
                            <option value="<?php echo !empty($record->lastclass)?$record->lastclass:''; ?>"<?php echo set_select('lastclass', '', TRUE); ?>><?php echo !empty($record->lastclass)?$record->lastclass:'--SELECT--'; ?></option>
                   			<option value="BASIC 5"<?php  echo set_select('lastclass','BASIC 5') ?>>BASIC 5</option>
                		    <option value="BASIC 6"<?php  echo set_select('lastclass','BASIC 6') ?>>BASIC 6</option>
                		    <option value="JSS 1"<?php  echo set_select('lastclass','JSS 1') ?>>JSS 1</option>
                		    <option value="JSS 2"<?php  echo set_select('lastclass','JSS 2') ?>>JSS 2</option>
                		    <option value="JSS 3"<?php  echo set_select('lastclass','JSS 3') ?>>JSS 3</option>
                		    <option value="SSS 1"<?php  echo set_select('lastclass','SSS 1') ?>>SSS 1</option>
                		    <option value="SSS 2"<?php  echo set_select('lastclass','SSS 2') ?>>SSS 2</option>
                		    <option value="SSS 3"<?php  echo set_select('lastclass','SSS 3') ?>>SSS 3</option>
                            </select>
                            <span class="kerr">
                                <?php echo form_error('lastclass');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="newclass">
                                New Class<span class="reqerror">*</span>
                            </label>
                            <select id="newclass" name="newclass" class="select" value="<?php echo $record->newclass; ?>" required>
                            <option value="<?php echo !empty($record->newclass)?$record->newclass:''; ?>"<?php echo set_select('newclass', '', TRUE); ?>><?php echo !empty($record->newclass)?$record->newclass:'--SELECT--'; ?></option>
                   			<option value="JSS 1"<?php  echo set_select('newclass','JSS 1') ?>>JSS 1</option>
                		    <option value="JSS 2"<?php  echo set_select('newclass','JSS 2') ?>>JSS 2</option>
                		    <option value="JSS 3"<?php  echo set_select('newclass','JSS 3') ?>>JSS 3</option>
                		    <option value="SSS 1"<?php  echo set_select('newclass','SSS 1') ?>>SSS 1</option>
                		    <option value="SSS 2"<?php  echo set_select('newclass','SSS 2') ?>>SSS 2</option>
                		    <option value="SSS 3"<?php  echo set_select('newclass','SSS 3') ?>>SSS 3</option>
                			
                            </select>
                            <span class="kerr">
                                <?php echo form_error('newclass');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="classarm">
                                Class Arm
                            </label>
                            <select id="classarm" name="classarm" class="select" value="<?php echo $record->classarm; ?>" >
                            <option value="<?php echo !empty($record->classarm)?$record->classarm:''; ?>"<?php echo set_select('classarm', '', TRUE); ?>><?php echo !empty($record->classarm)?$record->classarm:'--SELECT--'; ?></option>
                   			<option value="A"<?php  echo set_select('classarm','A') ?>>A</option>
                   			<option value="B"<?php  echo set_select('classarm','B') ?>>B</option>
                   			<option value="Commercial"<?php  echo set_select('classarm','Commercial') ?>>Commercial</option>
                   			<option value="Science"<?php  echo set_select('classarm','Science') ?>>Science</option>
                   			<option value="Art"<?php  echo set_select('classarm','Art') ?>>Art</option>
                			
                            </select>
                            <span class="kerr">
                                <?php echo form_error('classarm');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="lastschool">
                                Last School Attended <span class="reqerror">*</span>
                            </label>
                        
                            <input type="text" id="lastschool" name="lastschool" value="<?php echo $record->lastschool; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('lastschool');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="fathername">
                                Father's Name <span class="reqerror">*</span>
                            </label>
                        
                            <input type="text" id="fathername" name="fathername" value="<?php echo $record->fathername; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('fathername');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="mothername">
                                Mother's Name <span class="reqerror">*</span>
                            </label>
                        
                            <input type="text" id="mothername" name="mothername" value="<?php echo $record->mothername; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('mothername');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="guardian">
                                Guardian (optional)
                            </label>
                        
                            <input type="text" id="guardian" name="guardian" value="<?php echo $record->guardian; ?>" >
                            <span class="kerr">
                                <?php echo form_error('guardian');?>
                            </span>
                        </div>
                        <div class="column">
                            <label for="officeaddress">
                                Office Address<span class="reqerror">*</span>
                            </label>
                            <textarea type="text" id="officeaddress" name="officeaddress" required><?php echo $record->officeaddress; ?></textarea>
                            <span class="kerr">
                                <?php echo form_error('officeaddress');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="phone">
                                Phone No. <span class="reqerror">*</span>
                            </label>
                        
                            <input type="text" id="phone" name="phone" value="<?php echo $record->phone; ?>" required>
                            <span class="kerr">
                                <?php echo form_error('phone');?>
                            </span>
                        </div>
                        
                        <div class="column">
                            <label for="company-name">
                                Email Address <span class="reqerror">*</span>
                            </label>
                        
                            <input type="email" id="email" name="email" value="<?php echo $record->email; ?>" readonly required>
                            <span class="kerr">
                                <?php echo form_error('email');?>
                            </span>
                        </div>
                        
                        
                        
                    </div>
                    <div class="form-row" align="center" style="margin:0 auto;">
                        <button class="btn1" type="submit">Save</button>
                        <?php if($record->status==3){ ?>
                        <button class="btn2"><a style="text-decoration: none; color:fff; font-weight: bold;" href="https://mtss.schooldriveng.com/index.php/entrance/dashboard/<? echo $record->uuid ?>">Dashboard</a></button>
                        <?php } ?>
                        <button class="btn3"><a style="text-decoration: none; color:fff; font-weight: bold;" href="https://mtss.schooldriveng.com/index.php/entrance/login">logout</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div align="center" style="margin:0px; padding:0px; font-size:12px; color:darkblue;">
        Copyright @2023 07053796686, schooldrivesng@gmail.com Drive Technology Limited, All rights reserved.
    </div>
</body>
</html>