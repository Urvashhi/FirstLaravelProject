$function(){
	$.validator.addMethod('strongPassword', function(value, element ){
		return this.optional(element)
		|| value.length >= 6
		&& /\d/.test(value)
		&& /[a-z]/i.test(value);
	},'your password must be at least 6 character long and contain at least one number and one char\'.')
	$("#frm").validate(
	{
     rules:{
     	email:{
     		required: true,
     		email: true
     	},password:{
     	required: true,
     	strongPassword: true
     		},
     	cpassword{
     		required:true,
     		equalTo: "#password"
     	}
     },
     messages:{
     	email:{
     		required:'Please  enter an email address.',
     		email:'Please enter a <em>valid</em>email address.'
     	}
     }
	}

		);