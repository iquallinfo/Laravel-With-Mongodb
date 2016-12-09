var root = location.protocol + '//' + location.host+"/iquall/b2blaravel/";
// Backbone.Events.on('login', function(){
	// var uname= $("#userName").val();
	// var password = $("#userPassword").val();
	// if(uname != "" && password !=""){
		// $.ajax({
		  // type: 'POST',
		  // url: $("#loginfrom").attr("action"),
		  // data: {username:uname,
		  // password:password,
		  // },
		  // success: function(data) {
			// var result = JSON.parse(data);
			// if(result['response'] == 'success'){
				// window.location.href  = result['redirectTo'];
			// }
			// else{
				// alert(result['response']);
			// }
		  // },
		  // error: function(){
			// alert("error");
		  // }
		// });
	// }
	// else{
		// alert("Please enter username and password");
		// return false;
	// }
// });
// Backbone.Events.on('fetchUsers', function(){
		// $.ajax({
		  // type: 'GET',
		  // url: $("#fetchurl").val(),
		  // success: function(data) {
			// $("#userdata").html(data);
		  // },
		  // error: function(){
			// alert("error");
		  // }
		// });
// });
_.extend(Backbone.Validation.callbacks, {
    valid: function (view, attr, selector) {
        var $el = view.$('[name=' + attr + ']'), 
            $group = $el.closest('.form-group');
        
        $group.removeClass('has-error');
        $group.find('.help-block').html('').addClass('hidden');
    },
    invalid: function (view, attr, error, selector) {
        var $el = view.$('[name=' + attr + ']'), 
            $group = $el.closest('.form-group');
        
        $group.addClass('has-error');
        $group.find('.help-block').html(error).removeClass('hidden');
    }
});
$(function () {
    var view = new UserRegistrationView({
        el: '#registerform',
        model: new FormValidation()
    });
});
/* ================================ Registration Page Model / View ========================================== */

// Define a View that uses our model
var UserRegistrationView = Backbone.View.extend({
    events: {
        'click #registerbtn': function (e) {
            e.preventDefault();
            this.signUp();
        },
		"blur #email": function (e) {
            e.preventDefault();
            this.checkEmail();
        }
    },
    initialize: function () {
        // This hooks up the validation
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
        Backbone.Validation.bind(this);
    },
    signUp: function () {
        var data = this.$el.serializeObject();

        this.model.set(data);
        
        // Check if the model is valid before saving
        // See: http://thedersen.com/projects/backbone-validation/#methods/isvalid
        if(this.model.isValid(true)){
			/* Inserting data in table Register  */
			  //this.model.save();
			  $.ajax({
			  type: 'POST',
			  url: $("#registerform").attr("action"),
			  data: data,
			  success: function(data) {
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					$("input[type='text'],input[type='email'],input[type='password']").val("");
					$("#success_reg").removeClass("hide");
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
    },
	
	checkEmail: function () {
        var email = $("#email").val();
		if(email != ""){
		$.ajax({
			  type: 'POST',
			  url: root+"checkemail",
			  data: {email:email},
			  success: function(data) {
				//var result = JSON.parse(data);
				if(data > 0){
					//window.location.href  = result['redirectTo'];
					$("#email").focus();
					$("#email").parent().parent().addClass("has-error");
					$("#email + .help-block").removeClass("hidden");
					$("#email + .help-block").html("Email Already Exists");
				}
				else{
					$("#email").parent().parent().removeClass("has-error");
					$("#email + .help-block").addClass("hidden");
					$("#email + .help-block").html("");
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
		}
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

// Define a model with some validation rules
var FormValidation = Backbone.Model.extend({
    defaults: {
        terms: false,
        gender: ''
    },
    validation: {
        firstname: {
            required: true
        },
		lastname: {
            required: true
        },
        email: {
            required: true
        },
        password: {
            minLength: 8
        },
        repeatPassword: {
            equalTo: 'password',
            msg: 'The passwords does not match'
        },
        country: {
          required: true
        },
        contact_no: {
            required: true,
			pattern: 'number'
        },
        address_1: {
            required: true
        },
		address_2: {
          required: true
        },
        city: {
            required: true
        },
        postcode: {
            required: true
        },
		state: {
            required: true
        },
		companyname: {
            required: true
        },
		companyloca: {
            required: true
        },
		companydesc: {
            required: true
        }
		
		
		
    }
});
// https://github.com/hongymagic/jQuery.serializeObject
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};

/* ================================ Registration Page Model / View End  ============================== */

/* ================================ Login Page Model / View ========================================== */

$(function () {
    var login = new LoginUserView({
        el: '#loginform',
        model: new loginModel()
    });
});

// Define a View that uses our model
var LoginUserView = Backbone.View.extend({
    events: {
        'click #loginbtn': function (e) {
            e.preventDefault();
            this.checklogin();
        },
    },
    initialize: function () {
        //Backbone.Validation.bind(this);
    },
    checklogin: function () {
		
			var email = $("#useremail").val();
			var pass = $("#password").val();
			if(email != "" && pass !=""){
			$.ajax({
				  type: 'POST',
				  url: root+"login",
				  data: {email:email,password:pass},
				  success: function(data) {
					var result = JSON.parse(data);
					if(result["response"] == "success"){
						window.location.href  = result['redirectTo'];
					}
					else{
						$("#errorlogin").html("Invalid Email and Password");
						$("#errorlogin").removeClass("hide");
					}
				  },
				  error: function(){
					alert("error");
				  }
				});
			}
			else{
				$("#errorlogin").html("Please enter Email and Password");
				$("#errorlogin").removeClass("hide");
			}
		
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

// Define a model with some validation rules
var loginModel = Backbone.Model.extend({
    defaults: {
        terms: false,
        gender: ''
    },
    validation: {
        useremail: {
            required: true,
			pattern:'email'
        },
		 userpassword: {
           required: true,
        }
    }
});


/* ================================ Login Page Model / View End ========================================== */


/* ================================ Edit Account Page Model / View ========================================== */

$(function () {
    var editaccount = new UserEditView({
        el: '#editacctform',
        model: new editFormValidation()
    });
});

// Define a View that uses our model
var UserEditView = Backbone.View.extend({
    events: {
        'click #editaccountbtn': function (e) {
            e.preventDefault();
            this.editAccount();
        },
		"blur #email": function (e) {
            e.preventDefault();
            this.checkEmail();
        }
    },
    initialize: function () {
        // This hooks up the validation
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
        Backbone.Validation.bind(this);
    },
    editAccount: function () {
		var companydesc =  CKEDITOR.instances['companydesc'].getData();
		$("#companydesc").html(companydesc);
		
		var data = this.$el.serializeObject();
		this.model.set(data);
        
        // Check if the model is valid before saving
        // See: http://thedersen.com/projects/backbone-validation/#methods/isvalid
        if(this.model.isValid(true)){
			/* Inserting data in table Register  */
			  //this.model.save();
			  $.ajax({
			  type: 'POST',
			  url: $("#editacctform").attr("action"),
			  data: data,
			  success: function(data) {
				  
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					//$("input[type='text'],input[type='email'],input[type='password']").val("");
					$("#success_reg").removeClass("hide");
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
		
    },
	
	checkEmail: function () {
        var email = $("#email").val();
		if(email != ""){
		$.ajax({
			  type: 'POST',
			  url: root+"checkemail",
			  data: {email:email},
			  success: function(data) {
				//var result = JSON.parse(data);
				if(data > 0){
					//window.location.href  = result['redirectTo'];
					$("#email").focus();
					$("#email").parent().parent().addClass("has-error");
					$("#email + .help-block").removeClass("hidden");
					$("#email + .help-block").html("Email Already Exists");
				}
				else{
					$("#email").parent().parent().removeClass("has-error");
					$("#email + .help-block").addClass("hidden");
					$("#email + .help-block").html("");
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
		}
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

// Define a model with some validation rules
var editFormValidation = Backbone.Model.extend({
    defaults: {
        terms: false,
        gender: ''
    },
    validation: {
        firstname: {
            required: true
        },
		lastname: {
            required: true
        },
        country: {
          required: true
        },
        contact_no: {
            required: true,
			pattern: 'number'
        },
        address_1: {
            required: true
        },
		address_2: {
          required: true
        },
        city: {
            required: true
        },
        postcode: {
            required: true
        },
		state: {
            required: true
        },
		companyname: {
            required: true
        },
		companyloca: {
            required: true
        },
		companydesc: {
            required: true
        }
		
		
		
    }
});
// https://github.com/hongymagic/jQuery.serializeObject
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};

/* ================================ Edit Account Page Model / View End  ============================== */



/* ================================ Add Product Page Model / View ========================================== */

$(function () {
    var addproduct = new AddProductView({
        el: '#addproduct',
        model: new productValidation()
    });
});

// Define a View that uses our model
var AddProductView = Backbone.View.extend({
    events: {
        'click #addprobtn': function (e) {
            e.preventDefault();
            this.addProduct();
        },
    },
    initialize: function () {
        // This hooks up the validation
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
        Backbone.Validation.bind(this);
    },
    addProduct: function (e) {
		var despdata =  CKEDITOR.instances['description'].getData();
		$("#description").html(despdata);
		var data = this.$el.serializeObject();
		this.model.set(data);
        
        // Check if the model is valid before saving
        if(this.model.isValid(true)){
		
			/* Inserting data in table products  */
			  $.ajax({
			  type: 'POST',
			  url: $("#addproduct").attr("action"),
			  data: data,
			  success: function(data) {
				  
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					$("input[type='text'],select").val("");
					CKEDITOR.instances['description'].setData("");
					$("#success_reg").removeClass("hide");
					
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
		
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

// Define a model with some validation rules
var productValidation = Backbone.Model.extend({
    defaults: {
        terms: false,
        gender: ''
    },
    validation: {
        productname: {
            required: true
        },
		price: {
            required: true,
			pattern:"number"
        },
		imagename: {
            required: true,
        },
        category: {
          required: true
        },
        description: {
            required: true,
        }
    }
});
// https://github.com/hongymagic/jQuery.serializeObject
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};

/* ================================ Add Product Page Model / View End  ============================== */


/* ================================ Edit Product Page Model / View ========================================== */

$(function () {
    var editproduct = new EditProductView({
        el: '#editproduct',
        model: new productValidation()
    });
});

// Define a View that uses our model
var EditProductView = Backbone.View.extend({
    events: {
        'click #editprobtn': function (e) {
            e.preventDefault();
            this.editProduct();
        },
    },
    initialize: function () {
        Backbone.Validation.bind(this);
    },
    editProduct: function (e) {
		var despdata =  CKEDITOR.instances['description'].getData();
		$("#description").html(despdata);
		var data = this.$el.serializeObject();
		this.model.set(data);
        
        // Check if the model is valid before saving
        if(this.model.isValid(true)){
		
			
			/* Edit data in table products  */
			  $.ajax({
			  type: 'POST',
			  url: $("#editproduct").attr("action"),
			  data: data,
			  success: function(data) {
				  
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					$("#success_reg").removeClass("hide");
					
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
		
    },
    
    remove: function() {
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

/* ================================ Edit Product Page Model / View End  ============================== */


/* ================================ Add Blog Page Model / View ========================================== */

$(function () {
    var addblog = new AddBlogView({
        el: '#addblog',
        model: new blogValidation()
    });
});

// Define a View that uses our model
var AddBlogView = Backbone.View.extend({
    events: {
        'click #addblogbtn': function (e) {
            e.preventDefault();
            this.addBlog();
        },
    },
    initialize: function () {
        // This hooks up the validation
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
        Backbone.Validation.bind(this);
    },
    addBlog: function (e) {
		var despdata =  CKEDITOR.instances['description'].getData();
		$("#description").html(despdata);
		var data = this.$el.serializeObject();
		this.model.set(data);
        
        // Check if the model is valid before saving
        if(this.model.isValid(true)){
		
			/* Inserting data in table products  */
			  $.ajax({
			  type: 'POST',
			  url: $("#addblog").attr("action"),
			  data: data,
			  success: function(data) {
				  
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					$("input[type='text'],select").val("");
					CKEDITOR.instances['description'].setData("");
					$("#success_reg").removeClass("hide");
					
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
		
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

// Define a model with some validation rules
var blogValidation = Backbone.Model.extend({
    defaults: {
        terms: false,
        gender: ''
    },
    validation: {
        blogtitle: {
            required: true
        },
        description: {
            required: true,
        }
    }
});
// https://github.com/hongymagic/jQuery.serializeObject
$.fn.serializeObject = function () {
    "use strict";
    var a = {}, b = function (b, c) {
        var d = a[c.name];
        "undefined" != typeof d && d !== null ? $.isArray(d) ? d.push(c.value) : a[c.name] = [d, c.value] : a[c.name] = c.value
    };
    return $.each(this.serializeArray(), b), a
};

/* ================================ Add Blog Page Model / View End  ============================== */


/* ================================ Edit Blog Page Model / View ========================================== */

$(function () {
    var editblog = new EditBlogView({
        el: '#editblog',
        model: new blogValidation()
    });
});

// Define a View that uses our model
var EditBlogView = Backbone.View.extend({
    events: {
        'click #editblogbtn': function (e) {
            e.preventDefault();
            this.editBlog();
        },
    },
    initialize: function () {
        // This hooks up the validation
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/validation-binding
        Backbone.Validation.bind(this);
    },
    editBlog: function (e) {
		var despdata =  CKEDITOR.instances['description'].getData();
		$("#description").html(despdata);
		var data = this.$el.serializeObject();
		this.model.set(data);
        
        // Check if the model is valid before saving
        if(this.model.isValid(true)){
		
			/* Inserting data in table products  */
			  $.ajax({
			  type: 'POST',
			  url: $("#editblog").attr("action"),
			  data: data,
			  success: function(data) {
				  
				var result = JSON.parse(data);
				if(result['response'] == 'success'){
					$("input[type='text'],select").val("");
					CKEDITOR.instances['description'].setData("");
					$("#success_reg").removeClass("hide");
					
					$("html, body").animate({ scrollTop: 0 }, "slow");
					//window.location.href  = result['redirectTo'];
				}
				else{
					alert(result['response']);
				}
			  },
			  error: function(){
				alert("error");
			  }
			});
			  
        }
		
    },
    
    remove: function() {
        // Remove the validation binding
        // See: http://thedersen.com/projects/backbone-validation/#using-form-model-validation/unbinding
        Backbone.Validation.unbind(this);
        return Backbone.View.prototype.remove.apply(this, arguments);
    },
});

/* ================================ Edit Blog Page Model / View End  ============================== */