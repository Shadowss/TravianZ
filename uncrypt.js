var MooTools = {
	version: "1.2.5",
	build: "008d8f0f2fcc2044e54fdd3635341aaab274e757"
};

var Native = function (l) {
		l = l || {};
		var a = l.name;
		var j = l.legacy;
		var b = l.protect;
		var c = l.implement;
		var i = l.generics;
		var g = l.initialize;
		var h = l.afterImplement ||
		function () {};
		var d = g || j;
		i = i !== false;
		d.constructor = Native;
		d.$family = {
			name: "native"
		};
		if (j && g) {
			d.prototype = j.prototype
		}
		d.prototype.constructor = d;
		if (a) {
			var f = a.toLowerCase();
			d.prototype.$family = {
				name: f
			};
			Native.typize(d, f)
		}
		var k = function (o, m, p, n) {
				if (!b || n || !o.prototype[m]) {
					o.prototype[m] = p
				}
				if (i) {
					Native.genericize(o, m, b)
				}
				h.call(o, m, p);
				return o
			};
		d.alias = function (o, m, q) {
			if (typeof o == "string") {
				var p = this.prototype[o];
				if ((o = p)) {
					return k(this, m, o, q)
				}
			}
			for (var n in o) {
				this.alias(n, o[n], m)
			}
			return this
		};
		d.implement = function (n, m, q) {
			if (typeof n == "string") {
				return k(this, n, m, q)
			}
			for (var o in n) {
				k(this, o, n[o], m)
			}
			return this
		};
		if (c) {
			d.implement(c)
		}
		return d
	};
Native.genericize = function (b, c, a) {
	if ((!a || !b[c]) && typeof b.prototype[c] == "function") {
		b[c] = function () {
			var d = Array.prototype.slice.call(arguments);
			return b.prototype[c].apply(d.shift(), d)
		}
	}
};
Native.implement = function (d, c) {
	for (var b = 0, a = d.length; b < a; b++) {
		d[b].implement(c)
	}
};
Native.typize = function (a, b) {
	if (!a.type) {
		a.type = function (c) {
			return ($type(c) === b)
		}
	}
};
(function () {
	var a = {
		Array: Array,
		Date: Date,
		Function: Function,
		Number: Number,
		RegExp: RegExp,
		String: String
	};
	for (var j in a) {
		new Native({
			name: j,
			initialize: a[j],
			protect: true
		})
	}
	var d = {
		"boolean": Boolean,
		"native": Native,
		object: Object
	};
	for (var c in d) {
		Native.typize(d[c], c)
	}
	var h = {
		Array: ["concat", "indexOf", "join", "lastIndexOf", "pop", "push", "reverse", "shift", "slice", "sort", "splice", "toString", "unshift", "valueOf"],
		String: ["charAt", "charCodeAt", "concat", "indexOf", "lastIndexOf", "match", "replace", "search", "slice", "split", "substr", "substring", "toLowerCase", "toUpperCase", "valueOf"]
	};
	for (var f in h) {
		for (var b = h[f].length; b--;) {
			Native.genericize(a[f], h[f][b], true)
		}
	}
})();
var Hash = new Native({
	name: "Hash",
	initialize: function (a) {
		if ($type(a) == "hash") {
			a = $unlink(a.getClean())
		}
		for (var b in a) {
			this[b] = a[b]
		}
		return this
	}
});
Hash.implement({
	forEach: function (b, c) {
		for (var a in this) {
			if (this.hasOwnProperty(a)) {
				b.call(c, this[a], a, this)
			}
		}
	},
	getClean: function () {
		var b = {};
		for (var a in this) {
			if (this.hasOwnProperty(a)) {
				b[a] = this[a]
			}
		}
		return b
	},
	getLength: function () {
		var b = 0;
		for (var a in this) {
			if (this.hasOwnProperty(a)) {
				b++
			}
		}
		return b
	}
});
Hash.alias("forEach", "each");
Array.implement({
	forEach: function (c, d) {
		for (var b = 0, a = this.length; b < a; b++) {
			c.call(d, this[b], b, this)
		}
	}
});
Array.alias("forEach", "each");

function $A(b) {
	if (b.item) {
		var a = b.length,
			c = new Array(a);
		while (a--) {
			c[a] = b[a]
		}
		return c
	}
	return Array.prototype.slice.call(b)
}
function $arguments(a) {
	return function () {
		return arguments[a]
	}
}
function $chk(a) {
	return !!(a || a === 0)
}
function $clear(a) {
	clearTimeout(a);
	clearInterval(a);
	return null
}
function $defined(a) {
	return (a != undefined)
}
function $each(c, b, d) {
	var a = $type(c);
	((a == "arguments" || a == "collection" || a == "array") ? Array : Hash).each(c, b, d)
}
function $empty() {}
function $extend(c, a) {
	for (var b in (a || {})) {
		c[b] = a[b]
	}
	return c
}
function $H(a) {
	return new Hash(a)
}
function $lambda(a) {
	return ($type(a) == "function") ? a : function () {
		return a
	}
}
function $merge() {
	var a = Array.slice(arguments);
	a.unshift({});
	return $mixin.apply(null, a)
}
function $mixin(f) {
	for (var d = 1, a = arguments.length; d < a; d++) {
		var b = arguments[d];
		if ($type(b) != "object") {
			continue
		}
		for (var c in b) {
			var h = b[c],
				g = f[c];
			f[c] = (g && $type(h) == "object" && $type(g) == "object") ? $mixin(g, h) : $unlink(h)
		}
	}
	return f
}
function $pick() {
	for (var b = 0, a = arguments.length; b < a; b++) {
		if (arguments[b] != undefined) {
			return arguments[b]
		}
	}
	return null
}
function $random(b, a) {
	return Math.floor(Math.random() * (a - b + 1) + b)
}
function $splat(b) {
	var a = $type(b);
	return (a) ? ((a != "array" && a != "arguments") ? [b] : b) : []
}
var $time = Date.now ||
function () {
	return +new Date
};

function $try() {
	for (var b = 0, a = arguments.length; b < a; b++) {
		try {
			return arguments[b]()
		} catch (c) {}
	}
	return null
}
function $type(a) {
	if (a == undefined) {
		return false
	}
	if (a.$family) {
		return (a.$family.name == "number" && !isFinite(a)) ? false : a.$family.name
	}
	if (a.nodeName) {
		switch (a.nodeType) {
		case 1:
			return "element";
		case 3:
			return (/\S/).test(a.nodeValue) ? "textnode" : "whitespace"
		}
	} else {
		if (typeof a.length == "number") {
			if (a.callee) {
				return "arguments"
			} else {
				if (a.item) {
					return "collection"
				}
			}
		}
	}
	return typeof a
}
function $unlink(c) {
	var b;
	switch ($type(c)) {
	case "object":
		b = {};
		for (var f in c) {
			b[f] = $unlink(c[f])
		}
		break;
	case "hash":
		b = new Hash(c);
		break;
	case "array":
		b = [];
		for (var d = 0, a = c.length; d < a; d++) {
			b[d] = $unlink(c[d])
		}
		break;
	default:
		return c
	}
	return b
}
Array.implement({
	every: function (c, d) {
		for (var b = 0, a = this.length; b < a; b++) {
			if (!c.call(d, this[b], b, this)) {
				return false
			}
		}
		return true
	},
	filter: function (d, f) {
		var c = [];
		for (var b = 0, a = this.length; b < a; b++) {
			if (d.call(f, this[b], b, this)) {
				c.push(this[b])
			}
		}
		return c
	},
	clean: function () {
		return this.filter($defined)
	},
	indexOf: function (c, d) {
		var a = this.length;
		for (var b = (d < 0) ? Math.max(0, a + d) : d || 0; b < a; b++) {
			if (this[b] === c) {
				return b
			}
		}
		return -1
	},
	map: function (d, f) {
		var c = [];
		for (var b = 0, a = this.length; b < a; b++) {
			c[b] = d.call(f, this[b], b, this)
		}
		return c
	},
	some: function (c, d) {
		for (var b = 0, a = this.length; b < a; b++) {
			if (c.call(d, this[b], b, this)) {
				return true
			}
		}
		return false
	},
	associate: function (c) {
		var d = {},
			b = Math.min(this.length, c.length);
		for (var a = 0; a < b; a++) {
			d[c[a]] = this[a]
		}
		return d
	},
	link: function (c) {
		var a = {};
		for (var f = 0, b = this.length; f < b; f++) {
			for (var d in c) {
				if (c[d](this[f])) {
					a[d] = this[f];
					delete c[d];
					break
				}
			}
		}
		return a
	},
	contains: function (a, b) {
		return this.indexOf(a, b) != -1
	},
	extend: function (c) {
		for (var b = 0, a = c.length; b < a; b++) {
			this.push(c[b])
		}
		return this
	},
	getLast: function () {
		return (this.length) ? this[this.length - 1] : null
	},
	getRandom: function () {
		return (this.length) ? this[$random(0, this.length - 1)] : null
	},
	include: function (a) {
		if (!this.contains(a)) {
			this.push(a)
		}
		return this
	},
	combine: function (c) {
		for (var b = 0, a = c.length; b < a; b++) {
			this.include(c[b])
		}
		return this
	},
	erase: function (b) {
		for (var a = this.length; a--; a) {
			if (this[a] === b) {
				this.splice(a, 1)
			}
		}
		return this
	},
	empty: function () {
		this.length = 0;
		return this
	},
	flatten: function () {
		var d = [];
		for (var b = 0, a = this.length; b < a; b++) {
			var c = $type(this[b]);
			if (!c) {
				continue
			}
			d = d.concat((c == "array" || c == "collection" || c == "arguments") ? Array.flatten(this[b]) : this[b])
		}
		return d
	},
	hexToRgb: function (b) {
		if (this.length != 3) {
			return null
		}
		var a = this.map(function (c) {
			if (c.length == 1) {
				c += c
			}
			return c.toInt(16)
		});
		return (b) ? a : "rgb(" + a + ")"
	},
	rgbToHex: function (d) {
		if (this.length < 3) {
			return null
		}
		if (this.length == 4 && this[3] == 0 && !d) {
			return "transparent"
		}
		var b = [];
		for (var a = 0; a < 3; a++) {
			var c = (this[a] - 0).toString(16);
			b.push((c.length == 1) ? "0" + c : c)
		}
		return (d) ? b : "#" + b.join("")
	}
});
String.implement({
	test: function (a, b) {
		return ((typeof a == "string") ? new RegExp(a, b) : a).test(this)
	},
	contains: function (a, b) {
		return (b) ? (b + this + b).indexOf(b + a + b) > -1 : this.indexOf(a) > -1
	},
	trim: function () {
		return this.replace(/^\s+|\s+$/g, "")
	},
	clean: function () {
		return this.replace(/\s+/g, " ").trim()
	},
	camelCase: function () {
		return this.replace(/-\D/g, function (a) {
			return a.charAt(1).toUpperCase()
		})
	},
	hyphenate: function () {
		return this.replace(/[A-Z]/g, function (a) {
			return ("-" + a.charAt(0).toLowerCase())
		})
	},
	capitalize: function () {
		return this.replace(/\b[a-z]/g, function (a) {
			return a.toUpperCase()
		})
	},
	escapeRegExp: function () {
		return this.replace(/([-.*+?^${}()|[\]\/\\])/g, "\\$1")
	},
	toInt: function (a) {
		return parseInt(this, a || 10)
	},
	toFloat: function () {
		return parseFloat(this)
	},
	hexToRgb: function (b) {
		var a = this.match(/^#?(\w{1,2})(\w{1,2})(\w{1,2})$/);
		return (a) ? a.slice(1).hexToRgb(b) : null
	},
	rgbToHex: function (b) {
		var a = this.match(/\d{1,3}/g);
		return (a) ? a.rgbToHex(b) : null
	},
	stripScripts: function (b) {
		var a = "";
		var c = this.replace(/<script[^>]*>([\s\S]*?)<\/script>/gi, function () {
			a += arguments[1] + "\n";
			return ""
		});
		if (b === true) {
			$exec(a)
		} else {
			if ($type(b) == "function") {
				b(a, c)
			}
		}
		return c
	},
	substitute: function (a, b) {
		return this.replace(b || (/\\?\{([^{}]+)\}/g), function (d, c) {
			if (d.charAt(0) == "\\") {
				return d.slice(1)
			}
			return (a[c] != undefined) ? a[c] : ""
		})
	}
});
try {
	delete Function.prototype.bind
} catch (e) {}
Function.implement({
	extend: function (a) {
		for (var b in a) {
			this[b] = a[b]
		}
		return this
	},
	create: function (b) {
		var a = this;
		b = b || {};
		return function (d) {
			var c = b.arguments;
			c = (c != undefined) ? $splat(c) : Array.slice(arguments, (b.event) ? 1 : 0);
			if (b.event) {
				c = [d || window.event].extend(c)
			}
			var f = function () {
					return a.apply(b.bind || null, c)
				};
			if (b.delay) {
				return setTimeout(f, b.delay)
			}
			if (b.periodical) {
				return setInterval(f, b.periodical)
			}
			if (b.attempt) {
				return $try(f)
			}
			return f()
		}
	},
	run: function (a, b) {
		return this.apply(b, $splat(a))
	},
	pass: function (a, b) {
		return this.create({
			bind: b,
			arguments: a
		})
	},
	bind: function (b, a) {
		return this.create({
			bind: b,
			arguments: a
		})
	},
	bindWithEvent: function (b, a) {
		return this.create({
			bind: b,
			arguments: a,
			event: true
		})
	},
	attempt: function (a, b) {
		return this.create({
			bind: b,
			arguments: a,
			attempt: true
		})()
	},
	delay: function (b, c, a) {
		return this.create({
			bind: c,
			arguments: a,
			delay: b
		})()
	},
	periodical: function (c, b, a) {
		return this.create({
			bind: b,
			arguments: a,
			periodical: c
		})()
	}
});
Number.implement({
	limit: function (b, a) {
		return Math.min(a, Math.max(b, this))
	},
	round: function (a) {
		a = Math.pow(10, a || 0);
		return Math.round(this * a) / a
	},
	times: function (b, c) {
		for (var a = 0; a < this; a++) {
			b.call(c, a, this)
		}
	},
	toFloat: function () {
		return parseFloat(this)
	},
	toInt: function (a) {
		return parseInt(this, a || 10)
	}
});
Number.alias("times", "each");
(function (b) {
	var a = {};
	b.each(function (c) {
		if (!Number[c]) {
			a[c] = function () {
				return Math[c].apply(null, [this].concat($A(arguments)))
			}
		}
	});
	Number.implement(a)
})(["abs", "acos", "asin", "atan", "atan2", "ceil", "cos", "exp", "floor", "log", "max", "min", "pow", "sin", "sqrt", "tan"]);
Hash.implement({
	has: Object.prototype.hasOwnProperty,
	keyOf: function (b) {
		for (var a in this) {
			if (this.hasOwnProperty(a) && this[a] === b) {
				return a
			}
		}
		return null
	},
	hasValue: function (a) {
		return (Hash.keyOf(this, a) !== null)
	},
	extend: function (a) {
		Hash.each(a || {}, function (c, b) {
			Hash.set(this, b, c)
		}, this);
		return this
	},
	combine: function (a) {
		Hash.each(a || {}, function (c, b) {
			Hash.include(this, b, c)
		}, this);
		return this
	},
	erase: function (a) {
		if (this.hasOwnProperty(a)) {
			delete this[a]
		}
		return this
	},
	get: function (a) {
		return (this.hasOwnProperty(a)) ? this[a] : null
	},
	set: function (a, b) {
		if (!this[a] || this.hasOwnProperty(a)) {
			this[a] = b
		}
		return this
	},
	empty: function () {
		Hash.each(this, function (b, a) {
			delete this[a]
		}, this);
		return this
	},
	include: function (a, b) {
		if (this[a] == undefined) {
			this[a] = b
		}
		return this
	},
	map: function (b, c) {
		var a = new Hash;
		Hash.each(this, function (f, d) {
			a.set(d, b.call(c, f, d, this))
		}, this);
		return a
	},
	filter: function (b, c) {
		var a = new Hash;
		Hash.each(this, function (f, d) {
			if (b.call(c, f, d, this)) {
				a.set(d, f)
			}
		}, this);
		return a
	},
	every: function (b, c) {
		for (var a in this) {
			if (this.hasOwnProperty(a) && !b.call(c, this[a], a)) {
				return false
			}
		}
		return true
	},
	some: function (b, c) {
		for (var a in this) {
			if (this.hasOwnProperty(a) && b.call(c, this[a], a)) {
				return true
			}
		}
		return false
	},
	getKeys: function () {
		var a = [];
		Hash.each(this, function (c, b) {
			a.push(b)
		});
		return a
	},
	getValues: function () {
		var a = [];
		Hash.each(this, function (b) {
			a.push(b)
		});
		return a
	},
	toQueryString: function (a) {
		var b = [];
		Hash.each(this, function (g, f) {
			if (a) {
				f = a + "[" + f + "]"
			}
			var d;
			switch ($type(g)) {
			case "object":
				d = Hash.toQueryString(g, f);
				break;
			case "array":
				var c = {};
				g.each(function (j, h) {
					c[h] = j
				});
				d = Hash.toQueryString(c, f);
				break;
			default:
				d = f + "=" + encodeURIComponent(g)
			}
			if (g != undefined) {
				b.push(d)
			}
		});
		return b.join("&")
	}
});
Hash.alias({
	keyOf: "indexOf",
	hasValue: "contains"
});

function Class(b) {
	if (b instanceof Function) {
		b = {
			initialize: b
		}
	}
	var a = function () {
			Object.reset(this);
			if (a._prototyping) {
				return this
			}
			this._current = $empty;
			var c = (this.initialize) ? this.initialize.apply(this, arguments) : this;
			delete this._current;
			delete this.caller;
			return c
		}.extend(this);
	a.implement(b);
	a.constructor = Class;
	a.prototype.constructor = a;
	return a
}
Function.prototype.protect = function () {
	this._protected = true;
	return this
};
Object.reset = function (a, c) {
	if (c == null) {
		for (var f in a) {
			Object.reset(a, f)
		}
		return a
	}
	delete a[c];
	switch ($type(a[c])) {
	case "object":
		var d = function () {};
		d.prototype = a[c];
		var b = new d;
		a[c] = Object.reset(b);
		break;
	case "array":
		a[c] = $unlink(a[c]);
		break
	}
	return a
};
new Native({
	name: "Class",
	initialize: Class
}).extend({
	instantiate: function (b) {
		b._prototyping = true;
		var a = new b;
		delete b._prototyping;
		return a
	},
	wrap: function (a, b, c) {
		if (c._origin) {
			c = c._origin
		}
		return function () {
			if (c._protected && this._current == null) {
				throw new Error('The method "' + b + '" cannot be called.')
			}
			var f = this.caller,
				g = this._current;
			this.caller = g;
			this._current = arguments.callee;
			var d = c.apply(this, arguments);
			this._current = g;
			this.caller = f;
			return d
		}.extend({
			_owner: a,
			_origin: c,
			_name: b
		})
	}
});
Class.implement({
	implement: function (a, d) {
		if ($type(a) == "object") {
			for (var f in a) {
				this.implement(f, a[f])
			}
			return this
		}
		var g = Class.Mutators[a];
		if (g) {
			d = g.call(this, d);
			if (d == null) {
				return this
			}
		}
		var c = this.prototype;
		switch ($type(d)) {
		case "function":
			if (d._hidden) {
				return this
			}
			c[a] = Class.wrap(this, a, d);
			break;
		case "object":
			var b = c[a];
			if ($type(b) == "object") {
				$mixin(b, d)
			} else {
				c[a] = $unlink(d)
			}
			break;
		case "array":
			c[a] = $unlink(d);
			break;
		default:
			c[a] = d
		}
		return this
	}
});
Class.Mutators = {
	Extends: function (a) {
		this.parent = a;
		this.prototype = Class.instantiate(a);
		this.implement("parent", function () {
			var b = this.caller._name,
				c = this.caller._owner.parent.prototype[b];
			if (!c) {
				throw new Error('The method "' + b + '" has no parent.')
			}
			return c.apply(this, arguments)
		}.protect())
	},
	Implements: function (a) {
		$splat(a).each(function (b) {
			if (b instanceof Function) {
				b = Class.instantiate(b)
			}
			this.implement(b)
		}, this)
	}
};
var Chain = new Class({
	$chain: [],
	chain: function () {
		this.$chain.extend(Array.flatten(arguments));
		return this
	},
	callChain: function () {
		return (this.$chain.length) ? this.$chain.shift().apply(this, arguments) : false
	},
	clearChain: function () {
		this.$chain.empty();
		return this
	}
});
var Events = new Class({
	$events: {},
	addEvent: function (c, b, a) {
		c = Events.removeOn(c);
		if (b != $empty) {
			this.$events[c] = this.$events[c] || [];
			this.$events[c].include(b);
			if (a) {
				b.internal = true
			}
		}
		return this
	},
	addEvents: function (a) {
		for (var b in a) {
			this.addEvent(b, a[b])
		}
		return this
	},
	fireEvent: function (c, b, a) {
		c = Events.removeOn(c);
		if (!this.$events || !this.$events[c]) {
			return this
		}
		this.$events[c].each(function (d) {
			d.create({
				bind: this,
				delay: a,
				"arguments": b
			})()
		}, this);
		return this
	},
	removeEvent: function (b, a) {
		b = Events.removeOn(b);
		if (!this.$events[b]) {
			return this
		}
		if (!a.internal) {
			this.$events[b].erase(a)
		}
		return this
	},
	removeEvents: function (c) {
		var d;
		if ($type(c) == "object") {
			for (d in c) {
				this.removeEvent(d, c[d])
			}
			return this
		}
		if (c) {
			c = Events.removeOn(c)
		}
		for (d in this.$events) {
			if (c && c != d) {
				continue
			}
			var b = this.$events[d];
			for (var a = b.length; a--; a) {
				this.removeEvent(d, b[a])
			}
		}
		return this
	}
});
Events.removeOn = function (a) {
	return a.replace(/^on([A-Z])/, function (b, c) {
		return c.toLowerCase()
	})
};
var Options = new Class({
	setOptions: function () {
		this.options = $merge.run([this.options].extend(arguments));
		if (!this.addEvent) {
			return this
		}
		for (var a in this.options) {
			if ($type(this.options[a]) != "function" || !(/^on[A-Z]/).test(a)) {
				continue
			}
			this.addEvent(a, this.options[a]);
			delete this.options[a]
		}
		return this
	}
});
var Browser = $merge({
	Engine: {
		name: "unknown",
		version: 0
	},
	Platform: {
		name: (window.orientation != undefined) ? "ipod" : (navigator.platform.match(/mac|win|linux/i) || ["other"])[0].toLowerCase()
	},
	Features: {
		xpath: !! (document.evaluate),
		air: !! (window.runtime),
		query: !! (document.querySelector)
	},
	Plugins: {},
	Engines: {
		presto: function () {
			return (!window.opera) ? false : ((arguments.callee.caller) ? 960 : ((document.getElementsByClassName) ? 950 : 925))
		},
		trident: function () {
			return (!window.ActiveXObject) ? false : ((window.XMLHttpRequest) ? ((document.querySelectorAll) ? 6 : 5) : 4)
		},
		webkit: function () {
			return (navigator.taintEnabled) ? false : ((Browser.Features.xpath) ? ((Browser.Features.query) ? 525 : 420) : 419)
		},
		gecko: function () {
			return (!document.getBoxObjectFor && window.mozInnerScreenX == null) ? false : ((document.getElementsByClassName) ? 19 : 18)
		}
	}
}, Browser || {});
Browser.Platform[Browser.Platform.name] = true;
Browser.detect = function () {
	for (var b in this.Engines) {
		var a = this.Engines[b]();
		if (a) {
			this.Engine = {
				name: b,
				version: a
			};
			this.Engine[b] = this.Engine[b + a] = true;
			break
		}
	}
	return {
		name: b,
		version: a
	}
};
Browser.detect();
Browser.Request = function () {
	return $try(function () {
		return new XMLHttpRequest()
	}, function () {
		return new ActiveXObject("MSXML2.XMLHTTP")
	}, function () {
		return new ActiveXObject("Microsoft.XMLHTTP")
	})
};
Browser.Features.xhr = !! (Browser.Request());
Browser.Plugins.Flash = (function () {
	var a = ($try(function () {
		return navigator.plugins["Shockwave Flash"].description
	}, function () {
		return new ActiveXObject("ShockwaveFlash.ShockwaveFlash").GetVariable("$version")
	}) || "0 r0").match(/\d+/g);
	return {
		version: parseInt(a[0] || 0 + "." + a[1], 10) || 0,
		build: parseInt(a[2], 10) || 0
	}
})();

function $exec(b) {
	if (!b) {
		return b
	}
	if (window.execScript) {
		window.execScript(b)
	} else {
		var a = document.createElement("script");
		a.setAttribute("type", "text/javascript");
		a[(Browser.Engine.webkit && Browser.Engine.version < 420) ? "innerText" : "text"] = b;
		document.head.appendChild(a);
		document.head.removeChild(a)
	}
	return b
}
Native.UID = 1;
var $uid = (Browser.Engine.trident) ?
function (a) {
	return (a.uid || (a.uid = [Native.UID++]))[0]
} : function (a) {
	return a.uid || (a.uid = Native.UID++)
};
var Window = new Native({
	name: "Window",
	legacy: (Browser.Engine.trident) ? null : window.Window,
	initialize: function (a) {
		$uid(a);
		if (!a.Element) {
			a.Element = $empty;
			if (Browser.Engine.webkit) {
				a.document.createElement("iframe")
			}
			a.Element.prototype = (Browser.Engine.webkit) ? window["[[DOMElement.prototype]]"] : {}
		}
		a.document.window = a;
		return $extend(a, Window.Prototype)
	},
	afterImplement: function (b, a) {
		window[b] = Window.Prototype[b] = a
	}
});
Window.Prototype = {
	$family: {
		name: "window"
	}
};
new Window(window);
var Document = new Native({
	name: "Document",
	legacy: (Browser.Engine.trident) ? null : window.Document,
	initialize: function (a) {
		$uid(a);
		a.head = a.getElementsByTagName("head")[0];
		a.html = a.getElementsByTagName("html")[0];
		if (Browser.Engine.trident && Browser.Engine.version <= 4) {
			$try(function () {
				a.execCommand("BackgroundImageCache", false, true)
			})
		}
		if (Browser.Engine.trident) {
			a.window.attachEvent("onunload", function () {
				a.window.detachEvent("onunload", arguments.callee);
				a.head = a.html = a.window = null
			})
		}
		return $extend(a, Document.Prototype)
	},
	afterImplement: function (b, a) {
		document[b] = Document.Prototype[b] = a
	}
});
Document.Prototype = {
	$family: {
		name: "document"
	}
};
new Document(document);
var Element = new Native({
	name: "Element",
	legacy: window.Element,
	initialize: function (a, b) {
		var c = Element.Constructors.get(a);
		if (c) {
			return c(b)
		}
		if (typeof a == "string") {
			return document.newElement(a, b)
		}
		return document.id(a).set(b)
	},
	afterImplement: function (a, b) {
		Element.Prototype[a] = b;
		if (Array[a]) {
			return
		}
		Elements.implement(a, function () {
			var c = [],
				h = true;
			for (var f = 0, d = this.length; f < d; f++) {
				var g = this[f][a].apply(this[f], arguments);
				c.push(g);
				if (h) {
					h = ($type(g) == "element")
				}
			}
			return (h) ? new Elements(c) : c
		})
	}
});
Element.Prototype = {
	$family: {
		name: "element"
	}
};
Element.Constructors = new Hash;
var IFrame = new Native({
	name: "IFrame",
	generics: false,
	initialize: function () {
		var g = Array.link(arguments, {
			properties: Object.type,
			iframe: $defined
		});
		var d = g.properties || {};
		var c = document.id(g.iframe);
		var f = d.onload || $empty;
		delete d.onload;
		d.id = d.name = $pick(d.id, d.name, c ? (c.id || c.name) : "IFrame_" + $time());
		c = new Element(c || "iframe", d);
		var b = function () {
				var h = $try(function () {
					return c.contentWindow.location.host
				});
				if (!h || h == window.location.host) {
					var i = new Window(c.contentWindow);
					new Document(c.contentWindow.document);
					$extend(i.Element.prototype, Element.Prototype)
				}
				f.call(c.contentWindow, c.contentWindow.document)
			};
		var a = $try(function () {
			return c.contentWindow
		});
		((a && a.document.body) || window.frames[d.id]) ? b() : c.addListener("load", b);
		return c
	}
});
var Elements = new Native({
	initialize: function (g, b) {
		b = $extend({
			ddup: true,
			cash: true
		}, b);
		g = g || [];
		if (b.ddup || b.cash) {
			var h = {},
				f = [];
			for (var c = 0, a = g.length; c < a; c++) {
				var d = document.id(g[c], !b.cash);
				if (b.ddup) {
					if (h[d.uid]) {
						continue
					}
					h[d.uid] = true
				}
				if (d) {
					f.push(d)
				}
			}
			g = f
		}
		return (b.cash) ? $extend(g, this) : g
	}
});
Elements.implement({
	filter: function (a, b) {
		if (!a) {
			return this
		}
		return new Elements(Array.filter(this, (typeof a == "string") ?
		function (c) {
			return c.match(a)
		} : a, b))
	}
});
(function () {
	var d;
	try {
		var a = document.createElement("<input name=x>");
		d = (a.name == "x")
	} catch (b) {}
	var c = function (f) {
			return ("" + f).replace(/&/g, "&amp;").replace(/"/g, "&quot;")
		};
	Document.implement({
		newElement: function (f, g) {
			if (g && g.checked != null) {
				g.defaultChecked = g.checked
			}
			if (d && g) {
				f = "<" + f;
				if (g.name) {
					f += ' name="' + c(g.name) + '"'
				}
				if (g.type) {
					f += ' type="' + c(g.type) + '"'
				}
				f += ">";
				delete g.name;
				delete g.type
			}
			return this.id(this.createElement(f)).set(g)
		},
		newTextNode: function (f) {
			return this.createTextNode(f)
		},
		getDocument: function () {
			return this
		},
		getWindow: function () {
			return this.window
		},
		id: (function () {
			var f = {
				string: function (i, h, g) {
					i = g.getElementById(i);
					return (i) ? f.element(i, h) : null
				},
				element: function (g, j) {
					$uid(g);
					if (!j && !g.$family && !(/^object|embed$/i).test(g.tagName)) {
						var h = Element.Prototype;
						for (var i in h) {
							g[i] = h[i]
						}
					}
					return g
				},
				object: function (h, i, g) {
					if (h.toElement) {
						return f.element(h.toElement(g), i)
					}
					return null
				}
			};
			f.textnode = f.whitespace = f.window = f.document = $arguments(0);
			return function (h, j, i) {
				if (h && h.$family && h.uid) {
					return h
				}
				var g = $type(h);
				return (f[g]) ? f[g](h, j, i || document) : null
			}
		})()
	})
})();
if (window.$ == null) {
	Window.implement({
		$: function (a, b) {
			return document.id(a, b, this.document)
		}
	})
}
Window.implement({
	$$: function (a) {
		if (arguments.length == 1 && typeof a == "string") {
			return this.document.getElements(a)
		}
		var g = [];
		var c = Array.flatten(arguments);
		for (var d = 0, b = c.length; d < b; d++) {
			var f = c[d];
			switch ($type(f)) {
			case "element":
				g.push(f);
				break;
			case "string":
				g.extend(this.document.getElements(f, true))
			}
		}
		return new Elements(g)
	},
	getDocument: function () {
		return this.document
	},
	getWindow: function () {
		return this
	}
});
Native.implement([Element, Document], {
	getElement: function (a, b) {
		return document.id(this.getElements(a, true)[0] || null, b)
	},
	getElements: function (a, d) {
		a = a.split(",");
		var c = [];
		var b = (a.length > 1);
		a.each(function (f) {
			var g = this.getElementsByTagName(f.trim());
			(b) ? c.extend(g) : c = g
		}, this);
		return new Elements(c, {
			ddup: b,
			cash: !d
		})
	}
});
(function () {
	var i = {},
		g = {};
	var j = {
		input: "checked",
		option: "selected",
		textarea: (Browser.Engine.webkit && Browser.Engine.version < 420) ? "innerHTML" : "value"
	};
	var c = function (m) {
			return (g[m] || (g[m] = {}))
		};
	var h = function (o, m) {
			if (!o) {
				return
			}
			var n = o.uid;
			if (m !== true) {
				m = false
			}
			if (Browser.Engine.trident) {
				if (o.clearAttributes) {
					var r = m && o.cloneNode(false);
					o.clearAttributes();
					if (r) {
						o.mergeAttributes(r)
					}
				} else {
					if (o.removeEvents) {
						o.removeEvents()
					}
				}
				if ((/object/i).test(o.tagName)) {
					for (var q in o) {
						if (typeof o[q] == "function") {
							o[q] = $empty
						}
					}
					Element.dispose(o)
				}
			}
			if (!n) {
				return
			}
			i[n] = g[n] = null
		};
	var d = function () {
			Hash.each(i, h);
			if (Browser.Engine.trident) {
				$A(document.getElementsByTagName("object")).each(h)
			}
			if (window.CollectGarbage) {
				CollectGarbage()
			}
			i = g = null
		};
	var k = function (o, m, t, n, q, s) {
			var p = o[t || m];
			var r = [];
			while (p) {
				if (p.nodeType == 1 && (!n || Element.match(p, n))) {
					if (!q) {
						return document.id(p, s)
					}
					r.push(p)
				}
				p = p[m]
			}
			return (q) ? new Elements(r, {
				ddup: false,
				cash: !s
			}) : null
		};
	var f = {
		html: "innerHTML",
		"class": "className",
		"for": "htmlFor",
		defaultValue: "defaultValue",
		text: (Browser.Engine.trident || (Browser.Engine.webkit && Browser.Engine.version < 420)) ? "innerText" : "textContent"
	};
	var b = ["compact", "nowrap", "ismap", "declare", "noshade", "checked", "disabled", "readonly", "multiple", "selected", "noresize", "defer"];
	var l = ["value", "type", "defaultValue", "accessKey", "cellPadding", "cellSpacing", "colSpan", "frameBorder", "maxLength", "readOnly", "rowSpan", "tabIndex", "useMap"];
	b = b.associate(b);
	Hash.extend(f, b);
	Hash.extend(f, l.associate(l.map(String.toLowerCase)));
	var a = {
		before: function (n, m) {
			if (m.parentNode) {
				m.parentNode.insertBefore(n, m)
			}
		},
		after: function (n, m) {
			if (!m.parentNode) {
				return
			}
			var o = m.nextSibling;
			(o) ? m.parentNode.insertBefore(n, o) : m.parentNode.appendChild(n)
		},
		bottom: function (n, m) {
			m.appendChild(n)
		},
		top: function (n, m) {
			var o = m.firstChild;
			(o) ? m.insertBefore(n, o) : m.appendChild(n)
		}
	};
	a.inside = a.bottom;
	Hash.each(a, function (m, n) {
		n = n.capitalize();
		Element.implement("inject" + n, function (o) {
			m(this, document.id(o, true));
			return this
		});
		Element.implement("grab" + n, function (o) {
			m(document.id(o, true), this);
			return this
		})
	});
	Element.implement({
		set: function (q, n) {
			switch ($type(q)) {
			case "object":
				for (var o in q) {
					this.set(o, q[o])
				}
				break;
			case "string":
				var m = Element.Properties.get(q);
				(m && m.set) ? m.set.apply(this, Array.slice(arguments, 1)) : this.setProperty(q, n)
			}
			return this
		},
		get: function (n) {
			var m = Element.Properties.get(n);
			return (m && m.get) ? m.get.apply(this, Array.slice(arguments, 1)) : this.getProperty(n)
		},
		erase: function (n) {
			var m = Element.Properties.get(n);
			(m && m.erase) ? m.erase.apply(this) : this.removeProperty(n);
			return this
		},
		setProperty: function (n, o) {
			var m = f[n];
			if (o == undefined) {
				return this.removeProperty(n)
			}
			if (m && b[n]) {
				o = !! o
			}(m) ? this[m] = o : this.setAttribute(n, "" + o);
			return this
		},
		setProperties: function (m) {
			for (var n in m) {
				this.setProperty(n, m[n])
			}
			return this
		},
		getProperty: function (n) {
			var m = f[n];
			var o = (m) ? this[m] : this.getAttribute(n, 2);
			return (b[n]) ? !! o : (m) ? o : o || null
		},
		getProperties: function () {
			var m = $A(arguments);
			return m.map(this.getProperty, this).associate(m)
		},
		removeProperty: function (n) {
			var m = f[n];
			(m) ? this[m] = (m && b[n]) ? false : "" : this.removeAttribute(n);
			return this
		},
		removeProperties: function () {
			Array.each(arguments, this.removeProperty, this);
			return this
		},
		hasClass: function (m) {
			return this.className.contains(m, " ")
		},
		addClass: function (m) {
			if (!this.hasClass(m)) {
				this.className = (this.className + " " + m).clean()
			}
			return this
		},
		removeClass: function (m) {
			this.className = this.className.replace(new RegExp("(^|\\s)" + m + "(?:\\s|$)"), "$1");
			return this
		},
		toggleClass: function (m) {
			return this.hasClass(m) ? this.removeClass(m) : this.addClass(m)
		},
		adopt: function () {
			Array.flatten(arguments).each(function (m) {
				m = document.id(m, true);
				if (m) {
					this.appendChild(m)
				}
			}, this);
			return this
		},
		appendText: function (n, m) {
			return this.grab(this.getDocument().newTextNode(n), m)
		},
		grab: function (n, m) {
			a[m || "bottom"](document.id(n, true), this);
			return this
		},
		inject: function (n, m) {
			a[m || "bottom"](this, document.id(n, true));
			return this
		},
		replaces: function (m) {
			m = document.id(m, true);
			m.parentNode.replaceChild(this, m);
			return this
		},
		wraps: function (n, m) {
			n = document.id(n, true);
			return this.replaces(n).grab(n, m)
		},
		getPrevious: function (m, n) {
			return k(this, "previousSibling", null, m, false, n)
		},
		getAllPrevious: function (m, n) {
			return k(this, "previousSibling", null, m, true, n)
		},
		getNext: function (m, n) {
			return k(this, "nextSibling", null, m, false, n)
		},
		getAllNext: function (m, n) {
			return k(this, "nextSibling", null, m, true, n)
		},
		getFirst: function (m, n) {
			return k(this, "nextSibling", "firstChild", m, false, n)
		},
		getLast: function (m, n) {
			return k(this, "previousSibling", "lastChild", m, false, n)
		},
		getParent: function (m, n) {
			return k(this, "parentNode", null, m, false, n)
		},
		getParents: function (m, n) {
			return k(this, "parentNode", null, m, true, n)
		},
		getSiblings: function (m, n) {
			return this.getParent().getChildren(m, n).erase(this)
		},
		getChildren: function (m, n) {
			return k(this, "nextSibling", "firstChild", m, true, n)
		},
		getWindow: function () {
			return this.ownerDocument.window
		},
		getDocument: function () {
			return this.ownerDocument
		},
		getElementById: function (p, o) {
			var n = this.ownerDocument.getElementById(p);
			if (!n) {
				return null
			}
			for (var m = n.parentNode; m != this; m = m.parentNode) {
				if (!m) {
					return null
				}
			}
			return document.id(n, o)
		},
		getSelected: function () {
			return new Elements($A(this.options).filter(function (m) {
				return m.selected
			}))
		},
		getComputedStyle: function (n) {
			if (this.currentStyle) {
				return this.currentStyle[n.camelCase()]
			}
			var m = this.getDocument().defaultView.getComputedStyle(this, null);
			return (m) ? m.getPropertyValue([n.hyphenate()]) : null
		},
		toQueryString: function () {
			var m = [];
			this.getElements("input, select, textarea", true).each(function (n) {
				if (!n.name || n.disabled || n.type == "submit" || n.type == "reset" || n.type == "file") {
					return
				}
				var o = (n.tagName.toLowerCase() == "select") ? Element.getSelected(n).map(function (p) {
					return p.value
				}) : ((n.type == "radio" || n.type == "checkbox") && !n.checked) ? null : n.value;
				$splat(o).each(function (p) {
					if (typeof p != "undefined") {
						m.push(n.name + "=" + encodeURIComponent(p))
					}
				})
			});
			return m.join("&")
		},
		clone: function (p, m) {
			p = p !== false;
			var s = this.cloneNode(p);
			var o = function (w, v) {
					if (!m) {
						w.removeAttribute("id")
					}
					if (Browser.Engine.trident) {
						w.clearAttributes();
						w.mergeAttributes(v);
						w.removeAttribute("uid");
						if (w.options) {
							var x = w.options,
								t = v.options;
							for (var u = x.length; u--;) {
								x[u].selected = t[u].selected
							}
						}
					}
					var y = j[v.tagName.toLowerCase()];
					if (y && v[y]) {
						w[y] = v[y]
					}
				};
			if (p) {
				var q = s.getElementsByTagName("*"),
					r = this.getElementsByTagName("*");
				for (var n = q.length; n--;) {
					o(q[n], r[n])
				}
			}
			o(s, this);
			return document.id(s)
		},
		destroy: function () {
			Element.empty(this);
			Element.dispose(this);
			h(this, true);
			return null
		},
		empty: function () {
			$A(this.childNodes).each(function (m) {
				Element.destroy(m)
			});
			return this
		},
		dispose: function () {
			return (this.parentNode) ? this.parentNode.removeChild(this) : this
		},
		hasChild: function (m) {
			m = document.id(m, true);
			if (!m) {
				return false
			}
			if (Browser.Engine.webkit && Browser.Engine.version < 420) {
				return $A(this.getElementsByTagName(m.tagName)).contains(m)
			}
			return (this.contains) ? (this != m && this.contains(m)) : !! (this.compareDocumentPosition(m) & 16)
		},
		match: function (m) {
			return (!m || (m == this) || (Element.get(this, "tag") == m))
		}
	});
	Native.implement([Element, Window, Document], {
		addListener: function (p, o) {
			if (p == "unload") {
				var m = o,
					n = this;
				o = function () {
					n.removeListener("unload", o);
					m()
				}
			} else {
				i[this.uid] = this
			}
			if (this.addEventListener) {
				this.addEventListener(p, o, false)
			} else {
				this.attachEvent("on" + p, o)
			}
			return this
		},
		removeListener: function (n, m) {
			if (this.removeEventListener) {
				this.removeEventListener(n, m, false)
			} else {
				this.detachEvent("on" + n, m)
			}
			return this
		},
		retrieve: function (n, m) {
			var p = c(this.uid),
				o = p[n];
			if (m != undefined && o == undefined) {
				o = p[n] = m
			}
			return $pick(o)
		},
		store: function (n, m) {
			var o = c(this.uid);
			o[n] = m;
			return this
		},
		eliminate: function (m) {
			var n = c(this.uid);
			delete n[m];
			return this
		}
	});
	window.addListener("unload", d)
})();
Element.Properties = new Hash;
Element.Properties.style = {
	set: function (a) {
		this.style.cssText = a
	},
	get: function () {
		return this.style.cssText
	},
	erase: function () {
		this.style.cssText = ""
	}
};
Element.Properties.tag = {
	get: function () {
		return this.tagName.toLowerCase()
	}
};
Element.Properties.html = (function () {
	var c = document.createElement("div");
	var a = {
		table: [1, "<table>", "</table>"],
		select: [1, "<select>", "</select>"],
		tbody: [2, "<table><tbody>", "</tbody></table>"],
		tr: [3, "<table><tbody><tr>", "</tr></tbody></table>"]
	};
	a.thead = a.tfoot = a.tbody;
	var b = {
		set: function () {
			var f = Array.flatten(arguments).join("");
			var g = Browser.Engine.trident && a[this.get("tag")];
			if (g) {
				var h = c;
				h.innerHTML = g[1] + f + g[2];
				for (var d = g[0]; d--;) {
					h = h.firstChild
				}
				this.empty().adopt(h.childNodes)
			} else {
				this.innerHTML = f
			}
		}
	};
	b.erase = b.set;
	return b
})();
if (Browser.Engine.webkit && Browser.Engine.version < 420) {
	Element.Properties.text = {
		get: function () {
			if (this.innerText) {
				return this.innerText
			}
			var a = this.ownerDocument.newElement("div", {
				html: this.innerHTML
			}).inject(this.ownerDocument.body);
			var b = a.innerText;
			a.destroy();
			return b
		}
	}
}(function () {
	Element.implement({
		scrollTo: function (i, j) {
			if (b(this)) {
				this.getWindow().scrollTo(i, j)
			} else {
				this.scrollLeft = i;
				this.scrollTop = j
			}
			return this
		},
		getSize: function () {
			if (b(this)) {
				return this.getWindow().getSize()
			}
			return {
				x: this.offsetWidth,
				y: this.offsetHeight
			}
		},
		getScrollSize: function () {
			if (b(this)) {
				return this.getWindow().getScrollSize()
			}
			return {
				x: this.scrollWidth,
				y: this.scrollHeight
			}
		},
		getScroll: function () {
			if (b(this)) {
				return this.getWindow().getScroll()
			}
			return {
				x: this.scrollLeft,
				y: this.scrollTop
			}
		},
		getScrolls: function () {
			var j = this,
				i = {
					x: 0,
					y: 0
				};
			while (j && !b(j)) {
				i.x += j.scrollLeft;
				i.y += j.scrollTop;
				j = j.parentNode
			}
			return i
		},
		getOffsetParent: function () {
			var i = this;
			if (b(i)) {
				return null
			}
			if (!Browser.Engine.trident) {
				return i.offsetParent
			}
			while ((i = i.parentNode) && !b(i)) {
				if (d(i, "position") != "static") {
					return i
				}
			}
			return null
		},
		getOffsets: function () {
			if (this.getBoundingClientRect) {
				var k = this.getBoundingClientRect(),
					n = document.id(this.getDocument().documentElement),
					q = n.getScroll(),
					l = this.getScrolls(),
					j = this.getScroll(),
					i = (d(this, "position") == "fixed");
				return {
					x: k.left.toInt() + l.x - j.x + ((i) ? 0 : q.x) - n.clientLeft,
					y: k.top.toInt() + l.y - j.y + ((i) ? 0 : q.y) - n.clientTop
				}
			}
			var m = this,
				o = {
					x: 0,
					y: 0
				};
			if (b(this)) {
				return o
			}
			while (m && !b(m)) {
				o.x += m.offsetLeft;
				o.y += m.offsetTop;
				if (Browser.Engine.gecko) {
					if (!g(m)) {
						o.x += c(m);
						o.y += h(m)
					}
					var p = m.parentNode;
					if (p && d(p, "overflow") != "visible") {
						o.x += c(p);
						o.y += h(p)
					}
				} else {
					if (m != this && Browser.Engine.webkit) {
						o.x += c(m);
						o.y += h(m)
					}
				}
				m = m.offsetParent
			}
			if (Browser.Engine.gecko && !g(this)) {
				o.x -= c(this);
				o.y -= h(this)
			}
			return o
		},
		getPosition: function (l) {
			if (b(this)) {
				return {
					x: 0,
					y: 0
				}
			}
			var m = this.getOffsets(),
				j = this.getScrolls();
			var i = {
				x: m.x - j.x,
				y: m.y - j.y
			};
			var k = (l && (l = document.id(l))) ? l.getPosition() : {
				x: 0,
				y: 0
			};
			return {
				x: i.x - k.x,
				y: i.y - k.y
			}
		},
		getCoordinates: function (k) {
			if (b(this)) {
				return this.getWindow().getCoordinates()
			}
			var i = this.getPosition(k),
				j = this.getSize();
			var l = {
				left: i.x,
				top: i.y,
				width: j.x,
				height: j.y
			};
			l.right = l.left + l.width;
			l.bottom = l.top + l.height;
			return l
		},
		computePosition: function (i) {
			return {
				left: i.x - f(this, "margin-left"),
				top: i.y - f(this, "margin-top")
			}
		},
		setPosition: function (i) {
			return this.setStyles(this.computePosition(i))
		}
	});
	Native.implement([Document, Window], {
		getSize: function () {
			if (Browser.Engine.presto || Browser.Engine.webkit) {
				var j = this.getWindow();
				return {
					x: j.innerWidth,
					y: j.innerHeight
				}
			}
			var i = a(this);
			return {
				x: i.clientWidth,
				y: i.clientHeight
			}
		},
		getScroll: function () {
			var j = this.getWindow(),
				i = a(this);
			return {
				x: j.pageXOffset || i.scrollLeft,
				y: j.pageYOffset || i.scrollTop
			}
		},
		getScrollSize: function () {
			var j = a(this),
				i = this.getSize();
			return {
				x: Math.max(j.scrollWidth, i.x),
				y: Math.max(j.scrollHeight, i.y)
			}
		},
		getPosition: function () {
			return {
				x: 0,
				y: 0
			}
		},
		getCoordinates: function () {
			var i = this.getSize();
			return {
				top: 0,
				left: 0,
				bottom: i.y,
				right: i.x,
				height: i.y,
				width: i.x
			}
		}
	});
	var d = Element.getComputedStyle;

	function f(i, j) {
		return d(i, j).toInt() || 0
	}
	function g(i) {
		return d(i, "-moz-box-sizing") == "border-box"
	}
	function h(i) {
		return f(i, "border-top-width")
	}
	function c(i) {
		return f(i, "border-left-width")
	}
	function b(i) {
		return (/^(?:body|html)$/i).test(i.tagName)
	}
	function a(i) {
		var j = i.getDocument();
		return (!j.compatMode || j.compatMode == "CSS1Compat") ? j.html : j.body
	}
})();
Element.alias("setPosition", "position");
Native.implement([Window, Document, Element], {
	getHeight: function () {
		return this.getSize().y
	},
	getWidth: function () {
		return this.getSize().x
	},
	getScrollTop: function () {
		return this.getScroll().y
	},
	getScrollLeft: function () {
		return this.getScroll().x
	},
	getScrollHeight: function () {
		return this.getScrollSize().y
	},
	getScrollWidth: function () {
		return this.getScrollSize().x
	},
	getTop: function () {
		return this.getPosition().y
	},
	getLeft: function () {
		return this.getPosition().x
	}
});
var Event = new Native({
	name: "Event",
	initialize: function (a, g) {
		g = g || window;
		var l = g.document;
		a = a || g.event;
		if (a.$extended) {
			return a
		}
		this.$extended = true;
		var k = a.type;
		var h = a.target || a.srcElement;
		while (h && h.nodeType == 3) {
			h = h.parentNode
		}
		if (k.test(/key/)) {
			var b = a.which || a.keyCode;
			var n = Event.Keys.keyOf(b);
			if (k == "keydown") {
				var d = b - 111;
				if (d > 0 && d < 13) {
					n = "f" + d
				}
			}
			n = n || String.fromCharCode(b).toLowerCase()
		} else {
			if (k.match(/(click|mouse|menu)/i)) {
				l = (!l.compatMode || l.compatMode == "CSS1Compat") ? l.html : l.body;
				var j = {
					x: a.pageX || a.clientX + l.scrollLeft,
					y: a.pageY || a.clientY + l.scrollTop
				};
				var c = {
					x: (a.pageX) ? a.pageX - g.pageXOffset : a.clientX,
					y: (a.pageY) ? a.pageY - g.pageYOffset : a.clientY
				};
				if (k.match(/DOMMouseScroll|mousewheel/)) {
					var i = (a.wheelDelta) ? a.wheelDelta / 120 : -(a.detail || 0) / 3
				}
				var f = (a.which == 3) || (a.button == 2);
				var m = null;
				if (k.match(/over|out/)) {
					switch (k) {
					case "mouseover":
						m = a.relatedTarget || a.fromElement;
						break;
					case "mouseout":
						m = a.relatedTarget || a.toElement
					}
					if (!(function () {
						while (m && m.nodeType == 3) {
							m = m.parentNode
						}
						return true
					}).create({
						attempt: Browser.Engine.gecko
					})()) {
						m = false
					}
				}
			}
		}
		return $extend(this, {
			event: a,
			type: k,
			page: j,
			client: c,
			rightClick: f,
			wheel: i,
			relatedTarget: m,
			target: h,
			code: b,
			key: n,
			shift: a.shiftKey,
			control: a.ctrlKey,
			alt: a.altKey,
			meta: a.metaKey
		})
	}
});
Event.Keys = new Hash({
	enter: 13,
	up: 38,
	down: 40,
	left: 37,
	right: 39,
	esc: 27,
	space: 32,
	backspace: 8,
	tab: 9,
	"delete": 46
});
Event.implement({
	stop: function () {
		return this.stopPropagation().preventDefault()
	},
	stopPropagation: function () {
		if (this.event.stopPropagation) {
			this.event.stopPropagation()
		} else {
			this.event.cancelBubble = true
		}
		return this
	},
	preventDefault: function () {
		if (this.event.preventDefault) {
			this.event.preventDefault()
		} else {
			this.event.returnValue = false
		}
		return this
	}
});
Element.Properties.events = {
	set: function (a) {
		this.addEvents(a)
	}
};
Native.implement([Element, Window, Document], {
	addEvent: function (f, h) {
		var i = this.retrieve("events", {});
		i[f] = i[f] || {
			keys: [],
			values: []
		};
		if (i[f].keys.contains(h)) {
			return this
		}
		i[f].keys.push(h);
		var g = f,
			a = Element.Events.get(f),
			c = h,
			j = this;
		if (a) {
			if (a.onAdd) {
				a.onAdd.call(this, h)
			}
			if (a.condition) {
				c = function (k) {
					if (a.condition.call(this, k)) {
						return h.call(this, k)
					}
					return true
				}
			}
			g = a.base || g
		}
		var d = function () {
				return h.call(j)
			};
		var b = Element.NativeEvents[g];
		if (b) {
			if (b == 2) {
				d = function (k) {
					k = new Event(k, j.getWindow());
					if (c.call(j, k) === false) {
						k.stop()
					}
				}
			}
			this.addListener(g, d)
		}
		i[f].values.push(d);
		return this
	},
	removeEvent: function (c, b) {
		var a = this.retrieve("events");
		if (!a || !a[c]) {
			return this
		}
		var g = a[c].keys.indexOf(b);
		if (g == -1) {
			return this
		}
		a[c].keys.splice(g, 1);
		var f = a[c].values.splice(g, 1)[0];
		var d = Element.Events.get(c);
		if (d) {
			if (d.onRemove) {
				d.onRemove.call(this, b)
			}
			c = d.base || c
		}
		return (Element.NativeEvents[c]) ? this.removeListener(c, f) : this
	},
	addEvents: function (a) {
		for (var b in a) {
			this.addEvent(b, a[b])
		}
		return this
	},
	removeEvents: function (a) {
		var c;
		if ($type(a) == "object") {
			for (c in a) {
				this.removeEvent(c, a[c])
			}
			return this
		}
		var b = this.retrieve("events");
		if (!b) {
			return this
		}
		if (!a) {
			for (c in b) {
				this.removeEvents(c)
			}
			this.eliminate("events")
		} else {
			if (b[a]) {
				while (b[a].keys[0]) {
					this.removeEvent(a, b[a].keys[0])
				}
				b[a] = null
			}
		}
		return this
	},
	fireEvent: function (d, b, a) {
		var c = this.retrieve("events");
		if (!c || !c[d]) {
			return this
		}
		c[d].keys.each(function (f) {
			f.create({
				bind: this,
				delay: a,
				"arguments": b
			})()
		}, this);
		return this
	},
	cloneEvents: function (d, a) {
		d = document.id(d);
		var c = d.retrieve("events");
		if (!c) {
			return this
		}
		if (!a) {
			for (var b in c) {
				this.cloneEvents(d, b)
			}
		} else {
			if (c[a]) {
				c[a].keys.each(function (f) {
					this.addEvent(a, f)
				}, this)
			}
		}
		return this
	}
});
try {
	if (typeof HTMLElement != "undefined") {
		HTMLElement.prototype.fireEvent = Element.prototype.fireEvent
	}
} catch (e) {}
Element.NativeEvents = {
	click: 2,
	dblclick: 2,
	mouseup: 2,
	mousedown: 2,
	contextmenu: 2,
	mousewheel: 2,
	DOMMouseScroll: 2,
	mouseover: 2,
	mouseout: 2,
	mousemove: 2,
	selectstart: 2,
	selectend: 2,
	keydown: 2,
	keypress: 2,
	keyup: 2,
	focus: 2,
	blur: 2,
	change: 2,
	reset: 2,
	select: 2,
	submit: 2,
	load: 1,
	unload: 1,
	beforeunload: 2,
	resize: 1,
	move: 1,
	DOMContentLoaded: 1,
	readystatechange: 1,
	error: 1,
	abort: 1,
	scroll: 1
};
(function () {
	var a = function (b) {
			var c = b.relatedTarget;
			if (c == undefined) {
				return true
			}
			if (c === false) {
				return false
			}
			return ($type(this) != "document" && c != this && c.prefix != "xul" && !this.hasChild(c))
		};
	Element.Events = new Hash({
		mouseenter: {
			base: "mouseover",
			condition: a
		},
		mouseleave: {
			base: "mouseout",
			condition: a
		},
		mousewheel: {
			base: (Browser.Engine.gecko) ? "DOMMouseScroll" : "mousewheel"
		}
	})
})();
Element.Properties.styles = {
	set: function (a) {
		this.setStyles(a)
	}
};
Element.Properties.opacity = {
	set: function (a, b) {
		if (!b) {
			if (a == 0) {
				if (this.style.visibility != "hidden") {
					this.style.visibility = "hidden"
				}
			} else {
				if (this.style.visibility != "visible") {
					this.style.visibility = "visible"
				}
			}
		}
		if (!this.currentStyle || !this.currentStyle.hasLayout) {
			this.style.zoom = 1
		}
		if (Browser.Engine.trident) {
			this.style.filter = (a == 1) ? "" : "alpha(opacity=" + a * 100 + ")"
		}
		this.style.opacity = a;
		this.store("opacity", a)
	},
	get: function () {
		return this.retrieve("opacity", 1)
	}
};
Element.implement({
	setOpacity: function (a) {
		return this.set("opacity", a, true)
	},
	getOpacity: function () {
		return this.get("opacity")
	},
	setStyle: function (b, a) {
		switch (b) {
		case "opacity":
			return this.set("opacity", parseFloat(a));
		case "float":
			b = (Browser.Engine.trident) ? "styleFloat" : "cssFloat"
		}
		b = b.camelCase();
		if ($type(a) != "string") {
			var c = (Element.Styles.get(b) || "@").split(" ");
			a = $splat(a).map(function (f, d) {
				if (!c[d]) {
					return ""
				}
				return ($type(f) == "number") ? c[d].replace("@", Math.round(f)) : f
			}).join(" ")
		} else {
			if (a == String(Number(a))) {
				a = Math.round(a)
			}
		}
		this.style[b] = a;
		return this
	},
	getStyle: function (h) {
		switch (h) {
		case "opacity":
			return this.get("opacity");
		case "float":
			h = (Browser.Engine.trident) ? "styleFloat" : "cssFloat"
		}
		h = h.camelCase();
		var a = this.style[h];
		if (!$chk(a)) {
			a = [];
			for (var g in Element.ShortStyles) {
				if (h != g) {
					continue
				}
				for (var f in Element.ShortStyles[g]) {
					a.push(this.getStyle(f))
				}
				return a.join(" ")
			}
			a = this.getComputedStyle(h)
		}
		if (a) {
			a = String(a);
			var c = a.match(/rgba?\([\d\s,]+\)/);
			if (c) {
				a = a.replace(c[0], c[0].rgbToHex())
			}
		}
		if (Browser.Engine.presto || (Browser.Engine.trident && !$chk(parseInt(a, 10)))) {
			if (h.test(/^(height|width)$/)) {
				var b = (h == "width") ? ["left", "right"] : ["top", "bottom"],
					d = 0;
				b.each(function (i) {
					d += this.getStyle("border-" + i + "-width").toInt() + this.getStyle("padding-" + i).toInt()
				}, this);
				return this["offset" + h.capitalize()] - d + "px"
			}
			if ((Browser.Engine.presto) && String(a).test("px")) {
				return a
			}
			if (h.test(/(border(.+)Width|margin|padding)/)) {
				return "0px"
			}
		}
		return a
	},
	setStyles: function (b) {
		for (var a in b) {
			this.setStyle(a, b[a])
		}
		return this
	},
	getStyles: function () {
		var a = {};
		Array.flatten(arguments).each(function (b) {
			a[b] = this.getStyle(b)
		}, this);
		return a
	}
});
Element.Styles = new Hash({
	left: "@px",
	top: "@px",
	bottom: "@px",
	right: "@px",
	width: "@px",
	height: "@px",
	maxWidth: "@px",
	maxHeight: "@px",
	minWidth: "@px",
	minHeight: "@px",
	backgroundColor: "rgb(@, @, @)",
	backgroundPosition: "@px @px",
	color: "rgb(@, @, @)",
	fontSize: "@px",
	letterSpacing: "@px",
	lineHeight: "@px",
	clip: "rect(@px @px @px @px)",
	margin: "@px @px @px @px",
	padding: "@px @px @px @px",
	border: "@px @ rgb(@, @, @) @px @ rgb(@, @, @) @px @ rgb(@, @, @)",
	borderWidth: "@px @px @px @px",
	borderStyle: "@ @ @ @",
	borderColor: "rgb(@, @, @) rgb(@, @, @) rgb(@, @, @) rgb(@, @, @)",
	zIndex: "@",
	zoom: "@",
	fontWeight: "@",
	textIndent: "@px",
	opacity: "@"
});
Element.ShortStyles = {
	margin: {},
	padding: {},
	border: {},
	borderWidth: {},
	borderStyle: {},
	borderColor: {}
};
["Top", "Right", "Bottom", "Left"].each(function (h) {
	var g = Element.ShortStyles;
	var b = Element.Styles;
	["margin", "padding"].each(function (i) {
		var j = i + h;
		g[i][j] = b[j] = "@px"
	});
	var f = "border" + h;
	g.border[f] = b[f] = "@px @ rgb(@, @, @)";
	var d = f + "Width",
		a = f + "Style",
		c = f + "Color";
	g[f] = {};
	g.borderWidth[d] = g[f][d] = b[d] = "@px";
	g.borderStyle[a] = g[f][a] = b[a] = "@";
	g.borderColor[c] = g[f][c] = b[c] = "rgb(@, @, @)"
});
var Fx = new Class({
	Implements: [Chain, Events, Options],
	options: {
		fps: 50,
		unit: false,
		duration: 500,
		link: "ignore"
	},
	initialize: function (a) {
		this.subject = this.subject || this;
		this.setOptions(a);
		this.options.duration = Fx.Durations[this.options.duration] || this.options.duration.toInt();
		var b = this.options.wait;
		if (b === false) {
			this.options.link = "cancel"
		}
	},
	getTransition: function () {
		return function (a) {
			return -(Math.cos(Math.PI * a) - 1) / 2
		}
	},
	step: function () {
		var a = $time();
		if (a < this.time + this.options.duration) {
			var b = this.transition((a - this.time) / this.options.duration);
			this.set(this.compute(this.from, this.to, b))
		} else {
			this.set(this.compute(this.from, this.to, 1));
			this.complete()
		}
	},
	set: function (a) {
		return a
	},
	compute: function (c, b, a) {
		return Fx.compute(c, b, a)
	},
	check: function () {
		if (!this.timer) {
			return true
		}
		switch (this.options.link) {
		case "cancel":
			this.cancel();
			return true;
		case "chain":
			this.chain(this.caller.bind(this, arguments));
			return false
		}
		return false
	},
	start: function (b, a) {
		if (!this.check(b, a)) {
			return this
		}
		this.from = b;
		this.to = a;
		this.time = 0;
		this.transition = this.getTransition();
		this.startTimer();
		this.onStart();
		return this
	},
	complete: function () {
		if (this.stopTimer()) {
			this.onComplete()
		}
		return this
	},
	cancel: function () {
		if (this.stopTimer()) {
			this.onCancel()
		}
		return this
	},
	onStart: function () {
		this.fireEvent("start", this.subject)
	},
	onComplete: function () {
		this.fireEvent("complete", this.subject);
		if (!this.callChain()) {
			this.fireEvent("chainComplete", this.subject)
		}
	},
	onCancel: function () {
		this.fireEvent("cancel", this.subject).clearChain()
	},
	pause: function () {
		this.stopTimer();
		return this
	},
	resume: function () {
		this.startTimer();
		return this
	},
	stopTimer: function () {
		if (!this.timer) {
			return false
		}
		this.time = $time() - this.time;
		this.timer = $clear(this.timer);
		return true
	},
	startTimer: function () {
		if (this.timer) {
			return false
		}
		this.time = $time() - this.time;
		this.timer = this.step.periodical(Math.round(1000 / this.options.fps), this);
		return true
	}
});
Fx.compute = function (c, b, a) {
	return (b - c) * a + c
};
Fx.Durations = {
	"short": 250,
	normal: 500,
	"long": 1000
};
Fx.CSS = new Class({
	Extends: Fx,
	prepare: function (d, f, b) {
		b = $splat(b);
		var c = b[1];
		if (!$chk(c)) {
			b[1] = b[0];
			b[0] = d.getStyle(f)
		}
		var a = b.map(this.parse);
		return {
			from: a[0],
			to: a[1]
		}
	},
	parse: function (a) {
		a = $lambda(a)();
		a = (typeof a == "string") ? a.split(" ") : $splat(a);
		return a.map(function (c) {
			c = String(c);
			var b = false;
			Fx.CSS.Parsers.each(function (g, f) {
				if (b) {
					return
				}
				var d = g.parse(c);
				if ($chk(d)) {
					b = {
						value: d,
						parser: g
					}
				}
			});
			b = b || {
				value: c,
				parser: Fx.CSS.Parsers.String
			};
			return b
		})
	},
	compute: function (d, c, b) {
		var a = [];
		(Math.min(d.length, c.length)).times(function (f) {
			a.push({
				value: d[f].parser.compute(d[f].value, c[f].value, b),
				parser: d[f].parser
			})
		});
		a.$family = {
			name: "fx:css:value"
		};
		return a
	},
	serve: function (c, b) {
		if ($type(c) != "fx:css:value") {
			c = this.parse(c)
		}
		var a = [];
		c.each(function (d) {
			a = a.concat(d.parser.serve(d.value, b))
		});
		return a
	},
	render: function (a, d, c, b) {
		a.setStyle(d, this.serve(c, b))
	},
	search: function (a) {
		if (Fx.CSS.Cache[a]) {
			return Fx.CSS.Cache[a]
		}
		var b = {};
		Array.each(document.styleSheets, function (f, d) {
			var c = f.href;
			if (c && c.contains("://") && !c.contains(document.domain)) {
				return
			}
			var g = f.rules || f.cssRules;
			Array.each(g, function (k, h) {
				if (!k.style) {
					return
				}
				var j = (k.selectorText) ? k.selectorText.replace(/^\w+/, function (i) {
					return i.toLowerCase()
				}) : null;
				if (!j || !j.test("^" + a + "$")) {
					return
				}
				Element.Styles.each(function (l, i) {
					if (!k.style[i] || Element.ShortStyles[i]) {
						return
					}
					l = String(k.style[i]);
					b[i] = (l.test(/^rgb/)) ? l.rgbToHex() : l
				})
			})
		});
		return Fx.CSS.Cache[a] = b
	}
});
Fx.CSS.Cache = {};
Fx.CSS.Parsers = new Hash({
	Color: {
		parse: function (a) {
			if (a.match(/^#[0-9a-f]{3,6}$/i)) {
				return a.hexToRgb(true)
			}
			return ((a = a.match(/(\d+),\s*(\d+),\s*(\d+)/))) ? [a[1], a[2], a[3]] : false
		},
		compute: function (c, b, a) {
			return c.map(function (f, d) {
				return Math.round(Fx.compute(c[d], b[d], a))
			})
		},
		serve: function (a) {
			return a.map(Number)
		}
	},
	Number: {
		parse: parseFloat,
		compute: Fx.compute,
		serve: function (b, a) {
			return (a) ? b + a : b
		}
	},
	String: {
		parse: $lambda(false),
		compute: $arguments(1),
		serve: $arguments(0)
	}
});
Fx.Morph = new Class({
	Extends: Fx.CSS,
	initialize: function (b, a) {
		this.element = this.subject = document.id(b);
		this.parent(a)
	},
	set: function (a) {
		if (typeof a == "string") {
			a = this.search(a)
		}
		for (var b in a) {
			this.render(this.element, b, a[b], this.options.unit)
		}
		return this
	},
	compute: function (f, d, c) {
		var a = {};
		for (var b in f) {
			a[b] = this.parent(f[b], d[b], c)
		}
		return a
	},
	start: function (b) {
		if (!this.check(b)) {
			return this
		}
		if (typeof b == "string") {
			b = this.search(b)
		}
		var f = {},
			d = {};
		for (var c in b) {
			var a = this.prepare(this.element, c, b[c]);
			f[c] = a.from;
			d[c] = a.to
		}
		return this.parent(f, d)
	}
});
Element.Properties.morph = {
	set: function (a) {
		var b = this.retrieve("morph");
		if (b) {
			b.cancel()
		}
		return this.eliminate("morph").store("morph:options", $extend({
			link: "cancel"
		}, a))
	},
	get: function (a) {
		if (a || !this.retrieve("morph")) {
			if (a || !this.retrieve("morph:options")) {
				this.set("morph", a)
			}
			this.store("morph", new Fx.Morph(this, this.retrieve("morph:options")))
		}
		return this.retrieve("morph")
	}
};
Element.implement({
	morph: function (a) {
		this.get("morph").start(a);
		return this
	}
});
Fx.implement({
	getTransition: function () {
		var a = this.options.transition || Fx.Transitions.Sine.easeInOut;
		if (typeof a == "string") {
			var b = a.split(":");
			a = Fx.Transitions;
			a = a[b[0]] || a[b[0].capitalize()];
			if (b[1]) {
				a = a["ease" + b[1].capitalize() + (b[2] ? b[2].capitalize() : "")]
			}
		}
		return a
	}
});
Fx.Transition = function (b, a) {
	a = $splat(a);
	return $extend(b, {
		easeIn: function (c) {
			return b(c, a)
		},
		easeOut: function (c) {
			return 1 - b(1 - c, a)
		},
		easeInOut: function (c) {
			return (c <= 0.5) ? b(2 * c, a) / 2 : (2 - b(2 * (1 - c), a)) / 2
		}
	})
};
Fx.Transitions = new Hash({
	linear: $arguments(0)
});
Fx.Transitions.extend = function (a) {
	for (var b in a) {
		Fx.Transitions[b] = new Fx.Transition(a[b])
	}
};
Fx.Transitions.extend({
	Pow: function (b, a) {
		return Math.pow(b, a[0] || 6)
	},
	Expo: function (a) {
		return Math.pow(2, 8 * (a - 1))
	},
	Circ: function (a) {
		return 1 - Math.sin(Math.acos(a))
	},
	Sine: function (a) {
		return 1 - Math.sin((1 - a) * Math.PI / 2)
	},
	Back: function (b, a) {
		a = a[0] || 1.618;
		return Math.pow(b, 2) * ((a + 1) * b - a)
	},
	Bounce: function (g) {
		var f;
		for (var d = 0, c = 1; 1; d += c, c /= 2) {
			if (g >= (7 - 4 * d) / 11) {
				f = c * c - Math.pow((11 - 6 * d - 11 * g) / 4, 2);
				break
			}
		}
		return f
	},
	Elastic: function (b, a) {
		return Math.pow(2, 10 * --b) * Math.cos(20 * b * Math.PI * (a[0] || 1) / 3)
	}
});
["Quad", "Cubic", "Quart", "Quint"].each(function (b, a) {
	Fx.Transitions[b] = new Fx.Transition(function (c) {
		return Math.pow(c, [a + 2])
	})
});
Fx.Tween = new Class({
	Extends: Fx.CSS,
	initialize: function (b, a) {
		this.element = this.subject = document.id(b);
		this.parent(a)
	},
	set: function (b, a) {
		if (arguments.length == 1) {
			a = b;
			b = this.property || this.options.property
		}
		this.render(this.element, b, a, this.options.unit);
		return this
	},
	start: function (c, f, d) {
		if (!this.check(c, f, d)) {
			return this
		}
		var b = Array.flatten(arguments);
		this.property = this.options.property || b.shift();
		var a = this.prepare(this.element, this.property, b);
		return this.parent(a.from, a.to)
	}
});
Element.Properties.tween = {
	set: function (a) {
		var b = this.retrieve("tween");
		if (b) {
			b.cancel()
		}
		return this.eliminate("tween").store("tween:options", $extend({
			link: "cancel"
		}, a))
	},
	get: function (a) {
		if (a || !this.retrieve("tween")) {
			if (a || !this.retrieve("tween:options")) {
				this.set("tween", a)
			}
			this.store("tween", new Fx.Tween(this, this.retrieve("tween:options")))
		}
		return this.retrieve("tween")
	}
};
Element.implement({
	tween: function (a, c, b) {
		this.get("tween").start(arguments);
		return this
	},
	fade: function (c) {
		var f = this.get("tween"),
			d = "opacity",
			a;
		c = $pick(c, "toggle");
		switch (c) {
		case "in":
			f.start(d, 1);
			break;
		case "out":
			f.start(d, 0);
			break;
		case "show":
			f.set(d, 1);
			break;
		case "hide":
			f.set(d, 0);
			break;
		case "toggle":
			var b = this.retrieve("fade:flag", this.get("opacity") == 1);
			f.start(d, (b) ? 0 : 1);
			this.store("fade:flag", !b);
			a = true;
			break;
		default:
			f.start(d, arguments)
		}
		if (!a) {
			this.eliminate("fade:flag")
		}
		return this
	},
	highlight: function (c, a) {
		if (!a) {
			a = this.retrieve("highlight:original", this.getStyle("background-color"));
			a = (a == "transparent") ? "#fff" : a
		}
		var b = this.get("tween");
		b.start("background-color", c || "#ffff88", a).chain(function () {
			this.setStyle("background-color", this.retrieve("highlight:original"));
			b.callChain()
		}.bind(this));
		return this
	}
});
var Request = new Class({
	Implements: [Chain, Events, Options],
	options: {
		url: "",
		data: "",
		headers: {
			"X-Requested-With": "XMLHttpRequest",
			Accept: "text/javascript, text/html, application/xml, text/xml, */*"
		},
		async: true,
		format: false,
		method: "post",
		link: "ignore",
		isSuccess: null,
		emulation: true,
		urlEncoded: true,
		encoding: "utf-8",
		evalScripts: false,
		evalResponse: false,
		noCache: false
	},
	initialize: function (a) {
		this.xhr = new Browser.Request();
		this.setOptions(a);
		this.options.isSuccess = this.options.isSuccess || this.isSuccess;
		this.headers = new Hash(this.options.headers)
	},
	onStateChange: function () {
		if (this.xhr.readyState != 4 || !this.running) {
			return
		}
		this.running = false;
		this.status = 0;
		$try(function () {
			this.status = this.xhr.status
		}.bind(this));
		this.xhr.onreadystatechange = $empty;
		if (this.options.isSuccess.call(this, this.status)) {
			this.response = {
				text: this.xhr.responseText,
				xml: this.xhr.responseXML
			};
			this.success(this.response.text, this.response.xml)
		} else {
			this.response = {
				text: null,
				xml: null
			};
			this.failure()
		}
	},
	isSuccess: function () {
		return ((this.status >= 200) && (this.status < 300))
	},
	processScripts: function (a) {
		if (this.options.evalResponse || (/(ecma|java)script/).test(this.getHeader("Content-type"))) {
			return $exec(a)
		}
		return a.stripScripts(this.options.evalScripts)
	},
	success: function (b, a) {
		this.onSuccess(this.processScripts(b), a)
	},
	onSuccess: function () {
		this.fireEvent("complete", arguments).fireEvent("success", arguments).callChain()
	},
	failure: function () {
		this.onFailure()
	},
	onFailure: function () {
		this.fireEvent("complete").fireEvent("failure", this.xhr)
	},
	setHeader: function (a, b) {
		this.headers.set(a, b);
		return this
	},
	getHeader: function (a) {
		return $try(function () {
			return this.xhr.getResponseHeader(a)
		}.bind(this))
	},
	check: function () {
		if (!this.running) {
			return true
		}
		switch (this.options.link) {
		case "cancel":
			this.cancel();
			return true;
		case "chain":
			this.chain(this.caller.bind(this, arguments));
			return false
		}
		return false
	},
	send: function (l) {
		if (!this.check(l)) {
			return this
		}
		this.running = true;
		var j = $type(l);
		if (j == "string" || j == "element") {
			l = {
				data: l
			}
		}
		var d = this.options;
		l = $extend({
			data: d.data,
			url: d.url,
			method: d.method
		}, l);
		var h = l.data,
			b = String(l.url),
			a = l.method.toLowerCase();
		switch ($type(h)) {
		case "element":
			h = document.id(h).toQueryString();
			break;
		case "object":
		case "hash":
			h = Hash.toQueryString(h)
		}
		if (this.options.format) {
			var k = "format=" + this.options.format;
			h = (h) ? k + "&" + h : k
		}
		if (this.options.emulation && !["get", "post"].contains(a)) {
			var i = "_method=" + a;
			h = (h) ? i + "&" + h : i;
			a = "post"
		}
		if (this.options.urlEncoded && a == "post") {
			var c = (this.options.encoding) ? "; charset=" + this.options.encoding : "";
			this.headers.set("Content-type", "application/x-www-form-urlencoded" + c)
		}
		if (this.options.noCache) {
			var g = "noCache=" + new Date().getTime();
			h = (h) ? g + "&" + h : g
		}
		var f = b.lastIndexOf("/");
		if (f > -1 && (f = b.indexOf("#")) > -1) {
			b = b.substr(0, f)
		}
		if (h && a == "get") {
			b = b + (b.contains("?") ? "&" : "?") + h;
			h = null
		}
		this.xhr.open(a.toUpperCase(), b, this.options.async);
		this.xhr.onreadystatechange = this.onStateChange.bind(this);
		this.headers.each(function (n, m) {
			try {
				this.xhr.setRequestHeader(m, n)
			} catch (o) {
				this.fireEvent("exception", [m, n])
			}
		}, this);
		this.fireEvent("request");
		this.xhr.send(h);
		if (!this.options.async) {
			this.onStateChange()
		}
		return this
	},
	cancel: function () {
		if (!this.running) {
			return this
		}
		this.running = false;
		this.xhr.abort();
		this.xhr.onreadystatechange = $empty;
		this.xhr = new Browser.Request();
		this.fireEvent("cancel");
		return this
	}
});
(function () {
	var a = {};
	["get", "post", "put", "delete", "GET", "POST", "PUT", "DELETE"].each(function (b) {
		a[b] = function () {
			var c = Array.link(arguments, {
				url: String.type,
				data: $defined
			});
			return this.send($extend(c, {
				method: b
			}))
		}
	});
	Request.implement(a)
})();
Element.Properties.send = {
	set: function (a) {
		var b = this.retrieve("send");
		if (b) {
			b.cancel()
		}
		return this.eliminate("send").store("send:options", $extend({
			data: this,
			link: "cancel",
			method: this.get("method") || "post",
			url: this.get("action")
		}, a))
	},
	get: function (a) {
		if (a || !this.retrieve("send")) {
			if (a || !this.retrieve("send:options")) {
				this.set("send", a)
			}
			this.store("send", new Request(this.retrieve("send:options")))
		}
		return this.retrieve("send")
	}
};
Element.implement({
	send: function (a) {
		var b = this.get("send");
		b.send({
			data: this,
			url: a || b.options.url
		});
		return this
	}
});
Request.HTML = new Class({
	Extends: Request,
	options: {
		update: false,
		append: false,
		evalScripts: true,
		filter: false
	},
	processHTML: function (c) {
		var b = c.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
		c = (b) ? b[1] : c;
		var a = new Element("div");
		return $try(function () {
			var d = "<root>" + c + "</root>",
				h;
			if (Browser.Engine.trident) {
				h = new ActiveXObject("Microsoft.XMLDOM");
				h.async = false;
				h.loadXML(d)
			} else {
				h = new DOMParser().parseFromString(d, "text/xml")
			}
			d = h.getElementsByTagName("root")[0];
			if (!d) {
				return null
			}
			for (var g = 0, f = d.childNodes.length; g < f; g++) {
				var j = Element.clone(d.childNodes[g], true, true);
				if (j) {
					a.grab(j)
				}
			}
			return a
		}) || a.set("html", c)
	},
	success: function (d) {
		var c = this.options,
			b = this.response;
		b.html = d.stripScripts(function (f) {
			b.javascript = f
		});
		var a = this.processHTML(b.html);
		b.tree = a.childNodes;
		b.elements = a.getElements("*");
		if (c.filter) {
			b.tree = b.elements.filter(c.filter)
		}
		if (c.update) {
			document.id(c.update).empty().set("html", b.html)
		} else {
			if (c.append) {
				document.id(c.append).adopt(a.getChildren())
			}
		}
		if (c.evalScripts) {
			$exec(b.javascript)
		}
		this.onSuccess(b.tree, b.elements, b.html, b.javascript)
	}
});
Element.Properties.load = {
	set: function (a) {
		var b = this.retrieve("load");
		if (b) {
			b.cancel()
		}
		return this.eliminate("load").store("load:options", $extend({
			data: this,
			link: "cancel",
			update: this,
			method: "get"
		}, a))
	},
	get: function (a) {
		if (a || !this.retrieve("load")) {
			if (a || !this.retrieve("load:options")) {
				this.set("load", a)
			}
			this.store("load", new Request.HTML(this.retrieve("load:options")))
		}
		return this.retrieve("load")
	}
};
Element.implement({
	load: function () {
		this.get("load").send(Array.link(arguments, {
			data: Object.type,
			url: String.type
		}));
		return this
	}
});
var JSON = new Hash(this.JSON && {
	stringify: JSON.stringify,
	parse: JSON.parse
}).extend({
	$specialChars: {
		"\b": "\\b",
		"\t": "\\t",
		"\n": "\\n",
		"\f": "\\f",
		"\r": "\\r",
		'"': '\\"',
		"\\": "\\\\"
	},
	$replaceChars: function (a) {
		return JSON.$specialChars[a] || "\\u00" + Math.floor(a.charCodeAt() / 16).toString(16) + (a.charCodeAt() % 16).toString(16)
	},
	encode: function (b) {
		switch ($type(b)) {
		case "string":
			return '"' + b.replace(/[\x00-\x1f\\"]/g, JSON.$replaceChars) + '"';
		case "array":
			return "[" + String(b.map(JSON.encode).clean()) + "]";
		case "object":
		case "hash":
			var a = [];
			Hash.each(b, function (f, d) {
				var c = JSON.encode(f);
				if (c) {
					a.push(JSON.encode(d) + ":" + c)
				}
			});
			return "{" + a + "}";
		case "number":
		case "boolean":
			return String(b);
		case false:
			return "null"
		}
		return null
	},
	decode: function (string, secure) {
		if ($type(string) != "string" || !string.length) {
			return null
		}
		if (secure && !(/^[,:{}\[\]0-9.\-+Eaeflnr-u \n\r\t]*$/).test(string.replace(/\\./g, "@").replace(/"[^"\\\n\r]*"/g, ""))) {
			return null
		}
		return eval("(" + string + ")")
	}
});
Request.JSON = new Class({
	Extends: Request,
	options: {
		secure: true
	},
	initialize: function (a) {
		this.parent(a);
		this.headers.extend({
			Accept: "application/json",
			"X-Request": "JSON"
		})
	},
	success: function (a) {
		this.response.json = JSON.decode(a, this.options.secure);
		this.onSuccess(this.response.json, a)
	}
});
var Cookie = new Class({
	Implements: Options,
	options: {
		path: false,
		domain: false,
		duration: false,
		secure: false,
		document: document
	},
	initialize: function (b, a) {
		this.key = b;
		this.setOptions(a)
	},
	write: function (b) {
		b = encodeURIComponent(b);
		if (this.options.domain) {
			b += "; domain=" + this.options.domain
		}
		if (this.options.path) {
			b += "; path=" + this.options.path
		}
		if (this.options.duration) {
			var a = new Date();
			a.setTime(a.getTime() + this.options.duration * 24 * 60 * 60 * 1000);
			b += "; expires=" + a.toGMTString()
		}
		if (this.options.secure) {
			b += "; secure"
		}
		this.options.document.cookie = this.key + "=" + b;
		return this
	},
	read: function () {
		var a = this.options.document.cookie.match("(?:^|;)\\s*" + this.key.escapeRegExp() + "=([^;]*)");
		return (a) ? decodeURIComponent(a[1]) : null
	},
	dispose: function () {
		new Cookie(this.key, $merge(this.options, {
			duration: -1
		})).write("");
		return this
	}
});
Cookie.write = function (b, c, a) {
	return new Cookie(b, a).write(c)
};
Cookie.read = function (a) {
	return new Cookie(a).read()
};
Cookie.dispose = function (b, a) {
	return new Cookie(b, a).dispose()
};
Element.Events.domready = {
	onAdd: function (a) {
		if (Browser.loaded) {
			a.call(this)
		}
	}
};
(function () {
	var b = function () {
			if (Browser.loaded) {
				return
			}
			Browser.loaded = true;
			window.fireEvent("domready");
			document.fireEvent("domready")
		};
	window.addEvent("load", b);
	if (Browser.Engine.trident) {
		var a = document.createElement("div");
		(function () {
			($try(function () {
				a.doScroll();
				return document.id(a).inject(document.body).set("html", "temp").dispose()
			})) ? b() : arguments.callee.delay(50)
		})()
	} else {
		if (Browser.Engine.webkit && Browser.Engine.version < 525) {
			(function () {
				(["loaded", "complete"].contains(document.readyState)) ? b() : arguments.callee.delay(50)
			})()
		} else {
			document.addEvent("DOMContentLoaded", b)
		}
	}
})();
Native.implement([Document, Element], {
	getElements: function (j, h) {
		j = j.split(",");
		var c, f = {};
		for (var d = 0, b = j.length; d < b; d++) {
			var a = j[d],
				g = Selectors.Utils.search(this, a, f);
			if (d != 0 && g.item) {
				g = $A(g)
			}
			c = (d == 0) ? g : (c.item) ? $A(c).concat(g) : c.concat(g)
		}
		return new Elements(c, {
			ddup: (j.length > 1),
			cash: !h
		})
	}
});
Element.implement({
	match: function (b) {
		if (!b || (b == this)) {
			return true
		}
		var d = Selectors.Utils.parseTagAndID(b);
		var a = d[0],
			f = d[1];
		if (!Selectors.Filters.byID(this, f) || !Selectors.Filters.byTag(this, a)) {
			return false
		}
		var c = Selectors.Utils.parseSelector(b);
		return (c) ? Selectors.Utils.filter(this, c, {}) : true
	}
});
var Selectors = {
	Cache: {
		nth: {},
		parsed: {}
	}
};
Selectors.RegExps = {
	id: (/#([\w-]+)/),
	tag: (/^(\w+|\*)/),
	quick: (/^(\w+|\*)$/),
	splitter: (/\s*([+>~\s])\s*([a-zA-Z#.*:\[])/g),
	combined: (/\.([\w-]+)|\[(\w+)(?:([!*^$~|]?=)(["']?)([^\4]*?)\4)?\]|:([\w-]+)(?:\(["']?(.*?)?["']?\)|$)/g)
};
Selectors.Utils = {
	chk: function (b, c) {
		if (!c) {
			return true
		}
		var a = $uid(b);
		if (!c[a]) {
			return c[a] = true
		}
		return false
	},
	parseNthArgument: function (i) {
		if (Selectors.Cache.nth[i]) {
			return Selectors.Cache.nth[i]
		}
		var f = i.match(/^([+-]?\d*)?([a-z]+)?([+-]?\d*)?$/);
		if (!f) {
			return false
		}
		var h = parseInt(f[1], 10);
		var d = (h || h === 0) ? h : 1;
		var g = f[2] || false;
		var c = parseInt(f[3], 10) || 0;
		if (d != 0) {
			c--;
			while (c < 1) {
				c += d
			}
			while (c >= d) {
				c -= d
			}
		} else {
			d = c;
			g = "index"
		}
		switch (g) {
		case "n":
			f = {
				a: d,
				b: c,
				special: "n"
			};
			break;
		case "odd":
			f = {
				a: 2,
				b: 0,
				special: "n"
			};
			break;
		case "even":
			f = {
				a: 2,
				b: 1,
				special: "n"
			};
			break;
		case "first":
			f = {
				a: 0,
				special: "index"
			};
			break;
		case "last":
			f = {
				special: "last-child"
			};
			break;
		case "only":
			f = {
				special: "only-child"
			};
			break;
		default:
			f = {
				a: (d - 1),
				special: "index"
			}
		}
		return Selectors.Cache.nth[i] = f
	},
	parseSelector: function (f) {
		if (Selectors.Cache.parsed[f]) {
			return Selectors.Cache.parsed[f]
		}
		var d, i = {
			classes: [],
			pseudos: [],
			attributes: []
		};
		while ((d = Selectors.RegExps.combined.exec(f))) {
			var j = d[1],
				h = d[2],
				g = d[3],
				b = d[5],
				c = d[6],
				k = d[7];
			if (j) {
				i.classes.push(j)
			} else {
				if (c) {
					var a = Selectors.Pseudo.get(c);
					if (a) {
						i.pseudos.push({
							parser: a,
							argument: k
						})
					} else {
						i.attributes.push({
							name: c,
							operator: "=",
							value: k
						})
					}
				} else {
					if (h) {
						i.attributes.push({
							name: h,
							operator: g,
							value: b
						})
					}
				}
			}
		}
		if (!i.classes.length) {
			delete i.classes
		}
		if (!i.attributes.length) {
			delete i.attributes
		}
		if (!i.pseudos.length) {
			delete i.pseudos
		}
		if (!i.classes && !i.attributes && !i.pseudos) {
			i = null
		}
		return Selectors.Cache.parsed[f] = i
	},
	parseTagAndID: function (b) {
		var a = b.match(Selectors.RegExps.tag);
		var c = b.match(Selectors.RegExps.id);
		return [(a) ? a[1] : "*", (c) ? c[1] : false]
	},
	filter: function (g, c, f) {
		var d;
		if (c.classes) {
			for (d = c.classes.length; d--; d) {
				var h = c.classes[d];
				if (!Selectors.Filters.byClass(g, h)) {
					return false
				}
			}
		}
		if (c.attributes) {
			for (d = c.attributes.length; d--; d) {
				var b = c.attributes[d];
				if (!Selectors.Filters.byAttribute(g, b.name, b.operator, b.value)) {
					return false
				}
			}
		}
		if (c.pseudos) {
			for (d = c.pseudos.length; d--; d) {
				var a = c.pseudos[d];
				if (!Selectors.Filters.byPseudo(g, a.parser, a.argument, f)) {
					return false
				}
			}
		}
		return true
	},
	getByTagAndID: function (b, a, d) {
		if (d) {
			var c = (b.getElementById) ? b.getElementById(d, true) : Element.getElementById(b, d, true);
			return (c && Selectors.Filters.byTag(c, a)) ? [c] : []
		} else {
			return b.getElementsByTagName(a)
		}
	},
	search: function (p, o, u) {
		var b = [];
		var c = o.trim().replace(Selectors.RegExps.splitter, function (k, j, i) {
			b.push(j);
			return ":)" + i
		}).split(":)");
		var q, f, B;
		for (var A = 0, w = c.length; A < w; A++) {
			var z = c[A];
			if (A == 0 && Selectors.RegExps.quick.test(z)) {
				q = p.getElementsByTagName(z);
				continue
			}
			var a = b[A - 1];
			var r = Selectors.Utils.parseTagAndID(z);
			var C = r[0],
				s = r[1];
			if (A == 0) {
				q = Selectors.Utils.getByTagAndID(p, C, s)
			} else {
				var d = {},
					h = [];
				for (var y = 0, x = q.length; y < x; y++) {
					h = Selectors.Getters[a](h, q[y], C, s, d)
				}
				q = h
			}
			var g = Selectors.Utils.parseSelector(z);
			if (g) {
				f = [];
				for (var v = 0, t = q.length; v < t; v++) {
					B = q[v];
					if (Selectors.Utils.filter(B, g, u)) {
						f.push(B)
					}
				}
				q = f
			}
		}
		return q
	}
};
Selectors.Getters = {
	" ": function (j, h, k, a, f) {
		var d = Selectors.Utils.getByTagAndID(h, k, a);
		for (var c = 0, b = d.length; c < b; c++) {
			var g = d[c];
			if (Selectors.Utils.chk(g, f)) {
				j.push(g)
			}
		}
		return j
	},
	">": function (j, h, k, a, g) {
		var c = Selectors.Utils.getByTagAndID(h, k, a);
		for (var f = 0, d = c.length; f < d; f++) {
			var b = c[f];
			if (b.parentNode == h && Selectors.Utils.chk(b, g)) {
				j.push(b)
			}
		}
		return j
	},
	"+": function (c, b, a, f, d) {
		while ((b = b.nextSibling)) {
			if (b.nodeType == 1) {
				if (Selectors.Utils.chk(b, d) && Selectors.Filters.byTag(b, a) && Selectors.Filters.byID(b, f)) {
					c.push(b)
				}
				break
			}
		}
		return c
	},
	"~": function (c, b, a, f, d) {
		while ((b = b.nextSibling)) {
			if (b.nodeType == 1) {
				if (!Selectors.Utils.chk(b, d)) {
					break
				}
				if (Selectors.Filters.byTag(b, a) && Selectors.Filters.byID(b, f)) {
					c.push(b)
				}
			}
		}
		return c
	}
};
Selectors.Filters = {
	byTag: function (b, a) {
		return (a == "*" || (b.tagName && b.tagName.toLowerCase() == a))
	},
	byID: function (a, b) {
		return (!b || (a.id && a.id == b))
	},
	byClass: function (b, a) {
		return (b.className && b.className.contains && b.className.contains(a, " "))
	},
	byPseudo: function (a, d, c, b) {
		return d.call(a, c, b)
	},
	byAttribute: function (c, d, b, f) {
		var a = Element.prototype.getProperty.call(c, d);
		if (!a) {
			return (b == "!=")
		}
		if (!b || f == undefined) {
			return true
		}
		switch (b) {
		case "=":
			return (a == f);
		case "*=":
			return (a.contains(f));
		case "^=":
			return (a.substr(0, f.length) == f);
		case "$=":
			return (a.substr(a.length - f.length) == f);
		case "!=":
			return (a != f);
		case "~=":
			return a.contains(f, " ");
		case "|=":
			return a.contains(f, "-")
		}
		return false
	}
};
Selectors.Pseudo = new Hash({
	checked: function () {
		return this.checked
	},
	empty: function () {
		return !(this.innerText || this.textContent || "").length
	},
	not: function (a) {
		return !Element.match(this, a)
	},
	contains: function (a) {
		return (this.innerText || this.textContent || "").contains(a)
	},
	"first-child": function () {
		return Selectors.Pseudo.index.call(this, 0)
	},
	"last-child": function () {
		var a = this;
		while ((a = a.nextSibling)) {
			if (a.nodeType == 1) {
				return false
			}
		}
		return true
	},
	"only-child": function () {
		var b = this;
		while ((b = b.previousSibling)) {
			if (b.nodeType == 1) {
				return false
			}
		}
		var a = this;
		while ((a = a.nextSibling)) {
			if (a.nodeType == 1) {
				return false
			}
		}
		return true
	},
	"nth-child": function (h, f) {
		h = (h == undefined) ? "n" : h;
		var c = Selectors.Utils.parseNthArgument(h);
		if (c.special != "n") {
			return Selectors.Pseudo[c.special].call(this, c.a, f)
		}
		var g = 0;
		f.positions = f.positions || {};
		var d = $uid(this);
		if (!f.positions[d]) {
			var b = this;
			while ((b = b.previousSibling)) {
				if (b.nodeType != 1) {
					continue
				}
				g++;
				var a = f.positions[$uid(b)];
				if (a != undefined) {
					g = a + g;
					break
				}
			}
			f.positions[d] = g
		}
		return (f.positions[d] % c.a == c.b)
	},
	index: function (a) {
		var b = this,
			c = 0;
		while ((b = b.previousSibling)) {
			if (b.nodeType == 1 && ++c > a) {
				return false
			}
		}
		return (c == a)
	},
	even: function (b, a) {
		return Selectors.Pseudo["nth-child"].call(this, "2n+1", a)
	},
	odd: function (b, a) {
		return Selectors.Pseudo["nth-child"].call(this, "2n", a)
	},
	selected: function () {
		return this.selected
	},
	enabled: function () {
		return (this.disabled === false)
	}
});
var Swiff = new Class({
	Implements: [Options],
	options: {
		id: null,
		height: 1,
		width: 1,
		container: null,
		properties: {},
		params: {
			quality: "high",
			allowScriptAccess: "always",
			wMode: "transparent",
			swLiveConnect: true
		},
		callBacks: {},
		vars: {}
	},
	toElement: function () {
		return this.object
	},
	initialize: function (m, n) {
		this.instance = "Swiff_" + $time();
		this.setOptions(n);
		n = this.options;
		var b = this.id = n.id || this.instance;
		var a = document.id(n.container);
		Swiff.CallBacks[this.instance] = {};
		var f = n.params,
			h = n.vars,
			g = n.callBacks;
		var i = $extend({
			height: n.height,
			width: n.width
		}, n.properties);
		var l = this;
		for (var d in g) {
			Swiff.CallBacks[this.instance][d] = (function (o) {
				return function () {
					return o.apply(l.object, arguments)
				}
			})(g[d]);
			h[d] = "Swiff.CallBacks." + this.instance + "." + d
		}
		f.flashVars = Hash.toQueryString(h);
		if (Browser.Engine.trident) {
			i.classid = "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000";
			f.movie = m
		} else {
			i.type = "application/x-shockwave-flash";
			i.data = m
		}
		var k = '<object id="' + b + '"';
		for (var j in i) {
			k += " " + j + '="' + i[j] + '"'
		}
		k += ">";
		for (var c in f) {
			if (f[c]) {
				k += '<param name="' + c + '" value="' + f[c] + '" />'
			}
		}
		k += "</object>";
		this.object = ((a) ? a.empty() : new Element("div")).set("html", k).firstChild
	},
	replaces: function (a) {
		a = document.id(a, true);
		a.parentNode.replaceChild(this.toElement(), a);
		return this
	},
	inject: function (a) {
		document.id(a, true).appendChild(this.toElement());
		return this
	},
	remote: function () {
		return Swiff.remote.apply(Swiff, [this.toElement()].extend(arguments))
	}
});
Swiff.CallBacks = {};
Swiff.remote = function (obj, fn) {
	var rs = obj.CallFunction('<invoke name="' + fn + '" returntype="javascript">' + __flash__argumentsToXML(arguments, 2) + "</invoke>");
	return eval(rs)
};
MooTools.More = {
	version: "1.2.4.4",
	build: "6f6057dc645fdb7547689183b2311063bd653ddf"
};
(function () {
	var a = {
		language: "en-US",
		languages: {
			"en-US": {}
		},
		cascades: ["en-US"]
	};
	var b;
	MooTools.lang = new Events();
	$extend(MooTools.lang, {
		setLanguage: function (c) {
			if (!a.languages[c]) {
				return this
			}
			a.language = c;
			this.load();
			this.fireEvent("langChange", c);
			return this
		},
		load: function () {
			var c = this.cascade(this.getCurrentLanguage());
			b = {};
			$each(c, function (f, d) {
				b[d] = this.lambda(f)
			}, this)
		},
		getCurrentLanguage: function () {
			return a.language
		},
		addLanguage: function (c) {
			a.languages[c] = a.languages[c] || {};
			return this
		},
		cascade: function (f) {
			var c = (a.languages[f] || {}).cascades || [];
			c.combine(a.cascades);
			c.erase(f).push(f);
			var d = c.map(function (g) {
				return a.languages[g]
			}, this);
			return $merge.apply(this, d)
		},
		lambda: function (c) {
			(c || {}).get = function (f, d) {
				return $lambda(c[f]).apply(this, $splat(d))
			};
			return c
		},
		get: function (f, d, c) {
			if (b && b[f]) {
				return (d ? b[f].get(d, c) : b[f])
			}
		},
		set: function (d, f, c) {
			this.addLanguage(d);
			langData = a.languages[d];
			if (!langData[f]) {
				langData[f] = {}
			}
			$extend(langData[f], c);
			if (d == this.getCurrentLanguage()) {
				this.load();
				this.fireEvent("langChange", d)
			}
			return this
		},
		list: function () {
			return Hash.getKeys(a.languages)
		}
	})
})();
Class.refactor = function (b, a) {
	$each(a, function (f, d) {
		var c = b.prototype[d];
		if (c && (c = c._origin) && typeof f == "function") {
			b.implement(d, function () {
				var g = this.previous;
				this.previous = c;
				var h = f.apply(this, arguments);
				this.previous = g;
				return h
			})
		} else {
			b.implement(d, f)
		}
	});
	return b
};
Class.Mutators.Binds = function (a) {
	return a
};
Class.Mutators.initialize = function (a) {
	return function () {
		$splat(this.Binds).each(function (b) {
			var c = this[b];
			if (c) {
				this[b] = c.bind(this)
			}
		}, this);
		return a.apply(this, arguments)
	}
};
Class.Occlude = new Class({
	occlude: function (c, b) {
		b = document.id(b || this.element);
		var a = b.retrieve(c || this.property);
		if (a && !$defined(this.occluded)) {
			return this.occluded = a
		}
		this.occluded = false;
		b.store(c || this.property, this);
		return this.occluded
	}
});
Array.implement({
	min: function () {
		return Math.min.apply(null, this)
	},
	max: function () {
		return Math.max.apply(null, this)
	},
	average: function () {
		return this.length ? this.sum() / this.length : 0
	},
	sum: function () {
		var a = 0,
			b = this.length;
		if (b) {
			do {
				a += this[--b]
			} while (b)
		}
		return a
	},
	unique: function () {
		return [].combine(this)
	},
	shuffle: function () {
		for (var b = this.length; b && --b;) {
			var a = this[b],
				c = Math.floor(Math.random() * (b + 1));
			this[b] = this[c];
			this[c] = a
		}
		return this
	}
});
Hash.implement({
	getFromPath: function (a) {
		var b = this.getClean();
		a.replace(/\[([^\]]+)\]|\.([^.[]+)|[^[.]+/g, function (c) {
			if (!b) {
				return null
			}
			var d = arguments[2] || arguments[1] || arguments[0];
			b = (d in b) ? b[d] : null;
			return c
		});
		return b
	},
	cleanValues: function (a) {
		a = a || $defined;
		this.each(function (c, b) {
			if (!a(c)) {
				this.erase(b)
			}
		}, this);
		return this
	},
	run: function () {
		var a = arguments;
		this.each(function (c, b) {
			if ($type(c) == "function") {
				c.run(a)
			}
		})
	}
});
(function () {
	var b = ["A", "a", "¡", "·", "¬", "‚", "A", "a", "ƒ", "‰", "A", "a", "√", "„", "•", "π", "∆", "Ê", "»", "Ë", "«", "Á", "œ", "Ô", "–", "", "E", "e", "…", "È", "E", "e", "À", "Î", "Ã", "Ï", " ", "Í", "G", "g", "I", "i", "Õ", "Ì", "Œ", "Ó", "I", "i", "≈", "Â", "º", "æ", "£", "≥", "N", "n", "“", "Ú", "—", "Ò", "O", "o", "”", "Û", "‘", "Ù", "O", "o", "÷", "ˆ", "O", "o", "ı", "ÿ", "¯", "¿", "‡", "ä", "ö", "™", "∫", "å", "ú", "ç", "ù", "ç", "ù", "ﬁ", "˛", "U", "u", "⁄", "˙", "U", "u", "‹", "¸", "Ÿ", "˘", "Y", "y", "˝", "›", "é", "û", "è", "ü", "Ø", "ø", "?", "?", "?", "?", "ﬂ", "O", "o", "A", "a", "µ"];
	var a = ["A", "a", "A", "a", "A", "a", "A", "a", "Ae", "ae", "A", "a", "A", "a", "A", "a", "C", "c", "C", "c", "C", "c", "D", "d", "D", "d", "E", "e", "E", "e", "E", "e", "E", "e", "E", "e", "E", "e", "G", "g", "I", "i", "I", "i", "I", "i", "I", "i", "L", "l", "L", "l", "L", "l", "N", "n", "N", "n", "N", "n", "O", "o", "O", "o", "O", "o", "O", "o", "Oe", "oe", "O", "o", "o", "R", "r", "R", "r", "S", "s", "S", "s", "S", "s", "T", "t", "T", "t", "T", "t", "U", "u", "U", "u", "U", "u", "Ue", "ue", "U", "u", "Y", "y", "Y", "y", "Z", "z", "Z", "z", "Z", "z", "TH", "th", "DH", "dh", "ss", "OE", "oe", "AE", "ae", "u"];
	var d = {
		"[\xa0\u2002\u2003\u2009]": " ",
		"\xb7": "*",
		"[\u2018\u2019]": "'",
		"[\u201c\u201d]": '"',
		"\u2026": "...",
		"\u2013": "-",
		"\u2014": "--",
		"\uFFFD": "&raquo;"
	};
	var c = function (f, g) {
			f = f || "";
			var h = g ? "<" + f + "[^>]*>([\\s\\S]*?)</" + f + ">" : "</?" + f + "([^>]+)?>";
			reg = new RegExp(h, "gi");
			return reg
		};
	String.implement({
		standardize: function () {
			var f = this;
			b.each(function (h, g) {
				f = f.replace(new RegExp(h, "g"), a[g])
			});
			return f
		},
		repeat: function (f) {
			return new Array(f + 1).join(this)
		},
		pad: function (g, i, f) {
			if (this.length >= g) {
				return this
			}
			var h = (i == null ? " " : "" + i).repeat(g - this.length).substr(0, g - this.length);
			if (!f || f == "right") {
				return this + h
			}
			if (f == "left") {
				return h + this
			}
			return h.substr(0, (h.length / 2).floor()) + this + h.substr(0, (h.length / 2).ceil())
		},
		getTags: function (f, g) {
			return this.match(c(f, g)) || []
		},
		stripTags: function (f, g) {
			return this.replace(c(f, g), "")
		},
		tidy: function () {
			var f = this.toString();
			$each(d, function (h, g) {
				f = f.replace(new RegExp(g, "g"), h)
			});
			return f
		}
	})
})();
String.implement({
	parseQueryString: function () {
		var b = this.split(/[&;]/),
			a = {};
		if (b.length) {
			b.each(function (h) {
				var c = h.indexOf("="),
					d = c < 0 ? [""] : h.substr(0, c).match(/[^\]\[]+/g),
					f = decodeURIComponent(h.substr(c + 1)),
					g = a;
				d.each(function (k, j) {
					var l = g[k];
					if (j < d.length - 1) {
						g = g[k] = l || {}
					} else {
						if ($type(l) == "array") {
							l.push(f)
						} else {
							g[k] = $defined(l) ? [l, f] : f
						}
					}
				})
			})
		}
		return a
	},
	cleanQueryString: function (a) {
		return this.split("&").filter(function (f) {
			var b = f.indexOf("="),
				c = b < 0 ? "" : f.substr(0, b),
				d = f.substr(b + 1);
			return a ? a.run([c, d]) : $chk(d)
		}).join("&")
	}
});
var URI = new Class({
	Implements: Options,
	options: {},
	regex: /^(?:(\w+):)?(?:\/\/(?:(?:([^:@\/]*):?([^:@\/]*))?@)?([^:\/?#]*)(?::(\d*))?)?(\.\.?$|(?:[^?#\/]*\/)*)([^?#]*)(?:\?([^#]*))?(?:#(.*))?/,
	parts: ["scheme", "user", "password", "host", "port", "directory", "file", "query", "fragment"],
	schemes: {
		http: 80,
		https: 443,
		ftp: 21,
		rtsp: 554,
		mms: 1755,
		file: 0
	},
	initialize: function (b, a) {
		this.setOptions(a);
		var c = this.options.base || URI.base;
		if (!b) {
			b = c
		}
		if (b && b.parsed) {
			this.parsed = $unlink(b.parsed)
		} else {
			this.set("value", b.href || b.toString(), c ? new URI(c) : false)
		}
	},
	parse: function (c, b) {
		var a = c.match(this.regex);
		if (!a) {
			return false
		}
		a.shift();
		return this.merge(a.associate(this.parts), b)
	},
	merge: function (b, a) {
		if ((!b || !b.scheme) && (!a || !a.scheme)) {
			return false
		}
		if (a) {
			this.parts.every(function (c) {
				if (b[c]) {
					return false
				}
				b[c] = a[c] || "";
				return true
			})
		}
		b.port = b.port || this.schemes[b.scheme.toLowerCase()];
		b.directory = b.directory ? this.parseDirectory(b.directory, a ? a.directory : "") : "/";
		return b
	},
	parseDirectory: function (b, c) {
		b = (b.substr(0, 1) == "/" ? "" : (c || "/")) + b;
		if (!b.test(URI.regs.directoryDot)) {
			return b
		}
		var a = [];
		b.replace(URI.regs.endSlash, "").split("/").each(function (d) {
			if (d == ".." && a.length > 0) {
				a.pop()
			} else {
				if (d != ".") {
					a.push(d)
				}
			}
		});
		return a.join("/") + "/"
	},
	combine: function (a) {
		return a.value || a.scheme + "://" + (a.user ? a.user + (a.password ? ":" + a.password : "") + "@" : "") + (a.host || "") + (a.port && a.port != this.schemes[a.scheme] ? ":" + a.port : "") + (a.directory || "/") + (a.file || "") + (a.query ? "?" + a.query : "") + (a.fragment ? "#" + a.fragment : "")
	},
	set: function (b, d, c) {
		if (b == "value") {
			var a = d.match(URI.regs.scheme);
			if (a) {
				a = a[1]
			}
			if (a && !$defined(this.schemes[a.toLowerCase()])) {
				this.parsed = {
					scheme: a,
					value: d
				}
			} else {
				this.parsed = this.parse(d, (c || this).parsed) || (a ? {
					scheme: a,
					value: d
				} : {
					value: d
				})
			}
		} else {
			if (b == "data") {
				this.setData(d)
			} else {
				this.parsed[b] = d
			}
		}
		return this
	},
	get: function (a, b) {
		switch (a) {
		case "value":
			return this.combine(this.parsed, b ? b.parsed : false);
		case "data":
			return this.getData()
		}
		return this.parsed[a] || ""
	},
	go: function () {
		document.location.href = this.toString()
	},
	toURI: function () {
		return this
	},
	getData: function (c, b) {
		var a = this.get(b || "query");
		if (!$chk(a)) {
			return c ? null : {}
		}
		var d = a.parseQueryString();
		return c ? d[c] : d
	},
	setData: function (a, c, b) {
		if (typeof a == "string") {
			data = this.getData();
			data[arguments[0]] = arguments[1];
			a = data
		} else {
			if (c) {
				a = $merge(this.getData(), a)
			}
		}
		return this.set(b || "query", Hash.toQueryString(a))
	},
	clearData: function (a) {
		return this.set(a || "query", "")
	}
});
URI.prototype.toString = URI.prototype.valueOf = function () {
	return this.get("value")
};
URI.regs = {
	endSlash: /\/$/,
	scheme: /^(\w+):/,
	directoryDot: /\.\/|\.$/
};
URI.base = new URI(document.getElements("base[href]", true).getLast(), {
	base: document.location
});
String.implement({
	toURI: function (a) {
		return new URI(this, a)
	}
});
Element.implement({
	tidy: function () {
		this.set("value", this.get("value").tidy())
	},
	getTextInRange: function (b, a) {
		return this.get("value").substring(b, a)
	},
	getSelectedText: function () {
		if (this.setSelectionRange) {
			return this.getTextInRange(this.getSelectionStart(), this.getSelectionEnd())
		}
		return document.selection.createRange().text
	},
	getSelectedRange: function () {
		if ($defined(this.selectionStart)) {
			return {
				start: this.selectionStart,
				end: this.selectionEnd
			}
		}
		var f = {
			start: 0,
			end: 0
		};
		var a = this.getDocument().selection.createRange();
		if (!a || a.parentElement() != this) {
			return f
		}
		var c = a.duplicate();
		if (this.type == "text") {
			f.start = 0 - c.moveStart("character", -100000);
			f.end = f.start + a.text.length
		} else {
			var b = this.get("value");
			var d = b.length;
			c.moveToElementText(this);
			c.setEndPoint("StartToEnd", a);
			if (c.text.length) {
				d -= b.match(/[\n\r]*$/)[0].length
			}
			f.end = d - c.text.length;
			c.setEndPoint("StartToStart", a);
			f.start = d - c.text.length
		}
		return f
	},
	getSelectionStart: function () {
		return this.getSelectedRange().start
	},
	getSelectionEnd: function () {
		return this.getSelectedRange().end
	},
	setCaretPosition: function (a) {
		if (a == "end") {
			a = this.get("value").length
		}
		this.selectRange(a, a);
		return this
	},
	getCaretPosition: function () {
		return this.getSelectedRange().start
	},
	selectRange: function (f, a) {
		if (this.setSelectionRange) {
			this.focus();
			this.setSelectionRange(f, a)
		} else {
			var c = this.get("value");
			var d = c.substr(f, a - f).replace(/\r/g, "").length;
			f = c.substr(0, f).replace(/\r/g, "").length;
			var b = this.createTextRange();
			b.collapse(true);
			b.moveEnd("character", f + d);
			b.moveStart("character", f);
			b.select()
		}
		return this
	},
	insertAtCursor: function (b, a) {
		var d = this.getSelectedRange();
		var c = this.get("value");
		this.set("value", c.substring(0, d.start) + b + c.substring(d.end, c.length));
		if ($pick(a, true)) {
			this.selectRange(d.start, d.start + b.length)
		} else {
			this.setCaretPosition(d.start + b.length)
		}
		return this
	},
	insertAroundCursor: function (b, a) {
		b = $extend({
			before: "",
			defaultMiddle: "",
			after: ""
		}, b);
		var c = this.getSelectedText() || b.defaultMiddle;
		var h = this.getSelectedRange();
		var g = this.get("value");
		if (h.start == h.end) {
			this.set("value", g.substring(0, h.start) + b.before + c + b.after + g.substring(h.end, g.length));
			this.selectRange(h.start + b.before.length, h.end + b.before.length + c.length)
		} else {
			var d = g.substring(h.start, h.end);
			this.set("value", g.substring(0, h.start) + b.before + d + b.after + g.substring(h.end, g.length));
			var f = h.start + b.before.length;
			if ($pick(a, true)) {
				this.selectRange(f, f + d.length)
			} else {
				this.setCaretPosition(f + g.length)
			}
		}
		return this
	}
});
Elements.from = function (f, d) {
	if ($pick(d, true)) {
		f = f.stripScripts()
	}
	var b, c = f.match(/^\s*<(t[dhr]|tbody|tfoot|thead)/i);
	if (c) {
		b = new Element("table");
		var a = c[1].toLowerCase();
		if (["td", "th", "tr"].contains(a)) {
			b = new Element("tbody").inject(b);
			if (a != "tr") {
				b = new Element("tr").inject(b)
			}
		}
	}
	return (b || new Element("div")).set("html", f).getChildren()
};
Element.implement({
	measure: function (f) {
		var h = function (i) {
				return !!(!i || i.offsetHeight || i.offsetWidth)
			};
		if (h(this)) {
			return f.apply(this)
		}
		var d = this.getParent(),
			g = [],
			b = [];
		while (!h(d) && d != document.body) {
			b.push(d.expose());
			d = d.getParent()
		}
		var c = this.expose();
		var a = f.apply(this);
		c();
		b.each(function (i) {
			i()
		});
		return a
	},
	expose: function () {
		if (this.getStyle("display") != "none") {
			return $empty
		}
		var a = this.style.cssText;
		this.setStyles({
			display: "block",
			position: "absolute",
			visibility: "hidden"
		});
		return function () {
			this.style.cssText = a
		}.bind(this)
	},
	getDimensions: function (a) {
		a = $merge({
			computeSize: false
		}, a);
		var f = {};
		var d = function (h, g) {
				return (g.computeSize) ? h.getComputedSize(g) : h.getSize()
			};
		var b = this.getParent("body");
		if (b && this.getStyle("display") == "none") {
			f = this.measure(function () {
				return d(this, a)
			})
		} else {
			if (b) {
				try {
					f = d(this, a)
				} catch (c) {}
			} else {
				f = {
					x: 0,
					y: 0
				}
			}
		}
		return $chk(f.x) ? $extend(f, {
			width: f.x,
			height: f.y
		}) : $extend(f, {
			x: f.width,
			y: f.height
		})
	},
	getComputedSize: function (a) {
		a = $merge({
			styles: ["padding", "border"],
			plains: {
				height: ["top", "bottom"],
				width: ["left", "right"]
			},
			mode: "both"
		}, a);
		var c = {
			width: 0,
			height: 0
		};
		switch (a.mode) {
		case "vertical":
			delete c.width;
			delete a.plains.width;
			break;
		case "horizontal":
			delete c.height;
			delete a.plains.height;
			break
		}
		var b = [];
		$each(a.plains, function (h, g) {
			h.each(function (i) {
				a.styles.each(function (j) {
					b.push((j == "border") ? j + "-" + i + "-width" : j + "-" + i)
				})
			})
		});
		var f = {};
		b.each(function (g) {
			f[g] = this.getComputedStyle(g)
		}, this);
		var d = [];
		$each(a.plains, function (h, g) {
			var i = g.capitalize();
			c["total" + i] = c["computed" + i] = 0;
			h.each(function (j) {
				c["computed" + j.capitalize()] = 0;
				b.each(function (l, k) {
					if (l.test(j)) {
						f[l] = f[l].toInt() || 0;
						c["total" + i] = c["total" + i] + f[l];
						c["computed" + j.capitalize()] = c["computed" + j.capitalize()] + f[l]
					}
					if (l.test(j) && g != l && (l.test("border") || l.test("padding")) && !d.contains(l)) {
						d.push(l);
						c["computed" + i] = c["computed" + i] - f[l]
					}
				})
			})
		});
		["Width", "Height"].each(function (h) {
			var g = h.toLowerCase();
			if (!$chk(c[g])) {
				return
			}
			c[g] = c[g] + this["offset" + h] + c["computed" + h];
			c["total" + h] = c[g] + c["total" + h];
			delete c["computed" + h]
		}, this);
		return $extend(f, c)
	}
});
(function () {
	var a = Element.prototype.position;
	Element.implement({
		position: function (h) {
			if (h && ($defined(h.x) || $defined(h.y))) {
				return a ? a.apply(this, arguments) : this
			}
			$each(h || {}, function (w, u) {
				if (!$defined(w)) {
					delete h[u]
				}
			});
			h = $merge({
				relativeTo: document.body,
				position: {
					x: "center",
					y: "center"
				},
				edge: false,
				offset: {
					x: 0,
					y: 0
				},
				returnPos: false,
				relFixedPosition: false,
				ignoreMargins: false,
				ignoreScroll: false,
				allowNegative: false
			}, h);
			var s = {
				x: 0,
				y: 0
			},
				f = false;
			var c = this.measure(function () {
				return document.id(this.getOffsetParent())
			});
			if (c && c != this.getDocument().body) {
				s = c.measure(function () {
					return this.getPosition()
				});
				f = c != document.id(h.relativeTo);
				h.offset.x = h.offset.x - s.x;
				h.offset.y = h.offset.y - s.y
			}
			var t = function (u) {
					if ($type(u) != "string") {
						return u
					}
					u = u.toLowerCase();
					var v = {};
					if (u.test("left")) {
						v.x = "left"
					} else {
						if (u.test("right")) {
							v.x = "right"
						} else {
							v.x = "center"
						}
					}
					if (u.test("upper") || u.test("top")) {
						v.y = "top"
					} else {
						if (u.test("bottom")) {
							v.y = "bottom"
						} else {
							v.y = "center"
						}
					}
					return v
				};
			h.edge = t(h.edge);
			h.position = t(h.position);
			if (!h.edge) {
				if (h.position.x == "center" && h.position.y == "center") {
					h.edge = {
						x: "center",
						y: "center"
					}
				} else {
					h.edge = {
						x: "left",
						y: "top"
					}
				}
			}
			this.setStyle("position", "absolute");
			var g = document.id(h.relativeTo) || document.body,
				d = g == document.body ? window.getScroll() : g.getPosition(),
				m = d.y,
				i = d.x;
			var o = this.getDimensions({
				computeSize: true,
				styles: ["padding", "border", "margin"]
			});
			var k = {},
				p = h.offset.y,
				r = h.offset.x,
				l = window.getSize();
			switch (h.position.x) {
			case "left":
				k.x = i + r;
				break;
			case "right":
				k.x = i + r + g.offsetWidth;
				break;
			default:
				k.x = i + ((g == document.body ? l.x : g.offsetWidth) / 2) + r;
				break
			}
			switch (h.position.y) {
			case "top":
				k.y = m + p;
				break;
			case "bottom":
				k.y = m + p + g.offsetHeight;
				break;
			default:
				k.y = m + ((g == document.body ? l.y : g.offsetHeight) / 2) + p;
				break
			}
			if (h.edge) {
				var b = {};
				switch (h.edge.x) {
				case "left":
					b.x = 0;
					break;
				case "right":
					b.x = -o.x - o.computedRight - o.computedLeft;
					break;
				default:
					b.x = -(o.totalWidth / 2);
					break
				}
				switch (h.edge.y) {
				case "top":
					b.y = 0;
					break;
				case "bottom":
					b.y = -o.y - o.computedTop - o.computedBottom;
					break;
				default:
					b.y = -(o.totalHeight / 2);
					break
				}
				k.x += b.x;
				k.y += b.y
			}
			k = {
				left: ((k.x >= 0 || f || h.allowNegative) ? k.x : 0).toInt(),
				top: ((k.y >= 0 || f || h.allowNegative) ? k.y : 0).toInt()
			};
			var j = {
				left: "x",
				top: "y"
			};
			["minimum", "maximum"].each(function (u) {
				["left", "top"].each(function (v) {
					var w = h[u] ? h[u][j[v]] : null;
					if (w != null && k[v] < w) {
						k[v] = w
					}
				})
			});
			if (g.getStyle("position") == "fixed" || h.relFixedPosition) {
				var n = window.getScroll();
				k.top += n.y;
				k.left += n.x
			}
			if (h.ignoreScroll) {
				var q = g.getScroll();
				k.top -= q.y;
				k.left -= q.x
			}
			if (h.ignoreMargins) {
				k.left += (h.edge.x == "right" ? o["margin-right"] : h.edge.x == "center" ? -o["margin-left"] + ((o["margin-right"] + o["margin-left"]) / 2) : -o["margin-left"]);
				k.top += (h.edge.y == "bottom" ? o["margin-bottom"] : h.edge.y == "center" ? -o["margin-top"] + ((o["margin-bottom"] + o["margin-top"]) / 2) : -o["margin-top"])
			}
			k.left = Math.ceil(k.left);
			k.top = Math.ceil(k.top);
			if (h.returnPos) {
				return k
			} else {
				this.setStyles(k)
			}
			return this
		}
	})
})();
Element.implement({
	isDisplayed: function () {
		return this.getStyle("display") != "none"
	},
	isVisible: function () {
		var a = this.offsetWidth,
			b = this.offsetHeight;
		return (a == 0 && b == 0) ? false : (a > 0 && b > 0) ? true : this.isDisplayed()
	},
	toggle: function () {
		return this[this.isDisplayed() ? "hide" : "show"]()
	},
	hide: function () {
		var b;
		try {
			b = this.getStyle("display")
		} catch (a) {}
		return this.store("originalDisplay", b || "").setStyle("display", "none")
	},
	show: function (a) {
		a = a || this.retrieve("originalDisplay") || "block";
		return this.setStyle("display", (a == "none") ? "block" : a)
	},
	swapClass: function (a, b) {
		return this.removeClass(a).addClass(b)
	}
});
var OverText = new Class({
	Implements: [Options, Events, Class.Occlude],
	Binds: ["reposition", "assert", "focus", "hide"],
	options: {
		element: "label",
		positionOptions: {
			position: "upperLeft",
			edge: "upperLeft",
			offset: {
				x: 4,
				y: 2
			}
		},
		poll: false,
		pollInterval: 250,
		wrap: false
	},
	property: "OverText",
	initialize: function (b, a) {
		this.element = document.id(b);
		if (this.occlude()) {
			return this.occluded
		}
		this.setOptions(a);
		this.attach(this.element);
		OverText.instances.push(this);
		if (this.options.poll) {
			this.poll()
		}
		return this
	},
	toElement: function () {
		return this.element
	},
	attach: function () {
		var a = this.options.textOverride || this.element.get("alt") || this.element.get("title");
		if (!a) {
			return
		}
		this.text = new Element(this.options.element, {
			"class": "overTxtLabel",
			styles: {
				lineHeight: "normal",
				position: "absolute",
				cursor: "text"
			},
			html: a,
			events: {
				click: this.hide.pass(this.options.element == "label", this)
			}
		}).inject(this.element, "after");
		if (this.options.element == "label") {
			if (!this.element.get("id")) {
				this.element.set("id", "input_" + new Date().getTime())
			}
			this.text.set("for", this.element.get("id"))
		}
		if (this.options.wrap) {
			this.textHolder = new Element("div", {
				styles: {
					lineHeight: "normal",
					position: "relative"
				},
				"class": "overTxtWrapper"
			}).adopt(this.text).inject(this.element, "before")
		}
		this.element.addEvents({
			focus: this.focus,
			blur: this.assert,
			change: this.assert
		}).store("OverTextDiv", this.text);
		window.addEvent("resize", this.reposition.bind(this));
		this.assert(true);
		this.reposition()
	},
	wrap: function () {
		if (this.options.element == "label") {
			if (!this.element.get("id")) {
				this.element.set("id", "input_" + new Date().getTime())
			}
			this.text.set("for", this.element.get("id"))
		}
	},
	startPolling: function () {
		this.pollingPaused = false;
		return this.poll()
	},
	poll: function (a) {
		if (this.poller && !a) {
			return this
		}
		var b = function () {
				if (!this.pollingPaused) {
					this.assert(true)
				}
			}.bind(this);
		if (a) {
			$clear(this.poller)
		} else {
			this.poller = b.periodical(this.options.pollInterval, this)
		}
		return this
	},
	stopPolling: function () {
		this.pollingPaused = true;
		return this.poll(true)
	},
	focus: function () {
		if (this.text && (!this.text.isDisplayed() || this.element.get("disabled"))) {
			return
		}
		this.hide()
	},
	hide: function (c, a) {
		if (this.text && (this.text.isDisplayed() && (!this.element.get("disabled") || a))) {
			this.text.hide();
			this.fireEvent("textHide", [this.text, this.element]);
			this.pollingPaused = true;
			if (!c) {
				try {
					this.element.fireEvent("focus");
					this.element.focus()
				} catch (b) {}
			}
		}
		return this
	},
	show: function () {
		if (this.text && !this.text.isDisplayed()) {
			this.text.show();
			this.reposition();
			this.fireEvent("textShow", [this.text, this.element]);
			this.pollingPaused = false
		}
		return this
	},
	assert: function (a) {
		this[this.test() ? "show" : "hide"](a)
	},
	test: function () {
		var a = this.element.get("value");
		return !a
	},
	reposition: function () {
		this.assert(true);
		if (!this.element.isVisible()) {
			return this.stopPolling().hide()
		}
		if (this.text && this.test()) {
			this.text.position($merge(this.options.positionOptions, {
				relativeTo: this.element
			}))
		}
		return this
	}
});
OverText.instances = [];
$extend(OverText, {
	each: function (a) {
		return OverText.instances.map(function (c, b) {
			if (c.element && c.text) {
				return a.apply(OverText, [c, b])
			}
			return null
		})
	},
	update: function () {
		return OverText.each(function (a) {
			return a.reposition()
		})
	},
	hideAll: function () {
		return OverText.each(function (a) {
			return a.hide(true, true)
		})
	},
	showAll: function () {
		return OverText.each(function (a) {
			return a.show()
		})
	}
});
if (window.Fx && Fx.Reveal) {
	Fx.Reveal.implement({
		hideInputs: Browser.Engine.trident ? "select, input, textarea, object, embed, .overTxtLabel" : false
	})
}
Fx.Elements = new Class({
	Extends: Fx.CSS,
	initialize: function (b, a) {
		this.elements = this.subject = $$(b);
		this.parent(a)
	},
	compute: function (h, j, k) {
		var c = {};
		for (var d in h) {
			var a = h[d],
				f = j[d],
				g = c[d] = {};
			for (var b in a) {
				g[b] = this.parent(a[b], f[b], k)
			}
		}
		return c
	},
	set: function (b) {
		for (var c in b) {
			var a = b[c];
			for (var d in a) {
				this.render(this.elements[c], d, a[d], this.options.unit)
			}
		}
		return this
	},
	start: function (c) {
		if (!this.check(c)) {
			return this
		}
		var j = {},
			k = {};
		for (var d in c) {
			var g = c[d],
				a = j[d] = {},
				h = k[d] = {};
			for (var b in g) {
				var f = this.prepare(this.elements[d], b, g[b]);
				a[b] = f.from;
				h[b] = f.to
			}
		}
		return this.parent(j, k)
	}
});
Fx.Accordion = new Class({
	Extends: Fx.Elements,
	options: {
		display: 0,
		show: false,
		height: true,
		width: false,
		opacity: true,
		alwaysHide: false,
		trigger: "click",
		initialDisplayFx: true,
		returnHeightToAuto: true
	},
	initialize: function () {
		var c = Array.link(arguments, {
			container: Element.type,
			options: Object.type,
			togglers: $defined,
			elements: $defined
		});
		this.parent(c.elements, c.options);
		this.togglers = $$(c.togglers);
		this.previous = -1;
		this.internalChain = new Chain();
		if (this.options.alwaysHide) {
			this.options.wait = true
		}
		if ($chk(this.options.show)) {
			this.options.display = false;
			this.previous = this.options.show
		}
		if (this.options.start) {
			this.options.display = false;
			this.options.show = false
		}
		this.effects = {};
		if (this.options.opacity) {
			this.effects.opacity = "fullOpacity"
		}
		if (this.options.width) {
			this.effects.width = this.options.fixedWidth ? "fullWidth" : "offsetWidth"
		}
		if (this.options.height) {
			this.effects.height = this.options.fixedHeight ? "fullHeight" : "scrollHeight"
		}
		for (var b = 0, a = this.togglers.length; b < a; b++) {
			this.addSection(this.togglers[b], this.elements[b])
		}
		this.elements.each(function (f, d) {
			if (this.options.show === d) {
				this.fireEvent("active", [this.togglers[d], f])
			} else {
				for (var g in this.effects) {
					f.setStyle(g, 0)
				}
			}
		}, this);
		if ($chk(this.options.display) || this.options.initialDisplayFx === false) {
			this.display(this.options.display, this.options.initialDisplayFx)
		}
		if (this.options.fixedHeight !== false) {
			this.options.returnHeightToAuto = false
		}
		this.addEvent("complete", this.internalChain.callChain.bind(this.internalChain))
	},
	addSection: function (f, c) {
		f = document.id(f);
		c = document.id(c);
		var g = this.togglers.contains(f);
		this.togglers.include(f);
		this.elements.include(c);
		var a = this.togglers.indexOf(f);
		var b = this.display.bind(this, a);
		f.store("accordion:display", b);
		f.addEvent(this.options.trigger, b);
		if (this.options.height) {
			c.setStyles({
				"padding-top": 0,
				"border-top": "none",
				"padding-bottom": 0,
				"border-bottom": "none"
			})
		}
		if (this.options.width) {
			c.setStyles({
				"padding-left": 0,
				"border-left": "none",
				"padding-right": 0,
				"border-right": "none"
			})
		}
		c.fullOpacity = 1;
		if (this.options.fixedWidth) {
			c.fullWidth = this.options.fixedWidth
		}
		if (this.options.fixedHeight) {
			c.fullHeight = this.options.fixedHeight
		}
		c.setStyle("overflow", "hidden");
		if (!g) {
			for (var d in this.effects) {
				c.setStyle(d, 0)
			}
		}
		return this
	},
	detach: function () {
		this.togglers.each(function (a) {
			a.removeEvent(this.options.trigger, a.retrieve("accordion:display"))
		}, this)
	},
	display: function (a, b) {
		if (!this.check(a, b)) {
			return this
		}
		b = $pick(b, true);
		if (this.options.returnHeightToAuto) {
			var d = this.elements[this.previous];
			if (d && !this.selfHidden) {
				for (var c in this.effects) {
					d.setStyle(c, d[this.effects[c]])
				}
			}
		}
		a = ($type(a) == "element") ? this.elements.indexOf(a) : a;
		if ((this.timer && this.options.wait) || (a === this.previous && !this.options.alwaysHide)) {
			return this
		}
		this.previous = a;
		var f = {};
		this.elements.each(function (j, h) {
			f[h] = {};
			var g;
			if (h != a) {
				g = true
			} else {
				if (this.options.alwaysHide && ((j.offsetHeight > 0 && this.options.height) || j.offsetWidth > 0 && this.options.width)) {
					g = true;
					this.selfHidden = true
				}
			}
			this.fireEvent(g ? "background" : "active", [this.togglers[h], j]);
			for (var k in this.effects) {
				f[h][k] = g ? 0 : j[this.effects[k]]
			}
		}, this);
		this.internalChain.chain(function () {
			if (this.options.returnHeightToAuto && !this.selfHidden) {
				var g = this.elements[a];
				if (g) {
					g.setStyle("height", "auto")
				}
			}
		}.bind(this));
		return b ? this.start(f) : this.set(f)
	}
});
var Accordion = new Class({
	Extends: Fx.Accordion,
	initialize: function () {
		this.parent.apply(this, arguments);
		var a = Array.link(arguments, {
			container: Element.type
		});
		this.container = a.container
	},
	addSection: function (c, b, f) {
		c = document.id(c);
		b = document.id(b);
		var d = this.togglers.contains(c);
		var a = this.togglers.length;
		if (a && (!d || f)) {
			f = $pick(f, a - 1);
			c.inject(this.togglers[f], "before");
			b.inject(c, "after")
		} else {
			if (this.container && !d) {
				c.inject(this.container);
				b.inject(this.container)
			}
		}
		return this.parent.apply(this, arguments)
	}
});
Fx.Move = new Class({
	Extends: Fx.Morph,
	options: {
		relativeTo: document.body,
		position: "center",
		edge: false,
		offset: {
			x: 0,
			y: 0
		}
	},
	start: function (a) {
		return this.parent(this.element.position($merge(this.options, a, {
			returnPos: true
		})))
	}
});
Element.Properties.move = {
	set: function (a) {
		var b = this.retrieve("move");
		if (b) {
			b.cancel()
		}
		return this.eliminate("move").store("move:options", $extend({
			link: "cancel"
		}, a))
	},
	get: function (a) {
		if (a || !this.retrieve("move")) {
			if (a || !this.retrieve("move:options")) {
				this.set("move", a)
			}
			this.store("move", new Fx.Move(this, this.retrieve("move:options")))
		}
		return this.retrieve("move")
	}
};
Element.implement({
	move: function (a) {
		this.get("move").start(a);
		return this
	}
});
Fx.Reveal = new Class({
	Extends: Fx.Morph,
	options: {
		link: "cancel",
		styles: ["padding", "border", "margin"],
		transitionOpacity: !Browser.Engine.trident4,
		mode: "vertical",
		display: "block",
		hideInputs: Browser.Engine.trident ? "select, input, textarea, object, embed" : false
	},
	dissolve: function () {
		try {
			if (!this.hiding && !this.showing) {
				if (this.element.getStyle("display") != "none") {
					this.hiding = true;
					this.showing = false;
					this.hidden = true;
					this.cssText = this.element.style.cssText;
					var d = this.element.getComputedSize({
						styles: this.options.styles,
						mode: this.options.mode
					});
					this.element.setStyle("display", this.options.display);
					if (this.options.transitionOpacity) {
						d.opacity = 1
					}
					var b = {};
					$each(d, function (g, f) {
						b[f] = [g, 0]
					}, this);
					this.element.setStyle("overflow", "hidden");
					var a = this.options.hideInputs ? this.element.getElements(this.options.hideInputs) : null;
					this.$chain.unshift(function () {
						if (this.hidden) {
							this.hiding = false;
							$each(d, function (g, f) {
								d[f] = g
							}, this);
							this.element.style.cssText = this.cssText;
							this.element.setStyle("display", "none");
							if (a) {
								a.setStyle("visibility", "visible")
							}
						}
						this.fireEvent("hide", this.element);
						this.callChain()
					}.bind(this));
					if (a) {
						a.setStyle("visibility", "hidden")
					}
					this.start(b)
				} else {
					this.callChain.delay(10, this);
					this.fireEvent("complete", this.element);
					this.fireEvent("hide", this.element)
				}
			} else {
				if (this.options.link == "chain") {
					this.chain(this.dissolve.bind(this))
				} else {
					if (this.options.link == "cancel" && !this.hiding) {
						this.cancel();
						this.dissolve()
					}
				}
			}
		} catch (c) {
			this.hiding = false;
			this.element.setStyle("display", "none");
			this.callChain.delay(10, this);
			this.fireEvent("complete", this.element);
			this.fireEvent("hide", this.element)
		}
		return this
	},
	reveal: function () {
		try {
			if (!this.showing && !this.hiding) {
				if (this.element.getStyle("display") == "none" || this.element.getStyle("visiblity") == "hidden" || this.element.getStyle("opacity") == 0) {
					this.showing = true;
					this.hiding = this.hidden = false;
					var d;
					this.cssText = this.element.style.cssText;
					this.element.measure(function () {
						d = this.element.getComputedSize({
							styles: this.options.styles,
							mode: this.options.mode
						})
					}.bind(this));
					$each(d, function (g, f) {
						d[f] = g
					});
					if ($chk(this.options.heightOverride)) {
						d.height = this.options.heightOverride.toInt()
					}
					if ($chk(this.options.widthOverride)) {
						d.width = this.options.widthOverride.toInt()
					}
					if (this.options.transitionOpacity) {
						this.element.setStyle("opacity", 0);
						d.opacity = 1
					}
					var b = {
						height: 0,
						display: this.options.display
					};
					$each(d, function (g, f) {
						b[f] = 0
					});
					this.element.setStyles($merge(b, {
						overflow: "hidden"
					}));
					var a = this.options.hideInputs ? this.element.getElements(this.options.hideInputs) : null;
					if (a) {
						a.setStyle("visibility", "hidden")
					}
					this.start(d);
					this.$chain.unshift(function () {
						this.element.style.cssText = this.cssText;
						this.element.setStyle("display", this.options.display);
						if (!this.hidden) {
							this.showing = false
						}
						if (a) {
							a.setStyle("visibility", "visible")
						}
						this.callChain();
						this.fireEvent("show", this.element)
					}.bind(this))
				} else {
					this.callChain();
					this.fireEvent("complete", this.element);
					this.fireEvent("show", this.element)
				}
			} else {
				if (this.options.link == "chain") {
					this.chain(this.reveal.bind(this))
				} else {
					if (this.options.link == "cancel" && !this.showing) {
						this.cancel();
						this.reveal()
					}
				}
			}
		} catch (c) {
			this.element.setStyles({
				display: this.options.display,
				visiblity: "visible",
				opacity: 1
			});
			this.showing = false;
			this.callChain.delay(10, this);
			this.fireEvent("complete", this.element);
			this.fireEvent("show", this.element)
		}
		return this
	},
	toggle: function () {
		if (this.element.getStyle("display") == "none" || this.element.getStyle("visiblity") == "hidden" || this.element.getStyle("opacity") == 0) {
			this.reveal()
		} else {
			this.dissolve()
		}
		return this
	},
	cancel: function () {
		this.parent.apply(this, arguments);
		this.element.style.cssText = this.cssText;
		this.hidding = false;
		this.showing = false
	}
});
Element.Properties.reveal = {
	set: function (a) {
		var b = this.retrieve("reveal");
		if (b) {
			b.cancel()
		}
		return this.eliminate("reveal").store("reveal:options", a)
	},
	get: function (a) {
		if (a || !this.retrieve("reveal")) {
			if (a || !this.retrieve("reveal:options")) {
				this.set("reveal", a)
			}
			this.store("reveal", new Fx.Reveal(this, this.retrieve("reveal:options")))
		}
		return this.retrieve("reveal")
	}
};
Element.Properties.dissolve = Element.Properties.reveal;
Element.implement({
	reveal: function (a) {
		this.get("reveal", a).reveal();
		return this
	},
	dissolve: function (a) {
		this.get("reveal", a).dissolve();
		return this
	},
	nix: function () {
		var a = Array.link(arguments, {
			destroy: Boolean.type,
			options: Object.type
		});
		this.get("reveal", a.options).dissolve().chain(function () {
			this[a.destroy ? "destroy" : "dispose"]()
		}.bind(this));
		return this
	},
	wink: function () {
		var b = Array.link(arguments, {
			duration: Number.type,
			options: Object.type
		});
		var a = this.get("reveal", b.options);
		a.reveal().chain(function () {
			(function () {
				a.dissolve()
			}).delay(b.duration || 2000)
		})
	}
});
Fx.Scroll = new Class({
	Extends: Fx,
	options: {
		offset: {
			x: 0,
			y: 0
		},
		wheelStops: true
	},
	initialize: function (b, a) {
		this.element = this.subject = document.id(b);
		this.parent(a);
		var d = this.cancel.bind(this, false);
		if ($type(this.element) != "element") {
			this.element = document.id(this.element.getDocument().body)
		}
		var c = this.element;
		if (this.options.wheelStops) {
			this.addEvent("start", function () {
				c.addEvent("mousewheel", d)
			}, true);
			this.addEvent("complete", function () {
				c.removeEvent("mousewheel", d)
			}, true)
		}
	},
	set: function () {
		var a = Array.flatten(arguments);
		if (Browser.Engine.gecko) {
			a = [Math.round(a[0]), Math.round(a[1])]
		}
		this.element.scrollTo(a[0], a[1])
	},
	compute: function (c, b, a) {
		return [0, 1].map(function (d) {
			return Fx.compute(c[d], b[d], a)
		})
	},
	start: function (c, h) {
		if (!this.check(c, h)) {
			return this
		}
		var f = this.element.getScrollSize(),
			b = this.element.getScroll(),
			d = {
				x: c,
				y: h
			};
		for (var g in d) {
			var a = f[g];
			if ($chk(d[g])) {
				d[g] = ($type(d[g]) == "number") ? d[g] : a
			} else {
				d[g] = b[g]
			}
			d[g] += this.options.offset[g]
		}
		return this.parent([b.x, b.y], [d.x, d.y])
	},
	toTop: function () {
		return this.start(false, 0)
	},
	toLeft: function () {
		return this.start(0, false)
	},
	toRight: function () {
		return this.start("right", false)
	},
	toBottom: function () {
		return this.start(false, "bottom")
	},
	toElement: function (b) {
		var a = document.id(b).getPosition(this.element);
		return this.start(a.x, a.y)
	},
	scrollIntoView: function (c, f, d) {
		f = f ? $splat(f) : ["x", "y"];
		var i = {};
		c = document.id(c);
		var g = c.getPosition(this.element);
		var j = c.getSize();
		var h = this.element.getScroll();
		var a = this.element.getSize();
		var b = {
			x: g.x + j.x,
			y: g.y + j.y
		};
		["x", "y"].each(function (k) {
			if (f.contains(k)) {
				if (b[k] > h[k] + a[k]) {
					i[k] = b[k] - a[k]
				}
				if (g[k] < h[k]) {
					i[k] = g[k]
				}
			}
			if (i[k] == null) {
				i[k] = h[k]
			}
			if (d && d[k]) {
				i[k] = i[k] + d[k]
			}
		}, this);
		if (i.x != h.x || i.y != h.y) {
			this.start(i.x, i.y)
		}
		return this
	},
	scrollToCenter: function (c, f, d) {
		f = f ? $splat(f) : ["x", "y"];
		c = $(c);
		var i = {},
			g = c.getPosition(this.element),
			j = c.getSize(),
			h = this.element.getScroll(),
			a = this.element.getSize(),
			b = {
				x: g.x + j.x,
				y: g.y + j.y
			};
		["x", "y"].each(function (k) {
			if (f.contains(k)) {
				i[k] = g[k] - (a[k] - j[k]) / 2
			}
			if (i[k] == null) {
				i[k] = h[k]
			}
			if (d && d[k]) {
				i[k] = i[k] + d[k]
			}
		}, this);
		if (i.x != h.x || i.y != h.y) {
			this.start(i.x, i.y)
		}
		return this
	}
});
Fx.Slide = new Class({
	Extends: Fx,
	options: {
		mode: "vertical",
		wrapper: false,
		hideOverflow: true
	},
	initialize: function (b, a) {
		this.addEvent("complete", function () {
			this.open = (this.wrapper["offset" + this.layout.capitalize()] != 0);
			if (this.open) {
				this.wrapper.setStyle("height", "")
			}
			if (this.open && Browser.Engine.webkit419) {
				this.element.dispose().inject(this.wrapper)
			}
		}, true);
		this.element = this.subject = document.id(b);
		this.parent(a);
		var d = this.element.retrieve("wrapper");
		var c = this.element.getStyles("margin", "position", "overflow");
		if (this.options.hideOverflow) {
			c = $extend(c, {
				overflow: "hidden"
			})
		}
		if (this.options.wrapper) {
			d = document.id(this.options.wrapper).setStyles(c)
		}
		this.wrapper = d || new Element("div", {
			styles: c
		}).wraps(this.element);
		this.element.store("wrapper", this.wrapper).setStyle("margin", 0);
		this.now = [];
		this.open = true
	},
	vertical: function () {
		this.margin = "margin-top";
		this.layout = "height";
		this.offset = this.element.offsetHeight
	},
	horizontal: function () {
		this.margin = "margin-left";
		this.layout = "width";
		this.offset = this.element.offsetWidth
	},
	set: function (a) {
		this.element.setStyle(this.margin, a[0]);
		this.wrapper.setStyle(this.layout, a[1]);
		return this
	},
	compute: function (c, b, a) {
		return [0, 1].map(function (d) {
			return Fx.compute(c[d], b[d], a)
		})
	},
	start: function (b, f) {
		if (!this.check(b, f)) {
			return this
		}
		this[f || this.options.mode]();
		var d = this.element.getStyle(this.margin).toInt();
		var c = this.wrapper.getStyle(this.layout).toInt();
		var a = [
			[d, c],
			[0, this.offset]
		];
		var h = [
			[d, c],
			[-this.offset, 0]
		];
		var g;
		switch (b) {
		case "in":
			g = a;
			break;
		case "out":
			g = h;
			break;
		case "toggle":
			g = (c == 0) ? a : h
		}
		return this.parent(g[0], g[1])
	},
	slideIn: function (a) {
		return this.start("in", a)
	},
	slideOut: function (a) {
		return this.start("out", a)
	},
	hide: function (a) {
		this[a || this.options.mode]();
		this.open = false;
		return this.set([-this.offset, 0])
	},
	show: function (a) {
		this[a || this.options.mode]();
		this.open = true;
		return this.set([0, this.offset])
	},
	toggle: function (a) {
		return this.start("toggle", a)
	}
});
Element.Properties.slide = {
	set: function (b) {
		var a = this.retrieve("slide");
		if (a) {
			a.cancel()
		}
		return this.eliminate("slide").store("slide:options", $extend({
			link: "cancel"
		}, b))
	},
	get: function (a) {
		if (a || !this.retrieve("slide")) {
			if (a || !this.retrieve("slide:options")) {
				this.set("slide", a)
			}
			this.store("slide", new Fx.Slide(this, this.retrieve("slide:options")))
		}
		return this.retrieve("slide")
	}
};
Element.implement({
	slide: function (d, f) {
		d = d || "toggle";
		var b = this.get("slide"),
			a;
		switch (d) {
		case "hide":
			b.hide(f);
			break;
		case "show":
			b.show(f);
			break;
		case "toggle":
			var c = this.retrieve("slide:flag", b.open);
			b[c ? "slideOut" : "slideIn"](f);
			this.store("slide:flag", !c);
			a = true;
			break;
		default:
			b.start(d, f)
		}
		if (!a) {
			this.eliminate("slide:flag")
		}
		return this
	}
});
var SmoothScroll = Fx.SmoothScroll = new Class({
	Extends: Fx.Scroll,
	initialize: function (b, c) {
		c = c || document;
		this.doc = c.getDocument();
		var d = c.getWindow();
		this.parent(this.doc, b);
		this.links = $$(this.options.links || this.doc.links);
		var a = d.location.href.match(/^[^#]*/)[0] + "#";
		this.links.each(function (g) {
			if (g.href.indexOf(a) != 0) {
				return
			}
			var f = g.href.substr(a.length);
			if (f) {
				this.useLink(g, f)
			}
		}, this);
		if (!Browser.Engine.webkit419) {
			this.addEvent("complete", function () {
				d.location.hash = this.anchor
			}, true)
		}
	},
	useLink: function (c, a) {
		var b;
		c.addEvent("click", function (d) {
			if (b !== false && !b) {
				b = document.id(a) || this.doc.getElement("a[name=" + a + "]")
			}
			if (b) {
				d.preventDefault();
				this.anchor = a;
				this.toElement(b).chain(function () {
					this.fireEvent("scrolledTo", [c, b])
				}.bind(this));
				c.blur()
			}
		}.bind(this))
	}
});
var Drag = new Class({
	Implements: [Events, Options],
	options: {
		snap: 6,
		unit: "px",
		grid: false,
		style: true,
		limit: false,
		handle: false,
		invert: false,
		preventDefault: false,
		stopPropagation: false,
		modifiers: {
			x: "left",
			y: "top"
		}
	},
	initialize: function () {
		var b = Array.link(arguments, {
			options: Object.type,
			element: $defined
		});
		this.element = document.id(b.element);
		this.document = this.element.getDocument();
		this.setOptions(b.options || {});
		var a = $type(this.options.handle);
		this.handles = ((a == "array" || a == "collection") ? $$(this.options.handle) : document.id(this.options.handle)) || this.element;
		this.mouse = {
			now: {},
			pos: {}
		};
		this.value = {
			start: {},
			now: {}
		};
		this.selection = (Browser.Engine.trident) ? "selectstart" : "mousedown";
		this.bound = {
			start: this.start.bind(this),
			check: this.check.bind(this),
			drag: this.drag.bind(this),
			stop: this.stop.bind(this),
			cancel: this.cancel.bind(this),
			eventStop: $lambda(false)
		};
		this.attach()
	},
	attach: function () {
		this.handles.addEvent("mousedown", this.bound.start);
		return this
	},
	detach: function () {
		this.handles.removeEvent("mousedown", this.bound.start);
		return this
	},
	start: function (c) {
		if (c.rightClick) {
			return
		}
		if (this.options.preventDefault) {
			c.preventDefault()
		}
		if (this.options.stopPropagation) {
			c.stopPropagation()
		}
		this.mouse.start = c.page;
		this.fireEvent("beforeStart", this.element);
		var a = this.options.limit;
		this.limit = {
			x: [],
			y: []
		};
		for (var d in this.options.modifiers) {
			if (!this.options.modifiers[d]) {
				continue
			}
			if (this.options.style) {
				this.value.now[d] = this.element.getStyle(this.options.modifiers[d]).toInt()
			} else {
				this.value.now[d] = this.element[this.options.modifiers[d]]
			}
			if (this.options.invert) {
				this.value.now[d] *= -1
			}
			this.mouse.pos[d] = c.page[d] - this.value.now[d];
			if (a && a[d]) {
				for (var b = 2; b--; b) {
					if ($chk(a[d][b])) {
						this.limit[d][b] = $lambda(a[d][b])()
					}
				}
			}
		}
		if ($type(this.options.grid) == "number") {
			this.options.grid = {
				x: this.options.grid,
				y: this.options.grid
			}
		}
		this.document.addEvents({
			mousemove: this.bound.check,
			mouseup: this.bound.cancel
		});
		this.document.addEvent(this.selection, this.bound.eventStop)
	},
	check: function (a) {
		if (this.options.preventDefault) {
			a.preventDefault()
		}
		var b = Math.round(Math.sqrt(Math.pow(a.page.x - this.mouse.start.x, 2) + Math.pow(a.page.y - this.mouse.start.y, 2)));
		if (b > this.options.snap) {
			this.cancel();
			this.document.addEvents({
				mousemove: this.bound.drag,
				mouseup: this.bound.stop
			});
			this.fireEvent("start", [this.element, a]).fireEvent("snap", this.element)
		}
	},
	drag: function (a) {
		if (this.options.preventDefault) {
			a.preventDefault()
		}
		this.mouse.now = a.page;
		for (var b in this.options.modifiers) {
			if (!this.options.modifiers[b]) {
				continue
			}
			this.value.now[b] = this.mouse.now[b] - this.mouse.pos[b];
			if (this.options.invert) {
				this.value.now[b] *= -1
			}
			if (this.options.limit && this.limit[b]) {
				if ($chk(this.limit[b][1]) && (this.value.now[b] > this.limit[b][1])) {
					this.value.now[b] = this.limit[b][1]
				} else {
					if ($chk(this.limit[b][0]) && (this.value.now[b] < this.limit[b][0])) {
						this.value.now[b] = this.limit[b][0]
					}
				}
			}
			if (this.options.grid[b]) {
				this.value.now[b] -= ((this.value.now[b] - (this.limit[b][0] || 0)) % this.options.grid[b])
			}
			if (this.options.style) {
				this.element.setStyle(this.options.modifiers[b], this.value.now[b] + this.options.unit)
			} else {
				this.element[this.options.modifiers[b]] = this.value.now[b]
			}
		}
		this.fireEvent("drag", [this.element, a])
	},
	cancel: function (a) {
		this.document.removeEvent("mousemove", this.bound.check);
		this.document.removeEvent("mouseup", this.bound.cancel);
		if (a) {
			this.document.removeEvent(this.selection, this.bound.eventStop);
			this.fireEvent("cancel", this.element)
		}
	},
	stop: function (a) {
		this.document.removeEvent(this.selection, this.bound.eventStop);
		this.document.removeEvent("mousemove", this.bound.drag);
		this.document.removeEvent("mouseup", this.bound.stop);
		if (a) {
			this.fireEvent("complete", [this.element, a])
		}
	}
});
Element.implement({
	makeResizable: function (a) {
		var b = new Drag(this, $merge({
			modifiers: {
				x: "width",
				y: "height"
			}
		}, a));
		this.store("resizer", b);
		return b.addEvent("drag", function () {
			this.fireEvent("resize", b)
		}.bind(this))
	}
});
Drag.Move = new Class({
	Extends: Drag,
	options: {
		droppables: [],
		container: false,
		precalculate: false,
		includeMargins: true,
		checkDroppables: true
	},
	initialize: function (b, a) {
		this.parent(b, a);
		b = this.element;
		this.droppables = $$(this.options.droppables);
		this.container = document.id(this.options.container);
		if (this.container && $type(this.container) != "element") {
			this.container = document.id(this.container.getDocument().body)
		}
		var c = b.getStyles("left", "top", "position");
		if (c.left == "auto" || c.top == "auto") {
			b.setPosition(b.getPosition(b.getOffsetParent()))
		}
		if (c.position == "static") {
			b.setStyle("position", "absolute")
		}
		this.addEvent("start", this.checkDroppables, true);
		this.overed = null
	},
	start: function (a) {
		if (this.container) {
			this.options.limit = this.calculateLimit()
		}
		if (this.options.precalculate) {
			this.positions = this.droppables.map(function (b) {
				return b.getCoordinates()
			})
		}
		this.parent(a)
	},
	calculateLimit: function () {
		var d = this.element.getOffsetParent(),
			h = this.container.getCoordinates(d),
			g = {},
			c = {},
			b = {},
			j = {},
			l = {};
		["top", "right", "bottom", "left"].each(function (p) {
			g[p] = this.container.getStyle("border-" + p).toInt();
			b[p] = this.element.getStyle("border-" + p).toInt();
			c[p] = this.element.getStyle("margin-" + p).toInt();
			j[p] = this.container.getStyle("margin-" + p).toInt();
			l[p] = d.getStyle("padding-" + p).toInt()
		}, this);
		var f = this.element.offsetWidth + c.left + c.right,
			o = this.element.offsetHeight + c.top + c.bottom,
			i = 0,
			k = 0,
			n = h.right - g.right - f,
			a = h.bottom - g.bottom - o;
		if (this.options.includeMargins) {
			i += c.left;
			k += c.top
		} else {
			n += c.right;
			a += c.bottom
		}
		if (this.element.getStyle("position") == "relative") {
			var m = this.element.getCoordinates(d);
			m.left -= this.element.getStyle("left").toInt();
			m.top -= this.element.getStyle("top").toInt();
			i += g.left - m.left;
			k += g.top - m.top;
			n += c.left - m.left;
			a += c.top - m.top;
			if (this.container != d) {
				i += j.left + l.left;
				k += (Browser.Engine.trident4 ? 0 : j.top) + l.top
			}
		} else {
			i -= c.left;
			k -= c.top;
			if (this.container == d) {
				n -= g.left;
				a -= g.top
			} else {
				i += h.left + g.left;
				k += h.top + g.top
			}
		}
		return {
			x: [i, n],
			y: [k, a]
		}
	},
	checkAgainst: function (c, b) {
		c = (this.positions) ? this.positions[b] : c.getCoordinates();
		var a = this.mouse.now;
		return (a.x > c.left && a.x < c.right && a.y < c.bottom && a.y > c.top)
	},
	checkDroppables: function () {
		var a = this.droppables.filter(this.checkAgainst, this).getLast();
		if (this.overed != a) {
			if (this.overed) {
				this.fireEvent("leave", [this.element, this.overed])
			}
			if (a) {
				this.fireEvent("enter", [this.element, a])
			}
			this.overed = a
		}
	},
	drag: function (a) {
		this.parent(a);
		if (this.options.checkDroppables && this.droppables.length) {
			this.checkDroppables()
		}
	},
	stop: function (a) {
		this.checkDroppables();
		this.fireEvent("drop", [this.element, this.overed, a]);
		this.overed = null;
		return this.parent(a)
	}
});
Element.implement({
	makeDraggable: function (a) {
		var b = new Drag.Move(this, a);
		this.store("dragger", b);
		return b
	}
});
var Slider = new Class({
	Implements: [Events, Options],
	Binds: ["clickedElement", "draggedKnob", "scrolledElement"],
	options: {
		onTick: function (a) {
			if (this.options.snap) {
				a = this.toPosition(this.step)
			}
			this.knob.setStyle(this.property, a)
		},
		initialStep: 0,
		snap: false,
		offset: 0,
		range: false,
		wheel: false,
		steps: 100,
		mode: "horizontal"
	},
	initialize: function (g, a, f) {
		this.setOptions(f);
		this.element = document.id(g);
		this.knob = document.id(a);
		this.previousChange = this.previousEnd = this.step = -1;
		var h, b = {},
			d = {
				x: false,
				y: false
			};
		switch (this.options.mode) {
		case "vertical":
			this.axis = "y";
			this.property = "top";
			h = "offsetHeight";
			break;
		case "horizontal":
			this.axis = "x";
			this.property = "left";
			h = "offsetWidth"
		}
		this.full = this.element.measure(function () {
			this.half = this.knob[h] / 2;
			return this.element[h] - this.knob[h] + (this.options.offset * 2)
		}.bind(this));
		this.min = $chk(this.options.range[0]) ? this.options.range[0] : 0;
		this.max = $chk(this.options.range[1]) ? this.options.range[1] : this.options.steps;
		this.range = this.max - this.min;
		this.steps = this.options.steps || this.full;
		this.stepSize = Math.abs(this.range) / this.steps;
		this.stepWidth = this.stepSize * this.full / Math.abs(this.range);
		this.knob.setStyle("position", "relative").setStyle(this.property, this.options.initialStep ? this.toPosition(this.options.initialStep) : -this.options.offset);
		d[this.axis] = this.property;
		b[this.axis] = [-this.options.offset, this.full - this.options.offset];
		var c = {
			snap: 0,
			limit: b,
			modifiers: d,
			onDrag: this.draggedKnob,
			onStart: this.draggedKnob,
			onBeforeStart: (function () {
				this.isDragging = true
			}).bind(this),
			onCancel: function () {
				this.isDragging = false
			}.bind(this),
			onComplete: function () {
				this.isDragging = false;
				this.draggedKnob();
				this.end()
			}.bind(this)
		};
		if (this.options.snap) {
			c.grid = Math.ceil(this.stepWidth);
			c.limit[this.axis][1] = this.full
		}
		this.drag = new Drag(this.knob, c);
		this.attach()
	},
	attach: function () {
		this.element.addEvent("mousedown", this.clickedElement);
		if (this.options.wheel) {
			this.element.addEvent("mousewheel", this.scrolledElement)
		}
		this.drag.attach();
		return this
	},
	detach: function () {
		this.element.removeEvent("mousedown", this.clickedElement);
		this.element.removeEvent("mousewheel", this.scrolledElement);
		this.drag.detach();
		return this
	},
	set: function (a) {
		if (!((this.range > 0) ^ (a < this.min))) {
			a = this.min
		}
		if (!((this.range > 0) ^ (a > this.max))) {
			a = this.max
		}
		this.step = Math.round(a);
		this.checkStep();
		this.fireEvent("tick", this.toPosition(this.step));
		this.end();
		return this
	},
	clickedElement: function (c) {
		if (this.isDragging || c.target == this.knob) {
			return
		}
		var b = this.range < 0 ? -1 : 1;
		var a = c.page[this.axis] - this.element.getPosition()[this.axis] - this.half;
		a = a.limit(-this.options.offset, this.full - this.options.offset);
		this.step = Math.round(this.min + b * this.toStep(a));
		this.checkStep();
		this.fireEvent("tick", a);
		this.end()
	},
	scrolledElement: function (a) {
		var b = (this.options.mode == "horizontal") ? (a.wheel < 0) : (a.wheel > 0);
		this.set(b ? this.step - this.stepSize : this.step + this.stepSize);
		a.stop()
	},
	draggedKnob: function () {
		var b = this.range < 0 ? -1 : 1;
		var a = this.drag.value.now[this.axis];
		a = a.limit(-this.options.offset, this.full - this.options.offset);
		this.step = Math.round(this.min + b * this.toStep(a));
		this.checkStep()
	},
	checkStep: function () {
		if (this.previousChange != this.step) {
			this.previousChange = this.step;
			this.fireEvent("change", this.step)
		}
	},
	end: function () {
		if (this.previousEnd !== this.step) {
			this.previousEnd = this.step;
			this.fireEvent("complete", this.step + "")
		}
	},
	toStep: function (a) {
		var b = (a + this.options.offset) * this.stepSize / this.full * this.steps;
		return this.options.steps ? Math.round(b -= b % this.stepSize) : b
	},
	toPosition: function (a) {
		return (this.full * Math.abs(this.min - a)) / (this.steps * this.stepSize) - this.options.offset
	}
});
var Sortables = new Class({
	Implements: [Events, Options],
	options: {
		snap: 4,
		opacity: 1,
		clone: false,
		revert: false,
		handle: false,
		constrain: false
	},
	initialize: function (a, b) {
		this.setOptions(b);
		this.elements = [];
		this.lists = [];
		this.idle = true;
		this.addLists($$(document.id(a) || a));
		if (!this.options.clone) {
			this.options.revert = false
		}
		if (this.options.revert) {
			this.effect = new Fx.Morph(null, $merge({
				duration: 250,
				link: "cancel"
			}, this.options.revert))
		}
	},
	attach: function () {
		this.addLists(this.lists);
		return this
	},
	detach: function () {
		this.lists = this.removeLists(this.lists);
		return this
	},
	addItems: function () {
		Array.flatten(arguments).each(function (a) {
			this.elements.push(a);
			var b = a.retrieve("sortables:start", this.start.bindWithEvent(this, a));
			(this.options.handle ? a.getElement(this.options.handle) || a : a).addEvent("mousedown", b)
		}, this);
		return this
	},
	addLists: function () {
		Array.flatten(arguments).each(function (a) {
			this.lists.push(a);
			this.addItems(a.getChildren())
		}, this);
		return this
	},
	removeItems: function () {
		return $$(Array.flatten(arguments).map(function (a) {
			this.elements.erase(a);
			var b = a.retrieve("sortables:start");
			(this.options.handle ? a.getElement(this.options.handle) || a : a).removeEvent("mousedown", b);
			return a
		}, this))
	},
	removeLists: function () {
		return $$(Array.flatten(arguments).map(function (a) {
			this.lists.erase(a);
			this.removeItems(a.getChildren());
			return a
		}, this))
	},
	getClone: function (b, a) {
		if (!this.options.clone) {
			return new Element("div").inject(document.body)
		}
		if ($type(this.options.clone) == "function") {
			return this.options.clone.call(this, b, a, this.list)
		}
		var c = a.clone(true).setStyles({
			margin: "0px",
			position: "absolute",
			visibility: "hidden",
			width: a.getStyle("width")
		});
		if (c.get("html").test("radio")) {
			c.getElements("input[type=radio]").each(function (d, f) {
				d.set("name", "clone_" + f)
			})
		}
		return c.inject(this.list).setPosition(a.getPosition(a.getOffsetParent()))
	},
	getDroppables: function () {
		var a = this.list.getChildren();
		if (!this.options.constrain) {
			a = this.lists.concat(a).erase(this.list)
		}
		return a.erase(this.clone).erase(this.element)
	},
	insert: function (c, b) {
		var a = "inside";
		if (this.lists.contains(b)) {
			this.list = b;
			this.drag.droppables = this.getDroppables()
		} else {
			a = this.element.getAllPrevious().contains(b) ? "before" : "after"
		}
		this.element.inject(b, a);
		this.fireEvent("sort", [this.element, this.clone])
	},
	start: function (b, a) {
		if (!this.idle) {
			return
		}
		this.idle = false;
		this.element = a;
		this.opacity = a.get("opacity");
		this.list = a.getParent();
		this.clone = this.getClone(b, a);
		this.drag = new Drag.Move(this.clone, {
			snap: this.options.snap,
			container: this.options.constrain && this.element.getParent(),
			droppables: this.getDroppables(),
			onSnap: function () {
				b.stop();
				this.clone.setStyle("visibility", "visible");
				this.element.set("opacity", this.options.opacity || 0);
				this.fireEvent("start", [this.element, this.clone])
			}.bind(this),
			onEnter: this.insert.bind(this),
			onCancel: this.reset.bind(this),
			onComplete: this.end.bind(this)
		});
		this.clone.inject(this.element, "before");
		this.drag.start(b)
	},
	end: function () {
		this.drag.detach();
		this.element.set("opacity", this.opacity);
		if (this.effect) {
			var a = this.element.getStyles("width", "height");
			var b = this.clone.computePosition(this.element.getPosition(this.clone.offsetParent));
			this.effect.element = this.clone;
			this.effect.start({
				top: b.top,
				left: b.left,
				width: a.width,
				height: a.height,
				opacity: 0.25
			}).chain(this.reset.bind(this))
		} else {
			this.reset()
		}
	},
	reset: function () {
		this.idle = true;
		this.clone.destroy();
		this.fireEvent("complete", this.element)
	},
	serialize: function () {
		var c = Array.link(arguments, {
			modifier: Function.type,
			index: $defined
		});
		var b = this.lists.map(function (d) {
			return d.getChildren().map(c.modifier ||
			function (f) {
				return f.get("id")
			}, this)
		}, this);
		var a = c.index;
		if (this.lists.length == 1) {
			a = 0
		}
		return $chk(a) && a >= 0 && a < this.lists.length ? b[a] : b
	}
});
Request.implement({
	options: {
		initialDelay: 5000,
		delay: 5000,
		limit: 60000
	},
	startTimer: function (b) {
		var a = function () {
				if (!this.running) {
					this.send({
						data: b
					})
				}
			};
		this.timer = a.delay(this.options.initialDelay, this);
		this.lastDelay = this.options.initialDelay;
		this.completeCheck = function (c) {
			$clear(this.timer);
			this.lastDelay = (c) ? this.options.delay : (this.lastDelay + this.options.delay).min(this.options.limit);
			this.timer = a.delay(this.lastDelay, this)
		};
		return this.addEvent("complete", this.completeCheck)
	},
	stopTimer: function () {
		$clear(this.timer);
		return this.removeEvent("complete", this.completeCheck)
	}
});
Hash.Cookie = new Class({
	Extends: Cookie,
	options: {
		autoSave: true
	},
	initialize: function (b, a) {
		this.parent(b, a);
		this.load()
	},
	save: function () {
		var a = JSON.encode(this.hash);
		if (!a || a.length > 4096) {
			return false
		}
		if (a == "{}") {
			this.dispose()
		} else {
			this.write(a)
		}
		return true
	},
	load: function () {
		this.hash = new Hash(JSON.decode(this.read(), true));
		return this
	}
});
Hash.each(Hash.prototype, function (b, a) {
	if (typeof b == "function") {
		Hash.Cookie.implement(a, function () {
			var c = b.apply(this.hash, arguments);
			if (this.options.autoSave) {
				this.save()
			}
			return c
		})
	}
});
var Scroller = new Class({
	Implements: [Events, Options],
	options: {
		area: 20,
		velocity: 1,
		onChange: function (a, b) {
			this.element.scrollTo(a, b)
		},
		fps: 50
	},
	initialize: function (b, a) {
		this.setOptions(a);
		this.element = document.id(b);
		this.docBody = document.id(this.element.getDocument().body);
		this.listener = ($type(this.element) != "element") ? this.docBody : this.element;
		this.timer = null;
		this.bound = {
			attach: this.attach.bind(this),
			detach: this.detach.bind(this),
			getCoords: this.getCoords.bind(this)
		}
	},
	start: function () {
		this.listener.addEvents({
			mouseover: this.bound.attach,
			mouseout: this.bound.detach
		})
	},
	stop: function () {
		this.listener.removeEvents({
			mouseover: this.bound.attach,
			mouseout: this.bound.detach
		});
		this.detach();
		this.timer = $clear(this.timer)
	},
	attach: function () {
		this.listener.addEvent("mousemove", this.bound.getCoords)
	},
	detach: function () {
		this.listener.removeEvent("mousemove", this.bound.getCoords);
		this.timer = $clear(this.timer)
	},
	getCoords: function (a) {
		this.page = (this.listener.get("tag") == "body") ? a.client : a.page;
		if (!this.timer) {
			this.timer = this.scroll.periodical(Math.round(1000 / this.options.fps), this)
		}
	},
	scroll: function () {
		var b = this.element.getSize(),
			a = this.element.getScroll(),
			g = this.element != this.docBody ? this.element.getOffsets() : {
				x: 0,
				y: 0
			},
			c = this.element.getScrollSize(),
			f = {
				x: 0,
				y: 0
			};
		for (var d in this.page) {
			if (this.page[d] < (this.options.area + g[d]) && a[d] != 0) {
				f[d] = (this.page[d] - this.options.area - g[d]) * this.options.velocity
			} else {
				if (this.page[d] + this.options.area > (b[d] + g[d]) && a[d] + b[d] != c[d]) {
					f[d] = (this.page[d] - b[d] + this.options.area - g[d]) * this.options.velocity
				}
			}
		}
		if (f.y || f.x) {
			this.fireEvent("change", [a.x + f.x, a.y + f.y])
		}
	}
});
(function () {
	var a = function (c, b) {
			return (c) ? ($type(c) == "function" ? c(b) : b.get(c)) : ""
		};
	this.Tips = new Class({
		Implements: [Events, Options],
		options: {
			onShow: function () {
				this.tip.setStyle("display", "block")
			},
			onHide: function () {
				this.tip.setStyle("display", "none")
			},
			title: "title",
			text: function (b) {
				return b.get("rel") || b.get("href")
			},
			showDelay: 100,
			hideDelay: 100,
			className: "tip-wrap",
			offset: {
				x: 16,
				y: 16
			},
			windowPadding: {
				x: 0,
				y: 0
			},
			fixed: false
		},
		initialize: function () {
			var b = Array.link(arguments, {
				options: Object.type,
				elements: $defined
			});
			this.setOptions(b.options);
			if (b.elements) {
				this.attach(b.elements)
			}
			this.container = new Element("div", {
				"class": "tip"
			})
		},
		toElement: function () {
			if (this.tip) {
				return this.tip
			}
			return this.tip = new Element("div", {
				"class": this.options.className,
				styles: {
					position: "absolute",
					top: 0,
					left: 0
				}
			}).adopt(new Element("div", {
				"class": "tip-top"
			}), this.container, new Element("div", {
				"class": "tip-bottom"
			})).inject(document.body)
		},
		attach: function (b) {
			$$(b).each(function (d) {
				var g = a(this.options.title, d),
					f = a(this.options.text, d);
				d.erase("title").store("tip:native", g).retrieve("tip:title", g);
				d.retrieve("tip:text", f);
				this.fireEvent("attach", [d]);
				var c = ["enter", "leave"];
				if (!this.options.fixed) {
					c.push("move")
				}
				c.each(function (i) {
					var h = d.retrieve("tip:" + i);
					if (!h) {
						h = this["element" + i.capitalize()].bindWithEvent(this, d)
					}
					d.store("tip:" + i, h).addEvent("mouse" + i, h)
				}, this)
			}, this);
			return this
		},
		detach: function (b) {
			$$(b).each(function (d) {
				["enter", "leave", "move"].each(function (f) {
					d.removeEvent("mouse" + f, d.retrieve("tip:" + f)).eliminate("tip:" + f)
				});
				this.fireEvent("detach", [d]);
				if (this.options.title == "title") {
					var c = d.retrieve("tip:native");
					if (c) {
						d.set("title", c)
					}
				}
			}, this);
			return this
		},
		elementEnter: function (c, b) {
			this.container.empty();
			["title", "text"].each(function (f) {
				var d = b.retrieve("tip:" + f);
				if (d) {
					this.fill(new Element("div", {
						"class": "tip-" + f
					}).inject(this.container), d)
				}
			}, this);
			$clear(this.timer);
			this.timer = (function () {
				this.show(this, b);
				this.position((this.options.fixed) ? {
					page: b.getPosition()
				} : c)
			}).delay(this.options.showDelay, this)
		},
		elementLeave: function (c, b) {
			$clear(this.timer);
			this.timer = this.hide.delay(this.options.hideDelay, this, b);
			this.fireForParent(c, b)
		},
		fireForParent: function (c, b) {
			b = b.getParent();
			if (!b || b == document.body) {
				return
			}
			if (b.retrieve("tip:enter")) {
				b.fireEvent("mouseenter", c)
			} else {
				this.fireForParent(c, b)
			}
		},
		elementMove: function (c, b) {
			this.position(c)
		},
		position: function (f) {
			if (!this.tip) {
				document.id(this)
			}
			var c = window.getSize(),
				b = window.getScroll(),
				g = {
					x: this.tip.offsetWidth,
					y: this.tip.offsetHeight
				},
				d = {
					x: "left",
					y: "top"
				},
				h = {};
			for (var i in d) {
				h[d[i]] = f.page[i] + this.options.offset[i];
				if ((h[d[i]] + g[i] - b[i]) > c[i] - this.options.windowPadding[i]) {
					h[d[i]] = f.page[i] - this.options.offset[i] - g[i]
				}
			}
			this.tip.setStyles(h)
		},
		fill: function (b, c) {
			if (typeof c == "string") {
				b.set("html", c)
			} else {
				b.adopt(c)
			}
		},
		show: function (b) {
			if (!this.tip) {
				document.id(this)
			}
			this.fireEvent("show", [this.tip, b])
		},
		hide: function (b) {
			if (!this.tip) {
				document.id(this)
			}
			this.fireEvent("hide", [this.tip, b])
		}
	})
})();
window.$w = function (a) {
	return $A(String(a).split(" "))
};

function $clone(a) {
	if (a && a.$family && a.$family.name == "array") {
		return a
	}
	return $merge(a, {})
}
Function.implement({
	wrap: function (b) {
		var a = this;
		return function () {
			return b.apply(this, [a.bind(this)].concat($A(arguments)))
		}
	}
});
if (JSON.stringify) {
	JSON.encode = JSON.encode.wrap(function (b, c) {
		if (typeof c == "undefined") {
			c = null
		}
		var a = JSON.stringify(c);
		return a
	});
	delete(Hash.prototype.toJSON);
	delete(Array.prototype.toJSON);
	delete(String.prototype.toJSON);
	delete(Number.prototype.toJSON)
}
if (JSON.parse) {
	JSON.decode = JSON.decode.wrap(function (b, a, c) {
		if (typeof a == "undefined" || a === null) {
			return null
		}
		return JSON.parse(a)
	})
}
$extend(Object, {
	toHTML: function (a) {
		return a && a.toHTML ? a.toHTML() : String.interpret(a)
	}
});
$extend(String, {
	interpret: function (a) {
		return a == null ? "" : String(a)
	}
});
Element._getContentFromAnonymousElement = function (c, b) {
	var d = new Element("div"),
		a = Element._insertionTranslations.tags[c];
	if (a) {
		d.innerHTML = a[0] + b + a[1];
		a[2].times(function () {
			d = d.firstChild
		})
	} else {
		d.innerHTML = b
	}
	return $A(d.childNodes)
};
Array.implement({
	find: function (d, c) {
		var a;
		var b = d;
		if (c) {
			b = b.bind(c)
		}
		this.some(function (g, f, h) {
			if (b(g, f, h)) {
				a = g;
				return true
			}
			return false
		});
		return a
	},
	inject: function (b, a) {
		this.each(function (d, c, f) {
			b = a(b, d, c, f)
		});
		return b
	},
	invoke: function (a) {
		this.each(function (b) {
			if (b && b[a]) {
				b[a]()
			}
		});
		return this
	}
});
Element.addClass = Element.addClass.wrap(function (c, b, a) {
	if ($type(a) != "array") {
		a = $w(a)
	}
	if ($type(a) == "array") {
		$each(a, function (d) {
			c(d)
		})
	} else {
		c(a)
	}
	return b
});
Element.prototype.addClass = Element.prototype.addClass.wrap(function (b, a) {
	if ($type(a) != "array") {
		a = $w(a)
	}
	if ($type(a) == "array") {
		$each(a, function (c) {
			b(c)
		})
	} else {
		b(a)
	}
	return this
});
Element.removeClass = Element.removeClass.wrap(function (c, b, a) {
	if ($type(a) != "array") {
		a = $w(a)
	}
	if ($type(a) == "array") {
		$each(a, function (d) {
			c(d)
		})
	} else {
		c(a)
	}
	return b
});
Element.prototype.removeClass = Element.prototype.removeClass.wrap(function (b, a) {
	if ($type(a) != "array") {
		a = $w(a)
	}
	if ($type(a) == "array") {
		$each(a, function (c) {
			b(c)
		})
	} else {
		b(a)
	}
	return this
});
Element.implement({
	disableSelection: function () {
		return this.setStyles({
			MozUserSelect: "none",
			KhtmlUserSelect: "none"
		}).setProperty("unselectable", "on")
	},
	down: function (a) {
		return this.getElement(a)
	},
	getSelectionEnd: function () {
		if (this.createTextRange) {
			var a = document.selection.createRange().duplicate();
			a.moveStart("character", -this.value.length);
			return a.text.length
		}
		return this.selectionEnd
	},
	getSelectionStart: function () {
		if (this.createTextRange) {
			var a = document.selection.createRange().duplicate();
			a.moveEnd("character", this.value.length);
			if (a.text == "") {
				return this.value.length
			}
			return this.value.lastIndexOf(a.text)
		}
		return this.selectionStart
	},
	insert: function (f) {
		var c = $(this);
		if (typeof f == "string" || typeof f == "number" || (f.nodeName && f.nodeType == 1) || (f && (f.toElement || f.toHTML))) {
			f = {
				bottom: f
			}
		}
		var d, g, b, h;
		for (var a in f) {
			d = f[a];
			a = a.toLowerCase();
			g = Element._insertionTranslations[a];
			if (d && d.toElement) {
				d = d.toElement()
			}
			if (d.nodeName && d.nodeType == 1) {
				g(c, d);
				continue
			}
			d = Object.toHTML(d);
			b = ((a == "before" || a == "after") ? c.parentNode : c).tagName.toUpperCase();
			h = Element._getContentFromAnonymousElement(b, d);
			if (a == "top" || a == "after") {
				h.reverse()
			}
			h.each(function (i) {
				g(c, i)
			})
		}
		return c
	},
	next: function (a) {
		return this.getNext(a)
	},
	prev: function (a) {
		return this.getPrevious(a)
	},
	select: function (b) {
		var c = this;
		var a = [];
		$A(arguments).each(function (d) {
			var f = c.getElements(d);
			if ($type(f) == "array") {
				a = a.concat(f)
			}
		});
		return a
	},
	setSize: function (b, a) {
		if (b && b.$family && b.$family.name == "array") {
			a = b[1];
			b = b[0]
		} else {
			if (typeof b == "object") {
				if (typeof b.x == "number") {
					a = b.y;
					b = b.x
				} else {
					a = b.height;
					b = b.width
				}
			}
		}
		return this.setStyles({
			width: b,
			height: a
		})
	},
	up: function (a) {
		return this.getParent(a)
	}
});
Element._insertionTranslations = {
	before: function (a, b) {
		a.parentNode.insertBefore(b, a)
	},
	top: function (a, b) {
		a.insertBefore(b, a.firstChild)
	},
	bottom: function (a, b) {
		a.appendChild(b)
	},
	after: function (a, b) {
		a.parentNode.insertBefore(b, a.nextSibling)
	},
	tags: {
		TABLE: ["<table>", "</table>", 1],
		TBODY: ["<table><tbody>", "</tbody></table>", 2],
		TR: ["<table><tbody><tr>", "</tr></tbody></table>", 3],
		TD: ["<table><tbody><tr><td>", "</td></tr></tbody></table>", 4],
		SELECT: ["<select>", "</select>", 1]
	}
};
Hash.implement({
	find: function (d, c) {
		var a;
		var b = d;
		if (c) {
			b = b.bind(c)
		}
		this.some(function (g, f, h) {
			if (b(g, f, h)) {
				a = g;
				return true
			}
			return false
		});
		return a
	},
	inject: function (b, a) {
		this.each(function (d, c, f) {
			b = a(b, d, c, f)
		});
		return b
	},
	invoke: function (a) {
		this.each(function (b) {
			if (b[a]) {
				b[a]()
			}
		});
		return this
	},
	ksort: function (c) {
		var b = this;
		var a = $H({});
		this.getKeys().sort(c).each(function (d) {
			a[d] = b[d]
		});
		return a
	},
	merge: function (a) {
		return $H($merge(this.toObject(), a || {}))
	},
	sort: function (a) {
		return this.toArray().sort(a)
	},
	toArray: function () {
		var a = [];
		this.each(function (b) {
			a.push(b)
		});
		return a
	},
	toObject: function () {
		var a = {};
		this.each(function (c, b) {
			a[b] = c
		});
		return a
	}
});
Number.implement({
	isNaN: function () {
		return isNaN(this)
	},
	sgn: function () {
		if (this < 0) {
			return -1
		} else {
			if (this > 0) {
				return 1
			}
		}
		return 0
	}
});
String.implement({
	fromQueryString: function (b) {
		var c = this;
		var a = {};
		if (c.indexOf("?") != -1) {
			c = c.substr(c.indexOf("?") + 1)
		}
		a = $H($A(c.split("&")).inject({}, function (d, f) {
			f = f.split("=");
			if (f.length == 2) {
				d[f[0]] = f[1]
			}
			return d
		}));
		if (a && a.toObject && b) {
			a = a.toObject()
		}
		return a
	},
	leftPad: function (b, c) {
		var a = new String(this);
		if (!c) {
			c = " "
		}
		while (a.length < b) {
			a = c + a
		}
		return a.toString()
	},
	stripTags: function () {
		return this.replace(/<\/?[^>]+>/gi, "")
	},
	substituteWithoutReplacingUndefinedKeys: function (a, b) {
		return this.replace(b || (/\\?\{([^{}]+)\}/g), function (d, c) {
			if (d.charAt(0) == "\\") {
				return d.slice(1)
			}
			return (a[c] != undefined) ? a[c] : "{" + c + "}"
		})
	},
	unescapeHtml: function () {
		var b = new Element("div");
		b.innerHTML = this.stripTags();
		if (!b.childNodes[0]) {
			return ""
		}
		if (b.childNodes.length > 1) {
			var a = "";
			$A(b.childNodes).each(function (c) {
				return a + c.nodeValue
			});
			return a
		} else {
			return b.childNodes[0].nodeValue
		}
	}
});
Element.NativeEvents = $extend(Element.NativeEvents, {
	touchstart: 2,
	touchend: 2,
	touchmove: 2,
	touchcancel: 2,
	gesturechange: 2,
	gestureend: 2
});
Browser.Engines.isChrome = function () {
	return Browser.Engine.webkit && navigator.userAgent.toLowerCase().indexOf("chrome") != -1
};
if (Browser.Engine.trident) {
	Element.implement({
		insertAtCursor: function (b, a) {
			var d = this.getSelectedRange();
			if (d.start == 0 && d.end == 0) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = b;
				this.focus();
				return this
			}
			var c = this.get("value");
			this.set("value", c.substring(0, d.start) + b + c.substring(d.end, c.length));
			if ($pick(a, true)) {
				this.selectRange(d.start, d.start + b.length)
			} else {
				this.setCaretPosition(d.start + b.length)
			}
			return this
		},
		insertAroundCursor: function (b, a) {
			b = $extend({
				before: "",
				defaultMiddle: "",
				after: ""
			}, b);
			var c = this.getSelectedText() || b.defaultMiddle;
			var h = this.getSelectedRange();
			if (h.start == 0 && h.end == 0) {
				this.focus();
				sel = document.selection.createRange();
				sel.text = b.before + b.after;
				this.focus();
				return this
			}
			var g = this.get("value");
			if (h.start == h.end) {
				this.set("value", g.substring(0, h.start) + b.before + c + b.after + g.substring(h.end, g.length));
				this.selectRange(h.start + b.before.length, h.end + b.before.length + c.length)
			} else {
				var d = g.substring(h.start, h.end);
				this.set("value", g.substring(0, h.start) + b.before + d + b.after + g.substring(h.end, g.length));
				var f = h.start + b.before.length;
				if ($pick(a, true)) {
					this.selectRange(f, f + d.length)
				} else {
					this.setCaretPosition(f + g.length)
				}
			}
			return this
		}
	})
}
window.Travian = {
	applicationId: "travian",
	emptyFunction: function () {},
	$d: function (b) {
		if (Browser.Engine.gecko) {
			console.info(b)
		} else {
			if (Browser.Engine.webkit) {
				console.log(b)
			} else {
				if (Browser.Engine.presto) {
					opera.postError(b)
				} else {
					if (Browser.Engine.trident && window.console) {
						if (typeof b == "object") {
							console.log(JSON.encode(b))
						} else {
							console.log(b)
						}
					} else {
						if (!$("travian_console")) {
							var a = new Element("div", {
								id: "travian_console",
								styles: {
									position: "absolute",
									left: 0,
									height: 150,
									width: "100%",
									bottom: 0,
									zIndex: 10000,
									overflow: "auto",
									overflowX: "hidden",
									overflowY: "auto",
									borderTop: "1px solid #A06060",
									backgroundColor: "#FFD0D0",
									fontSize: "10px",
									fontFamily: "tahoma,arial,helvetica,sans-serif"
								}
							});
							(new Element("div", {
								html: "Console",
								styles: {
									fontWeight: "bold",
									padding: 1,
									marginBottom: 2,
									borderBottom: "1px solid #858484"
								}
							})).inject(a, "bottom");
							a.inject(document.body, "bottom")
						}(new Element("span", {
							html: b + "<br />"
						})).inject($("travian_console"), "bottom")
					}
				}
			}
		}
	},
	ajax: function (a) {
		a = a || {};
		var b = {
			onRequest: a.onRequest || Travian.emptyFunction,
			onComplete: a.onComplete || Travian.emptyFunction,
			onCancel: a.onCancel || Travian.emptyFunction,
			onSuccess: a.onSuccess || Travian.emptyFunction,
			onFailure: a.onFailure || Travian.emptyFunction,
			onException: a.onException || Travian.emptyFunction
		};
		if (!a.url) {
			a.url = "ajax.php"
		}
		if (a.data && a.data.cmd) {
			a.url = a.url + (a.url.indexOf("?") == -1 ? "?" : "&") + "cmd=" + a.data.cmd
		}
		return new Request($merge(a, {
			method: "post",
			encoding: "utf-8",
			evalResponse: false,
			evalScripts: false,
			headers: {
				"X-Request": "JSON"
			},
			onRequest: function () {
				b.onRequest(this)
			},
			onComplete: function () {
				if (!this.response.json) {
					this.response.json = JSON.decode(this.response.text)
				}
				b.onComplete(this.response.json.data)
			},
			onCancel: function () {
				b.onCancel(this)
			},
			onSuccess: function () {
				if (!this.response.json) {
					this.response.json = JSON.decode(this.response.text)
				}
				if (this.response.json.error) {
					if (b.onFailure(this.response.json.data, this.response.json.error) !== false) {
						if (this.response.json.errorMsg == null) {
							this.response.json.errorMsg = "Ajax Request error and no text. That is not so good."
						}
						this.response.json.errorMsg.dialog()
					}
					return
				} else {
					if (this.response.json.reload) {
						window.location.reload()
					}
				}
				b.onSuccess(this.response.json.data)
			},
			onFailure: function () {
				if (!this.response.json) {
					this.response.json = JSON.decode(this.response.text)
				}
				if (this.response.json.error) {
					if (b.onFailure(this.response.json.data, this.response.json.error) !== false) {
						if (this.response.json.errorMsg == null) {
							this.response.json.errorMsg = "Ajax Request error and no text. That is not so good."
						}
						this.response.json.errorMsg.dialog()
					}
					return
				}
				b.onFailure(this.response.json.data)
			},
			onException: function () {
				b.onException(this)
			}
		})).send()
	},
	getDirection: function () {
		if (!this.direction) {
			this.direction = $(document.body).getStyle("direction").toLowerCase()
		}
		return this.direction
	},
	insertScript: (function () {
		var a = $A([]);
		var b = function (c) {
				if (a.length == 0) {
					$$("script[src]").each(function (d) {
						a.push({
							src: d.src,
							id: d.id,
							defer: d.defer,
							defaultURL: false
						})
					})
				}
				return a.find(function (d) {
					return d.src == c.src
				})
			};
		return function (c) {
			var f = this;
			if (!c) {
				return
			}
			if (c && c.$family && c.$family.name == "array") {
				return $A(c).each(function (g) {
					f.insertScript(g)
				})
			}
			if (typeof c == "string") {
				c = {
					src: c
				}
			}
			c.onLoad = c.onLoad || this.emptyFunction;
			if (b(c)) {
				c.onLoad(false);
				return true
			}
			a.push(c);
			var d = new Element("script", {
				id: (c.id ? c.id : undefined),
				src: c.src,
				type: "text/javascript",
				defer: (c.defer ? true : false)
			});
			if (Browser.Engine.trident) {
				d.onreadystatechange = function () {
					if (d.readyState == "loaded" || d.readyState == "complete" || d.readyState == 4) {
						c.onLoad(true)
					}
				}
			} else {
				d.onload = c.onLoad.pass(true)
			}
			$(document.html).getElement("head").appendChild(d);
			return d
		}
	})(),
	popup: function (b, a) {
		return window.open(b, a.id || "_blank", $H(a).getKeys().inject([], function (d, c) {
			if (c != "id") {
				if ($type(a[c]) == "boolean") {
					a[c] = a[c] ? "yes" : "no"
				}
				d.push(c + "=" + a[c])
			}
			return d
		}).join(","), true)
	},
	toggleSwitch: function (b, a) {
		b.toggleClass("hide");
		a.toggleClass("switchClosed");
		a.toggleClass("switchOpened");
		return this
	}
};
Travian.ajax = Travian.ajax.wrap(function (b, a) {
	if (!a.url) {
		a.url = "ajax.php"
	}
	return b(a)
});
Travian.Main = {};
Travian.Main.Flags = new Class({
	Implements: [Options],
	currentRegion: null,
	elements: {
		container: null,
		flagContainer: null,
		flags: null,
		regionContainer: null
	},
	options: {
		adCode: null,
		container: null,
		currentTld: null,
		flags: null,
		regions: null
	},
	initialize: function (a) {
		this.setOptions(a);
		this.render()
	},
	render: function () {
		var a = this;
		this.elements.container = $(this.options.container);
		this.elements.flagContainer = (new Element("div", {
			"class": "region_flag",
			id: "flag_box"
		})).inject(this.elements.container);
		this.elements.regionContainer = (new Element("select", {
			id: "region_select",
			name: "region",
			events: {
				change: function (b) {
					b.stop();
					a.selectRegion(a.elements.regionContainer.value)
				}
			}
		})).inject(this.elements.container);
		$each(this.options.flags, function (b, c) {
			$each(b, function (f, d) {
				var g = (new Element("a", {
					href: f + (a.options.adCode != "" ? "?ad=" + a.options.adCode : ""),
					title: d,
					"class": "flagEntry " + c
				})).hide().inject(a.elements.flagContainer);
				(new Element("img", {
					alt: d,
					"class": "flag_" + d,
					src: "img/x.gif"
				})).inject(g);
				if (a.options.currentTld == d) {
					a.currentRegion = c
				}
			})
		});
		this.elements.flags = this.elements.flagContainer.getElements(".flagEntry");
		$each(this.options.regions, function (c, b) {
			if (!a.currentRegion) {
				a.currentRegion = b
			}(new Element("option", {
				value: b,
				html: c
			})).inject(a.elements.regionContainer)
		});
		this.selectRegion(this.currentRegion);
		return this
	},
	selectRegion: function (a) {
		if (!this.options.regions[a]) {
			return this
		}
		this.currentRegion = a;
		this.elements.regionContainer.value = a;
		this.elements.flags.each(function (b) {
			b.setStyles({
				display: b.hasClass(a) ? "inline" : "none"
			})
		});
		return this
	}
});
var popupWidget = new Class({
	Implements: [Options, Events],
	options: {
		url: "",
		pop_bg: $("overlaybg"),
		pop_container: $$("popup"),
		close: $("pclose"),
		tour: false,
		insupport: false,
		anchorcheck: false
	},
	allowedAnchors: new Array("tutorial", "moregames", "impressum", "spielregeln", "links", "agb", "help", "spielregeln", "serverLogin", "serverRegister"),
	initialize: function (a) {
		this.setOptions(a);
		this.showPopup()
	},
	popcontent: function () {
		return $$(this.options.pop_container)[0].getChildren()[1]
	},
	showPopup: function () {
		var url = new URI(this.options.url);
		var anchor = url.get("fragment");
		var target = anchor + ".php";
		if (url.get("query").length > 0) {
			target += "?" + url.get("query")
		}
		if (this.allowedAnchors.indexOf(anchor) == -1) {
			if (this.options.anchorcheck == false) {
				target = this.options.url
			} else {
				return
			}
		}
		var self = this;
		var prevwindow = $$(this.options.pop_bg);
		var prevcontainer = $$(this.options.pop_container);
		var windowWidth = document.documentElement.clientWidth;
		prevcontainer[0].setStyles({
			display: "block",
			visibility: "hidden"
		});
		prevcontainer[0].className = anchor;
		var popupWidth = prevcontainer[0].getStyle("width").toInt();
		var left = windowWidth / 2 - popupWidth / 2;
		prevwindow[0].setStyles({
			opacity: "0.7",
			display: "block",
			height: $(document).getScrollSize().y
		});
		var scroll = $(document.body).getScroll();
		prevcontainer[0].setStyles({
			left: windowWidth / 2 - popupWidth / 2,
			top: scroll.y + 100,
			visibility: "visible",
			display: "block"
		});
		self.popcontent().set("html", '<div class="loading"></div>');
		var req = new Request.HTML({
			url: target,
			evalScripts: false,
			onSuccess: function (html, responseElements, responseHTML, responseJavaScript) {
				self.popcontent().set("text", "");
				self.popcontent().adopt(html);
				if (anchor == "tutorial") {
					self.startTour()
				}
				if (self.options.insupport) {
					self.startSupport()
				}
				if (responseJavaScript) {
					eval(responseJavaScript)
				}
			},
			onFailure: function () {
				self.popcontent().set("text", "The request failed.")
			}
		});
		req.send();
		var close = $$(this.options.close);
		close.addEvent("click", function () {
			self.options.pop_container[0].setStyle("display", "none");
			self.options.pop_bg.setStyle("display", "none");
			this.removeEvents()
		});
		var bg = $$(this.options.pop_bg);
		bg.addEvent("click", function () {
			self.options.pop_container[0].setStyle("display", "none");
			self.options.pop_bg.setStyle("display", "none");
			this.removeEvents()
		})
	},
	startSupport: function () {
		$$(".spopcon").addEvent("click", function (a) {
			a.stop();
			new popupWidget({
				pop_bg: $("overlaybg"),
				pop_container: $$("#popup"),
				close: $$(".pclose"),
				url: this.get("href"),
				tour: false,
				insupport: false
			})
		})
	},
	startTour: function () {
		var f = $$(this.popcontent())[0].getChildren()[1].getChildren("a.prev");
		var d = $$(this.popcontent())[0].getChildren()[1].getChildren("a.next");
		var c = $$(this.popcontent())[0].getChildren()[1].getChildren("a.prevtxt");
		var a = $$(this.popcontent())[0].getChildren()[1].getChildren("a.nexttxt");
		var b = this;
		if (d.get("href")[0].indexOf("tutorial.php") != -1) {
			d.addEvent("click", function (g) {
				g.stop();
				b.getTour(d.get("href"))
			});
			a.addEvent("click", function (g) {
				g.stop();
				b.getTour(a.get("href"))
			})
		}
		f.addEvent("click", function (g) {
			g.stop();
			b.getTour(f.get("href"))
		});
		c.addEvent("click", function (g) {
			g.stop();
			b.getTour(c.get("href"))
		})
	},
	getTour: function (b) {
		var a = this;
		a.popcontent().set("html", '<div class="loading"></div>');
		var c = new Request.HTML({
			url: b,
			evalScripts: false,
			onSuccess: function (d) {
				a.popcontent().set("text", "");
				a.popcontent().adopt(d);
				a.startTour()
			},
			onFailure: function () {
				a.popcontent().set("text", "The request failed.")
			}
		});
		c.send()
	}
});
var sliderWidget = new Class({
	Implements: [Options, Events],
	options: {
		container: "",
		preview: true,
		inpreview: false,
		start: 0,
		head: "",
		desc: "",
		prev_bg: "",
		prev_container: "",
		prev_stage_container: "",
		prev_items: "",
		close: "",
		pimgwidth: "",
		directcall: false
	},
	initialize: function (a) {
		this.setOptions(a);
		if (!this.options.directcall) {
			this.slideshow()
		} else {
			this.previewstart(0)
		}
	},
	stage: function () {
		return $$(this.options.container[0].getChildren(":nth-child(2)"))
	},
	belt: function () {
		return $$(this.stage()[0].getChildren(":nth-child(1)"))
	},
	items: function () {
		return $$(this.belt().getChildren())
	},
	item: function () {
		return this.items()[0]
	},
	itemlength: function () {
		var b = this.item().getAttribute("width");
		if (b == null) {
			b = this.item().getStyle("width").toInt()
		}
		if (b == 0) {
			b = 520
		}
		b = parseInt(b);
		var c = this.item().getStyle("margin-left").toInt();
		var a = this.item().getStyle("margin-right").toInt();
		return b + c + a
	},
	beltlength: function () {
		var a = this.items().length * this.itemlength();
		this.belt().setStyle("width", a);
		return a
	},
	viewport: function () {
		return this.stage()[0].getStyle("width").toInt()
	},
	prevslide: function () {
		return $$(this.options.container[0].getChildren("a.prev"))
	},
	nextslide: function () {
		return $$(this.options.container[0].getChildren("a.next"))
	},
	index: function () {
		return this.options.start
	},
	slideshow: function () {
		var g = this.beltlength();
		var b = this.itemlength();
		var f = 0;
		var a = this;
		var c = a.index();
		if (c == "0") {
			this.prevslide().removeClass("disabled");
			this.nextslide().addClass("disabled")
		} else {
			if (c == this.items().length - 1) {
				this.prevslide().addClass("disabled");
				this.nextslide().removeClass("disabled")
			} else {
				this.prevslide().removeClass("disabled");
				this.nextslide().removeClass("disabled")
			}
		}
		if (this.options.inpreview) {
			this.addHeader(c);
			this.adddescription(c);
			if (c != "0") {
				g = g - this.itemlength() * (c + 1);
				b = b + this.itemlength() * (c - 1);
				f = b - this.itemlength();
				var d = new Fx.Morph(a.belt()[0], {
					duration: "normal",
					transition: "sine:in:out"
				});
				d.start({
					left: "-" + b + "px"
				})
			} else {
				a.belt()[0].setStyle("left", 0)
			}
		}
		this.prevslide().addEvent("click", function () {
			if (a.options.inpreview) {
				c = c + 1;
				a.addHeader(c);
				a.adddescription(c)
			}
			if (a.nextslide().hasClass("disabled")) {
				a.nextslide().removeClass("disabled")
			}
			if (g == a.beltlength()) {
				b = b;
				g = g - a.itemlength()
			} else {
				b = a.beltlength() - g
			}
			if (g > a.viewport()) {
				var h = new Fx.Morph(a.belt()[0], {
					duration: "normal",
					transition: "sine:in:out"
				});
				var i = {};
				if (Travian.getDirection() == "ltr") {
					i.left = "-" + b + "px"
				} else {
					i.right = "-" + b + "px"
				}
				h.start(i);
				g = g - a.itemlength();
				f = b - a.itemlength();
				if (g < a.viewport()) {
					this.addClass("disabled")
				}
			}
		});
		this.nextslide().addEvent("click", function () {
			c = c - 1;
			if (a.options.inpreview) {
				a.addHeader(c);
				a.adddescription(c)
			}
			if (a.prevslide().hasClass("disabled")) {
				a.prevslide().removeClass("disabled")
			}
			if (f != "-" + a.itemlength()) {
				var h = new Fx.Morph(a.belt()[0], {
					duration: "normal",
					transition: "sine:in:out"
				});
				var i = {};
				if (Travian.getDirection() == "ltr") {
					i.left = "-" + f + "px"
				} else {
					i.right = "-" + f + "px"
				}
				h.start(i);
				f = f - a.itemlength();
				g = g + a.itemlength();
				if (f == "-" + a.itemlength()) {
					this.addClass("disabled")
				}
			}
		});
		if (this.options.preview) {
			this.items().each(function (i, h) {
				i.addEvent("click", function () {
					a.previewstart(h)
				})
			})
		}
	},
	previewstart: function (b) {
		var a = this;
		this.options.prev_items.empty();
		$each(screenshots, function (d) {
			a.addImg(d.img)
		});
		var c = new sliderWidget({
			container: this.options.prev_stage_container,
			preview: false,
			inpreview: true,
			start: b,
			head: this.options.head,
			desc: this.options.desc,
			prev_bg: this.options.prev_bg,
			prev_container: this.options.prev_container,
			close: this.options.close,
			pimgwidth: this.options.pimgwidth
		});
		this.showPreview(c)
	},
	addImg: function (b) {
		var a = new Element("img", {
			src: "img/x.gif",
			"class": b,
			width: this.options.pimgwidth,
			height: 397
		}).inject(this.options.prev_items)
	},
	addHeader: function (a) {
		this.options.head.getElement("h3").empty().appendText(screenshots[a].hl)
	},
	adddescription: function (a) {
		this.options.desc.empty().appendText(screenshots[a].desc)
	},
	showPreview: function (g) {
		var f = $$(g.options.prev_bg);
		var d = $$(g.options.prev_container);
		var b = document.documentElement.clientWidth;
		d[0].setStyles({
			display: "block",
			visibility: "hidden"
		});
		var c = d[0].getStyle("width").toInt();
		f[0].setStyles({
			opacity: "0.7",
			display: "block"
		});
		var a = $(document.body).getScroll();
		d[0].setStyles({
			left: b / 2 - c / 2,
			top: a.y + 100,
			visibility: "visible",
			display: "block"
		});
		var h = $(d[0]).getElement(".close");
		h.addEvent("click", function () {
			f[0].setStyle("display", "none");
			d[0].setStyle("display", "none");
			g.prevslide().removeEvents();
			g.nextslide().removeEvents()
		});
		f[0].addEvent("click", function () {
			f[0].setStyle("display", "none");
			d[0].setStyle("display", "none");
			g.prevslide().removeEvents();
			g.nextslide().removeEvents()
		})
	}
});
var stageWidget = new Class({
	Implements: [Options, Events],
	options: {
		stagebg: "",
		stagecon: [],
		stagenav: [],
		stagelink: [],
		stageduration: [],
		periodical: "",
		currentCounter: 0,
		nextCounter: 1,
		numberOfStages: 3
	},
	initialize: function (a) {
		this.setOptions(a);
		this.stageshow();
		this.autoshow()
	},
	stageshow: function () {
		var a = this;
		this.options.stagenav.each(function (c, b) {
			c.addEvents({
				mouseenter: function () {
					a.pauseshow();
					if (!this.hasClass("act" + b)) {
						a.animateStage(b)
					}
				},
				mouseleave: function (d) {
					if (d.relatedTarget != null && d.relatedTarget.className.substring() != "stage-content") {
						a.autoshow()
					}
				}
			})
		})
	},
	autoAnimateState: function () {
		this.animateStage();
		clearTimeout(this.options.timeout);
		var a = this.options.stageduration[this.options.currentCounter];
		this.options.timeout = this.autoAnimateState.delay(a, this)
	},
	animateStage: function (a) {
		$each(this.options.stagenav, function (d, c) {
			d.removeClass("act" + c)
		});
		$each(this.options.stagecon, function (c) {
			c.removeClass("shown")
		});
		$each(this.options.stagelink, function (c) {
			c.removeClass("shown")
		});
		if (typeof a === "undefined") {
			this.options.currentCounter = this.options.nextCounter;
			var b = this.options.nextCounter;
			this.options.nextCounter = (this.options.nextCounter + 1) % this.options.numberOfStages
		} else {
			b = a;
			this.options.currentCounter = b;
			this.options.nextCounter = (b + 1) % this.options.numberOfStages
		}
		this.options.stagecon[b].setStyles({
			visibility: "hidden",
			opacity: 0
		});
		this.options.stagebg.setStyles({
			visibility: "hidden",
			opacity: 0
		});
		this.options.stagenav[b].addClass("act" + b).fade("in");
		this.options.stagecon[b].addClass("shown").fade("in");
		this.options.stagelink[b].addClass("shown").fade("in")
	},
	autoshow: function () {
		var a = this.options.stageduration[this.options.currentCounter];
		this.options.timeout = this.autoAnimateState.delay(a, this)
	},
	pauseshow: function () {
		clearTimeout(this.options.timeout)
	}
});
var tooltipWidget = new Class({
	Implements: [Options, Events],
	options: {
		tips: [],
		details: []
	},
	initialize: function (a) {
		this.setOptions(a);
		this.tooltip()
	},
	tooltip: function () {
		var a = this;
		this.options.tips.each(function (c, b) {
			c.addEvents({
				mouseenter: function () {
					if (Travian.getDirection() == "ltr") {
						var g = this.offsetLeft + 85
					} else {
						var g = this.offsetLeft - 275
					}
					a.options.details[b].addClass("shown");
					var f = a.options.details[b].getSize();
					a.options.details[b].removeClass("shown");
					var d = this.offsetTop - f.y;
					a.options.details[b].setStyles({
						position: "absolute",
						left: g,
						top: d,
						visibility: "hidden",
						opacity: 0
					});
					if (!this.hasClass("shown")) {
						a.options.details[b].addClass("shown").fade("in");
						this.addClass("act" + b)
					}
				},
				mouseleave: function (d) {
					if (d.relatedTarget.className.substring(0, 7) != "details") {
						a.options.details[b].removeClass("shown");
						this.removeClass("act" + b)
					}
				}
			})
		});
		this.options.details.each(function (c, b) {
			c.addEvents({
				mouseleave: function () {
					this.removeClass("shown")
				}
			})
		})
	}
});
window.addEvent("domready", function () {
	$$(".popcon").addEvent("click", function (c) {
		c.stop();
		new popupWidget({
			pop_bg: $("overlaybg"),
			pop_container: $$("#popup"),
			close: $$(".pclose"),
			url: this.get("href"),
			tour: this.get("href") == "#tutorial" ? true : false,
			insupport: this.get("href") == "#help" ? true : false
		})
	});
	var b = new URI();
	var a = b.get("fragment");
	if (a && a == "screenshots") {} else {
		if (a) {
			new popupWidget({
				pop_bg: $("overlaybg"),
				pop_container: $$("#popup"),
				close: $$(".pclose"),
				url: b.toString(),
				tour: a == "#tutorial" ? true : false,
				insupport: a == "#help" ? true : false,
				anchorcheck: true
			})
		}
	}
});