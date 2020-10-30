/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/bs4-toast/dist/toast.min.js":
/*!**************************************************!*\
  !*** ./node_modules/bs4-toast/dist/toast.min.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * @author Script47 (https://github.com/Script47/Toast)
 * @description Toast - A Bootstrap 4.2+ jQuery plugin for the toast component
 * @version 0.7.1
 **/
(function(b){b.toast=function(c){b("#toast-container").length||(b("body").prepend('<div id="toast-container" aria-live="polite" aria-atomic="true"></div>'),b("#toast-container").append('<div id="toast-wrapper"></div>'),b("body").on("hidden.bs.toast",".toast",function(){b(this).remove()}));var h="toast-"+(b(".toast").length+1),a="",e=a="",f="text-muted",g="",q=c.title||"Notice!",r=c.subtitle||"",p=c.content||"",k=c.delay||-1,d=c.img,l=c.pause_on_hover||!1,m=!1,n="";switch(c.type||"info"){case "info":a=
"bg-info";g=f=e="text-white";break;case "success":a="bg-success";g=f=e="text-white";break;case "warning":case "warn":a="bg-warning";g=f=e="text-white";break;case "error":case "danger":a="bg-danger",g=f=e="text-white"}!1!==l?(c=Math.floor(Date.now()/1E3)+k/1E3,n='data-autohide="false"',l='data-hide-timestamp="'+c+'"'):n=-1===k?'data-autohide="false"':'data-delay="'+k+'"';a='<div id="'+h+'" class="toast" role="alert" aria-live="assertive" aria-atomic="true" '+n+" "+l+">"+('<div class="toast-header '+
a+" "+e+'">');"undefined"!==typeof d&&(a+='<img src="'+d.src+'" class="'+(d["class"]||"")+' mr-2" alt="'+(d.alt||"Image")+'" '+("undefined"!==typeof d.title?'data-toggle="tooltip" title="'+d.title+'"':"")+">");a=a+('<strong class="mr-auto">'+q+"</strong>")+('<small class="'+f+'">'+r+"</small>");a+='<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">';a+='<span aria-hidden="true" class="'+g+'">&times;</span>';a+="</button>";a+="</div>";""!==p&&(a+='<div class="toast-body">',
a+=p,a+="</div>");a+="</div>";b("#toast-wrapper").append(a);b("#toast-wrapper .toast:last").toast("show");!1!==l&&(setTimeout(function(){m||b("#"+h).toast("hide")},k),b(document).on("mouseover","#"+h,function(){m=!0}),b(document).on("mouseleave","#"+h,function(){var a=Math.floor(Date.now()/1E3),c=parseInt(b(this).data("hide-timestamp"));m=!1;a>=c&&b(this).toast("hide")}))}})(jQuery);

/***/ }),

/***/ "./node_modules/freezeframe/dist/freezeframe.min.js":
/*!**********************************************************!*\
  !*** ./node_modules/freezeframe/dist/freezeframe.min.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

!function(t,n){ true?module.exports=n():undefined}(window,(function(){return function(t){var n={};function e(r){if(n[r])return n[r].exports;var i=n[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,e),i.l=!0,i.exports}return e.m=t,e.c=n,e.d=function(t,n,r){e.o(t,n)||Object.defineProperty(t,n,{enumerable:!0,get:r})},e.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},e.t=function(t,n){if(1&n&&(t=e(t)),8&n)return t;if(4&n&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(e.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&n&&"string"!=typeof t)for(var i in t)e.d(r,i,function(n){return t[n]}.bind(null,i));return r},e.n=function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,"a",n),n},e.o=function(t,n){return Object.prototype.hasOwnProperty.call(t,n)},e.p="/Users/nicholas.ford/Sites/freezeframe.js/packages/freezeframe/examples",e(e.s=120)}([function(t,n,e){var r=e(23)("wks"),i=e(18),o=e(1).Symbol,c="function"==typeof o;(t.exports=function(t){return r[t]||(r[t]=c&&o[t]||(c?o:i)("Symbol."+t))}).store=r},function(t,n){var e=t.exports="undefined"!=typeof window&&window.Math==Math?window:"undefined"!=typeof self&&self.Math==Math?self:Function("return this")();"number"==typeof __g&&(__g=e)},function(t,n,e){var r=e(3);t.exports=function(t){if(!r(t))throw TypeError(t+" is not an object!");return t}},function(t,n){t.exports=function(t){return"object"==typeof t?null!==t:"function"==typeof t}},function(t,n,e){var r=e(2),i=e(52),o=e(30),c=Object.defineProperty;n.f=e(5)?Object.defineProperty:function(t,n,e){if(r(t),n=o(n,!0),r(e),i)try{return c(t,n,e)}catch(t){}if("get"in e||"set"in e)throw TypeError("Accessors not supported!");return"value"in e&&(t[n]=e.value),t}},function(t,n,e){t.exports=!e(7)((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a}))},function(t,n,e){var r=e(1),i=e(11),o=e(9),c=e(8),a=e(13),u=function(t,n,e){var s,f,l,h,p=t&u.F,v=t&u.G,d=t&u.S,y=t&u.P,m=t&u.B,g=v?r:d?r[n]||(r[n]={}):(r[n]||{}).prototype,b=v?i:i[n]||(i[n]={}),w=b.prototype||(b.prototype={});for(s in v&&(e=n),e)l=((f=!p&&g&&void 0!==g[s])?g:e)[s],h=m&&f?a(l,r):y&&"function"==typeof l?a(Function.call,l):l,g&&c(g,s,l,t&u.U),b[s]!=l&&o(b,s,h),y&&w[s]!=l&&(w[s]=l)};r.core=i,u.F=1,u.G=2,u.S=4,u.P=8,u.B=16,u.W=32,u.U=64,u.R=128,t.exports=u},function(t,n){t.exports=function(t){try{return!!t()}catch(t){return!0}}},function(t,n,e){var r=e(1),i=e(9),o=e(12),c=e(18)("src"),a=e(74),u=(""+a).split("toString");e(11).inspectSource=function(t){return a.call(t)},(t.exports=function(t,n,e,a){var s="function"==typeof e;s&&(o(e,"name")||i(e,"name",n)),t[n]!==e&&(s&&(o(e,c)||i(e,c,t[n]?""+t[n]:u.join(String(n)))),t===r?t[n]=e:a?t[n]?t[n]=e:i(t,n,e):(delete t[n],i(t,n,e)))})(Function.prototype,"toString",(function(){return"function"==typeof this&&this[c]||a.call(this)}))},function(t,n,e){var r=e(4),i=e(17);t.exports=e(5)?function(t,n,e){return r.f(t,n,i(1,e))}:function(t,n,e){return t[n]=e,t}},function(t,n,e){var r=e(76),i=e(25);t.exports=function(t){return r(i(t))}},function(t,n){var e=t.exports={version:"2.6.5"};"number"==typeof __e&&(__e=e)},function(t,n){var e={}.hasOwnProperty;t.exports=function(t,n){return e.call(t,n)}},function(t,n,e){var r=e(24);t.exports=function(t,n,e){if(r(t),void 0===n)return t;switch(e){case 1:return function(e){return t.call(n,e)};case 2:return function(e,r){return t.call(n,e,r)};case 3:return function(e,r,i){return t.call(n,e,r,i)}}return function(){return t.apply(n,arguments)}}},function(t,n){var e={}.toString;t.exports=function(t){return e.call(t).slice(8,-1)}},function(t,n,e){var r=e(53),i=e(34);t.exports=Object.keys||function(t){return r(t,i)}},function(t,n){t.exports=function(t,n,e){return n in t?Object.defineProperty(t,n,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[n]=e,t}},function(t,n){t.exports=function(t,n){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:n}}},function(t,n){var e=0,r=Math.random();t.exports=function(t){return"Symbol(".concat(void 0===t?"":t,")_",(++e+r).toString(36))}},function(t,n){t.exports=!1},function(t,n,e){var r=e(4).f,i=e(12),o=e(0)("toStringTag");t.exports=function(t,n,e){t&&!i(t=e?t:t.prototype,o)&&r(t,o,{configurable:!0,value:n})}},function(t,n){t.exports={}},function(t,n){t.exports=function(t,n){return n||(n=t.slice(0)),Object.freeze(Object.defineProperties(t,{raw:{value:Object.freeze(n)}}))}},function(t,n,e){var r=e(11),i=e(1),o=i["__core-js_shared__"]||(i["__core-js_shared__"]={});(t.exports=function(t,n){return o[t]||(o[t]=void 0!==n?n:{})})("versions",[]).push({version:r.version,mode:e(19)?"pure":"global",copyright:"© 2019 Denis Pushkarev (zloirock.ru)"})},function(t,n){t.exports=function(t){if("function"!=typeof t)throw TypeError(t+" is not a function!");return t}},function(t,n){t.exports=function(t){if(null==t)throw TypeError("Can't call method on  "+t);return t}},function(t,n,e){var r=e(32),i=Math.min;t.exports=function(t){return t>0?i(r(t),9007199254740991):0}},function(t,n){n.f={}.propertyIsEnumerable},function(t,n,e){var r=e(14),i=e(0)("toStringTag"),o="Arguments"==r(function(){return arguments}());t.exports=function(t){var n,e,c;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(e=function(t,n){try{return t[n]}catch(t){}}(n=Object(t),i))?e:o?r(n):"Object"==(c=r(n))&&"function"==typeof n.callee?"Arguments":c}},function(t,n,e){var r=e(3),i=e(1).document,o=r(i)&&r(i.createElement);t.exports=function(t){return o?i.createElement(t):{}}},function(t,n,e){var r=e(3);t.exports=function(t,n){if(!r(t))return t;var e,i;if(n&&"function"==typeof(e=t.toString)&&!r(i=e.call(t)))return i;if("function"==typeof(e=t.valueOf)&&!r(i=e.call(t)))return i;if(!n&&"function"==typeof(e=t.toString)&&!r(i=e.call(t)))return i;throw TypeError("Can't convert object to primitive value")}},function(t,n,e){var r=e(53),i=e(34).concat("length","prototype");n.f=Object.getOwnPropertyNames||function(t){return r(t,i)}},function(t,n){var e=Math.ceil,r=Math.floor;t.exports=function(t){return isNaN(t=+t)?0:(t>0?r:e)(t)}},function(t,n,e){var r=e(23)("keys"),i=e(18);t.exports=function(t){return r[t]||(r[t]=i(t))}},function(t,n){t.exports="constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf".split(",")},function(t,n){n.f=Object.getOwnPropertySymbols},function(t,n,e){var r=e(27),i=e(17),o=e(10),c=e(30),a=e(12),u=e(52),s=Object.getOwnPropertyDescriptor;n.f=e(5)?s:function(t,n){if(t=o(t),n=c(n,!0),u)try{return s(t,n)}catch(t){}if(a(t,n))return i(!r.f.call(t,n),t[n])}},function(t,n,e){var r=e(18)("meta"),i=e(3),o=e(12),c=e(4).f,a=0,u=Object.isExtensible||function(){return!0},s=!e(7)((function(){return u(Object.preventExtensions({}))})),f=function(t){c(t,r,{value:{i:"O"+ ++a,w:{}}})},l=t.exports={KEY:r,NEED:!1,fastKey:function(t,n){if(!i(t))return"symbol"==typeof t?t:("string"==typeof t?"S":"P")+t;if(!o(t,r)){if(!u(t))return"F";if(!n)return"E";f(t)}return t[r].i},getWeak:function(t,n){if(!o(t,r)){if(!u(t))return!0;if(!n)return!1;f(t)}return t[r].w},onFreeze:function(t){return s&&l.NEED&&u(t)&&!o(t,r)&&f(t),t}}},function(t,n,e){var r=e(2),i=e(83),o=e(34),c=e(33)("IE_PROTO"),a=function(){},u=function(){var t,n=e(29)("iframe"),r=o.length;for(n.style.display="none",e(56).appendChild(n),n.src="javascript:",(t=n.contentWindow.document).open(),t.write("<script>document.F=Object<\/script>"),t.close(),u=t.F;r--;)delete u.prototype[o[r]];return u()};t.exports=Object.create||function(t,n){var e;return null!==t?(a.prototype=r(t),e=new a,a.prototype=null,e[c]=t):e=u(),void 0===n?e:i(e,n)}},function(t,n,e){var r=e(25);t.exports=function(t){return Object(r(t))}},function(t,n){t.exports=function(t,n,e,r){if(!(t instanceof n)||void 0!==r&&r in t)throw TypeError(e+": incorrect invocation!");return t}},function(t,n,e){var r=e(13),i=e(57),o=e(58),c=e(2),a=e(26),u=e(59),s={},f={};(n=t.exports=function(t,n,e,l,h){var p,v,d,y,m=h?function(){return t}:u(t),g=r(e,l,n?2:1),b=0;if("function"!=typeof m)throw TypeError(t+" is not iterable!");if(o(m)){for(p=a(t.length);p>b;b++)if((y=n?g(c(v=t[b])[0],v[1]):g(t[b]))===s||y===f)return y}else for(d=m.call(t);!(v=d.next()).done;)if((y=i(d,g,v.value,n))===s||y===f)return y}).BREAK=s,n.RETURN=f},function(t,n,e){var r=e(8);t.exports=function(t,n,e){for(var i in n)r(t,i,n[i],e);return t}},function(t,n,e){var r=e(0)("iterator"),i=!1;try{var o=[7][r]();o.return=function(){i=!0},Array.from(o,(function(){throw 2}))}catch(t){}t.exports=function(t,n){if(!n&&!i)return!1;var e=!1;try{var o=[7],c=o[r]();c.next=function(){return{done:e=!0}},o[r]=function(){return c},t(o)}catch(t){}return e}},function(t,n,e){"use strict";var r=e(95),i=e(65),o=e(21),c=e(10);t.exports=e(45)(Array,"Array",(function(t,n){this._t=c(t),this._i=0,this._k=n}),(function(){var t=this._t,n=this._k,e=this._i++;return!t||e>=t.length?(this._t=void 0,i(1)):i(0,"keys"==n?e:"values"==n?t[e]:[e,t[e]])}),"values"),o.Arguments=o.Array,r("keys"),r("values"),r("entries")},function(t,n,e){"use strict";var r=e(19),i=e(6),o=e(8),c=e(9),a=e(21),u=e(96),s=e(20),f=e(97),l=e(0)("iterator"),h=!([].keys&&"next"in[].keys()),p=function(){return this};t.exports=function(t,n,e,v,d,y,m){u(e,n,v);var g,b,w,I=function(t){if(!h&&t in E)return E[t];switch(t){case"keys":case"values":return function(){return new e(this,t)}}return function(){return new e(this,t)}},x=n+" Iterator",j="values"==d,S=!1,E=t.prototype,_=E[l]||E["@@iterator"]||d&&E[d],P=_||I(d),Z=d?j?I("entries"):P:void 0,L="Array"==n&&E.entries||_;if(L&&(w=f(L.call(new t)))!==Object.prototype&&w.next&&(s(w,x,!0),r||"function"==typeof w[l]||c(w,l,p)),j&&_&&"values"!==_.name&&(S=!0,P=function(){return _.call(this)}),r&&!m||!h&&!S&&E[l]||c(E,l,P),a[n]=P,a[x]=p,d)if(g={values:j?P:I("values"),keys:y?P:I("keys"),entries:Z},m)for(b in g)b in E||o(E,b,g[b]);else i(i.P+i.F*(h||S),n,g);return g}},function(t,n,e){"use strict";var r=e(28),i={};i[e(0)("toStringTag")]="z",i+""!="[object z]"&&e(8)(Object.prototype,"toString",(function(){return"[object "+r(this)+"]"}),!0)},function(t,n,e){"use strict";var r,i,o=e(48),c=RegExp.prototype.exec,a=String.prototype.replace,u=c,s=(r=/a/,i=/b*/g,c.call(r,"a"),c.call(i,"a"),0!==r.lastIndex||0!==i.lastIndex),f=void 0!==/()??/.exec("")[1];(s||f)&&(u=function(t){var n,e,r,i,u=this;return f&&(e=new RegExp("^"+u.source+"$(?!\\s)",o.call(u))),s&&(n=u.lastIndex),r=c.call(u,t),s&&r&&(u.lastIndex=u.global?r.index+r[0].length:n),f&&r&&r.length>1&&a.call(r[0],e,(function(){for(i=1;i<arguments.length-2;i++)void 0===arguments[i]&&(r[i]=void 0)})),r}),t.exports=u},function(t,n,e){"use strict";var r=e(2);t.exports=function(){var t=r(this),n="";return t.global&&(n+="g"),t.ignoreCase&&(n+="i"),t.multiline&&(n+="m"),t.unicode&&(n+="u"),t.sticky&&(n+="y"),n}},function(t,n,e){t.exports=e(93)},function(t,n){function e(t,n){for(var e=0;e<n.length;e++){var r=n[e];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}t.exports=function(t,n,r){return n&&e(t.prototype,n),r&&e(t,r),t}},function(t,n,e){var r=e(106),i=e(107),o=e(108);t.exports=function(t){return r(t)||i(t)||o()}},function(t,n,e){t.exports=!e(5)&&!e(7)((function(){return 7!=Object.defineProperty(e(29)("div"),"a",{get:function(){return 7}}).a}))},function(t,n,e){var r=e(12),i=e(10),o=e(77)(!1),c=e(33)("IE_PROTO");t.exports=function(t,n){var e,a=i(t),u=0,s=[];for(e in a)e!=c&&r(a,e)&&s.push(e);for(;n.length>u;)r(a,e=n[u++])&&(~o(s,e)||s.push(e));return s}},function(t,n,e){"use strict";var r=e(4),i=e(17);t.exports=function(t,n,e){n in t?r.f(t,n,i(0,e)):t[n]=e}},function(t,n,e){n.f=e(0)},function(t,n,e){var r=e(1).document;t.exports=r&&r.documentElement},function(t,n,e){var r=e(2);t.exports=function(t,n,e,i){try{return i?n(r(e)[0],e[1]):n(e)}catch(n){var o=t.return;throw void 0!==o&&r(o.call(t)),n}}},function(t,n,e){var r=e(21),i=e(0)("iterator"),o=Array.prototype;t.exports=function(t){return void 0!==t&&(r.Array===t||o[i]===t)}},function(t,n,e){var r=e(28),i=e(0)("iterator"),o=e(21);t.exports=e(11).getIteratorMethod=function(t){if(null!=t)return t[i]||t["@@iterator"]||o[r(t)]}},function(t,n,e){var r=e(2),i=e(24),o=e(0)("species");t.exports=function(t,n){var e,c=r(t).constructor;return void 0===c||null==(e=r(c)[o])?n:i(e)}},function(t,n,e){var r,i,o,c=e(13),a=e(88),u=e(56),s=e(29),f=e(1),l=f.process,h=f.setImmediate,p=f.clearImmediate,v=f.MessageChannel,d=f.Dispatch,y=0,m={},g=function(){var t=+this;if(m.hasOwnProperty(t)){var n=m[t];delete m[t],n()}},b=function(t){g.call(t.data)};h&&p||(h=function(t){for(var n=[],e=1;arguments.length>e;)n.push(arguments[e++]);return m[++y]=function(){a("function"==typeof t?t:Function(t),n)},r(y),y},p=function(t){delete m[t]},"process"==e(14)(l)?r=function(t){l.nextTick(c(g,t,1))}:d&&d.now?r=function(t){d.now(c(g,t,1))}:v?(o=(i=new v).port2,i.port1.onmessage=b,r=c(o.postMessage,o,1)):f.addEventListener&&"function"==typeof postMessage&&!f.importScripts?(r=function(t){f.postMessage(t+"","*")},f.addEventListener("message",b,!1)):r="onreadystatechange"in s("script")?function(t){u.appendChild(s("script")).onreadystatechange=function(){u.removeChild(this),g.call(t)}}:function(t){setTimeout(c(g,t,1),0)}),t.exports={set:h,clear:p}},function(t,n,e){"use strict";var r=e(24);function i(t){var n,e;this.promise=new t((function(t,r){if(void 0!==n||void 0!==e)throw TypeError("Bad Promise constructor");n=t,e=r})),this.resolve=r(n),this.reject=r(e)}t.exports.f=function(t){return new i(t)}},function(t,n,e){"use strict";var r=e(1),i=e(4),o=e(5),c=e(0)("species");t.exports=function(t){var n=r[t];o&&n&&!n[c]&&i.f(n,c,{configurable:!0,get:function(){return this}})}},function(t,n,e){for(var r=e(44),i=e(15),o=e(8),c=e(1),a=e(9),u=e(21),s=e(0),f=s("iterator"),l=s("toStringTag"),h=u.Array,p={CSSRuleList:!0,CSSStyleDeclaration:!1,CSSValueList:!1,ClientRectList:!1,DOMRectList:!1,DOMStringList:!1,DOMTokenList:!0,DataTransferItemList:!1,FileList:!1,HTMLAllCollection:!1,HTMLCollection:!1,HTMLFormElement:!1,HTMLSelectElement:!1,MediaList:!0,MimeTypeArray:!1,NamedNodeMap:!1,NodeList:!0,PaintRequestList:!1,Plugin:!1,PluginArray:!1,SVGLengthList:!1,SVGNumberList:!1,SVGPathSegList:!1,SVGPointList:!1,SVGStringList:!1,SVGTransformList:!1,SourceBufferList:!1,StyleSheetList:!0,TextTrackCueList:!1,TextTrackList:!1,TouchList:!1},v=i(p),d=0;d<v.length;d++){var y,m=v[d],g=p[m],b=c[m],w=b&&b.prototype;if(w&&(w[f]||a(w,f,h),w[l]||a(w,l,m),u[m]=h,g))for(y in r)w[y]||o(w,y,r[y],!0)}},function(t,n){t.exports=function(t,n){return{value:n,done:!!t}}},function(t,n,e){var r=e(3);t.exports=function(t,n){if(!r(t)||t._t!==n)throw TypeError("Incompatible receiver, "+n+" required!");return t}},function(t,n,e){var r=e(32),i=e(25);t.exports=function(t){return function(n,e){var o,c,a=String(i(n)),u=r(e),s=a.length;return u<0||u>=s?t?"":void 0:(o=a.charCodeAt(u))<55296||o>56319||u+1===s||(c=a.charCodeAt(u+1))<56320||c>57343?t?a.charAt(u):o:t?a.slice(u,u+2):c-56320+(o-55296<<10)+65536}}},function(t,n){function e(t,n,e,r,i,o,c){try{var a=t[o](c),u=a.value}catch(t){return void e(t)}a.done?n(u):Promise.resolve(u).then(r,i)}t.exports=function(t){return function(){var n=this,r=arguments;return new Promise((function(i,o){var c=t.apply(n,r);function a(t){e(c,i,o,a,u,"next",t)}function u(t){e(c,i,o,a,u,"throw",t)}a(void 0)}))}}},function(t,n){t.exports=function(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")}},function(t,n,e){var r,i;!function(o,c){"use strict";r=[e(100)],void 0===(i=function(t){return function(t,n){var e=t.jQuery,r=t.console;function i(t,n){for(var e in n)t[e]=n[e];return t}var o=Array.prototype.slice;function c(t,n,a){if(!(this instanceof c))return new c(t,n,a);var u,s=t;("string"==typeof t&&(s=document.querySelectorAll(t)),s)?(this.elements=(u=s,Array.isArray(u)?u:"object"==typeof u&&"number"==typeof u.length?o.call(u):[u]),this.options=i({},this.options),"function"==typeof n?a=n:i(this.options,n),a&&this.on("always",a),this.getImages(),e&&(this.jqDeferred=new e.Deferred),setTimeout(this.check.bind(this))):r.error("Bad element for imagesLoaded "+(s||t))}c.prototype=Object.create(n.prototype),c.prototype.options={},c.prototype.getImages=function(){this.images=[],this.elements.forEach(this.addElementImages,this)},c.prototype.addElementImages=function(t){"IMG"==t.nodeName&&this.addImage(t),!0===this.options.background&&this.addElementBackgroundImages(t);var n=t.nodeType;if(n&&a[n]){for(var e=t.querySelectorAll("img"),r=0;r<e.length;r++){var i=e[r];this.addImage(i)}if("string"==typeof this.options.background){var o=t.querySelectorAll(this.options.background);for(r=0;r<o.length;r++){var c=o[r];this.addElementBackgroundImages(c)}}}};var a={1:!0,9:!0,11:!0};function u(t){this.img=t}function s(t,n){this.url=t,this.element=n,this.img=new Image}return c.prototype.addElementBackgroundImages=function(t){var n=getComputedStyle(t);if(n)for(var e=/url\((['"])?(.*?)\1\)/gi,r=e.exec(n.backgroundImage);null!==r;){var i=r&&r[2];i&&this.addBackground(i,t),r=e.exec(n.backgroundImage)}},c.prototype.addImage=function(t){var n=new u(t);this.images.push(n)},c.prototype.addBackground=function(t,n){var e=new s(t,n);this.images.push(e)},c.prototype.check=function(){var t=this;function n(n,e,r){setTimeout((function(){t.progress(n,e,r)}))}this.progressedCount=0,this.hasAnyBroken=!1,this.images.length?this.images.forEach((function(t){t.once("progress",n),t.check()})):this.complete()},c.prototype.progress=function(t,n,e){this.progressedCount++,this.hasAnyBroken=this.hasAnyBroken||!t.isLoaded,this.emitEvent("progress",[this,t,n]),this.jqDeferred&&this.jqDeferred.notify&&this.jqDeferred.notify(this,t),this.progressedCount==this.images.length&&this.complete(),this.options.debug&&r&&r.log("progress: "+e,t,n)},c.prototype.complete=function(){var t=this.hasAnyBroken?"fail":"done";if(this.isComplete=!0,this.emitEvent(t,[this]),this.emitEvent("always",[this]),this.jqDeferred){var n=this.hasAnyBroken?"reject":"resolve";this.jqDeferred[n](this)}},u.prototype=Object.create(n.prototype),u.prototype.check=function(){this.getIsImageComplete()?this.confirm(0!==this.img.naturalWidth,"naturalWidth"):(this.proxyImage=new Image,this.proxyImage.addEventListener("load",this),this.proxyImage.addEventListener("error",this),this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.proxyImage.src=this.img.src)},u.prototype.getIsImageComplete=function(){return this.img.complete&&this.img.naturalWidth},u.prototype.confirm=function(t,n){this.isLoaded=t,this.emitEvent("progress",[this,this.img,n])},u.prototype.handleEvent=function(t){var n="on"+t.type;this[n]&&this[n](t)},u.prototype.onload=function(){this.confirm(!0,"onload"),this.unbindEvents()},u.prototype.onerror=function(){this.confirm(!1,"onerror"),this.unbindEvents()},u.prototype.unbindEvents=function(){this.proxyImage.removeEventListener("load",this),this.proxyImage.removeEventListener("error",this),this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype=Object.create(u.prototype),s.prototype.check=function(){this.img.addEventListener("load",this),this.img.addEventListener("error",this),this.img.src=this.url,this.getIsImageComplete()&&(this.confirm(0!==this.img.naturalWidth,"naturalWidth"),this.unbindEvents())},s.prototype.unbindEvents=function(){this.img.removeEventListener("load",this),this.img.removeEventListener("error",this)},s.prototype.confirm=function(t,n){this.isLoaded=t,this.emitEvent("progress",[this,this.element,n])},c.makeJQueryPlugin=function(n){(n=n||t.jQuery)&&((e=n).fn.imagesLoaded=function(t,n){return new c(this,t,n).jqDeferred.promise(e(this))})},c.makeJQueryPlugin(),c}(o,t)}.apply(n,r))||(t.exports=i)}("undefined"!=typeof window?window:this)},function(t,n){function e(n){return"function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?t.exports=e=function(t){return typeof t}:t.exports=e=function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},e(n)}t.exports=e},function(t,n,e){(t.exports=e(119)(!1)).push([t.i,'.ff-container{display:inline-block;position:relative}.ff-container .ff-image{z-index:0;vertical-align:top;opacity:0}.ff-container .ff-canvas{display:inline-block;position:absolute;top:0;left:0;pointer-events:none;z-index:1;vertical-align:top;opacity:0}.ff-container .ff-canvas.ff-canvas-ready{-webkit-transition:opacity 300ms;-o-transition:opacity 300ms;-moz-transition:opacity 300ms;transition:opacity 300ms;opacity:1}.ff-container.ff-active .ff-image{opacity:1}.ff-container.ff-active .ff-canvas.ff-canvas-ready{-webkit-transition:none;-o-transition:none;-moz-transition:none;transition:none;opacity:0}.ff-container.ff-active .ff-overlay{display:none}.ff-container.ff-inactive .ff-canvas.ff-canvas-ready{-webkit-transition:opacity 300ms;-o-transition:opacity 300ms;-moz-transition:opacity 300ms;transition:opacity 300ms;opacity:1}.ff-container.ff-inactive .ff-image{-webkit-transition:opacity 300ms;-o-transition:opacity 300ms;-moz-transition:opacity 300ms;transition:opacity 300ms;-webkit-transition-delay:170ms;-moz-transition-delay:170ms;-o-transition-delay:170ms;transition-delay:170ms;opacity:0}.ff-container.ff-responsive{width:100%}.ff-container.ff-responsive .ff-image,.ff-container.ff-responsive .ff-canvas{width:100%}.ff-container.ff-loading-icon:before{content:\'\';position:absolute;background-image:url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48c3ZnIHdpZHRoPSc1MHB4JyBoZWlnaHQ9JzUwcHgnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIiBjbGFzcz0idWlsLXNwaW4iPjxyZWN0IHg9IjAiIHk9IjAiIHdpZHRoPSIxMDAiIGhlaWdodD0iMTAwIiBmaWxsPSJub25lIiBjbGFzcz0iYmsiPjwvcmVjdD48ZyB0cmFuc2Zvcm09InRyYW5zbGF0ZSg1MCA1MCkiPjxnIHRyYW5zZm9ybT0icm90YXRlKDApIHRyYW5zbGF0ZSgzNCAwKSI+PGNpcmNsZSBjeD0iMCIgY3k9IjAiIHI9IjgiIGZpbGw9IiNmZmZmZmYiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9Im9wYWNpdHkiIGZyb209IjEiIHRvPSIwLjEiIGJlZ2luPSIwcyIgZHVyPSIxcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZVRyYW5zZm9ybSBhdHRyaWJ1dGVOYW1lPSJ0cmFuc2Zvcm0iIHR5cGU9InNjYWxlIiBmcm9tPSIxLjUiIHRvPSIxIiBiZWdpbj0iMHMiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9jaXJjbGU+PC9nPjxnIHRyYW5zZm9ybT0icm90YXRlKDQ1KSB0cmFuc2xhdGUoMzQgMCkiPjxjaXJjbGUgY3g9IjAiIGN5PSIwIiByPSI4IiBmaWxsPSIjZmZmZmZmIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJvcGFjaXR5IiBmcm9tPSIxIiB0bz0iMC4xIiBiZWdpbj0iMC4xMnMiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJzY2FsZSIgZnJvbT0iMS41IiB0bz0iMSIgYmVnaW49IjAuMTJzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPjwvY2lyY2xlPjwvZz48ZyB0cmFuc2Zvcm09InJvdGF0ZSg5MCkgdHJhbnNsYXRlKDM0IDApIj48Y2lyY2xlIGN4PSIwIiBjeT0iMCIgcj0iOCIgZmlsbD0iI2ZmZmZmZiI+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0ib3BhY2l0eSIgZnJvbT0iMSIgdG89IjAuMSIgYmVnaW49IjAuMjVzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0ic2NhbGUiIGZyb209IjEuNSIgdG89IjEiIGJlZ2luPSIwLjI1cyIgZHVyPSIxcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L2NpcmNsZT48L2c+PGcgdHJhbnNmb3JtPSJyb3RhdGUoMTM1KSB0cmFuc2xhdGUoMzQgMCkiPjxjaXJjbGUgY3g9IjAiIGN5PSIwIiByPSI4IiBmaWxsPSIjZmZmZmZmIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJvcGFjaXR5IiBmcm9tPSIxIiB0bz0iMC4xIiBiZWdpbj0iMC4zN3MiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJzY2FsZSIgZnJvbT0iMS41IiB0bz0iMSIgYmVnaW49IjAuMzdzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPjwvY2lyY2xlPjwvZz48ZyB0cmFuc2Zvcm09InJvdGF0ZSgxODApIHRyYW5zbGF0ZSgzNCAwKSI+PGNpcmNsZSBjeD0iMCIgY3k9IjAiIHI9IjgiIGZpbGw9IiNmZmZmZmYiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9Im9wYWNpdHkiIGZyb209IjEiIHRvPSIwLjEiIGJlZ2luPSIwLjVzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0ic2NhbGUiIGZyb209IjEuNSIgdG89IjEiIGJlZ2luPSIwLjVzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPjwvY2lyY2xlPjwvZz48ZyB0cmFuc2Zvcm09InJvdGF0ZSgyMjUpIHRyYW5zbGF0ZSgzNCAwKSI+PGNpcmNsZSBjeD0iMCIgY3k9IjAiIHI9IjgiIGZpbGw9IiNmZmZmZmYiPjxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9Im9wYWNpdHkiIGZyb209IjEiIHRvPSIwLjEiIGJlZ2luPSIwLjYycyIgZHVyPSIxcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZT48YW5pbWF0ZVRyYW5zZm9ybSBhdHRyaWJ1dGVOYW1lPSJ0cmFuc2Zvcm0iIHR5cGU9InNjYWxlIiBmcm9tPSIxLjUiIHRvPSIxIiBiZWdpbj0iMC42MnMiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9jaXJjbGU+PC9nPjxnIHRyYW5zZm9ybT0icm90YXRlKDI3MCkgdHJhbnNsYXRlKDM0IDApIj48Y2lyY2xlIGN4PSIwIiBjeT0iMCIgcj0iOCIgZmlsbD0iI2ZmZmZmZiI+PGFuaW1hdGUgYXR0cmlidXRlTmFtZT0ib3BhY2l0eSIgZnJvbT0iMSIgdG89IjAuMSIgYmVnaW49IjAuNzVzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0ic2NhbGUiIGZyb209IjEuNSIgdG89IjEiIGJlZ2luPSIwLjc1cyIgZHVyPSIxcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L2NpcmNsZT48L2c+PGcgdHJhbnNmb3JtPSJyb3RhdGUoMzE1KSB0cmFuc2xhdGUoMzQgMCkiPjxjaXJjbGUgY3g9IjAiIGN5PSIwIiByPSI4IiBmaWxsPSIjZmZmZmZmIj48YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJvcGFjaXR5IiBmcm9tPSIxIiB0bz0iMC4xIiBiZWdpbj0iMC44N3MiIGR1cj0iMXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGU+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJzY2FsZSIgZnJvbT0iMS41IiB0bz0iMSIgYmVnaW49IjAuODdzIiBkdXI9IjFzIiByZXBlYXRDb3VudD0iaW5kZWZpbml0ZSI+PC9hbmltYXRlVHJhbnNmb3JtPjwvY2lyY2xlPjwvZz48L2c+PC9zdmc+");background-position:center center;background-repeat:no-repeat;height:46px;width:46px;z-index:3;top:50%;left:50%;-webkit-transform:translate(-50%, -50%);-moz-transform:translate(-50%, -50%);-ms-transform:translate(-50%, -50%);-o-transform:translate(-50%, -50%);transform:translate(-50%, -50%)}.ff-container .ff-overlay{background-image:url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAF4AAABeCAQAAAAA22vlAAAGFklEQVR42t2ce0yVdRjHP9zlKnfQAwoqV80bImCR90tGhJmShVOxVFJBrdSWVmvmnJlSm2ZbWwunlc4ZOf5IV7NJ84KmFpmZioiKigoKyPWct72vJ4dj0Lm8t9Nz/jt/fd73/L6/5/v8fs9z4H8VTjjhjAuu5o8LLtJ3DoEuYnvghS89pY8PnrjjgrPeH0BEd8fbEHRpaVOZqVUQ2m/cLfomGX+8pAfQ8S8gonvglx/TeEToEKbW69vnD6Annrjp9QEevnU/Q0RDmdAp2m6ffSs0DD964KrHBeSEK96EnlgtdBGN5T9kEYQPHvp7AGc8CCCq7ozQTdzdv2U4AXjrTQEueBFGorFN6DaMzZWFU/t2UIAuwhVfIkkSLIiW6lOLfULx1Y8C3PAnmjTBwmg4UTyFQLzx0MMCcieQAaQLlofp1u73B+sjB7gTRCyjBavCWF+xPs2gvQJE+DjGCFZH8+WjuQRrqwB3gm2DF+P+4Z1jJQVotIDsghcEk7H6q4I4/M02TuUHsBNejPa6c2sTemlhImSAF6Pp/M/ZkgJUNREywYtRe3B7mroKkBFetNFXP5vTXz0bLSu8ZKNr/nhDLRstO7xko39Tx0YrAi/G7e+Vt9GKwYs2uqowK0pJE6EgvKSAG7/nK2ejFYaXbPSpkgxlFKACvKSAfR8Pk18BKsELgrGpcovchaRq8IJUSJ5eIqcCVIWXFHBy/1QC5VGA6vCii7i9d+NQOQpJLeBFBTy4vMl+BWgELyng2q95hNijAA3hJQWUPTpKcbV+AWkMLylgzwdDbFOA9vCiAhovb5zQx3oF6AJeUkDVyQXWHqXoBl5SwLF9k6w5TNQVvHSY+K3lh4l6gxcV0FCxIc1gSSGpQ3hJAZWl2QTghVt3+DqFF3+AMwUE4SXt/w4HL5hatoonoZ5db546hheEq3sQ1767Q8I33yKGYOndOx68IDCE3vg4JLypnWRE2+DqgPC3K0glGn+HhC8pIpUoh3zzd24aZpJEJL4OB3+vNnMlExlEON4OJViTUFqWsJwsUulHID1wdhj4C1XZn7KA6aSTQDg+XRsEncHX3lu323k5c3medAYiXlR7OIQ9aG3bfSjobRaQzWRSiMeAv2SL9W/MjpWnrOd1csggnSH049+rIb37+crq3M/JZw7TGEcScRgsu1XUHL6+cfN3riuYzwwmkkIifSw/iNIUvt1Y/EvkWhbxEs/wJE8QTZg1ByAawp/+a9xHLGY2mYxmGAPoZe31g0bw1TUFX5LPPGmVjyCOCFsufjSAf9C0vcTzTV5lJpNJJZG+hNh26awyvNF08PiA91jEyzzLUwyWtkR/W6/7VYX/81JmIUukVT6GYcTQ275GC9Xga2rX7GQZuUxnAsnEE2l/k5cq8M0tRQd7rmKBtMrTGEQUoXK0VigObxIOnxq8jjxeMSf+/oTL1dioMPzFqllbWcocshhDErGWJn7N4evurxftbS4vMpGRJNBH7lZGheDb2vYcChHtrZj4R0mrPEz+/g9F4MvOjtpgtrdPM5T+9FKmfVd2+Gs3874gn7mP7G3Eo/tuJ123rDQ2bdvvISb+GUyy1t5qCm80HTje710WMYuptthbDeHPVTxK/KPNiV+FMQ0Z4O/Urdn1WOKPIFidARk74Vtbd/0YsPqxxB+iXlexXfBHy0d82CnxezpAO+6V6nnbzYl/rPyJX0H4hsbC4g4VvwKJXyF4o7HkSF87Kn4N4csvTNncqeL30m7swuKBl5q7q3ZQwDxeYLztFb/c8LGM/q/xuuaWogO+K3nNXPEPtL3ilxdeGvK6fr479NLTUi0kVvwPD0HDba/45QzzeN2ObV2BV1zL2dahForRYkvsKsyDjZ7TrvzdGfxe/aa9zuKWqFgtZF+YR0oZH7/w4oWO4O3txaWGd1iobC1kX5iHeUkmwy33k68vXWlvF4S6+p/Kxm0gjxyeU7YWsi/MY9TEkUYGOeSxjBXks4jZZHU6BNXZGLt5gJ1exJLMeDKZwUymk8E4RipfC8mB74EfoUSRyHBSSGUkQ4nX4yrv6u17E0AYEUQRTV8MhDjCnzbgaH+X8Q8RGKy7dFBuqQAAAABJRU5ErkJggg==");background-repeat:no-repeat;max-width:94px;max-height:94px;position:absolute;left:0%;right:0%;top:0%;bottom:0%;margin:auto;-webkit-background-size:contain;-moz-background-size:contain;background-size:contain;background-position:center;pointer-events:none;z-index:100}\n',""])},function(t,n,e){var r=e(6),i=e(75),o=e(10),c=e(36),a=e(54);r(r.S,"Object",{getOwnPropertyDescriptors:function(t){for(var n,e,r=o(t),u=c.f,s=i(r),f={},l=0;s.length>l;)void 0!==(e=u(r,n=s[l++]))&&a(f,n,e);return f}})},function(t,n,e){t.exports=e(23)("native-function-to-string",Function.toString)},function(t,n,e){var r=e(31),i=e(35),o=e(2),c=e(1).Reflect;t.exports=c&&c.ownKeys||function(t){var n=r.f(o(t)),e=i.f;return e?n.concat(e(t)):n}},function(t,n,e){var r=e(14);t.exports=Object("z").propertyIsEnumerable(0)?Object:function(t){return"String"==r(t)?t.split(""):Object(t)}},function(t,n,e){var r=e(10),i=e(26),o=e(78);t.exports=function(t){return function(n,e,c){var a,u=r(n),s=i(u.length),f=o(c,s);if(t&&e!=e){for(;s>f;)if((a=u[f++])!=a)return!0}else for(;s>f;f++)if((t||f in u)&&u[f]===e)return t||f||0;return!t&&-1}}},function(t,n,e){var r=e(32),i=Math.max,o=Math.min;t.exports=function(t,n){return(t=r(t))<0?i(t+n,0):o(t,n)}},function(t,n,e){"use strict";var r=e(1),i=e(12),o=e(5),c=e(6),a=e(8),u=e(37).KEY,s=e(7),f=e(23),l=e(20),h=e(18),p=e(0),v=e(55),d=e(80),y=e(81),m=e(82),g=e(2),b=e(3),w=e(10),I=e(30),x=e(17),j=e(38),S=e(84),E=e(36),_=e(4),P=e(15),Z=E.f,L=_.f,O=S.f,k=r.Symbol,G=r.JSON,R=G&&G.stringify,A=p("_hidden"),W=p("toPrimitive"),T={}.propertyIsEnumerable,F=f("symbol-registry"),Y=f("symbols"),M=f("op-symbols"),N=Object.prototype,B="function"==typeof k,J=r.QObject,z=!J||!J.prototype||!J.prototype.findChild,C=o&&s((function(){return 7!=j(L({},"a",{get:function(){return L(this,"a",{value:7}).a}})).a}))?function(t,n,e){var r=Z(N,n);r&&delete N[n],L(t,n,e),r&&t!==N&&L(N,n,r)}:L,H=function(t){var n=Y[t]=j(k.prototype);return n._k=t,n},V=B&&"symbol"==typeof k.iterator?function(t){return"symbol"==typeof t}:function(t){return t instanceof k},X=function(t,n,e){return t===N&&X(M,n,e),g(t),n=I(n,!0),g(e),i(Y,n)?(e.enumerable?(i(t,A)&&t[A][n]&&(t[A][n]=!1),e=j(e,{enumerable:x(0,!1)})):(i(t,A)||L(t,A,x(1,{})),t[A][n]=!0),C(t,n,e)):L(t,n,e)},U=function(t,n){g(t);for(var e,r=y(n=w(n)),i=0,o=r.length;o>i;)X(t,e=r[i++],n[e]);return t},D=function(t){var n=T.call(this,t=I(t,!0));return!(this===N&&i(Y,t)&&!i(M,t))&&(!(n||!i(this,t)||!i(Y,t)||i(this,A)&&this[A][t])||n)},Q=function(t,n){if(t=w(t),n=I(n,!0),t!==N||!i(Y,n)||i(M,n)){var e=Z(t,n);return!e||!i(Y,n)||i(t,A)&&t[A][n]||(e.enumerable=!0),e}},K=function(t){for(var n,e=O(w(t)),r=[],o=0;e.length>o;)i(Y,n=e[o++])||n==A||n==u||r.push(n);return r},q=function(t){for(var n,e=t===N,r=O(e?M:w(t)),o=[],c=0;r.length>c;)!i(Y,n=r[c++])||e&&!i(N,n)||o.push(Y[n]);return o};B||(a((k=function(){if(this instanceof k)throw TypeError("Symbol is not a constructor!");var t=h(arguments.length>0?arguments[0]:void 0),n=function(e){this===N&&n.call(M,e),i(this,A)&&i(this[A],t)&&(this[A][t]=!1),C(this,t,x(1,e))};return o&&z&&C(N,t,{configurable:!0,set:n}),H(t)}).prototype,"toString",(function(){return this._k})),E.f=Q,_.f=X,e(31).f=S.f=K,e(27).f=D,e(35).f=q,o&&!e(19)&&a(N,"propertyIsEnumerable",D,!0),v.f=function(t){return H(p(t))}),c(c.G+c.W+c.F*!B,{Symbol:k});for(var $="hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables".split(","),tt=0;$.length>tt;)p($[tt++]);for(var nt=P(p.store),et=0;nt.length>et;)d(nt[et++]);c(c.S+c.F*!B,"Symbol",{for:function(t){return i(F,t+="")?F[t]:F[t]=k(t)},keyFor:function(t){if(!V(t))throw TypeError(t+" is not a symbol!");for(var n in F)if(F[n]===t)return n},useSetter:function(){z=!0},useSimple:function(){z=!1}}),c(c.S+c.F*!B,"Object",{create:function(t,n){return void 0===n?j(t):U(j(t),n)},defineProperty:X,defineProperties:U,getOwnPropertyDescriptor:Q,getOwnPropertyNames:K,getOwnPropertySymbols:q}),G&&c(c.S+c.F*(!B||s((function(){var t=k();return"[null]"!=R([t])||"{}"!=R({a:t})||"{}"!=R(Object(t))}))),"JSON",{stringify:function(t){for(var n,e,r=[t],i=1;arguments.length>i;)r.push(arguments[i++]);if(e=n=r[1],(b(n)||void 0!==t)&&!V(t))return m(n)||(n=function(t,n){if("function"==typeof e&&(n=e.call(this,t,n)),!V(n))return n}),r[1]=n,R.apply(G,r)}}),k.prototype[W]||e(9)(k.prototype,W,k.prototype.valueOf),l(k,"Symbol"),l(Math,"Math",!0),l(r.JSON,"JSON",!0)},function(t,n,e){var r=e(1),i=e(11),o=e(19),c=e(55),a=e(4).f;t.exports=function(t){var n=i.Symbol||(i.Symbol=o?{}:r.Symbol||{});"_"==t.charAt(0)||t in n||a(n,t,{value:c.f(t)})}},function(t,n,e){var r=e(15),i=e(35),o=e(27);t.exports=function(t){var n=r(t),e=i.f;if(e)for(var c,a=e(t),u=o.f,s=0;a.length>s;)u.call(t,c=a[s++])&&n.push(c);return n}},function(t,n,e){var r=e(14);t.exports=Array.isArray||function(t){return"Array"==r(t)}},function(t,n,e){var r=e(4),i=e(2),o=e(15);t.exports=e(5)?Object.defineProperties:function(t,n){i(t);for(var e,c=o(n),a=c.length,u=0;a>u;)r.f(t,e=c[u++],n[e]);return t}},function(t,n,e){var r=e(10),i=e(31).f,o={}.toString,c="object"==typeof window&&window&&Object.getOwnPropertyNames?Object.getOwnPropertyNames(window):[];t.exports.f=function(t){return c&&"[object Window]"==o.call(t)?function(t){try{return i(t)}catch(t){return c.slice()}}(t):i(r(t))}},function(t,n,e){var r=e(39),i=e(15);e(86)("keys",(function(){return function(t){return i(r(t))}}))},function(t,n,e){var r=e(6),i=e(11),o=e(7);t.exports=function(t,n){var e=(i.Object||{})[t]||Object[t],c={};c[t]=n(e),r(r.S+r.F*o((function(){e(1)})),"Object",c)}},function(t,n,e){"use strict";var r,i,o,c,a=e(19),u=e(1),s=e(13),f=e(28),l=e(6),h=e(3),p=e(24),v=e(40),d=e(41),y=e(60),m=e(61).set,g=e(89)(),b=e(62),w=e(90),I=e(91),x=e(92),j=u.TypeError,S=u.process,E=S&&S.versions,_=E&&E.v8||"",P=u.Promise,Z="process"==f(S),L=function(){},O=i=b.f,k=!!function(){try{var t=P.resolve(1),n=(t.constructor={})[e(0)("species")]=function(t){t(L,L)};return(Z||"function"==typeof PromiseRejectionEvent)&&t.then(L)instanceof n&&0!==_.indexOf("6.6")&&-1===I.indexOf("Chrome/66")}catch(t){}}(),G=function(t){var n;return!(!h(t)||"function"!=typeof(n=t.then))&&n},R=function(t,n){if(!t._n){t._n=!0;var e=t._c;g((function(){for(var r=t._v,i=1==t._s,o=0,c=function(n){var e,o,c,a=i?n.ok:n.fail,u=n.resolve,s=n.reject,f=n.domain;try{a?(i||(2==t._h&&T(t),t._h=1),!0===a?e=r:(f&&f.enter(),e=a(r),f&&(f.exit(),c=!0)),e===n.promise?s(j("Promise-chain cycle")):(o=G(e))?o.call(e,u,s):u(e)):s(r)}catch(t){f&&!c&&f.exit(),s(t)}};e.length>o;)c(e[o++]);t._c=[],t._n=!1,n&&!t._h&&A(t)}))}},A=function(t){m.call(u,(function(){var n,e,r,i=t._v,o=W(t);if(o&&(n=w((function(){Z?S.emit("unhandledRejection",i,t):(e=u.onunhandledrejection)?e({promise:t,reason:i}):(r=u.console)&&r.error&&r.error("Unhandled promise rejection",i)})),t._h=Z||W(t)?2:1),t._a=void 0,o&&n.e)throw n.v}))},W=function(t){return 1!==t._h&&0===(t._a||t._c).length},T=function(t){m.call(u,(function(){var n;Z?S.emit("rejectionHandled",t):(n=u.onrejectionhandled)&&n({promise:t,reason:t._v})}))},F=function(t){var n=this;n._d||(n._d=!0,(n=n._w||n)._v=t,n._s=2,n._a||(n._a=n._c.slice()),R(n,!0))},Y=function(t){var n,e=this;if(!e._d){e._d=!0,e=e._w||e;try{if(e===t)throw j("Promise can't be resolved itself");(n=G(t))?g((function(){var r={_w:e,_d:!1};try{n.call(t,s(Y,r,1),s(F,r,1))}catch(t){F.call(r,t)}})):(e._v=t,e._s=1,R(e,!1))}catch(t){F.call({_w:e,_d:!1},t)}}};k||(P=function(t){v(this,P,"Promise","_h"),p(t),r.call(this);try{t(s(Y,this,1),s(F,this,1))}catch(t){F.call(this,t)}},(r=function(t){this._c=[],this._a=void 0,this._s=0,this._d=!1,this._v=void 0,this._h=0,this._n=!1}).prototype=e(42)(P.prototype,{then:function(t,n){var e=O(y(this,P));return e.ok="function"!=typeof t||t,e.fail="function"==typeof n&&n,e.domain=Z?S.domain:void 0,this._c.push(e),this._a&&this._a.push(e),this._s&&R(this,!1),e.promise},catch:function(t){return this.then(void 0,t)}}),o=function(){var t=new r;this.promise=t,this.resolve=s(Y,t,1),this.reject=s(F,t,1)},b.f=O=function(t){return t===P||t===c?new o(t):i(t)}),l(l.G+l.W+l.F*!k,{Promise:P}),e(20)(P,"Promise"),e(63)("Promise"),c=e(11).Promise,l(l.S+l.F*!k,"Promise",{reject:function(t){var n=O(this);return(0,n.reject)(t),n.promise}}),l(l.S+l.F*(a||!k),"Promise",{resolve:function(t){return x(a&&this===c?P:this,t)}}),l(l.S+l.F*!(k&&e(43)((function(t){P.all(t).catch(L)}))),"Promise",{all:function(t){var n=this,e=O(n),r=e.resolve,i=e.reject,o=w((function(){var e=[],o=0,c=1;d(t,!1,(function(t){var a=o++,u=!1;e.push(void 0),c++,n.resolve(t).then((function(t){u||(u=!0,e[a]=t,--c||r(e))}),i)})),--c||r(e)}));return o.e&&i(o.v),e.promise},race:function(t){var n=this,e=O(n),r=e.reject,i=w((function(){d(t,!1,(function(t){n.resolve(t).then(e.resolve,r)}))}));return i.e&&r(i.v),e.promise}})},function(t,n){t.exports=function(t,n,e){var r=void 0===e;switch(n.length){case 0:return r?t():t.call(e);case 1:return r?t(n[0]):t.call(e,n[0]);case 2:return r?t(n[0],n[1]):t.call(e,n[0],n[1]);case 3:return r?t(n[0],n[1],n[2]):t.call(e,n[0],n[1],n[2]);case 4:return r?t(n[0],n[1],n[2],n[3]):t.call(e,n[0],n[1],n[2],n[3])}return t.apply(e,n)}},function(t,n,e){var r=e(1),i=e(61).set,o=r.MutationObserver||r.WebKitMutationObserver,c=r.process,a=r.Promise,u="process"==e(14)(c);t.exports=function(){var t,n,e,s=function(){var r,i;for(u&&(r=c.domain)&&r.exit();t;){i=t.fn,t=t.next;try{i()}catch(r){throw t?e():n=void 0,r}}n=void 0,r&&r.enter()};if(u)e=function(){c.nextTick(s)};else if(!o||r.navigator&&r.navigator.standalone)if(a&&a.resolve){var f=a.resolve(void 0);e=function(){f.then(s)}}else e=function(){i.call(r,s)};else{var l=!0,h=document.createTextNode("");new o(s).observe(h,{characterData:!0}),e=function(){h.data=l=!l}}return function(r){var i={fn:r,next:void 0};n&&(n.next=i),t||(t=i,e()),n=i}}},function(t,n){t.exports=function(t){try{return{e:!1,v:t()}}catch(t){return{e:!0,v:t}}}},function(t,n,e){var r=e(1).navigator;t.exports=r&&r.userAgent||""},function(t,n,e){var r=e(2),i=e(3),o=e(62);t.exports=function(t,n){if(r(t),i(n)&&n.constructor===t)return n;var e=o.f(t);return(0,e.resolve)(n),e.promise}},function(t,n,e){var r=function(t){"use strict";var n=Object.prototype,e=n.hasOwnProperty,r="function"==typeof Symbol?Symbol:{},i=r.iterator||"@@iterator",o=r.asyncIterator||"@@asyncIterator",c=r.toStringTag||"@@toStringTag";function a(t,n,e,r){var i=n&&n.prototype instanceof f?n:f,o=Object.create(i.prototype),c=new x(r||[]);return o._invoke=function(t,n,e){var r="suspendedStart";return function(i,o){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===i)throw o;return S()}for(e.method=i,e.arg=o;;){var c=e.delegate;if(c){var a=b(c,e);if(a){if(a===s)continue;return a}}if("next"===e.method)e.sent=e._sent=e.arg;else if("throw"===e.method){if("suspendedStart"===r)throw r="completed",e.arg;e.dispatchException(e.arg)}else"return"===e.method&&e.abrupt("return",e.arg);r="executing";var f=u(t,n,e);if("normal"===f.type){if(r=e.done?"completed":"suspendedYield",f.arg===s)continue;return{value:f.arg,done:e.done}}"throw"===f.type&&(r="completed",e.method="throw",e.arg=f.arg)}}}(t,e,c),o}function u(t,n,e){try{return{type:"normal",arg:t.call(n,e)}}catch(t){return{type:"throw",arg:t}}}t.wrap=a;var s={};function f(){}function l(){}function h(){}var p={};p[i]=function(){return this};var v=Object.getPrototypeOf,d=v&&v(v(j([])));d&&d!==n&&e.call(d,i)&&(p=d);var y=h.prototype=f.prototype=Object.create(p);function m(t){["next","throw","return"].forEach((function(n){t[n]=function(t){return this._invoke(n,t)}}))}function g(t,n){var r;this._invoke=function(i,o){function c(){return new n((function(r,c){!function r(i,o,c,a){var s=u(t[i],t,o);if("throw"!==s.type){var f=s.arg,l=f.value;return l&&"object"==typeof l&&e.call(l,"__await")?n.resolve(l.__await).then((function(t){r("next",t,c,a)}),(function(t){r("throw",t,c,a)})):n.resolve(l).then((function(t){f.value=t,c(f)}),(function(t){return r("throw",t,c,a)}))}a(s.arg)}(i,o,r,c)}))}return r=r?r.then(c,c):c()}}function b(t,n){var e=t.iterator[n.method];if(void 0===e){if(n.delegate=null,"throw"===n.method){if(t.iterator.return&&(n.method="return",n.arg=void 0,b(t,n),"throw"===n.method))return s;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var r=u(e,t.iterator,n.arg);if("throw"===r.type)return n.method="throw",n.arg=r.arg,n.delegate=null,s;var i=r.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=void 0),n.delegate=null,s):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,s)}function w(t){var n={tryLoc:t[0]};1 in t&&(n.catchLoc=t[1]),2 in t&&(n.finallyLoc=t[2],n.afterLoc=t[3]),this.tryEntries.push(n)}function I(t){var n=t.completion||{};n.type="normal",delete n.arg,t.completion=n}function x(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(w,this),this.reset(!0)}function j(t){if(t){var n=t[i];if(n)return n.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,o=function n(){for(;++r<t.length;)if(e.call(t,r))return n.value=t[r],n.done=!1,n;return n.value=void 0,n.done=!0,n};return o.next=o}}return{next:S}}function S(){return{value:void 0,done:!0}}return l.prototype=y.constructor=h,h.constructor=l,h[c]=l.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var n="function"==typeof t&&t.constructor;return!!n&&(n===l||"GeneratorFunction"===(n.displayName||n.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,c in t||(t[c]="GeneratorFunction")),t.prototype=Object.create(y),t},t.awrap=function(t){return{__await:t}},m(g.prototype),g.prototype[o]=function(){return this},t.AsyncIterator=g,t.async=function(n,e,r,i,o){void 0===o&&(o=Promise);var c=new g(a(n,e,r,i),o);return t.isGeneratorFunction(e)?c:c.next().then((function(t){return t.done?t.value:c.next()}))},m(y),y[c]="Generator",y[i]=function(){return this},y.toString=function(){return"[object Generator]"},t.keys=function(t){var n=[];for(var e in t)n.push(e);return n.reverse(),function e(){for(;n.length;){var r=n.pop();if(r in t)return e.value=r,e.done=!1,e}return e.done=!0,e}},t.values=j,x.prototype={constructor:x,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(I),!t)for(var n in this)"t"===n.charAt(0)&&e.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function r(e,r){return c.type="throw",c.arg=t,n.next=e,r&&(n.method="next",n.arg=void 0),!!r}for(var i=this.tryEntries.length-1;i>=0;--i){var o=this.tryEntries[i],c=o.completion;if("root"===o.tryLoc)return r("end");if(o.tryLoc<=this.prev){var a=e.call(o,"catchLoc"),u=e.call(o,"finallyLoc");if(a&&u){if(this.prev<o.catchLoc)return r(o.catchLoc,!0);if(this.prev<o.finallyLoc)return r(o.finallyLoc)}else if(a){if(this.prev<o.catchLoc)return r(o.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return r(o.finallyLoc)}}}},abrupt:function(t,n){for(var r=this.tryEntries.length-1;r>=0;--r){var i=this.tryEntries[r];if(i.tryLoc<=this.prev&&e.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=n&&n<=o.finallyLoc&&(o=null);var c=o?o.completion:{};return c.type=t,c.arg=n,o?(this.method="next",this.next=o.finallyLoc,s):this.complete(c)},complete:function(t,n){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&n&&(this.next=n),s},finish:function(t){for(var n=this.tryEntries.length-1;n>=0;--n){var e=this.tryEntries[n];if(e.finallyLoc===t)return this.complete(e.completion,e.afterLoc),I(e),s}},catch:function(t){for(var n=this.tryEntries.length-1;n>=0;--n){var e=this.tryEntries[n];if(e.tryLoc===t){var r=e.completion;if("throw"===r.type){var i=r.arg;I(e)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,e){return this.delegate={iterator:j(t),resultName:n,nextLoc:e},"next"===this.method&&(this.arg=void 0),s}},t}(t.exports);try{regeneratorRuntime=r}catch(t){Function("r","regeneratorRuntime = r")(r)}},function(t,n,e){var r=function(t){"use strict";var n=Object.prototype,e=n.hasOwnProperty,r="function"==typeof Symbol?Symbol:{},i=r.iterator||"@@iterator",o=r.asyncIterator||"@@asyncIterator",c=r.toStringTag||"@@toStringTag";function a(t,n,e,r){var i=n&&n.prototype instanceof f?n:f,o=Object.create(i.prototype),c=new x(r||[]);return o._invoke=function(t,n,e){var r="suspendedStart";return function(i,o){if("executing"===r)throw new Error("Generator is already running");if("completed"===r){if("throw"===i)throw o;return S()}for(e.method=i,e.arg=o;;){var c=e.delegate;if(c){var a=b(c,e);if(a){if(a===s)continue;return a}}if("next"===e.method)e.sent=e._sent=e.arg;else if("throw"===e.method){if("suspendedStart"===r)throw r="completed",e.arg;e.dispatchException(e.arg)}else"return"===e.method&&e.abrupt("return",e.arg);r="executing";var f=u(t,n,e);if("normal"===f.type){if(r=e.done?"completed":"suspendedYield",f.arg===s)continue;return{value:f.arg,done:e.done}}"throw"===f.type&&(r="completed",e.method="throw",e.arg=f.arg)}}}(t,e,c),o}function u(t,n,e){try{return{type:"normal",arg:t.call(n,e)}}catch(t){return{type:"throw",arg:t}}}t.wrap=a;var s={};function f(){}function l(){}function h(){}var p={};p[i]=function(){return this};var v=Object.getPrototypeOf,d=v&&v(v(j([])));d&&d!==n&&e.call(d,i)&&(p=d);var y=h.prototype=f.prototype=Object.create(p);function m(t){["next","throw","return"].forEach((function(n){t[n]=function(t){return this._invoke(n,t)}}))}function g(t){var n;this._invoke=function(r,i){function o(){return new Promise((function(n,o){!function n(r,i,o,c){var a=u(t[r],t,i);if("throw"!==a.type){var s=a.arg,f=s.value;return f&&"object"==typeof f&&e.call(f,"__await")?Promise.resolve(f.__await).then((function(t){n("next",t,o,c)}),(function(t){n("throw",t,o,c)})):Promise.resolve(f).then((function(t){s.value=t,o(s)}),(function(t){return n("throw",t,o,c)}))}c(a.arg)}(r,i,n,o)}))}return n=n?n.then(o,o):o()}}function b(t,n){var e=t.iterator[n.method];if(void 0===e){if(n.delegate=null,"throw"===n.method){if(t.iterator.return&&(n.method="return",n.arg=void 0,b(t,n),"throw"===n.method))return s;n.method="throw",n.arg=new TypeError("The iterator does not provide a 'throw' method")}return s}var r=u(e,t.iterator,n.arg);if("throw"===r.type)return n.method="throw",n.arg=r.arg,n.delegate=null,s;var i=r.arg;return i?i.done?(n[t.resultName]=i.value,n.next=t.nextLoc,"return"!==n.method&&(n.method="next",n.arg=void 0),n.delegate=null,s):i:(n.method="throw",n.arg=new TypeError("iterator result is not an object"),n.delegate=null,s)}function w(t){var n={tryLoc:t[0]};1 in t&&(n.catchLoc=t[1]),2 in t&&(n.finallyLoc=t[2],n.afterLoc=t[3]),this.tryEntries.push(n)}function I(t){var n=t.completion||{};n.type="normal",delete n.arg,t.completion=n}function x(t){this.tryEntries=[{tryLoc:"root"}],t.forEach(w,this),this.reset(!0)}function j(t){if(t){var n=t[i];if(n)return n.call(t);if("function"==typeof t.next)return t;if(!isNaN(t.length)){var r=-1,o=function n(){for(;++r<t.length;)if(e.call(t,r))return n.value=t[r],n.done=!1,n;return n.value=void 0,n.done=!0,n};return o.next=o}}return{next:S}}function S(){return{value:void 0,done:!0}}return l.prototype=y.constructor=h,h.constructor=l,h[c]=l.displayName="GeneratorFunction",t.isGeneratorFunction=function(t){var n="function"==typeof t&&t.constructor;return!!n&&(n===l||"GeneratorFunction"===(n.displayName||n.name))},t.mark=function(t){return Object.setPrototypeOf?Object.setPrototypeOf(t,h):(t.__proto__=h,c in t||(t[c]="GeneratorFunction")),t.prototype=Object.create(y),t},t.awrap=function(t){return{__await:t}},m(g.prototype),g.prototype[o]=function(){return this},t.AsyncIterator=g,t.async=function(n,e,r,i){var o=new g(a(n,e,r,i));return t.isGeneratorFunction(e)?o:o.next().then((function(t){return t.done?t.value:o.next()}))},m(y),y[c]="Generator",y[i]=function(){return this},y.toString=function(){return"[object Generator]"},t.keys=function(t){var n=[];for(var e in t)n.push(e);return n.reverse(),function e(){for(;n.length;){var r=n.pop();if(r in t)return e.value=r,e.done=!1,e}return e.done=!0,e}},t.values=j,x.prototype={constructor:x,reset:function(t){if(this.prev=0,this.next=0,this.sent=this._sent=void 0,this.done=!1,this.delegate=null,this.method="next",this.arg=void 0,this.tryEntries.forEach(I),!t)for(var n in this)"t"===n.charAt(0)&&e.call(this,n)&&!isNaN(+n.slice(1))&&(this[n]=void 0)},stop:function(){this.done=!0;var t=this.tryEntries[0].completion;if("throw"===t.type)throw t.arg;return this.rval},dispatchException:function(t){if(this.done)throw t;var n=this;function r(e,r){return c.type="throw",c.arg=t,n.next=e,r&&(n.method="next",n.arg=void 0),!!r}for(var i=this.tryEntries.length-1;i>=0;--i){var o=this.tryEntries[i],c=o.completion;if("root"===o.tryLoc)return r("end");if(o.tryLoc<=this.prev){var a=e.call(o,"catchLoc"),u=e.call(o,"finallyLoc");if(a&&u){if(this.prev<o.catchLoc)return r(o.catchLoc,!0);if(this.prev<o.finallyLoc)return r(o.finallyLoc)}else if(a){if(this.prev<o.catchLoc)return r(o.catchLoc,!0)}else{if(!u)throw new Error("try statement without catch or finally");if(this.prev<o.finallyLoc)return r(o.finallyLoc)}}}},abrupt:function(t,n){for(var r=this.tryEntries.length-1;r>=0;--r){var i=this.tryEntries[r];if(i.tryLoc<=this.prev&&e.call(i,"finallyLoc")&&this.prev<i.finallyLoc){var o=i;break}}o&&("break"===t||"continue"===t)&&o.tryLoc<=n&&n<=o.finallyLoc&&(o=null);var c=o?o.completion:{};return c.type=t,c.arg=n,o?(this.method="next",this.next=o.finallyLoc,s):this.complete(c)},complete:function(t,n){if("throw"===t.type)throw t.arg;return"break"===t.type||"continue"===t.type?this.next=t.arg:"return"===t.type?(this.rval=this.arg=t.arg,this.method="return",this.next="end"):"normal"===t.type&&n&&(this.next=n),s},finish:function(t){for(var n=this.tryEntries.length-1;n>=0;--n){var e=this.tryEntries[n];if(e.finallyLoc===t)return this.complete(e.completion,e.afterLoc),I(e),s}},catch:function(t){for(var n=this.tryEntries.length-1;n>=0;--n){var e=this.tryEntries[n];if(e.tryLoc===t){var r=e.completion;if("throw"===r.type){var i=r.arg;I(e)}return i}}throw new Error("illegal catch attempt")},delegateYield:function(t,n,e){return this.delegate={iterator:j(t),resultName:n,nextLoc:e},"next"===this.method&&(this.arg=void 0),s}},t}(t.exports);try{regeneratorRuntime=r}catch(t){Function("r","regeneratorRuntime = r")(r)}},function(t,n,e){var r=e(0)("unscopables"),i=Array.prototype;null==i[r]&&e(9)(i,r,{}),t.exports=function(t){i[r][t]=!0}},function(t,n,e){"use strict";var r=e(38),i=e(17),o=e(20),c={};e(9)(c,e(0)("iterator"),(function(){return this})),t.exports=function(t,n,e){t.prototype=r(c,{next:i(1,e)}),o(t,n+" Iterator")}},function(t,n,e){var r=e(12),i=e(39),o=e(33)("IE_PROTO"),c=Object.prototype;t.exports=Object.getPrototypeOf||function(t){return t=i(t),r(t,o)?t[o]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?c:null}},function(t,n,e){var r=e(6),i=e(99)(!1);r(r.S,"Object",{values:function(t){return i(t)}})},function(t,n,e){var r=e(15),i=e(10),o=e(27).f;t.exports=function(t){return function(n){for(var e,c=i(n),a=r(c),u=a.length,s=0,f=[];u>s;)o.call(c,e=a[s++])&&f.push(t?[e,c[e]]:c[e]);return f}}},function(t,n,e){var r,i;"undefined"!=typeof window&&window,void 0===(i="function"==typeof(r=function(){"use strict";function t(){}var n=t.prototype;return n.on=function(t,n){if(t&&n){var e=this._events=this._events||{},r=e[t]=e[t]||[];return-1==r.indexOf(n)&&r.push(n),this}},n.once=function(t,n){if(t&&n){this.on(t,n);var e=this._onceEvents=this._onceEvents||{};return(e[t]=e[t]||{})[n]=!0,this}},n.off=function(t,n){var e=this._events&&this._events[t];if(e&&e.length){var r=e.indexOf(n);return-1!=r&&e.splice(r,1),this}},n.emitEvent=function(t,n){var e=this._events&&this._events[t];if(e&&e.length){e=e.slice(0),n=n||[];for(var r=this._onceEvents&&this._onceEvents[t],i=0;i<e.length;i++){var o=e[i];r&&r[o]&&(this.off(t,o),delete r[o]),o.apply(this,n)}return this}},n.allOff=function(){delete this._events,delete this._onceEvents},t})?r.call(n,e,n,t):r)||(t.exports=i)},function(t,n,e){"use strict";var r=e(102),i=e(66);t.exports=e(103)("Set",(function(t){return function(){return t(this,arguments.length>0?arguments[0]:void 0)}}),{add:function(t){return r.def(i(this,"Set"),t=0===t?0:t,t)}},r)},function(t,n,e){"use strict";var r=e(4).f,i=e(38),o=e(42),c=e(13),a=e(40),u=e(41),s=e(45),f=e(65),l=e(63),h=e(5),p=e(37).fastKey,v=e(66),d=h?"_s":"size",y=function(t,n){var e,r=p(n);if("F"!==r)return t._i[r];for(e=t._f;e;e=e.n)if(e.k==n)return e};t.exports={getConstructor:function(t,n,e,s){var f=t((function(t,r){a(t,f,n,"_i"),t._t=n,t._i=i(null),t._f=void 0,t._l=void 0,t[d]=0,null!=r&&u(r,e,t[s],t)}));return o(f.prototype,{clear:function(){for(var t=v(this,n),e=t._i,r=t._f;r;r=r.n)r.r=!0,r.p&&(r.p=r.p.n=void 0),delete e[r.i];t._f=t._l=void 0,t[d]=0},delete:function(t){var e=v(this,n),r=y(e,t);if(r){var i=r.n,o=r.p;delete e._i[r.i],r.r=!0,o&&(o.n=i),i&&(i.p=o),e._f==r&&(e._f=i),e._l==r&&(e._l=o),e[d]--}return!!r},forEach:function(t){v(this,n);for(var e,r=c(t,arguments.length>1?arguments[1]:void 0,3);e=e?e.n:this._f;)for(r(e.v,e.k,this);e&&e.r;)e=e.p},has:function(t){return!!y(v(this,n),t)}}),h&&r(f.prototype,"size",{get:function(){return v(this,n)[d]}}),f},def:function(t,n,e){var r,i,o=y(t,n);return o?o.v=e:(t._l=o={i:i=p(n,!0),k:n,v:e,p:r=t._l,n:void 0,r:!1},t._f||(t._f=o),r&&(r.n=o),t[d]++,"F"!==i&&(t._i[i]=o)),t},getEntry:y,setStrong:function(t,n,e){s(t,n,(function(t,e){this._t=v(t,n),this._k=e,this._l=void 0}),(function(){for(var t=this._k,n=this._l;n&&n.r;)n=n.p;return this._t&&(this._l=n=n?n.n:this._t._f)?f(0,"keys"==t?n.k:"values"==t?n.v:[n.k,n.v]):(this._t=void 0,f(1))}),e?"entries":"values",!e,!0),l(n)}}},function(t,n,e){"use strict";var r=e(1),i=e(6),o=e(8),c=e(42),a=e(37),u=e(41),s=e(40),f=e(3),l=e(7),h=e(43),p=e(20),v=e(104);t.exports=function(t,n,e,d,y,m){var g=r[t],b=g,w=y?"set":"add",I=b&&b.prototype,x={},j=function(t){var n=I[t];o(I,t,"delete"==t||"has"==t?function(t){return!(m&&!f(t))&&n.call(this,0===t?0:t)}:"get"==t?function(t){return m&&!f(t)?void 0:n.call(this,0===t?0:t)}:"add"==t?function(t){return n.call(this,0===t?0:t),this}:function(t,e){return n.call(this,0===t?0:t,e),this})};if("function"==typeof b&&(m||I.forEach&&!l((function(){(new b).entries().next()})))){var S=new b,E=S[w](m?{}:-0,1)!=S,_=l((function(){S.has(1)})),P=h((function(t){new b(t)})),Z=!m&&l((function(){for(var t=new b,n=5;n--;)t[w](n,n);return!t.has(-0)}));P||((b=n((function(n,e){s(n,b,t);var r=v(new g,n,b);return null!=e&&u(e,y,r[w],r),r}))).prototype=I,I.constructor=b),(_||Z)&&(j("delete"),j("has"),y&&j("get")),(Z||E)&&j(w),m&&I.clear&&delete I.clear}else b=d.getConstructor(n,t,y,w),c(b.prototype,e),a.NEED=!0;return p(b,t),x[t]=b,i(i.G+i.W+i.F*(b!=g),x),m||d.setStrong(b,t,y),b}},function(t,n,e){var r=e(3),i=e(105).set;t.exports=function(t,n,e){var o,c=n.constructor;return c!==e&&"function"==typeof c&&(o=c.prototype)!==e.prototype&&r(o)&&i&&i(t,o),t}},function(t,n,e){var r=e(3),i=e(2),o=function(t,n){if(i(t),!r(n)&&null!==n)throw TypeError(n+": can't set as prototype!")};t.exports={set:Object.setPrototypeOf||("__proto__"in{}?function(t,n,r){try{(r=e(13)(Function.call,e(36).f(Object.prototype,"__proto__").set,2))(t,[]),n=!(t instanceof Array)}catch(t){n=!0}return function(t,e){return o(t,e),n?t.__proto__=e:r(t,e),t}}({},!1):void 0),check:o}},function(t,n){t.exports=function(t){if(Array.isArray(t)){for(var n=0,e=new Array(t.length);n<t.length;n++)e[n]=t[n];return e}}},function(t,n){t.exports=function(t){if(Symbol.iterator in Object(t)||"[object Arguments]"===Object.prototype.toString.call(t))return Array.from(t)}},function(t,n){t.exports=function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}},function(t,n,e){"use strict";var r=e(67)(!0);e(45)(String,"String",(function(t){this._t=String(t),this._i=0}),(function(){var t,n=this._t,e=this._i;return e>=n.length?{value:void 0,done:!0}:(t=r(n,e),this._i+=t.length,{value:t,done:!1})}))},function(t,n,e){"use strict";var r=e(13),i=e(6),o=e(39),c=e(57),a=e(58),u=e(26),s=e(54),f=e(59);i(i.S+i.F*!e(43)((function(t){Array.from(t)})),"Array",{from:function(t){var n,e,i,l,h=o(t),p="function"==typeof this?this:Array,v=arguments.length,d=v>1?arguments[1]:void 0,y=void 0!==d,m=0,g=f(h);if(y&&(d=r(d,v>2?arguments[2]:void 0,2)),null==g||p==Array&&a(g))for(e=new p(n=u(h.length));n>m;m++)s(e,m,y?d(h[m],m):h[m]);else for(l=g.call(h),e=new p;!(i=l.next()).done;m++)s(e,m,y?c(l,d,[i.value,m],!0):i.value);return e.length=m,e}})},function(t,n,e){"use strict";var r=e(112),i=e(2),o=e(60),c=e(113),a=e(26),u=e(114),s=e(47),f=e(7),l=Math.min,h=[].push,p=!f((function(){RegExp(4294967295,"y")}));e(115)("split",2,(function(t,n,e,f){var v;return v="c"=="abbc".split(/(b)*/)[1]||4!="test".split(/(?:)/,-1).length||2!="ab".split(/(?:ab)*/).length||4!=".".split(/(.?)(.?)/).length||".".split(/()()/).length>1||"".split(/.?/).length?function(t,n){var i=String(this);if(void 0===t&&0===n)return[];if(!r(t))return e.call(i,t,n);for(var o,c,a,u=[],f=(t.ignoreCase?"i":"")+(t.multiline?"m":"")+(t.unicode?"u":"")+(t.sticky?"y":""),l=0,p=void 0===n?4294967295:n>>>0,v=new RegExp(t.source,f+"g");(o=s.call(v,i))&&!((c=v.lastIndex)>l&&(u.push(i.slice(l,o.index)),o.length>1&&o.index<i.length&&h.apply(u,o.slice(1)),a=o[0].length,l=c,u.length>=p));)v.lastIndex===o.index&&v.lastIndex++;return l===i.length?!a&&v.test("")||u.push(""):u.push(i.slice(l)),u.length>p?u.slice(0,p):u}:"0".split(void 0,0).length?function(t,n){return void 0===t&&0===n?[]:e.call(this,t,n)}:e,[function(e,r){var i=t(this),o=null==e?void 0:e[n];return void 0!==o?o.call(e,i,r):v.call(String(i),e,r)},function(t,n){var r=f(v,t,this,n,v!==e);if(r.done)return r.value;var s=i(t),h=String(this),d=o(s,RegExp),y=s.unicode,m=(s.ignoreCase?"i":"")+(s.multiline?"m":"")+(s.unicode?"u":"")+(p?"y":"g"),g=new d(p?s:"^(?:"+s.source+")",m),b=void 0===n?4294967295:n>>>0;if(0===b)return[];if(0===h.length)return null===u(g,h)?[h]:[];for(var w=0,I=0,x=[];I<h.length;){g.lastIndex=p?I:0;var j,S=u(g,p?h:h.slice(I));if(null===S||(j=l(a(g.lastIndex+(p?0:I)),h.length))===w)I=c(h,I,y);else{if(x.push(h.slice(w,I)),x.length===b)return x;for(var E=1;E<=S.length-1;E++)if(x.push(S[E]),x.length===b)return x;I=w=j}}return x.push(h.slice(w)),x}]}))},function(t,n,e){var r=e(3),i=e(14),o=e(0)("match");t.exports=function(t){var n;return r(t)&&(void 0!==(n=t[o])?!!n:"RegExp"==i(t))}},function(t,n,e){"use strict";var r=e(67)(!0);t.exports=function(t,n,e){return n+(e?r(t,n).length:1)}},function(t,n,e){"use strict";var r=e(28),i=RegExp.prototype.exec;t.exports=function(t,n){var e=t.exec;if("function"==typeof e){var o=e.call(t,n);if("object"!=typeof o)throw new TypeError("RegExp exec method returned something other than an Object or null");return o}if("RegExp"!==r(t))throw new TypeError("RegExp#exec called on incompatible receiver");return i.call(t,n)}},function(t,n,e){"use strict";e(116);var r=e(8),i=e(9),o=e(7),c=e(25),a=e(0),u=e(47),s=a("species"),f=!o((function(){var t=/./;return t.exec=function(){var t=[];return t.groups={a:"7"},t},"7"!=="".replace(t,"$<a>")})),l=function(){var t=/(?:)/,n=t.exec;t.exec=function(){return n.apply(this,arguments)};var e="ab".split(t);return 2===e.length&&"a"===e[0]&&"b"===e[1]}();t.exports=function(t,n,e){var h=a(t),p=!o((function(){var n={};return n[h]=function(){return 7},7!=""[t](n)})),v=p?!o((function(){var n=!1,e=/a/;return e.exec=function(){return n=!0,null},"split"===t&&(e.constructor={},e.constructor[s]=function(){return e}),e[h](""),!n})):void 0;if(!p||!v||"replace"===t&&!f||"split"===t&&!l){var d=/./[h],y=e(c,h,""[t],(function(t,n,e,r,i){return n.exec===u?p&&!i?{done:!0,value:d.call(n,e,r)}:{done:!0,value:t.call(e,n,r)}:{done:!1}})),m=y[0],g=y[1];r(String.prototype,t,m),i(RegExp.prototype,h,2==n?function(t,n){return g.call(t,this,n)}:function(t){return g.call(t,this)})}}},function(t,n,e){"use strict";var r=e(47);e(6)({target:"RegExp",proto:!0,forced:r!==/./.exec},{exec:r})},function(t,n,e){"use strict";e(118);var r=e(2),i=e(48),o=e(5),c=/./.toString,a=function(t){e(8)(RegExp.prototype,"toString",t,!0)};e(7)((function(){return"/a/b"!=c.call({source:"a",flags:"b"})}))?a((function(){var t=r(this);return"/".concat(t.source,"/","flags"in t?t.flags:!o&&t instanceof RegExp?i.call(t):void 0)})):"toString"!=c.name&&a((function(){return c.call(this)}))},function(t,n,e){e(5)&&"g"!=/./g.flags&&e(4).f(RegExp.prototype,"flags",{configurable:!0,get:e(48)})},function(t,n,e){"use strict";t.exports=function(t){var n=[];return n.toString=function(){return this.map((function(n){var e=function(t,n){var e=t[1]||"",r=t[3];if(!r)return e;if(n&&"function"==typeof btoa){var i=(c=r,"/*# sourceMappingURL=data:application/json;charset=utf-8;base64,"+btoa(unescape(encodeURIComponent(JSON.stringify(c))))+" */"),o=r.sources.map((function(t){return"/*# sourceURL="+r.sourceRoot+t+" */"}));return[e].concat(o).concat([i]).join("\n")}var c;return[e].join("\n")}(n,t);return n[2]?"@media "+n[2]+"{"+e+"}":e})).join("")},n.i=function(t,e){"string"==typeof t&&(t=[[null,t,""]]);for(var r={},i=0;i<this.length;i++){var o=this[i][0];null!=o&&(r[o]=!0)}for(i=0;i<t.length;i++){var c=t[i];null!=c[0]&&r[c[0]]||(e&&!c[2]?c[2]=e:e&&(c[2]="("+c[2]+") and ("+e+")"),n.push(c))}},n}},function(t,n,e){"use strict";e.r(n);e(73),e(79),e(85),e(87);var r,i,o=e(49),c=e.n(o),a=(e(94),e(68)),u=e.n(a),s=(e(64),e(44),e(46),e(98),e(69)),f=e.n(s),l=e(50),h=e.n(l),p=e(16),v=e.n(p),d=e(70),y=e.n(d),m=(e(101),e(51)),g=e.n(m),b=(e(109),e(110),e(71)),w=e.n(b),I=(e(111),function(t){return"✨Freezeframe: ".concat(t,"✨")}),x=function(t){var n=t;return"string"===w()(n)?document.querySelectorAll(n):n},j=function(t,n,e){var r=t instanceof HTMLElement?[t]:t;return Array.from(r).reduce((function(t,n){if(n instanceof HTMLImageElement)t.push(n),"gif"!==function(t){return t.split(".").pop().toLowerCase().substring(0,3)}(n.src)&&e.warnings&&function(t){for(var n,e=arguments.length,r=new Array(e>1?e-1:0),i=1;i<e;i++)r[i-1]=arguments[i];(n=console).warn.apply(n,[I(t)].concat(r))}("Image does not appear to be a gif",n);else{var r,i=n.querySelectorAll("img");if(i.length)t=(r=t).concat.apply(r,g()(i));else!function(t){for(var n,e=arguments.length,r=new Array(e>1?e-1:0),i=1;i<e;i++)r[i-1]=arguments[i];(n=console).error.apply(n,[I(t)].concat(r))}("Invalid element",n)}return t}),[])},S=function(t){return g()(new Set(t))},E=function(t){var n=window.document.createElement("div");n.innerHTML=t;var e=n.childNodes;return e.length>1?e:e[0]},_=(e(117),e(22)),P=e.n(_),Z=function(){function t(t,n){for(var e=0;e<n.length;e++){var r=n[e];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(t,r.key,r)}}return function(n,e,r){return e&&t(n.prototype,e),r&&t(n,r),n}}(),L=(r=["",""],i=["",""],Object.freeze(Object.defineProperties(r,{raw:{value:Object.freeze(i)}})));function O(t,n){if(!(t instanceof n))throw new TypeError("Cannot call a class as a function")}var k=function(){function t(){for(var n=this,e=arguments.length,r=Array(e),i=0;i<e;i++)r[i]=arguments[i];return O(this,t),this.tag=function(t){for(var e=arguments.length,r=Array(e>1?e-1:0),i=1;i<e;i++)r[i-1]=arguments[i];return"function"==typeof t?n.interimTag.bind(n,t):"string"==typeof t?n.transformEndResult(t):(t=t.map(n.transformString.bind(n)),n.transformEndResult(t.reduce(n.processSubstitutions.bind(n,r))))},r.length>0&&Array.isArray(r[0])&&(r=r[0]),this.transformers=r.map((function(t){return"function"==typeof t?t():t})),this.tag}return Z(t,[{key:"interimTag",value:function(t,n){for(var e=arguments.length,r=Array(e>2?e-2:0),i=2;i<e;i++)r[i-2]=arguments[i];return this.tag(L,t.apply(void 0,[n].concat(r)))}},{key:"processSubstitutions",value:function(t,n,e){var r=this.transformSubstitution(t.shift(),n);return"".concat(n,r,e)}},{key:"transformString",value:function(t){return this.transformers.reduce((function(t,n){return n.onString?n.onString(t):t}),t)}},{key:"transformSubstitution",value:function(t,n){return this.transformers.reduce((function(t,e){return e.onSubstitution?e.onSubstitution(t,n):t}),t)}},{key:"transformEndResult",value:function(t){return this.transformers.reduce((function(t,n){return n.onEndResult?n.onEndResult(t):t}),t)}}]),t}(),G=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"";return{onEndResult:function(n){if(""===t)return n.trim();if("start"===(t=t.toLowerCase())||"left"===t)return n.replace(/^\s*/,"");if("end"===t||"right"===t)return n.replace(/\s*$/,"");throw new Error("Side not supported: "+t)}}};function R(t){if(Array.isArray(t)){for(var n=0,e=Array(t.length);n<t.length;n++)e[n]=t[n];return e}return Array.from(t)}var A=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"initial";return{onEndResult:function(n){if("initial"===t){var e=n.match(/^[^\S\n]*(?=\S)/gm),r=e&&Math.min.apply(Math,R(e.map((function(t){return t.length}))));if(r){var i=new RegExp("^.{"+r+"}","gm");return n.replace(i,"")}return n}if("all"===t)return n.replace(/^[^\S\n]+/gm,"");throw new Error("Unknown type: "+t)}}},W=function(t,n){return{onEndResult:function(e){if(null==t||null==n)throw new Error("replaceResultTransformer requires at least 2 arguments.");return e.replace(t,n)}}},T=function(t,n){return{onSubstitution:function(e,r){if(null==t||null==n)throw new Error("replaceSubstitutionTransformer requires at least 2 arguments.");return null==e?e:e.toString().replace(t,n)}}},F={separator:"",conjunction:"",serial:!1},Y=function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:F;return{onSubstitution:function(n,e){if(Array.isArray(n)){var r=n.length,i=t.separator,o=t.conjunction,c=t.serial,a=e.match(/(\n?[^\S\n]+)$/);if(n=a?n.join(i+a[1]):n.join(i+" "),o&&r>1){var u=n.lastIndexOf(i);n=n.slice(0,u)+(c?i:"")+" "+o+n.slice(u+1)}}return n}}},M=function(t){return{onSubstitution:function(n,e){if(null==t||"string"!=typeof t)throw new Error("You need to specify a string character to split by.");return"string"==typeof n&&n.includes(t)&&(n=n.split(t)),n}}},N=function(t){return null!=t&&!Number.isNaN(t)&&"boolean"!=typeof t},B=function(){return{onSubstitution:function(t){return Array.isArray(t)?t.filter(N):N(t)?t:""}}},J=(new k(Y({separator:","}),A,G),new k(Y({separator:",",conjunction:"and"}),A,G),new k(Y({separator:",",conjunction:"or"}),A,G),new k(M("\n"),B,Y,A,G)),z=(new k(M("\n"),Y,A,G,T(/&/g,"&amp;"),T(/</g,"&lt;"),T(/>/g,"&gt;"),T(/"/g,"&quot;"),T(/'/g,"&#x27;"),T(/`/g,"&#x60;")),new k(W(/(?:\n(?:\s*))+/g," "),G),new k(W(/(?:\n\s*)/g,""),G),new k(Y({separator:","}),W(/(?:\s+)/g," "),G),new k(Y({separator:",",conjunction:"or"}),W(/(?:\s+)/g," "),G),new k(Y({separator:",",conjunction:"and"}),W(/(?:\s+)/g," "),G),new k(Y,A,G),new k(Y,W(/(?:\s+)/g," "),G),new k(A,G),new k(A("all"),G),".freezeframe"),C="ff-container",H="ff-loading-icon",V="ff-image",X="ff-canvas",U="ff-ready",D="ff-inactive",Q="ff-active",K="ff-canvas-ready",q="ff-responsive",$="ff-overlay",tt={responsive:!0,trigger:"hover",overlay:!1,warnings:!0},nt={START:"start",STOP:"stop",TOGGLE:"toggle"},et=e(72),rt=e.n(et);function it(){var t=P()(['\n    <div class="','">\n    </div>\n  ']);return it=function(){return t},t}function ot(){var t=P()(['\n    <canvas class="','" width="0" height="0">\n    </canvas>\n  ']);return ot=function(){return t},t}function ct(){var t=P()(['\n    <div class="'," ",'">\n    </div>\n  ']);return ct=function(){return t},t}function at(){var t=P()(['\n    <style id="','">\n      ',"\n    </style>\n  "]);return at=function(){return t},t}function ut(t,n){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(t);n&&(r=r.filter((function(n){return Object.getOwnPropertyDescriptor(t,n).enumerable}))),e.push.apply(e,r)}return e}function st(t){for(var n=1;n<arguments.length;n++){var e=null!=arguments[n]?arguments[n]:{};n%2?ut(Object(e),!0).forEach((function(n){v()(t,n,e[n])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):ut(Object(e)).forEach((function(n){Object.defineProperty(t,n,Object.getOwnPropertyDescriptor(e,n))}))}return t}var ft=function(){function t(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:z,e=arguments.length>1?arguments[1]:void 0;f()(this,t),v()(this,"items",[]),v()(this,"$images",[]),v()(this,"_eventListeners",st({},Object.values(nt).reduce((function(t,n){return t[n]=[],t}),{}))),v()(this,"_internalEvents",[]),this.options=st({},tt,{},n instanceof Object&&!e?n:e);var r=this.options.selector||n;this._init(r)}var n;return h()(t,[{key:"_stylesInjected",get:function(){return!!document.querySelector("style#".concat("ff-styles"))}}]),h()(t,[{key:"_init",value:function(t){this._injectStylesheet(),this.isTouch="ontouchstart"in window||"onmsgesturechange"in window,this._capture(t),this._load(this.$images)}},{key:"_capture",value:function(t){this.$images=function(){for(var t=arguments.length,n=new Array(t),e=0;e<t;e++)n[e]=arguments[e];return function(){for(var t=arguments.length,e=new Array(t),r=0;r<t;r++)e[r]=arguments[r];return n.reduceRight((function(t,n){return function(){for(var r=arguments.length,i=new Array(r),o=0;o<r;o++)i[o]=arguments[o];return t(n.apply(void 0,i.concat(e)))}}))()}}(x,j,S)(t,this.options)}},{key:"_load",value:function(t){var n=this;y()(t).on("progress",(function(t,e){var r=e.img;n._setup(r)}))}},{key:"_setup",value:(n=u()(c.a.mark((function t(n){var e;return c.a.wrap((function(t){for(;;)switch(t.prev=t.next){case 0:return e=this._wrap(n),this.items.push(e),t.next=4,this._process(e);case 4:this._attach(e);case 5:case"end":return t.stop()}}),t,this)}))),function(t){return n.apply(this,arguments)})},{key:"_wrap",value:function(t){var n,e,r=E(J(ct(),C,H)),i=E(J(ot(),X));return this.options.responsive&&r.classList.add(q),this.options.overlay&&r.appendChild(E(J(it(),$))),t.classList.add(V),r.appendChild(i),e=r,(n=t).parentNode.insertBefore(e,n),e.appendChild(n),{$container:r,$canvas:i,$image:t}}},{key:"_process",value:function(t){var n=this;return new Promise((function(e){var r=t.$canvas,i=t.$image,o=t.$container,c=i.clientWidth,a=i.clientHeight;r.setAttribute("width",c),r.setAttribute("height",a),r.getContext("2d").drawImage(i,0,0,c,a),r.classList.add(K),r.addEventListener("transitionend",(function(){n._ready(o),e(t)}),{once:!0})}))}},{key:"_ready",value:function(t){t.classList.add(U),t.classList.add(D),t.classList.remove(H)}},{key:"_attach",value:function(t){var n=this,e=t.$image;if(!this.isTouch&&"hover"===this.options.trigger){this._addEventListener(e,"mouseleave",(function(){n._toggleOff(t),n._emit(nt.START,t,!1),n._emit(nt.TOGGLE,t,!1)})),this._addEventListener(e,"mouseenter",(function(){n._toggleOn(t),n._emit(nt.START,t,!0),n._emit(nt.TOGGLE,t,!0)}))}if(this.isTouch||"click"===this.options.trigger){this._addEventListener(e,"click",(function(){n._toggle(t)}))}}},{key:"_addEventListener",value:function(t,n,e){this._internalEvents.push({$image:t,event:n,listener:e}),t.addEventListener(n,e)}},{key:"_removeEventListener",value:function(t,n,e){t.removeEventListener(n,e)}},{key:"_injectStylesheet",value:function(){this._stylesInjected||document.head.appendChild(E(J(at(),"ff-styles",rt.a.toString())))}},{key:"_emit",value:function(t,n,e){this._eventListeners[t].forEach((function(t){t(1===n.length?n[0]:n,e)}))}},{key:"_toggleOn",value:function(t){var n=t.$container,e=t.$image;n.classList.contains(U)&&(e.setAttribute("src",e.src),n.classList.remove(D),n.classList.add(Q))}},{key:"_toggleOff",value:function(t){var n=t.$container;n.classList.contains(U)&&(n.classList.add(D),n.classList.remove(Q))}},{key:"_toggle",value:function(t){var n=t.$container.classList.contains(Q);return n?this._toggleOff(t):this._toggleOn(t),!n}},{key:"start",value:function(){var t=this;this.items.forEach((function(n){t._toggleOn(n)})),this._emit(nt.START,this.items,!0),this._emit(nt.TOGGLE,this.items,!0)}},{key:"stop",value:function(){var t=this;this.items.forEach((function(n){t._toggleOff(n)})),this._emit(nt.STOP,this.items,!1),this._emit(nt.TOGGLE,this.items,!1)}},{key:"toggle",value:function(){var t=this;this.items.forEach((function(n){var e=t._toggle(n);e?t._emit(nt.START,t.items,!1):t._emit(nt.STOP,t.items,!1),t._emit(nt.TOGGLE,t.items,e)}))}},{key:"on",value:function(t,n){this._eventListeners[t].push(n)}},{key:"destroy",value:function(){var t=this;this._internalEvents.forEach((function(n){var e=n.$image,r=n.event,i=n.listener;t._removeEventListener(e,r,i)}))}}]),t}();n.default=ft}]).default}));

/***/ }),

/***/ "./resources/js/ajax-forms.js":
/*!************************************!*\
  !*** ./resources/js/ajax-forms.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('body').on("submit", '[data-ajax="true"]', function (e) {
  e.preventDefault();
  console.log('Submit: ajax form');
  $this = $(this);
  console.log('this is:', $this);
  $form = $this[0];
  console.log('this form is:', $form);
  url = $this.attr('action');
  console.log('this url is: ', url);
  method = $this.attr('method');
  console.log('this method is: ', method);
  var enctype = $this.attr('enctype');
  console.log('this enctype is: ', enctype);
  var data = new FormData($form);
  console.log('data:', data);
  $onSuccess = $this.data('success');
  console.log('onSuccess:', $onSuccess);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: method,
    url: url,
    data: data,
    enctype: enctype,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    success: function success(data, textStatus, xhr) {
      var status = xhr.status;
      var html = data.html;
      var success = data.success;
      var message = data.message;
      var $html = $(html);
      var toast = data.toast;

      if (toast != 'undefind') {
        $.toast(toast);
      }

      switch ($onSuccess) {
        case 'close-modal':
          $this.closest('.modal').modal('toggle');
          console.log('success: closing modal', $this.closest('.modal'), response);
          break;

        case 'reload-page':
          location.reload();
          break;
      }
    },
    error: function error(request, status, _error) {
      toast = {
        'title': 'Error',
        'subtitle': 'just now',
        'content': 'Your request failed with an ' + status + '<br>Reason: ' + _error,
        'type': 'error',
        'delay': -1,
        'pause_on_hover': false
      };
      $.toast(toast);
      console.log('[ajax-forms.js] ajax error response:', request);
    }
  });
});

/***/ }),

/***/ "./resources/js/alert-toast.js":
/*!*************************************!*\
  !*** ./resources/js/alert-toast.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// CATCH AJAX ERRORS AND ALERT THEM
$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
  // handle any ajax error
  console.log('error status:', jqxhr.status);
  var title = 'Alert';
  var subtitle = 'Just now';
  var content = '';
  var type = 'error';
  var delay = -1;
  var pauseable = false;

  switch (jqxhr.status) {
    case 202:
      title = 'Alert: no content';
      content = 'You`re good but there is not content.';
      delay = 3;
      break;

    case 403:
      title = 'Alert: Forbidden access';
      subtitle = 'Just now';
      content = 'You can`t have that Dave!';
      break;

    case 401:
    case 419:
      title = 'Alert: Session Timeout';
      subtitle = 'Just now';
      content = 'Your current session has expired through lack of activiy. You will need to log back in to continue.';
      break;

    case 404:
      title = 'Alert: Page not found';
      subtitle = 'Just now';
      content = 'This is not the page your were looing for. Move along.';
      delay = 5;
      break;

    case 429:
      title = 'alert: Throtled';
      subtitle = 'Just now';
      content = 'Hey, slow down buddy!';
      var delay = 5;
      break;

    case 500:
      title = 'alert: Server error';
      subtitle = 'Just now';
      content = 'Okay, My bad!';
      break;
  }

  var toast = {
    'title': title,
    'subtitle': subtitle,
    'content': content,
    'type': type,
    'delay': delay,
    'pause_on_hover': pauseable
  };
  $.toast(toast);
  console.log('[alert-toast.js] ajax error response:', jqxhr.status);
});

/***/ }),

/***/ "./resources/js/grids.js":
/*!*******************************!*\
  !*** ./resources/js/grids.js ***!
  \*******************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var freezeframe__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! freezeframe */ "./node_modules/freezeframe/dist/freezeframe.min.js");
/* harmony import */ var freezeframe__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(freezeframe__WEBPACK_IMPORTED_MODULE_0__);

$(document).ready(function () {
  var grid = '.grid';
  var $grid = $(grid);
  var griditem = '.grid-item';
  var status = '.loader';
  var draggies = [];
  var isDrag = false; // get JSON-friendly data for items positions

  Packery.prototype.getShiftPositions = function (attrName) {
    attrName = attrName || 'id';

    var _this = this;

    return this.items.map(function (item) {
      return {
        i: item.element.getAttribute(attrName),
        x: item.rect.x / _this.packer.width
      };
    });
  };

  Packery.prototype.initShiftLayout = function (positions, attr) {
    if (!positions) {
      // if no initial positions, run packery layout
      this.layout();
      return;
    } // parse string to JSON


    if (typeof positions == 'string') {
      try {
        positions = JSON.parse(positions);
      } catch (error) {
        console.error('JSON parse error: ' + error);
        this.layout();
        return;
      }
    }

    attr = attr || 'id'; // default to id attribute

    this._resetLayout(); // set item order and horizontal position from saved positions


    this.items = positions.map(function (itemPosition) {
      console.log('itemPosition', itemPosition);
      var selector = '[' + attr + '="' + itemPosition.i + '"]';
      var itemElem = this.element.querySelector(selector);
      var item = this.getItem(itemElem);
      item.rect.x = itemPosition.x * this.packer.width;
      return item;
    }, this);
    this.shiftLayout();
  };

  function savePositions() {
    var board_id = $grid.data('index');
    var positions = localStorage.getItem('dragPositions');

    if (board_id) {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/api/b/ri',
        type: 'POST',
        data: {
          id: board_id,
          positions: positions
        },
        success: function success(response) {
          console.log('AJAX RESULT', response);
        }
      });
    }
  } //PACKERY


  $(function () {
    $grid.packery({
      columnWidth: '.grid-sizer',
      percentPosition: true
    });
  }); //fit layout for expanding items
  // $grid.on( 'click', griditem, function( event ) {
  //   var $item = $( event.currentTarget );
  //   // change size of item by toggling large class
  //   $item.toggleClass('col-md-8');
  //   if ( $item.is('.col-md-8') ) {
  //     // fit large item
  //     $grid.packery( 'fit', event.currentTarget );
  //   } else {
  //     // back to small, shiftLayout back
  //     $grid.packery('shiftLayout');
  //   }
  // });

  $('.toggle-drag-button').on('click', function (e) {
    var method = isDrag ? 'disable' : 'enable';
    draggies.forEach(function (draggie) {
      draggie[method]();
    });
    isDrag = !isDrag; // toglgle class

    $(griditem).toggleClass('draggable');
    $(this).parent('li').toggleClass('active'); // toggle text

    var t = $(this).text();
    var tt = $(this).attr('data-toggletext');
    $(this).text(tt);
    $(this).attr('data-toggletext', t); // action

    if (isDrag == false) {
      savePositions();
    }
  });

  function loadGrid() {
    var counter = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
    var timeout = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 3;
    // init Infinte Scroll
    //localStorage.removeItem('dragPositions');
    var url = $grid.data('url');
    url.substring(0, 1) == '/' ? url : url = '/' + url;
    var sortString = '';
    var filterString = '';
    $grid.infiniteScroll({
      path: function path() {
        var pageNumber = this.loadCount + 1;
        return '/api' + url + '?page=' + pageNumber + filterString + sortString;
      },
      checkLastPage: false,
      scrollThreshold: 0,
      history: true,
      status: status
    });
    $grid.infiniteScroll('loadNextPage');
  }

  $grid.on('load.infiniteScroll', function (event, response, path) {
    var viewmode =  true ? $grid.attr('data-layout') : undefined;
    var $items = $(response).find('.grid-item');
    localStorage.removeItem('dragPositions'); //make draggable. initially disabled

    var positions = [];
    $items.each(function (i, gridItem) {
      var draggie = new Draggabilly(gridItem);
      draggie.disable();
      draggies.push(draggie);
      $grid.packery('bindDraggabillyEvents', draggie);
      var index = gridItem.getAttribute('data-index');
      var x = gridItem.getAttribute('data-position');
      positions[i] = {
        'i': index,
        'x': x
      };
    });
    $grid.append($items).packery('appended', $items); // set positons

    $grid.packery('initShiftLayout', positions, 'data-index'); //$grid.packery();
    // $grid.imagesLoaded().progress( function() {});

    var gifs = new freezeframe__WEBPACK_IMPORTED_MODULE_0___default.a('.freezeframe', {
      overlay: true
    }); // const vplayers = Array.from(document.querySelectorAll('video')).map(p => new Plyr(p));
    // const aplayers = Array.from(document.querySelectorAll('audio')).map(p => new Plyr(p));
    // window.vplayers = vplayers;
    // window.aplayers = aplayers;
  });
  $grid.on('dragItemPositioned', function () {
    // save drag positions 
    var positions = $grid.packery('getShiftPositions', 'data-index');
    localStorage.setItem('dragPositions', JSON.stringify(positions)); //$grid.packery();
  }); //LAST PAGE
  // $grid.on( 'last.infiniteScroll', function( event, response, path ) {
  //   console.log( 'Loaded Last: ' + path );
  // });
  //EMPTY

  $grid.on('error.infiniteScroll', function (event, error, path) {
    //split path on ? then append 'create'
    console.log('Error Loading: ', error); // console.log('Path: ', path );
    // console.log('404 Event: ', event  );

    $('.loader').addClass('footer');
    var msg = error.toString().replace('Error: ', '');
    var url = path.substring(0, path.indexOf('?')) + '/?error=' + msg;
    return getErrorResponse(url);
  });

  function getErrorResponse(url) {
    console.log('sending error to:', url);
    $.getJSON(url, function (data, textStatus, jqXHR) {
      console.log('appending:', data.html);
      $grid.append(data.html);
    });
  }

  loadGrid();
});

/***/ }),

/***/ "./resources/js/modals.js":
/*!********************************!*\
  !*** ./resources/js/modals.js ***!
  \********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var modalTrigger = null;
$('.modal').on('show.bs.modal', function (e) {
  // prevent under-page scrolling
  var $body = $('html');
  var top = $body.scrollTop();
  $body.css('position', 'fixed');
  $body.css('top', -top); // do modal stuff

  modalTrigger = $(e.relatedTarget); // Button that triggered the modal

  modalTrigger.addClass('on');
  modalTitle = modalTrigger.data('target-title');
  var $this = $(this);
  var url = modalTrigger.data('url');
  url.substring(0, 1) == '/' ? '/api' + url : url = '/api/' + url;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: "GET",
    url: url,
    success: function success(response) {
      $('.modal-content').html(response);
      $('.modal-dialog').find('[role="title"]').text(modalTitle);
      $this.modal('show');
      $this.addClass('on');
    },
    error: function error(request, status, _error) {
      toast = {
        'title': 'Error',
        'subtitle': 'just now',
        'content': 'Your request failed with an ' + status + '<br>Reason: ' + _error,
        'type': 'error',
        'delay': 3,
        'pause_on_hover': false
      };
      $.toast(toast);
      console.log('[ajax-forms.js] ajax error response:', jqxhr.status);
      console.log("ajax call went wrong:" + request.responseText);
    }
  });
});
$('.modal').on('hide.bs.modal', function (e) {
  modalTrigger.removeClass('on'); //relaest fixed scroll

  var $body = $('html');
  var offset = $body.offset().top;
  $body.css('position', '');
  $body.css('top', '');
  window.scrollTo(0, parseInt(offset || '0') * -1);
});
$('.modal').on('hidden.bs.modal', function (e) {
  $('.modal-body').html('');
});

/***/ }),

/***/ "./resources/js/nav.js":
/*!*****************************!*\
  !*** ./resources/js/nav.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

$(document).ready(function () {
  $(document).on("click", '[data-to]', function (e) {
    $this = $(this);
    url = $this.attr('data-to');

    if ($this[0].hasAttribute('target')) {
      target = $this.attr('target');
      window.open(url, target);
    } else {
      window.location = url;
    }
  }); // STICKY
  // get the sticky element thne add .isStuck once it is stuck.

  var stickyElm = document.querySelector('.sticky-top');
  var observer = new IntersectionObserver(function (_ref) {
    var _ref2 = _slicedToArray(_ref, 1),
        e = _ref2[0];

    return e.target.classList.toggle('isStuck', e.intersectionRatio < 1);
  }, {
    threshold: [1]
  });
  observer.observe(stickyElm);
});

/***/ }),

/***/ "./resources/js/platform.js":
/*!**********************************!*\
  !*** ./resources/js/platform.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

window.onload = function () {
  // BOOTSTRAP
  $('body').tooltip({
    selector: '[data-toggle="tooltip"]'
  }); // BS$-TOAST

  $(document).on('hidden.bs.toast', '.toast', function (e) {
    $(this).remove();
  });
}; // GENERAL PLATFORM FUNCTIONS

/*
function nFormatter(num, digits) {
  var si = [
    { value: 1E18, symbol: "Q" },
    { value: 1E15, symbol: "q" },
    { value: 1E12, symbol: "t" },
    { value: 1E9,  symbol: "B" },
    { value: 1E6,  symbol: "M" },
    { value: 1E3,  symbol: "k" }
  ], i;
  for (i = 0; i < si.length; i++) {
    if (num >= si[i].value) {
      return (num / si[i].value).toFixed(digits).replace(/\.?0+$/, "") + si[i].symbol;
    }
  }
  return num;
}
*/

/***/ }),

/***/ "./resources/js/reactions.js":
/*!***********************************!*\
  !*** ./resources/js/reactions.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// GENERAL PLATFORM FUNCTIONS
function nFormatter(num, digits) {
  var si = [{
    value: 1E18,
    symbol: "Q"
  }, {
    value: 1E15,
    symbol: "q"
  }, {
    value: 1E12,
    symbol: "t"
  }, {
    value: 1E9,
    symbol: "B"
  }, {
    value: 1E6,
    symbol: "M"
  }, {
    value: 1E3,
    symbol: "k"
  }],
      i;

  for (i = 0; i < si.length; i++) {
    if (num >= si[i].value) {
      return (num / si[i].value).toFixed(digits).replace(/\.?0+$/, "") + si[i].symbol;
    }
  }

  return num;
}

$(document).on("click", '[data-action]', function (e) {
  e.preventDefault();
  e.stopPropagation();
  var $this = $(this);
  $this.prop('disabled', true);
  var action = $this.data('action');
  var type = $this.data('type');
  var id = $this.data('id');
  var url = $this.data('url');
  url.substring(0, 1) == '/' ? '/api' + url : url = '/api/' + url;
  var data = {
    action: action,
    type: type,
    id: id
  };
  var $item = $this.closest('.card');
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'POST',
    data: data,
    url: url,
    success: function success(data) {
      var count = data.totals.count ? data.totals.count : 0;
      var weight = data.totals.weight ? data.totals.count : null;
      var count_string = nFormatter(count, 1);
      var $parent = $item.closest('.grid-item'); //set counts & wieghts

      $parent.data('total-weight', weight);
      $parent.data('total-count', count); // set count_string

      $parent.find('[data-acted="' + action + '"]').each(function () {
        $(this).html(count_string);
      }); //set reacted class

      if (data.totals.reacted == true) {
        $this.addClass('on');
      } else {
        $this.removeClass('on');
      }
    },
    error: function error(request, status, _error) {
      console.log("actions ajax call went wrong:" + request.responseText);
      console.log("action url:" + url);
    }
  }).done(function () {
    $this.prop('disabled', false);
  });
});

/***/ }),

/***/ "./resources/js/uploader.js":
/*!**********************************!*\
  !*** ./resources/js/uploader.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  //CROPIE
  //$('#item').croppie(opts);
  // call a method via jquery
  //$('#item').croppie(method, args);
  //DROPZONE
  var dropzone = '[data-role="drop-zone"]',
      dropcontrolupload = '[data-role="drop-control-upload"]';
  dropcontrolrevert = '[data-role="drop-control-revert"]', dropimage = '[data-role="preview-image"]', dropinput = 'input[data-role="file-input"]';
  $('body').on('change', dropinput, function (event) {
    console.log('dropintput changed');
    zone = $(this).closest(dropzone);
    img = zone.find(dropimage);
    oldimg = img.attr('src');
    reverter = zone.find(dropcontrolrevert);
    hasChanged = readURL(this, img);

    if (hasChanged === true) {
      reverter.removeClass('disabled');
    } else {
      reverter.addClass('disabled');
    }
  });
  $('body').on('click', dropcontrolupload, function (e) {
    console.log('dropcontrolupload clicked');
    $this = $(this);
    input = $this.closest(dropzone).find(dropinput);
    input.click();
  });
  $('body').on('click', dropcontrolrevert, function (e) {
    console.log('dropcontrolrevert clicked');
    $this = $(this);
    zone = $this.closest(dropzone);
    input = zone.find(dropinput);
    img = zone.find(dropimage);
    fallback = img.data('default');
    img.attr('src', fallback);
    $this.addClass('disabled');
  }); // DRANG N DROP

  $('body').on('dragover', dropzone, function () {
    $this = $(this).addClass('dropping');
    return false;
  });
  $('body').on('dragend dragleave', dropzone, function () {
    $(dropzone).removeClass('dropping');
    return false;
  });
  $('body').on('drop', dropzone, function (e) {
    e.preventDefault();
    $this = $(this);
    zone = $this.closest(dropzone);
    zone.removeClass('dropping');
    var files = e.originalEvent.dataTransfer.files;

    if (files && files[0]) {
      input = zone.find(dropinput);
      input.files = files[0];
      console.log('input', input);
      img = zone.find(dropimage); //if (input.files && input.files[0]) {   

      var reader = new FileReader();

      reader.onload = function (e) {
        img.attr('src', e.target.result);
        console.log('drop2', img.attr('src'));
      };

      reader.readAsDataURL(input.files[0]); //}

      return true;
    }
  });

  function readURL(input, img) {
    $this = this;

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        img.attr('src', e.target.result);
      };

      reader.readAsDataURL(input.files[0]);
      return true;
    }

    return false;
  }
  /*
      reverter = zone.find(dropcontrolrevert);
      hasChanged = readURL(this, img); 
      if(hasChanged === true)
      {
        reverter.removeClass('disabled');
      } else {
        reverter.addClass('disabled');
      }
  */

});

/***/ }),

/***/ 1:
/*!*******************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** multi ./resources/js/platform.js ./node_modules/freezeframe/dist/freezeframe.min.js ./node_modules/bs4-toast/dist/toast.min.js ./resources/js/ajax-forms.js ./resources/js/alert-toast.js ./resources/js/nav.js ./resources/js/uploader.js ./resources/js/grids.js ./resources/js/modals.js ./resources/js/reactions.js ***!
  \*******************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /var/www/curio/resources/js/platform.js */"./resources/js/platform.js");
__webpack_require__(/*! /var/www/curio/node_modules/freezeframe/dist/freezeframe.min.js */"./node_modules/freezeframe/dist/freezeframe.min.js");
__webpack_require__(/*! /var/www/curio/node_modules/bs4-toast/dist/toast.min.js */"./node_modules/bs4-toast/dist/toast.min.js");
__webpack_require__(/*! /var/www/curio/resources/js/ajax-forms.js */"./resources/js/ajax-forms.js");
__webpack_require__(/*! /var/www/curio/resources/js/alert-toast.js */"./resources/js/alert-toast.js");
__webpack_require__(/*! /var/www/curio/resources/js/nav.js */"./resources/js/nav.js");
__webpack_require__(/*! /var/www/curio/resources/js/uploader.js */"./resources/js/uploader.js");
__webpack_require__(/*! /var/www/curio/resources/js/grids.js */"./resources/js/grids.js");
__webpack_require__(/*! /var/www/curio/resources/js/modals.js */"./resources/js/modals.js");
module.exports = __webpack_require__(/*! /var/www/curio/resources/js/reactions.js */"./resources/js/reactions.js");


/***/ })

/******/ });