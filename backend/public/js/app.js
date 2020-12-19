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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  mounted: function mounted() {
    console.log('Component mounted.');
  }
});

/***/ }),

/***/ "./node_modules/bootstrap/dist/js/bootstrap.js":
/*!*****************************************************!*\
  !*** ./node_modules/bootstrap/dist/js/bootstrap.js ***!
  \*****************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/bootstrap/dist/js/bootstrap.js'");

/***/ }),

/***/ "./node_modules/jquery/dist/jquery.js":
/*!********************************************!*\
  !*** ./node_modules/jquery/dist/jquery.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/jquery/dist/jquery.js'");

/***/ }),

/***/ "./node_modules/lodash/lodash.js":
/*!***************************************!*\
  !*** ./node_modules/lodash/lodash.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/lodash/lodash.js'");

/***/ }),

/***/ "./node_modules/popper.js/dist/esm/popper.js":
/*!***************************************************!*\
  !*** ./node_modules/popper.js/dist/esm/popper.js ***!
  \***************************************************/
/*! exports provided: default */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/popper.js/dist/esm/popper.js'");

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e&":
/*!*******************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e& ***!
  \*******************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _vm._m(0)
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "container" }, [
      _c("div", { staticClass: "row justify-content-center" }, [
        _c("div", { staticClass: "col-md-8" }, [
          _c("div", { staticClass: "card" }, [
            _c("div", { staticClass: "card-header" }, [
              _vm._v("Example Component")
            ]),
            _vm._v(" "),
            _c("div", { staticClass: "card-body" }, [
              _vm._v(
                "\n                    I'm an example component.\n                "
              )
            ])
          ])
        ])
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js":
/*!********************************************************************!*\
  !*** ./node_modules/vue-loader/lib/runtime/componentNormalizer.js ***!
  \********************************************************************/
/*! exports provided: default */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/vue-loader/lib/runtime/componentNormalizer.js'");

/***/ }),

/***/ "./node_modules/vue/dist/vue.common.js":
/*!*********************************************!*\
  !*** ./node_modules/vue/dist/vue.common.js ***!
  \*********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed: Error: ENOENT: no such file or directory, open '/work/node_modules/vue/dist/vue.common.js'");

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _barcode_bookInfo__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./barcode_bookInfo */ "./resources/js/barcode_bookInfo.js");
/* harmony import */ var _barcode_bookInfo__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_barcode_bookInfo__WEBPACK_IMPORTED_MODULE_0__);
__webpack_require__(/*! ../js/bootstrap */ "./resources/js/bootstrap.js");
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


__webpack_require__(/*! ./bootstrap */ "./resources/js/bootstrap.js");

__webpack_require__(/*! ./barcode_bookInfo */ "./resources/js/barcode_bookInfo.js"); // import "./barcode_bookInfo"


window.Vue = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.common.js");
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', __webpack_require__(/*! ./components/ExampleComponent.vue */ "./resources/js/components/ExampleComponent.vue")["default"]);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var app = new Vue({
  el: '#app'
});


/***/ }),

/***/ "./resources/js/barcode_bookInfo.js":
/*!******************************************!*\
  !*** ./resources/js/barcode_bookInfo.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

//バーコードリーダー機能
Quagga.init({
  inputStream: {
    name: 'Live',
    type: 'LiveStream',
    target: document.querySelector('#interactive'),
    //埋め込んだdivのID
    constraints: {
      facingMode: 'environment'
    },
    area: {
      //必要ならバーコードの読み取り範囲を調整
      top: "0%",
      right: "0%",
      left: "0%",
      bottom: "0%"
    }
  },
  locator: {
    patchSize: 'medium',
    halfSample: true
  },
  numOfWorkers: 2,
  decoder: {
    readers: ['ean_reader'] //ISBNは基本的にこれ（他にも種類あり）

  },
  locate: true
}, function (err) {
  if (!err) {
    Quagga.start();
  }
}); //ISBN13桁コードのチェックデジット

var calc = function calc(isbn) {
  var arrIsbn = isbn.toString().split("").map(function (num) {
    return parseInt(num);
  });
  var remainder = 0;
  var checkDigit = arrIsbn.pop();
  arrIsbn.forEach(function (num, index) {
    remainder += num * (index % 2 === 0 ? 1 : 3);
  });
  remainder %= 10;
  remainder = remainder === 0 ? 0 : 10 - remainder;
  return checkDigit === remainder;
}; // codeが13桁のISBNだったら書籍情報とってきてビデオ表示なしにする


Quagga.onDetected(function (success) {
  var code = success.codeResult.code;
  if (calc(code)) // alert(code);
    if (code.slice(0, 3) == 978) {
      //isbnコード上3桁チェック
      rakuten_info(code); //楽天API

      Quagga.stop(); //ビデオ停止

      turn_off_video(); //ビデオ領域非表示
    }
}); //楽天API用の変数用意

var r_BookTitle;
var r_isbn13;
var r_BookAuthor;
var r_PublishedDate;
var r_BookDescription;
var r_reviewCount;
var r_reviewAverage;
var r_BookThumbnail;
var r_price;
var r_size;
var r_page;
var r_genre; //Char-paramのグローバル変数用意

var hp, ap, dp; //楽天のAPI叩いて情報取得

function rakuten_info(isbn) {
  var r_url = "https://app.rakuten.co.jp/services/api/BooksBook/Search/20170404?format=json&applicationId=1080706320822310184&isbn=" + isbn;
  $.getJSON(r_url, function (data) {
    //変数用意
    r_BookTitle = data.Items[0].Item.title;
    r_isbn13 = data.Items[0].Item.isbn;
    r_BookAuthor = data.Items[0].Item.author;
    r_PublishedDate = data.Items[0].Item.salesDate;
    r_BookDescription = data.Items[0].Item.itemCaption;
    r_reviewCount = data.Items[0].Item.reviewCount;
    r_reviewAverage = data.Items[0].Item.reviewAverage;
    r_BookThumbnail = '<img src=\"' + data.Items[0].Item.largeImageUrl + '\" />';
    r_price = data.Items[0].Item.itemPrice;
    r_size = data.Items[0].Item.size;
    r_page = data.Items[0].Item.reviewAverage;
    r_genre = data.Items[0].Item.booksGenreId.slice(3, 6); //データあるか確認

    if (!data.Items) {
      $("#r_isbn13").val("");
      $("#r_BookTitle").text("");
      $("#r_BookAuthor").text("");
      $("#r_PublishedDate").text("");
      $("#r_BookThumbnail").text("");
      $("#r_BookDescription").text("");
      $("#message").html('<p class="bg-warning" id="warning">該当する書籍がありません。</p>');
      $('#message > p').fadeOut(3000);
    } else {
      // 該当書籍が存在した場合、JSONから値を取得して入力項目のデータを取得し入力
      $("#r_BookTitle").text(r_BookTitle);
      $("#r_isbn13").text(r_isbn13);
      $("#r_BookAuthor").text(r_BookAuthor);
      $("#r_PublishedDate").text(r_PublishedDate);
      $("#r_BookDescription").text(r_BookDescription);
      $("#r_reviewCount").text(r_reviewCount);
      $("#r_reviewAverage").text(r_reviewAverage);
      $("#r_BookThumbnail").html(r_BookThumbnail);
      $("#r_price").text(r_price);
      $("#r_size").text(r_size);
      $("#r_page").text(r_page);
      $("#r_genre").text(r_genre);
    } //パラメータ計算


    calc_param();
  });
} //ビデオ表示オフ


function turn_off_video() {
  // 「id="jQueryBox"」を非表示
  $("#interactive").css("display", "none");
} //パラメータ計算


function calc_param() {
  //パラメータ計算の前準備
  var date = r_PublishedDate.replace(/年/g, '').replace(/月/g, '').slice(0, 6); //出版日の整形

  if (r_reviewAverage < 2) {
    r_reviewAverage = 2;
  }

  ; //レビュー評価の調整

  var genre = r_genre.slice(3, 6); //ジャンル取得 (3桁取得 上3桁除く)
  //概要の文字数取得、文字数でボーナス倍数を決定

  var length = r_BookDescription.length;
  var bonus = 1;

  if (length < 50) {
    bonus = 1.2;
  } else if (50 <= length && length < 300) {
    bonus = 1.5;
  } else {
    bonus = 2;
  } //パラメータ計算


  hp = Math.round(1500 * date / 100000);
  ap = Math.round(180 * date / 100000 + r_price / 10);
  dp = 100 * r_reviewAverage; //ボーナス倍数を積算

  var month = date.slice(-2); //出版月取得

  if (month == "07" || month == "11") {
    ap = Math.round(ap * bonus);
  }

  ; //攻撃力アップ

  if (month == "01" || month == "04") {
    dp = Math.round(dp * bonus);
  }

  ; //防御力アップ
  //キャラパラメーター表示

  show_char_data(hp, ap, dp, r_BookThumbnail);
} //キャラパラメーター表示（更新予定）


function show_char_data(hp, ap, dp, r_BookThumbnail) {
  $("#name").text("テスト");
  $("#hp").text(hp);
  $("#ap").text(ap);
  $("#dp").text(dp);
  $("#lv").text("01");
  $("#r_BookThumbnail").html(r_BookThumbnail);
} //テーブル挿入php用 axios通信


function post_param(hp, ap, dp) {
  //アニメーション挿入部
  //Ajax開始
  $.ajax({
    url: '/api/character',
    type: 'POST',
    dataType: 'json',
    data: {
      name: 'ブックン',
      hp: hp,
      ap: ap,
      dp: dp
    }
  }).then(function (data) {//成功->表示処理を書く
  }, function () {
    //失敗
    alert("呼び出し失敗");
  });
} //改良必要：
//apiデータなかった場合、ビデオ再表示・Guagga再起動
//読み込み部分のサイズ変更とマスキング
//メモ：
//-char-tableのcolumn
//id,uid,name(name合成API),hp,ap,dp,exp(初期値0),lv(初期値1),thumnailURL,pictoURL(合成),size

/***/ }),

/***/ "./resources/js/bootstrap.js":
/*!***********************************!*\
  !*** ./resources/js/bootstrap.js ***!
  \***********************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
!(function webpackMissingModule() { var e = new Error("Cannot find module 'laravel-echo'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());
window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.Popper = __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js")["default"];
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js");

  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js");
} catch (e) {}
/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */
// window.axios = require('axios');


window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


window.Pusher = __webpack_require__(!(function webpackMissingModule() { var e = new Error("Cannot find module 'pusher-js'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));
window.Echo = new !(function webpackMissingModule() { var e = new Error("Cannot find module 'laravel-echo'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())({
  broadcaster: 'pusher',
  key: "",
  cluster: "mt1",
  forceTLS: false
});
window.Echo.channel('battle').listen('Battle', function (data) {// console.log('received a message:');
  // console.log(data);
});

/***/ }),

/***/ "./resources/js/components/ExampleComponent.vue":
/*!******************************************************!*\
  !*** ./resources/js/components/ExampleComponent.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./ExampleComponent.vue?vue&type=template&id=299e239e& */ "./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e&");
/* harmony import */ var _ExampleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./ExampleComponent.vue?vue&type=script&lang=js& */ "./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _ExampleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/ExampleComponent.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ExampleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./ExampleComponent.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ExampleComponent.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_ExampleComponent_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e&":
/*!*************************************************************************************!*\
  !*** ./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e& ***!
  \*************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./ExampleComponent.vue?vue&type=template&id=299e239e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/ExampleComponent.vue?vue&type=template&id=299e239e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_ExampleComponent_vue_vue_type_template_id_299e239e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

throw new Error("Module build failed (from ./node_modules/css-loader/index.js):\nModuleBuildError: Module build failed (from ./node_modules/sass-loader/dist/cjs.js):\nSassError: Can't find stylesheet to import.\n  ╷\n8 │ @import '~bootstrap/scss/bootstrap';\n  │         ^^^^^^^^^^^^^^^^^^^^^^^^^^^\n  ╵\n  /work/resources/sass/app.scss 8:9  root stylesheet\n    at runLoaders (/work/node_modules/webpack/lib/NormalModule.js:316:20)\n    at /work/node_modules/loader-runner/lib/LoaderRunner.js:367:11\n    at /work/node_modules/loader-runner/lib/LoaderRunner.js:233:18\n    at context.callback (/work/node_modules/loader-runner/lib/LoaderRunner.js:111:13)\n    at render (/work/node_modules/sass-loader/dist/index.js:73:7)\n    at Function.call$2 (/work/node_modules/sass/sass.dart.js:90633:16)\n    at _render_closure1.call$2 (/work/node_modules/sass/sass.dart.js:79699:12)\n    at _RootZone.runBinary$3$3 (/work/node_modules/sass/sass.dart.js:27088:18)\n    at _FutureListener.handleError$1 (/work/node_modules/sass/sass.dart.js:25616:19)\n    at _Future__propagateToListeners_handleError.call$0 (/work/node_modules/sass/sass.dart.js:25913:49)\n    at Object._Future__propagateToListeners (/work/node_modules/sass/sass.dart.js:4539:77)\n    at _Future._completeError$2 (/work/node_modules/sass/sass.dart.js:25746:9)\n    at _AsyncAwaitCompleter.completeError$2 (/work/node_modules/sass/sass.dart.js:25089:12)\n    at Object._asyncRethrow (/work/node_modules/sass/sass.dart.js:4288:17)\n    at /work/node_modules/sass/sass.dart.js:13180:20\n    at _wrapJsFunctionForAsync_closure.$protected (/work/node_modules/sass/sass.dart.js:4313:15)\n    at _wrapJsFunctionForAsync_closure.call$2 (/work/node_modules/sass/sass.dart.js:25110:12)\n    at _awaitOnObject_closure0.call$2 (/work/node_modules/sass/sass.dart.js:25102:25)\n    at _RootZone.runBinary$3$3 (/work/node_modules/sass/sass.dart.js:27088:18)\n    at _FutureListener.handleError$1 (/work/node_modules/sass/sass.dart.js:25616:19)\n    at _Future__propagateToListeners_handleError.call$0 (/work/node_modules/sass/sass.dart.js:25913:49)\n    at Object._Future__propagateToListeners (/work/node_modules/sass/sass.dart.js:4539:77)\n    at _Future._completeError$2 (/work/node_modules/sass/sass.dart.js:25746:9)\n    at _AsyncAwaitCompleter.completeError$2 (/work/node_modules/sass/sass.dart.js:25089:12)\n    at Object._asyncRethrow (/work/node_modules/sass/sass.dart.js:4288:17)\n    at /work/node_modules/sass/sass.dart.js:17935:20\n    at _wrapJsFunctionForAsync_closure.$protected (/work/node_modules/sass/sass.dart.js:4313:15)\n    at _wrapJsFunctionForAsync_closure.call$2 (/work/node_modules/sass/sass.dart.js:25110:12)\n    at _awaitOnObject_closure0.call$2 (/work/node_modules/sass/sass.dart.js:25102:25)\n    at _RootZone.runBinary$3$3 (/work/node_modules/sass/sass.dart.js:27088:18)\n    at _FutureListener.handleError$1 (/work/node_modules/sass/sass.dart.js:25616:19)\n    at _Future__propagateToListeners_handleError.call$0 (/work/node_modules/sass/sass.dart.js:25913:49)\n    at Object._Future__propagateToListeners (/work/node_modules/sass/sass.dart.js:4539:77)\n    at _Future._completeError$2 (/work/node_modules/sass/sass.dart.js:25746:9)\n    at _AsyncAwaitCompleter.completeError$2 (/work/node_modules/sass/sass.dart.js:25089:12)\n    at Object._asyncRethrow (/work/node_modules/sass/sass.dart.js:4288:17)");

/***/ }),

/***/ 0:
/*!*************************************************************!*\
  !*** multi ./resources/js/app.js ./resources/sass/app.scss ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /work/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /work/resources/sass/app.scss */"./resources/sass/app.scss");


/***/ })

/******/ });