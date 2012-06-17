function handleMove(element, dx, leftXLimit, rightXLimit)
{
	var xStart = element.getStyle('left').toInt();

	var xDest = xStart + dx;



	xDest = Math.min(xDest, rightXLimit);
	xDest = Math.max(xDest, leftXLimit);

	var nextStyle = 'block';
	if (xDest == leftXLimit) {
		nextStyle  = 'none';
	}
	$$('#screenshots .next img').setStyle('display', nextStyle);

	var prevStyle = 'block';
	if (xDest == rightXLimit) {
		prevStyle  = 'none';
	}
	$$('#screenshots .prev img').setStyle('display', prevStyle);

	element.lastDest = xDest;

	if(element.fx == null){
		element.fx = new Fx.Morph(element, {duration: 'normal', transition: Fx.Transitions.Sine.easeInOut});
	}
	element.fx.start({
		'left': xDest
	});
}

window.addEvent('domready', function() {

	//Overlay functions. Add FadeIN/OUT later.
	$$('div.overlay').addEvents({
		show: function() {
			this.setStyle('display', 'block');
		},
		hide: function() {
			this.setStyle('display', 'none');
		}
	});

	//Close Buttons
	$$('div.overlay .closer').addEvent('click', function(event) {
		event.stop();
		this.getParent('div.overlay').fireEvent('hide');
	});

	//Signup Buttons
	$$('.signup_link').addEvent('click', function(event) {
		event.stop();
		$('signup_layer').fireEvent('show');
	});

	//Login Buttons
	$$('.login_link').addEvent('click', function(event) {
		event.stop();
		$('login_layer').fireEvent('show');
	});

	//Login Buttons
	$$('#screenshot_list li a').each(function(item, index){
		item.addEvent('click', function(event) {
			event.stop();
			galarie.show(index);
			$('screenshot_layer').fireEvent('show');
		});
	});


	if ($('screenshot_list')) {
		$('screenshot_list').addEvents({
			moveRight: function() {
				var windowSize = 300;
				var w = this.getStyle('width').toInt();
				var leftXLimit = windowSize - w;
				var rightXLimit = 0;
				handleMove(this, 98, leftXLimit, rightXLimit);
			},
			moveLeft: function() {
				var windowSize = 300;
				var w = this.getStyle('width').toInt();
				var leftXLimit = windowSize - w;
				var rightXLimit = 0;
				handleMove(this, -98, leftXLimit, rightXLimit);
			}
		});

		$$('*.dynamic_img').addEvents({
			'mouseenter': function() {
				this.addClass('over');
			},
			'mouseleave': function() {
				this.removeClass('over');
			}
		});

		$$('*.dynamic_btn').addEvents({
			'mouseenter': function() {
				this.addClass('over');
			},
			'mouseleave': function() {
				this.removeClass('over');
				this.removeClass('clicked');
			},
			'mousedown': function() {
				this.removeClass('over');
				this.addClass('clicked');
			},
			'mouseup': function() {
				this.removeClass('clicked');
				this.addClass('over');
			}
		});


		$$('#screenshots .next').addEvent('click', function(e) {
				$('screenshot_list').fireEvent('moveLeft');
			});
		$$('#screenshots .prev').addEvent('click', function(e) {
				$('screenshot_list').fireEvent('moveRight');
			});
	}

	t_minus();

});

Fx.Screenshots = new Class({

	Implements: [Events, Options],

	$current: 0,
	$length: 0,

	initialize: function(image, headline, comment, elements){
		var self = this;

		this.elements = elements;
		this.targetImg = $(image);
		this.targetHl = $(headline);
		this.targetDesc = $(comment);
		this.$length = this.elements.length;
	},

	showNext: function(){
		var index = this.$current + 1;
		if (index >= this.$length) index = 0;
		this.render(index);
	},

	showPrev: function(){
		var index = this.$current - 1;
		if (index < 0) index = this.$length - 1;
		this.render(index);
	},

	show: function(num){
		this.render(num);
		return this;
	},

	render: function(index){
		index = this.elements[index] != undefined ? index : 0;
		var elem = this.elements[index];
		this.targetImg.src = elem.img;
		this.targetHl.innerHTML = elem.hl;
		this.targetDesc.innerHTML = elem.desc;
		this.$current = index;
	}

});



function Popup(i, j, game_url)
{
	var layer = $('iframe_layer');

	$('frame_box').empty();
	$('frame_box').innerHTML = "<iframe frameborder=\"0\" id=\"Frame\" src=\"" + game_url + "manual.php?typ=" + i + "&s=" + j + "\" width=\"412\" height=\"440\" border=\"0\"></iframe>";

	$('iframe_layer').fireEvent('show');

	var windowSize = window.getSize();

	if (windowSize.x < 700 || windowSize.y < 700) {
		$$('#iframe_layer .overlay_content').setStyle('position', 'absolute');
		return true;
	} else {
		$$('#iframe_layer .overlay_content').setStyle('position', 'fixed');
		return false;
	}
}

function t_minus()
{
	// Zeit wird herunter gezaehlt
	for (i = 1;; i++)
	{
		myElement = document.getElementById("timer" + i);
		if (myElement != null)
		{
			sek = t_format1(myElement) - 1;
			if (sek < 0)
			{
				setTimeout("document.location.reload()", 1000);
			}
			else
			{
				sek = t_format2(sek);
				myElement.innerHTML = sek;
			}
		}
		else
		{
			break;
		}
	}
	setTimeout("t_minus()", 1000);
}

function t_format1(myElement)
{
	// 00:01:30 wird zu 90s umformatiert
	p = myElement.innerHTML.split(":");
	sek = p[0] * 3600 + p[1] * 60 + p[2] * 1;
	return sek;
}

function t_format2(s)
{
	// 90s wird zu 00:01:30 umformatiert
	if (s > -1)
	{
		stunden = Math.floor(s / 3600);
		minuten = Math.floor(s / 60) % 60;
		sekunden = s % 60;
		t = stunden + ":";
		if (minuten < 10)
		{
			t += "0";
		}
		t += minuten + ":";
		if (sekunden < 10)
		{
			t += "0";
		}
		t += sekunden;
	}
	else
	{
		t = "0:00:0?";
	}
	return t;
}



function showLayer(layer)
{
	closeLayers();
	var layerName = layer+'_layer';
	$(layerName).fireEvent('show');
}

function closeLayers()
{
	$$('div.overlay').fireEvent('hide');
}