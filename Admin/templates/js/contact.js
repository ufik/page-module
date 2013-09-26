function Contact(){
	this.init();
}

Contact.prototype = {
	
	init : function(){
		console.log('Contact script initialized.');
	}
};

$(function(){
	contact = new Contact();
});
