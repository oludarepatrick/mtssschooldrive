<?php 

$config = array( 
			'signup' => array(
						   array(
								 'field'   => 'username', 
								 'label'   => 'Username', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'password', 
								 'label'   => 'Password', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'password2', 
								 'label'   => 'Password Confirmation', 
								 'rules'   => 'required|matches[password]'
							  ),   
						   array(
								 'field'   => 'email', 
								 'label'   => 'Email', 
								 'rules'   => 'required|valid_email'
							  )
            ),//signup
			'broadsheet' => array(
						   array(
								 'field'   => 'classes', 
								 'label'   => 'Student Class', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'class_arm', 
								 'label'   => 'Class Division', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'session', 
								 'label'   => 'Session', 
								 'rules'   => 'required'
							  ),
						
						array(
								 'field'   => 'term',
								 'label'   => 'Term', 
								 'rules'   => 'required'
							  ),
						
            ),//broadsheet
			
			
			'edit_student' => array(
							array(
								  'field' => 'surname',
								  'label' => 'Surname',
								  'rules' => 'required'
								  ),
				            
							array(
								  'field' => 'fname',
								  'label' => 'Firstname',
								  'rules' => 'required'
								  )
								  ),
			'login' => array(
						   array(
								 'field'   => 'username', 
								 'label'   => 'Username', 
								 'rules'   => 'required|callback__authentication'
							  ),
						   array(
								 'field'   => 'password', 
								 'label'   => 'Password', 
								 'rules'   => 'required'
							  )
			),//login
			'view_all' => array(
						   array(
								 'field'   => 'staffname', 
								 'label'   => 'Staffname', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'location', 
								 'label'   => 'Location', 
								 'rules'   => 'required'
							  )
			),//view_all
			'edit_staff_check' => array(
						   array(
								 'field'   => 'staff_id', 
								 'label'   => 'Checked', 
								 'rules'   => ''
							  )
			),//editstaffchecked
			'broadsheet' => array(
						   array(
								 'field'   => 'classes', 
								 'label'   => 'Class', 
								 'rules'   => ''
							  ),
						   array(
								 'field'   => 'class_arm', 
								 'label'   => 'Class Arm', 
								 'rules'   => ''
							  ),
						   array(
								 'field'   => 'term', 
								 'label'   => 'Term', 
								 'rules'   => ''
							  ),
						    array(
								 'field'   => 'session', 
								 'label'   => 'Session', 
								 'rules'   => ''
							  )
						 
			),//account
			
			'comment_query'=>array(
							array(
								'field'   => 'comment_category',
								'label'   => 'Category',
								'rules'	  => 'required'
								  )
								  ),
	'staff_registration'=>array(
							array(
								'field'   => 'fname',
								'label'   => 'First Name',
								'rules'	  => 'required'
								  ),
							array(
								'field'   => 'surname',
								'label'   => 'Surname',
								'rules'	  => 'required'
								  ),
							array(
								'field'   => 'username',
								'label'   => 'Username',
								'rules'	  => 'required|callback__authentication'
								  ),
							array(
								'field'   => 'staff_cat',
								'label'   => 'Teachers Category',
								'rules'	  => 'required'
								  ),	
							array(
								'field'   => 'classes',
								'label'   => 'Class',
								'rules'	  => 'required'
								  ),
							array(
								'field'   => 'password',
								'label'   => 'Password',
								'rules'	  => 'required'
								  ),
								  
							array(
								'field'   => 'passconf',
								'label'   => 'Password Confirmation',
								'rules'	  => 'required|matches[password]'
								  ),
							array(
								'field'   => 'email',
								'label'   => 'Email',
								'rules'	  => 'required|valid_email'
								  ),
							array(
								'field'   => 'phone',
								'label'   => 'Phone Number',
								'rules'	  => 'required|numeric'
								  )
							
								  ),//end employee registration
								  
			'student_registration'=>array(
							array(
								'field'   => 'lastname',
								'label'   => 'Last Name',
								'rules'	  => 'required'
								  ),
							array(
								'field'   => 'firstname',
								'label'   => 'First Name',
								'rules'	  => 'required'
								  ),
							array(
								'field'   => 'midname',
								'label'   => 'Middle Name',
								'rules'	  => ''
								  ),
							array(
								'field'   => 'department',
								'label'   => 'Department',
								'rules'	  => 'required'
								  ),	
							array(
								'field'   => 'sex',
								'label'   => 'Gender',
								'rules'	  => 'required'
								  ),
						
							array(
								'field'   => 'dob',
								'label'   => 'Date of Birth',
								'rules'	  => 'required'
								  ),
							
							array(
								'field'   => 'email',
								'label'   => 'Email',
								'rules'	  => 'required|valid_email'
								  ),
							array(
								'field'   => 'phone',
								'label'   => 'Phone Number',
								'rules'	  => 'required|numeric'
								  )
							
								  ),//end student registration					  
		'studentpay_plan'=>array(
						array(
								'field'	=> 'tuition',
								'label' => 'Tuition',
								'rules' => 'required'
								)
								),//endstudent pay rule	
								  
		'payroll'=>array(    
		            array(
					            'field'  => 'names',
								'label'  => 'Employee Names',
								'rules'  => ''
						   ),
					array(
					            'field'  => 'basicsal',
								'label'  => 'Basic Salary',
								'rules'  => 'required'
						   ),
					array(
					            'field'  => 'tax',
								'label'  => 'Tax',
								'rules'  => 'required'
						   ),
					array(
					            'field'  => 'loan',
								'label'  => 'Loan',
								'rules'  => ''
						   ),
				 array(
					            'field'  => 'coop',
								'label'  => 'Cooperative Deduction',
								'rules'  => ''
						   ),
				 array(
					            'field'  => 'nhis',
								'label'  => 'Health Insurance',
								'rules'  => ''
						   ),
				array(
					            'field'  => 'netpay',
								'label'  => 'Net Pay',
								'rules'  => ''
						   ),
					array(
					            'field'  => 'transport',
								'label'  => 'Transport',
								'rules'  => ''
						   ),
				   array(
					            'field'  => 'housing',
								'label'  => 'Housing Allowance',
								'rules'  => ''
						   ),
					array(
					            'field'  => 'entertainment',
								'label'  => 'Entertainment Allowance',
								'rules'  => ''
						   ),
					array(
					            'field'  => 'wardrope',
								'label'  => 'Wardrope Allowance',
								'rules'  => ''
						   )
						   ),//end of payroll
		'view_receipt'=>array(
						array(
							    'field'   => 'customername',
								'label'   => 'Customer Name',
								'rules'   => 'required'
							  ),
						array(
								'field'   => 'invoiceno',
								'label'   => 'Invoice No',
								'rules'   => 'required'
							  )
							  ),//end receipt view validation
			'receipt'=>array(
							  array(
							    'field'   => 'cusname',
								'label'   => 'Customer Name',
								'rules'   => 'required'
							   ),
							   array(
							    'field'   => 'contact',
								'label'   => 'Contact Name',
								'rules'   => 'required'
							   ),
						array( 
						        'field'  =>  'cusphone',
								'label'  =>  'Phone Number',
								'rules'	 =>  'required'
							   ),
					
                         array( 
						        'field'  =>  'cusemail',
								'label'  =>  'Email',
								'rules'	 =>  'required|valid_email'
							   ),
						array( 
						        'field'  =>  'address',
								'label'  =>  'Address',
								'rules'	 =>  'required'
							   ),
						array( 
						        'field'  =>  'invoicedate',
								'label'  =>  'Invoice Date',
								'rules'	 =>  'required'
							   ),
						array( 
						        'field'  =>  'invoiceno',
								'label'  =>  'Invoice Number',
								'rules'	 =>  'required'
							   ),
					 	array( 
						        'field'  =>  'description',
								'label'  =>  'Description',
								'rules'	 =>  'required'
							   ),
						array( 
						        'field'  =>  'quantity',
								'label'  =>  'Quantity',
								'rules'	 =>  'required'
							   ),
						array( 
						        'field'  =>  'price',
								'label'  =>  'Price Per Guard',
								'rules'	 =>  'required'
							   ),
						array( 
						        'field'  =>  'amount',
								'label'  =>  'Amount',
								'rules'	 =>  ''
							   ),	
					   array( 
						        'field'  =>  'subtotal',
								'label'  =>  'Sub Toal',
								'rules'	 =>  ''
							   ),	
						array( 
						        'field'  =>  'servicetax',
								'label'  =>  'VAT(Service Tax)',
								'rules'	 =>  ''
							   ),			     
					  array( 
						        'field'  =>  'total',
								'label'  =>  'Total',
								'rules'	 =>  ''
							   ),
					  array( 
						        'field'  =>  'amountpaid',
								'label'  =>  'Amount Paid',
								'rules'	 =>  ''
							   ),
					 ),//end receipt validation
			'registration'=> array(
			                  array(
							  		'field' => 'schname',
									'label' => 'School Name',
									'rules' => 'required'
									),
							  array(	
							        'field' => 'address',
									'label' => 'Address',
									'rules' => 'required'
									),
							 array(
							        'field' => 'phone',
									'label' => 'Phone Number',
									'rules'	=> 'required'
									),
							array(
							        'field' => 'email',
									'label' => 'Valid Email',
									'rules' => 'required|valid_email'
									),
							array(
							        'field' => 'schmotto',
									'label' => 'Motto',
									'rules' => 'required'
									),
							array(
							       'field' => 'postal',
								   'label' => 'Reference Number',
								   'rules' => ''
								   ),
						    array(
							       'field' => 'bank1',
								   'label' => 'Bank Name',
								   'rules' => ''
								   ),
						    array(
							       'field' => 'account1',
								   'label' => 'Account Number',
								   'rules' => ''
								   )
								   ),//end registration validation
			'student_register' =>array(//begins student registration validation rules
								  array(
								  		'field'=> 'surname',
										'label'=> 'Surname',
										'rules'=> 'required'
										),
								  array(
								        'field'=>'fname',
										'label'=>'First Name',
										'rules'=>'required'
										),
										
								array(
								        'field'=>'othername',
										'label'=>'Other Name',
										'rules'=>''
										),
									
								 array(
								        'field'=>'class',
										'label'=>'Class',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'gender',
										'label'=>'Gender',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'adminno',
										'label'=>'Admission NUmber',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'term',
										'label'=>'Term',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'house',
										'label'=>'House',
										'rules'=>''
										),
										
								 array(
								        'field'=>'state',
										'label'=>'State',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'nationality',
										'label'=>'Nationality',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'religion',
										'label'=>'Religion',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'dob',
										'label'=>'Date of Birth',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'parent_surname',
										'label'=>'Parent Surname',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'initial',
										'label'=>'Initial',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'title',
										'label'=>'Title',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'city',
										'label'=>'City',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'address',
										'label'=>'Address',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'state2',
										'label'=>'State',
										'rules'=>'required'
										),
										
								 array(
								        'field'=>'phone',
										'label'=>'Phone',
										'rules'=>'required'
										)
										),//end student registration validation rules
										
			'register' => array(
						   array(
								 'field'   => 'class_arm', 
								 'label'   => 'Class Arm', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'address', 
								 'label'   => 'Address', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'city', 
								 'label'   => 'City', 
								 'rules'   => 'required'
							  ),   
						   array(
								 'field'   => 'email', 
								 'label'   => 'Email', 
								 'rules'   => 'required|valid_email'
							  ),
						   array(
								 'field'   => 'state', 
								 'label'   => 'State', 
								 'rules'   => 'required'
							  ),
						   	array(
								 'field'   => 'phone', 
								 'label'   => 'Phone', 
								 'rules'   => 'required|numeric'
							  )
						   
						  
						   
            ),//register
			'invoice' => array(
						   array(
								 'field'   => 'customer', 
								 'label'   => 'Customer', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'inv_date', 
								 'label'   => 'Invoice date', 
								 'rules'   => 'required'
							  )
            ),//invoice
			'bill' => array(
						   array(
								 'field'   => 'vendor', 
								 'label'   => 'Vendor', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'bill_date', 
								 'label'   => 'Bill date', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'due_date', 
								 'label'   => 'Bill due date', 
								 'rules'   => 'required'
							  )
            ),//invoice
			
				'payment' => array(
						   array(
								 'field'   => 'vendor', 
								 'label'   => 'Vendor', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'account', 
								 'label'   => 'Account', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'payment_date', 
								 'label'   => 'Payment date', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'amount',
								 'label'   => 'Amount', 
								 'rules'   => 'required|numeric'
							  ),
            ),//payment
		
			'customer_register' => array(
						   array(
								 'field'   => 'title', 
								 'label'   => 'Title', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'firstname', 
								 'label'   => 'First Name', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'lastname', 
								 'label'   => 'Last Name', 
								 'rules'   => 'required'
							  ),
							array(
								 'field'   => 'name', 
								 'label'   => 'Company Name', 
								 'rules'   => 'required'
							  ),
							array(
								 'field'   => 'displayname', 
								 'label'   => 'Display Name', 
								 'rules'   => ''
							  ),
							array(
								 'field'   => 'address', 
								 'label'   => 'Address', 
								 'rules'   => ''
							  ),
							array(
								 'field'   => 'city', 
								 'label'   => 'City', 
								 'rules'   => ''
							  ),   
						
						   array(
								 'field'   => 'state', 
								 'label'   => 'State', 
								 'rules'   => ''
							  ),
						   
						   array(
								 'field'   => 'email', 
								 'label'   => 'Email', 
								 'rules'   => 'valid_email'
							  ),
						    array(
								 'field'   => 'website', 
								 'label'   => 'Website', 
								 'rules'   => ''
							  ),
						  
						   	array(
								 'field'   => 'phone', 
								 'label'   => 'Phone', 
								 'rules'   => 'numeric'
							  )
						   
						  
						   
            ),
			'vendor_register' => array(
						   
						   array(
								 'field'   => 'firstname', 
								 'label'   => 'First Name', 
								 'rules'   => 'required'
							  ),
						  
							array(
								 'field'   => 'name', 
								 'label'   => 'Company Name', 
								 'rules'   => 'required'
							  ),
							array(
								 'field'   => 'displayname', 
								 'label'   => 'Display Name', 
								 'rules'   => ''
							  ),
							array(
								 'field'   => 'address', 
								 'label'   => 'Address', 
								 'rules'   => ''
							  ),
							array(
								 'field'   => 'city', 
								 'label'   => 'City', 
								 'rules'   => ''
							  ),   
						
						   array(
								 'field'   => 'state', 
								 'label'   => 'State', 
								 'rules'   => ''
							  ),
						   
						   array(
								 'field'   => 'email', 
								 'label'   => 'Email', 
								 'rules'   => 'valid_email'
							  ),
						    array(
								 'field'   => 'website', 
								 'label'   => 'Website', 
								 'rules'   => ''
							  ),
						  
						   	array(
								 'field'   => 'phone', 
								 'label'   => 'Phone', 
								 'rules'   => 'numeric'
							  )
						   
						  
						   
            ),//register
			'transaction' => array(
						   array(
								 'field'   => 'fromDate', 
								 'label'   => 'From date', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'toDate', 
								 'label'   => 'To date', 
								 'rules'   => 'required'
							  )
            ),//transaction
			
			'student_list' => array(
						   array(
								 'field'   => 'class', 
								 'label'   => 'Class', 
								 'rules'   => 'required'
							  ),
						   array(
								 'field'   => 'classDiv', 
								 'label'   => 'Class Division', 
								 'rules'   => 'required'
							  )
            ),//student_list
			
			'edit_roll' => array(
								array(
								       'field' =>'empname',
									   'label' => 'Select Employee Name',
									   'rules' => ''
									   )
									   ),
			'edit_payupdate' => array(
								array(
								       'field' =>'stud_id',
									   'label' => 'Check Student Id',
									   'rules' => 'required'
									   )
									   ),						   
									   
			 'edit_studpay' => array(
								array(
								       'field' =>'studname',
									   'label' => 'Select Student Name',
									   'rules' => 'required'
									   ),
							    array(
								       'field' =>'month',
									   'label' => 'Select TERM',
									   'rules' => 'required'
									   ),
							    array(
								       'field' =>'year',
									   'label' => 'Select SESSION',
									   'rules' => 'required'
									   )
									   ),
			  'view_studpay_all' => array(
							    array(
								       'field' =>'month',
									   'label' => 'Select TERM',
									   'rules' => 'required'
									   ),
							    array(
								       'field' =>'year',
									   'label' => 'Select SESSION',
									   'rules' => 'required'
									   )
									   ),
			'delete_staff'	=>array(
								array( 
								      'field' => 'staffname',
									  'label' => 'Select Staff Name',
									  'rules' => ''
									  ),
								array(
									  'field' => 'id',
									  'label' => 'Check Id', 
									  'rules' => ''
								))
									   
			
		);//universal array

?>