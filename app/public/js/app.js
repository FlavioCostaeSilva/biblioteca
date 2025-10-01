/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

window.currencies = [];
$(document).ready(function () {
  $(document).on('click', '#convert', function (e) {
    e.preventDefault();
    convert();
  });
  var confMaskMoney = {
    prefix: 'R$ ',
    showSymbol: true,
    symbol: "R$",
    decimal: ",",
    thousands: ".",
    allowZero: true
  };
  $("#value").maskMoney(confMaskMoney);
  loadCurrencies();
  loadLastQuotations();
});

function convert() {
  var currency_index = $("#currency_selector");
  var value = $("#value");
  var form_of_payment = $("#form_of_payment").val();
  var currency = parseInt((value.maskMoney('unmasked')[0] * 100).toString());
  var data = '{}';
  data = JSON.parse(data);
  data.pair = window.currencies[currency_index.val()].currency_one.code + '-' + window.currencies[currency_index.val()].currency_two.code;
  data.value = currency;
  data.form_of_payment = form_of_payment;
  $.ajax({
    url: '/quote',
    method: 'POST',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: JSON.stringify(data),
    contentType: "application/json; charset=utf-8",
    processData: false,
    success: function success(data) {
      processResponse(data.data, '#result');
      value.val('R$ 0,00');
      loadLastQuotations();
    },
    error: function error(_error) {
      alert(_error.responseJSON.message);
    }
  });
}

function processResponse(data, attr) {
  var htmlOrAppend = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'html';
  var html = '<div class="quotation_result"><strong>Valor para conversão:</strong> ' + formatMoney(data, data.code_in, 'code_in_value_to_convert') + '<br>\n' + '<strong>Forma de pagamento:</strong> ' + formatFormOfPayment(data.form_of_payment) + '<br>\n' + '<strong>Valor da "Moeda de destino" usado para conversão (' + data.code + '):</strong> ' + formatMoney(data, data.code, 'code_currency_value') + '<br>\n' + '<strong>Valor comprado em "Moeda de destino (' + data.code + ')":</strong> ' + formatMoney(data, data.code, 'code_in_currency_purchased') + ' (Taxas aplicadas no valor de compra)<br>\n' + '<strong>Taxa de pagamento:</strong> ' + formatMoney(data, data.code_in, 'tax_payment') + '<br>\n' + '<strong>Taxa de conversão:</strong> ' + formatMoney(data, data.code_in, 'tax_conv') + '<br>\n' + '<strong>Valor utilizado para conversão descontando as taxas:</strong> ' + formatMoney(data, data.code_in, 'value_code_tax_deducted') + '<br>\n' + '<strong>Data de processamento:</strong> ' + new Date(data.created_at).toLocaleString('pt-BR') + '</div>';

  if (htmlOrAppend === 'html') {
    $(attr).html(html);
    return;
  }

  $(attr).append(html);
}

function formatMoney(data, code_selected, attr) {
  var currency_index = $("#currency_selector");
  var code = window.currencies[currency_index.val()].currency_one.code;
  var code_iso_lang = window.currencies[currency_index.val()].currency_one.code_iso_lang;

  if (code_selected !== code) {
    code_iso_lang = 'pt_BR';
  }

  var currency = Intl.NumberFormat(code_iso_lang.replace('_', '-'), {
    style: "currency",
    currency: code_selected,
    minimumFractionDigits: 2
  });
  return currency.format(data[attr]);
}

function formatFormOfPayment(form) {
  if (form === 'CREDIT_CARD') {
    return 'Cartão de crédito';
  }

  return 'Boleto';
}

function loadCurrencies() {
  $.ajax({
    url: '/get_pairs',
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      try {
        window.currencies = data.data;

        for (var index = 0; index <= data.data.length; index++) {
          $('#currency_selector').append('<option value="' + index + '">' + data.data[index].currency_one.code_name + '</option>');
        }
      } catch (e) {}
    },
    error: function error() {}
  });
}

function loadLastQuotations() {
  $.ajax({
    url: '/get_last_quotations',
    method: 'GET',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(data) {
      try {
        eraseQuotations('#last_quotations');

        for (var index = 0; index <= data.data.length; index++) {
          processResponse(data.data[index], '#last_quotations', 'append');
        }
      } catch (e) {}
    },
    error: function error() {}
  });
}

function eraseQuotations(attr) {
  $(attr).html('');
}

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;