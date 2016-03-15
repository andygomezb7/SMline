$(document).ready(function(){
	ascend_time = 10000;
	//setTimeout(function(){ start_ascend(); }, ascend_time);
	$('body').click(function(e){
	if ($(e.target).closest('.inp_text').length == 0) {
		$('#register_form ul li .inp_text').each(function(){
			$(this).parent().children('.info').hide();
		});
	}
    });
	$('#register_form ul li .inp_text').focus(function(){
		$('#register_form ul li .inp_text').each(function(){
			$(this).parent().children('.info').hide();
		});
		register.helper($(this).attr('id'));
	});
	$('#register_form ul li select.inp_text').change(function(){
		register.helper($(this).attr('id'), 'comprobando...');
		register.check($(this).attr('id'), $(this).val());
	});
	$('#register_form ul li .inp_text').blur(function(){
		register.helper($(this).attr('id'), 'comprobando...');
		register.check($(this).attr('id'), $(this).val());
	});
	$('#register_form ul li .inp_text#i_nick').focus();
	
	$('input[name=regSubmit]').click(function(){
		register.send();
		$('#register_form ul li select.inp_text').each(function(){
			if($(this).attr('id') != 'i_nick' && $(this).attr('id') != 'i_email') register.check($(this).attr('id'), $(this).val());
		});
	});
});

function start_ascend(){
	var miembros_registrados = parseInt($('#miembros_registrados').text());
	var articulos_calificados = parseInt($('#articulos_calificados').text());
	miembros_registrados = miembros_registrados + Math.floor(Math.random()*5);
	articulos_calificados = articulos_calificados + Math.floor(Math.random()*5);
	$('#miembros_registrados').text(miembros_registrados);
	$('#articulos_calificados').text(articulos_calificados);
	setTimeout(function(){ start_ascend(); }, ascend_time);
}

var register = {
	banned_passwords: ["111111","11111111","112233","121212","123123","123456","1234567","12345678","131313","232323","654321","666666","696969","777777","7777777","8675309","987654","aaaaaa","abc123","abc123","abcdef","abgrtyu","access","access14","action","albert","alexis","amanda","amateur","andrea","andrew","angela","angels","animal","anthony","apollo","apples","arsenal","arthur","asdasd","asdasdasd","asdfgh","asdfgh","ashley","asshole","august","austin","badboy","bailey","banana","barney","baseball","batman","beaver","beavis","bigcock","bigdaddy","bigdick","bigdog","bigtits","birdie","bitches","biteme","blazer","blonde","blondes","blowjob","blowme","bond007","bonnie","booboo","booger","boomer","boston","brandon","brandy","braves","brazil","bronco","broncos","bulldog","buster","butter","butthead","calvin","camaro","cameron","canada","captain","carlos","carter","casper","charles","charlie","cheese","chelsea","chester","chicago","chicken","cocacola","coffee","college","compaq","computer","cookie","cooper","corvette","cowboy","cowboys","crystal","cumming","cumshot","dakota","dallas","daniel","danielle","debbie","dennis","diablo","diamond","doctor","doggie","dolphin","dolphins","donald","dragon","dreams","driver","eagle1","eagles","edward","einstein","erotic","extreme","falcon","fender","ferrari","firebird","fishing","florida","flower","flyers","football","forever","freddy","freedom","fucked","fucker","fucking","fuckme","fuckyou","gandalf","gateway","gators","gemini","george","giants","ginger","golden","golfer","gordon","gregory","guitar","gunner","hammer","hannah","hardcore","harley","heather","helpme","hentai","hockey","hooters","horney","hotdog","hunter","hunting","iceman","iloveyou","internet","iwantu","jackie","jackson","jaguar","jasmine","jasper","jennifer","jeremy","jessica","johnny","johnson","jordan","joseph","joshua","junior","justin","killer","knight","ladies","lakers","lauren","leather","legend","letmein","letmein","little","london","lovers","maddog","madison","maggie","magnum","marine","marlboro","martin","marvin","master","matrix","matthew","maverick","maxwell","melissa","member","mercedes","merlin","michael","michelle","mickey","midnight","miller","mistress","monica","monkey","monkey","monster","morgan","mother","mountain","muffin","murphy","mustang","naked","nascar","nathan","naughty","ncc1701","newyork","nicholas","nicole","nipple","nipples","oliver","orange","packers","panther","panties","parker","password","password","password1","password12","password123","patrick","peaches","peanut","pepper","phantom","phoenix","player","please","pookie","porsche","prince","princess","private","purple","pussies","qazwsx","qwerty","qwertyui","rabbit","rachel","racing","raiders","rainbow","ranger","rangers","rebecca","redskins","redsox","redwings","richard","robert","rocket","rosebud","runner","rush2112","russia","samantha","sammy","samson","sandra","saturn","scooby","scooter","scorpio","scorpion","secret","sexsex","shadow","shannon","shaved","sierra","silver","skippy","slayer","smokey","snoopy","soccer","sophie","spanky","sparky","spider","squirt","srinivas","startrek","starwars","steelers","steven","sticky","stupid","success","suckit","summer","sunshine","superman","surfer","swimming","sydney","taylor","tennis","teresa","tester","testing","theman","thomas","thunder","thx1138","tiffany","tigers","tigger","tomcat","topgun","toyota","travis","trouble","trustno1","tucker","turtle","twitter","united","vagina","victor","victoria","viking","voodoo","voyager","walter","warrior","welcome","whatever","william","willie","wilson","winner","winston","winter","wizard","xavier","xxxxxx","xxxxxxxx","yamaha","yankee","yankees","yellow","zxcvbn","zxcvbnm","zzzzzz"],
	banned_email_hosts: ["0clickemail.com","10minutemail.com","bofthew.com","jnxjn.com","pjjkp.com","prtnx.com","tyldd.com","uggsrock.com","akapost.com","anon-mail.de","anonbox.net","anonymbox.com","antispam.de","antispam24.de","b2cmail.de","dodgit.com","dodgit.com","dontsendmespam.de","dotman.de","e4ward.com","eintagsmail.de","emailgo.de","emailias.com","getonemail.com","guerrillamailblock.com","hushmail.com","instant-mail.de","sinnlos-mail.de","wegwerf-email-adressen.de","wegwerf-emails.de","jetable.org","kasmail.com","mail4trash.com","maileimer.de","mailexpire.com","mailinator.com","bobmail.info","mailin8r.com","mailinator.com","mailinator.net","mailinator2.com","safetymail.info","slopsbox.com","sogetthis.com","spamherelots.com","thisisnotmyrealemail.com","tradermail.info","zippymail.info","mailshell.com","mailtrash.net","makemetheking.com","mbx.cc","mytrashmail.com","mytrashmail.com","thankyou2010.com","trash2009.com","trashymail.com","nervmich.net","nervtmich.net","wegwerfadresse.de","ohaaa.de","privy-mail.de","quickinbox.com","safetypost.de","schmeissweg.tk","schrott-email.de","secretemail.de","senseless-entertainment.com","shieldemail.com","sneakemail.com","sofort-mail.de","spam.la","spamavert.com","spambog.com","3d-painting.com","bio-muesli.info","bio-muesli.net","cust.in","discardmail.com","discardmail.de","great-host.in","imails.info","kulturbetrieb.info","nomail2me.com","nospamthanks.info","recode.me","sandelf.de","spambog.com","spambog.de","spambog.ru","teewars.org","thanksnospam.info","spambox.us","spamcero.com","spamex.com","spamfree24.org","spamfree24.com","spamfree24.de","spamfree24.info","spamfree24.org","spamgourmet.com","spaml.de","spammotel.com","spamobox.com","spamspot.com","spamtrail.com","spoofmail.de","giantmail.de","nevermail.de","spoofmail.de","tempail.com","tempemail.net","tempinbox.com","dingbone.com","fudgerub.com","lookugly.com","smellfear.com","tempinbox.com","tempomail.fr","temporarily.de","temporaryinbox.com","thismail.net","topranklist.de","trash-mail.com","trash-mail.de","trashdevil.com","trashdevil.de","trashmail.net","twinmail.de","wasteland.rfc822.org","wegwerf-email.net","wegwerfemail.com","wegwerfemail.de","wh4f.org","whyspam.me","yopmail.com","youmailr.com","zehnminuten.de"],
	info: {
		i_nick: 'Ingresa el nick deseado',
		i_email: 'Ingresa tu direcci&oacute;n de correo electr&oacute;nico',
		i_pass: 'Ingresa una contrase&ntilde;a segura',
		i_repass: 'Vuelve a ingresar la contrase&ntilde;a',
		i_pais: 'Pa&iacute;s donde recides actualmente',
		i_sexo: 'G&eacute;nero al que perteneces',
		i_dia: 'D&iacute;a en que naciste',
		i_mes: 'Mes en que naciste',
		i_ano: 'A&ntilde;o en que naciste',
		recaptcha_response_field: 'Ingresa el c&oacute;digo de seguridad para comprobar que no eres un robot'
	},
	helper: function(name, val){
		var text = val?val:this.info[name];
		var obj = $('#'+name);
		obj.parent().children('#register_helper').removeClass('ok').removeClass('error').addClass('info').show();
		obj.parent().children('#register_helper').children('.text').html(text);
	},
	ok: function(name, text){
		var obj = $('#'+name);
		obj.parent().children('#register_helper').removeClass('error').removeClass('info').addClass('ok').show();
		obj.parent().children('#register_helper').children('.text').html(text);
	},
	error: function(name, text){
		var obj = $('#'+name);
		obj.parent().children('#register_helper').removeClass('ok').removeClass('info').addClass('error').show();
		obj.parent().children('#register_helper').children('.text').html(text);
	},
	check: function(name, value){
		switch(name){
			case 'i_nick':
				this.error(name, 'Este campo debe tener entre 3 y 16 caracteres');
				var reglet = /([a-zA-Z]+)/g;
				var reg = /^[-_a-zA-Z0-9]{3,16}$/g;
				if(value.length == 0){
					this.error(name, 'Ingresa un nick');
				}else if(value.length < 3 || value.length > 16){
					this.error(name, 'Este campo debe tener entre 3 y 16 caracteres');
				}else if(reglet.test(value) === false){
					this.error(name, 'Solo caracteres alfanum&eacute;ricos y guiones');
				}else if(reg.test(value) === false){
					this.error(name, 'Solo caracteres alfanum&eacute;ricos y guiones');
				}else{
					$.ajax({
						type: 'POST',
						url: '/ajax/register/check',
						data: 'r_nick=' + value + '&r_email=0',
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									register.error(name, h.substring(3));
								break;
								case '1':
									register.ok(name, 'El nick est&aacute; disponinle');
								break;
							}
						},
						error: function(){
							register.ok(name, 'El nick est&aacute; disponinle');
						}
					});
				}
			break;
			case 'i_email':
				var reg = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;;
				if(value == ''){
					this.error(name, 'Ingresa tu email');
				}else if(reg.test(value) === false){
					this.error(name, 'Este email no es v&aacute;lido');
				}else if($.inArray(value.substr(value.indexOf('@')+1) , this.banned_email_hosts) != -1) {
					this.error(name, 'Este servidor de emails no est&aacute; permitido');
				}else{
					$.ajax({
						type: 'POST',
						url: '/ajax/register/check',
						data: 'r_email=' + value + '&r_nick=0',
						success: function(h){
							switch(h.charAt(0)){
								case '0':
									register.error(name, h.substring(3));
								break;
								case '1':
									register.ok(name, 'El email est&aacute; disponinle');
								break;
							}
						},
						error: function(){
							register.ok(name, 'El email est&aacute; disponinle');
						}
					});
				}
			break;
			case 'i_pass':
			var reg = /^[^"']{6,20}$/g;
				if(value.length == 0){
					this.error(name, 'Ingresa una contrase&ntilde;a');
				}else if(value == $('input[name=r_nick]').val()) {
					this.error(name, 'No puede ser igual a tu nick');
				}else if(value.length < 6 || value.length > 20){
					this.error(name, 'Este campo debe tener entre 6 y 20 caracteres');
				}else if($.inArray(value , this.banned_passwords) != -1){
					this.error(name, 'Esta contrase&ntilde;a no es segura');
				}else{
					this.ok(name, 'La contrase&ntilde;a es segura');
				}
			break;
			case 'i_repass':
				if(value != $('input[name=r_pass]').val()){
					this.error(name, 'Las contrase&ntilde;as no coinciden');
				}else if(value != ''){
					this.ok(name, 'Las contrase&ntilde;as coinciden');
				}
			break;
			case 'i_pais':
				if(value == '-1'){
					this.error(name, 'Selecciona el pa&iacute;s');
				}else if(value.length != 2){
					this.error(name, 'El pa&iacute;s seleccionado no existe');
				}else{
					this.ok(name, 'Ok');
				}
			break;
			case 'i_sexo':
				if(value == '-1'){
					this.error(name, 'Selecciona el sexo al que perteneces');
				}else if(value != 0 && value != 1){
					this.error(name, 'El sexo seleccionado no es v&aacute;lido');
				}else{
					this.ok(name, 'Ok');
				}
			break;
			case 'i_dia':
				if(value == '-1'){
					this.error(name, 'Selecciona el d&iacute;a');
				}else if(value > 31 || value < 1){
					this.error(name, 'Solo existen 31 d&iacute;as al mes');
				}else if($('#i_mes').val() == '-1'){
					this.helper(name, 'Selecciona el mes');
				}else if($('#i_ano').val() == '-1'){
					this.helper(name, 'Selecciona el a&ntilde;o');
				}else{
					this.ok(name, 'Ok');
				}
			break;
			case 'i_mes':
				if(value == '-1'){
					this.error(name, 'Selecciona el mes');
				}else if(value > 12 || value < 1){
					this.error(name, 'Solo existen 12 meses');
				}else if($('#i_dia').val() == '-1'){
					this.helper(name, 'Selecciona el d&iacute;a');
				}else if($('#i_ano').val() == '-1'){
					this.helper(name, 'Selecciona el a&ntilde;o');
				}else{
					this.ok(name, 'Ok');
				}
			break;
			case 'i_ano':
				if(value == '-1'){
					this.error(name, 'Selecciona el a&ntilde;o');
				}else if(value.length != 4){
					this.error(name, 'El a&ntilde;o seleccionado no es v&aacute;lido');
				}else if($('#i_mes').val() == '-1'){
					this.helper(name, 'Selecciona el mes');
				}else if($('#i_dia').val() == '-1'){
					this.helper(name, 'Selecciona el d&iacute;a');
				}else{
					this.ok(name, 'Ok');
				}
			break;
			case 'recaptcha_response_field':
				if(value == ''){
					this.error(name, 'Introduce el c&oacute;digo');
				}else{
					this.ok(name, 'Ok');
				}
			break;
		}
	},
	send: function(){
		no_validas = $('#register_helper.info').length+$('#register_helper.error').length;
		if(no_validas >= 1) return;
		$('#register_form ul li input.inp_text').each(function(){
			if($(this).val() == '') return;
		});
		$('#register_form ul li select.inp_text').each(function(){
			if($(this).val() == '-1') return;
		});
		$('#register_left, #register_right').css('opacity', '0.3');
		var params = $('#register_form input[name], #register_form select[name]');
		$.ajax({
			type: 'POST',
			url: '/ajax/register/send',
			dataType: 'json',
			data: $.param(params),
			success: function(h){
				if(h.length > 0){
					for(var i = 0; i < h.length; i++){
						register.error(h[i]['k'], h[i]['d']);
						Recaptcha.reload();
					}
				}else{
					//mydialog.alert('Listo!', h['data']);
					$('#register_left h2').html(h['title']);
					$('#register_left p').html(h['data']);
					$('#register_form, #register_left hr').hide();
				}
			},
			complete: function(){
				$('#register_left, #register_right').css('opacity', '1');
			},
			error: function(){
				$('#register_left, #register_right').css('opacity', '1');
				mydialog.error_500("register.send()");
			}
		});
	}
	
}