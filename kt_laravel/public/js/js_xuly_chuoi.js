function change_text_to_int($text){
	var text=$text;
	text=text.split('.').join('');
	text=parseInt(text);
	
	return text;
}
function format_to_money(num) {
	var p = num.toFixed(2).split(".");
	return p[0].split("").reverse().reduce(function(acc, num, i, orig) {
		return  num=="-" ? acc : num + (i && !(i % 3) ? "." : "") + acc;
	}, "")+" đ";
}
function close_iframe(){
	jQuery('.switcher-wrap').toggleClass('active');
	// parent.document.getElementsByTagName( 'frameset' )[ 0 ].rows = '0,100' ;
}
