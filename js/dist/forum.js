module.exports=function(e){var o={};function t(n){if(o[n])return o[n].exports;var r=o[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,t),r.l=!0,r.exports}return t.m=e,t.c=o,t.d=function(e,o,n){t.o(e,o)||Object.defineProperty(e,o,{enumerable:!0,get:n})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,o){if(1&o&&(e=t(e)),8&o)return e;if(4&o&&"object"==typeof e&&e&&e.__esModule)return e;var n=Object.create(null);if(t.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:e}),2&o&&"string"!=typeof e)for(var r in e)t.d(n,r,function(o){return e[o]}.bind(null,r));return n},t.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(o,"a",o),o},t.o=function(e,o){return Object.prototype.hasOwnProperty.call(e,o)},t.p="",t(t.s=4)}([function(e,o){e.exports=flarum.core.compat["forum/app"]},function(e,o){e.exports=flarum.core.compat["common/extend"]},function(e,o){e.exports=flarum.core.compat["forum/components/Post"]},,function(e,o,t){"use strict";t.r(o);var n=t(0),r=t.n(n),a=t(1),u=t(2),i=t.n(u);r.a.initializers.add("exercisebook-fof-upload-imagex",(function(){Object(a.extend)(i.a.prototype,"oncreate",(function(){var e=this;this.$("[data-fof-imagex-upload-download-uuid]").unbind("click").on("click",(function(o){if(o.preventDefault(),o.stopPropagation(),r.a.forum.attribute("fof-upload.canDownload")){var t=r.a.forum.attribute("apiUrl")+"/exercisebook/fof-imagex/download";t+="/"+encodeURIComponent(o.currentTarget.dataset.fofImagexUploadDownloadUuid),t+="/"+encodeURIComponent(e.attrs.post.id()),t+="/"+encodeURIComponent(r.a.session.csrfToken),window.open(t)}else alert(r.a.translator.trans("fof-upload.forum.states.unauthorized"))}))}))}))}]);
//# sourceMappingURL=forum.js.map