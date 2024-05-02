import { _ as __nuxt_component_0$1 } from './nuxt-link-BSFgMzag.mjs';
import { useSSRContext, defineComponent, mergeProps, unref, withCtx, createTextVNode } from 'vue';
import { ssrRenderAttrs, ssrInterpolate, ssrRenderComponent, ssrRenderSlot } from 'vue/server-renderer';
import { _ as _export_sfc } from './_plugin-vue_export-helper-1tPrXgE0.mjs';
import '../runtime.mjs';
import 'node:http';
import 'node:https';
import 'fs';
import 'path';
import 'node:fs';
import 'node:url';
import './server.mjs';
import '../routes/renderer.mjs';
import 'vue-bundle-renderer/runtime';
import 'devalue';
import '@unhead/ssr';
import 'unhead';
import '@unhead/shared';
import 'vue-router';

const _sfc_main$2 = {};
function _sfc_ssrRender$1(_ctx, _push, _parent, _attrs) {
  const _component_NuxtLink = __nuxt_component_0$1;
  _push(`<header${ssrRenderAttrs(mergeProps({ class: "container" }, _attrs))}><nav class="bg-purple-700 flex items-center justify-between p-4 shadow-md text-white">`);
  _push(ssrRenderComponent(_component_NuxtLink, {
    class: "font-bold text-2xl",
    to: { name: "index" }
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`Ap\u0123\u0113rbi.lv`);
      } else {
        return [
          createTextVNode("Ap\u0123\u0113rbi.lv")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`<ul class="flex flex-wrap gap-4"><li>`);
  _push(ssrRenderComponent(_component_NuxtLink, {
    class: "hover:text-lime-200 hover:underline text-white",
    to: { name: "index" }
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`S\u0101kums`);
      } else {
        return [
          createTextVNode("S\u0101kums")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li><li>`);
  _push(ssrRenderComponent(_component_NuxtLink, {
    class: "hover:text-lime-200 hover:underline text-white",
    to: "/catalogue"
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(` Katalogs `);
      } else {
        return [
          createTextVNode(" Katalogs ")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li><li>`);
  _push(ssrRenderComponent(_component_NuxtLink, {
    class: "hover:text-lime-200 hover:underline text-white",
    to: { name: "cart" }
  }, {
    default: withCtx((_, _push2, _parent2, _scopeId) => {
      if (_push2) {
        _push2(`Grozs`);
      } else {
        return [
          createTextVNode("Grozs")
        ];
      }
    }),
    _: 1
  }, _parent));
  _push(`</li></ul></nav></header>`);
}
const _sfc_setup$2 = _sfc_main$2.setup;
_sfc_main$2.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("components/PageHeader.vue");
  return _sfc_setup$2 ? _sfc_setup$2(props, ctx) : void 0;
};
const __nuxt_component_0 = /* @__PURE__ */ _export_sfc(_sfc_main$2, [["ssrRender", _sfc_ssrRender$1]]);
const _sfc_main$1 = /* @__PURE__ */ defineComponent({
  __name: "PageFooter",
  __ssrInlineRender: true,
  setup(__props) {
    const currentYear = (/* @__PURE__ */ new Date()).getFullYear();
    return (_ctx, _push, _parent, _attrs) => {
      _push(`<footer${ssrRenderAttrs(mergeProps({ class: "bg-white container text-sm" }, _attrs))}><div class="bg-purple-700 flex gap-4 justify-between p-4 text-white"><div>\xA9 ${ssrInterpolate(unref(currentYear))} Ap\u0123\u0113rbi.lv</div></div><div class="bg-black border-slate-200 flex justify-between px-2 py-1 text-[10px] text-white"><div> Made with \u2764\uFE0F by <a class="hover:underline text-orange-300" href="https://github.com/Amixx" target="_blank">https://github.com/Amixx</a></div><div> Images by <a class="hover:underline text-orange-300" href="https://www.freepik.com/free-photo/sweet-pastry-assortment-top-view_7781342.htm#query=bakery&amp;position=2&amp;from_view=keyword&amp;track=sph&amp;uuid=4f2eded4-37c1-41cf-9fcf-80f3c7ad0459" target="_blank"> Freepik </a></div></div></footer>`);
    };
  }
});
const _sfc_setup$1 = _sfc_main$1.setup;
_sfc_main$1.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("components/PageFooter.vue");
  return _sfc_setup$1 ? _sfc_setup$1(props, ctx) : void 0;
};
const _sfc_main = {};
function _sfc_ssrRender(_ctx, _push, _parent, _attrs) {
  const _component_PageHeader = __nuxt_component_0;
  const _component_PageFooter = _sfc_main$1;
  _push(`<div${ssrRenderAttrs(mergeProps({ class: "bg-slate-100 flex flex-col items-center justify-center m-auto max-w-screen-2xl" }, _attrs))}>`);
  _push(ssrRenderComponent(_component_PageHeader, null, null, _parent));
  _push(`<main class="bg-white container min-h-[calc(100vh-64px)]">`);
  ssrRenderSlot(_ctx.$slots, "default", {}, null, _push, _parent);
  _push(`</main>`);
  _push(ssrRenderComponent(_component_PageFooter, null, null, _parent));
  _push(`</div>`);
}
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("layouts/default.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};
const _default = /* @__PURE__ */ _export_sfc(_sfc_main, [["ssrRender", _sfc_ssrRender]]);

export { _default as default };
//# sourceMappingURL=default-Cm18CAYT.mjs.map
