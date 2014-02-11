// Part of "Top Comments" WordPress plugin. See top-comments.php for license notice.

var topcKarma = {

	I : function(a) {
		return document.getElementById(a);
	},

	opacity : function(el, n) {
		if ( undefined == el.style.opacity )
			el.style.filter = 'alpha(opacity='+n*100+')';
		else el.style.opacity = ''+n;
	},

	init : function() {
		var buttons = document.getElementsByTagName('span');

		for ( i = 0; i < buttons.length; i++ ) {
			if ( 'top-comments-button' == buttons[i].className )
				buttons[i].style.display = 'inline';
		}
	},

	up : function(n) {
		var t = this, p = t.I('up-'+n), url = t.url+'/wp-load.php?topcid='+n+'&topcwphc='+t.topc_wphc();

		t.opacity(p, 0.5);

		t.send({
			type : 'GET',
			url : url,
			success : function(text) {
					var res = text.split('|'), t = topcKarma, b, k;

					if ( res[0] == 'done' ) {
						res = res.slice(0,3);
						if ( parseInt(res[1]) && (b = t.I('up-'+res[1])) ) {
							// Hide the button and update the rating
							b.style.display = 'none';
							if ( parseInt(res[2]) > 0 && (k = t.I('karma-'+res[1])) )
								k.innerHTML = res[2];
						} else {
							alert(t.errors[0]);
							t.opacity(p, 1);
						}
					} else if ( res[0] == 'error' ) {
						res = res.slice(0,2);
						alert(res[1]);
						t.opacity(p, 1);
					}
				},
			error : function(type) {
					var err = ( 'GENERAL' == type ) ? topcKarma.errors[0] : topcKarma.errors[1];
					alert(err);
					t.opacity(p, 1);
				}
		});
	},

	send : function(o) {
		var x, t, w = window, c = 0;

		// Default settings
		o.scope = o.scope || this;
		o.success_scope = o.success_scope || o.scope;
		o.error_scope = o.error_scope || o.scope;
		o.async = o.async === false ? false : true;
		o.data = o.data || '';

		function get(s) {
			x = 0;

			try {
				x = new ActiveXObject(s);
			} catch (ex) {
			}

			return x;
		};

		x = w.XMLHttpRequest ? new XMLHttpRequest() : get('Microsoft.XMLHTTP') || get('Msxml2.XMLHTTP');

		if (x) {
			if (x.overrideMimeType)
				x.overrideMimeType(o.content_type);

			x.open(o.type || (o.data ? 'POST' : 'GET'), o.url, o.async);

			if (o.content_type)
				x.setRequestHeader('Content-Type', o.content_type);

			x.send(o.data);

			function ready() {
				if (!o.async || x.readyState == 4 || c++ > 10000) {
					if (o.success && c < 10000 && x.status == 200)
						o.success.call(o.success_scope, '' + x.responseText, x, o);
					else if (o.error)
						o.error.call(o.error_scope, c > 10000 ? 'TIMED_OUT' : 'GENERAL', x, o);

					x = null;
				} else
					w.setTimeout(ready, 10);
			};

			// Syncronous request
			if (!o.async)
				return ready();

			// Wait for response, onReadyStateChange can not be used since it leaks memory in IE
			t = w.setTimeout(ready, 10);
		}
	}
};
topcKarma.init();
