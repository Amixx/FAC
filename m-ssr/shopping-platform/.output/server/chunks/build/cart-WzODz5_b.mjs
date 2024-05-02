import { u as useFetch } from './fetch-DXIPJ5Pn.mjs';
import { defineComponent, withAsyncContext, watchEffect, resolveComponent, unref, mergeProps, withCtx, createTextVNode, useSSRContext } from 'vue';
import { u as useHead } from './index-BabADJUJ.mjs';
import { ssrRenderAttrs, ssrInterpolate, ssrRenderList, ssrRenderAttr, ssrRenderComponent } from 'vue/server-renderer';
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

const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "cart",
  __ssrInlineRender: true,
  async setup(__props) {
    let __temp, __restore;
    const { data, refresh } = ([__temp, __restore] = withAsyncContext(() => useFetch("/cart", {
      baseURL: "https://thesis-project.local.io/api/json"
    }, "$tF04VGYwkR")), __temp = await __temp, __restore(), __temp);
    watchEffect(() => {
      if (!data.value)
        return;
      useHead({
        title: data.value.metadata.title,
        meta: [
          { name: "description", content: data.value.metadata.metaDescription },
          { name: "keywords", content: data.value.metadata.metaKeywords }
        ]
      });
    });
    return (_ctx, _push, _parent, _attrs) => {
      const _component_router_link = resolveComponent("router-link");
      if (unref(data)) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto" }, _attrs))}><div class="flex flex-wrap my-4 shadow-md"><div class="bg-white p-4 sm:p-10 sm:w-3/4"><div class="border-b flex justify-between pb-8"><h1 class="font-semibold text-2xl">Iepirkumu grozs</h1><h2 class="font-semibold text-2xl">${ssrInterpolate(unref(data).order.orderItems.length)} produkti </h2></div><div class="flex mb-5 mt-10"><h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5"> Produkts </h3><h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"> Skaits </h3><h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"> Cena </h3><h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"> Kop\u0101 </h3><h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5"> No\u0146emt </h3></div><!--[-->`);
        ssrRenderList(unref(data).order.orderItems, (item) => {
          _push(`<div class="-mx-8 flex hover:bg-gray-100 items-center px-2 py-1.5 sm:px-6 sm:py-5"><div class="flex w-2/5"><div class="hidden sm:block w-20"><img${ssrRenderAttr("alt", item.product.title)} class="h-24"${ssrRenderAttr("src", item.product.images[0])}></div><div class="flex flex-col flex-grow justify-between ml-4"><span class="font-bold text-sm">${ssrInterpolate(item.product.title)}</span><span class="text-gray-500 text-xs">${ssrInterpolate(item.product.category.name)}</span></div></div><div class="w-1/5"><input${ssrRenderAttr("value", item.amount)} class="mx-2 text-center w-8" min="1" type="number"><button class="hover:text-purple-500 text-gray-600 transform"> Saglab\u0101t </button></div><span class="font-semibold text-center text-sm w-1/5">$${ssrInterpolate(item.product.price)}</span><span class="font-semibold text-center text-sm w-1/5">$${ssrInterpolate((item.amount * parseFloat(item.product.price)).toFixed(2))}</span><button class="hover:scale-110 transform w-4"> \u274C </button></div>`);
        });
        _push(`<!--]--></div><div id="summary" class="px-8 py-10 sm:w-1/4"><h1 class="border-b font-semibold pb-8 text-2xl"> Pas\u016Bt\u012Bjuma p\u0101rskats </h1><div class="flex justify-between mb-5 mt-10"><span class="font-semibold text-sm uppercase">${ssrInterpolate(unref(data).order.orderItems.length)} produkti</span><span class="font-semibold text-sm">$${ssrInterpolate(unref(data).order.totalPrice.toFixed(2))}</span></div><div class="flex gap-2 py-10">`);
        _push(ssrRenderComponent(_component_router_link, {
          class: "bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase",
          to: "/catalogue"
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(` Turpin\u0101t iepirkties `);
            } else {
              return [
                createTextVNode(" Turpin\u0101t iepirkties ")
              ];
            }
          }),
          _: 1
        }, _parent));
        _push(ssrRenderComponent(_component_router_link, {
          class: "bg-purple-500 hover:bg-purple-600 px-5 py-2 text-sm text-white uppercase",
          to: { name: "checkout" }
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(` Apmaks\u0101t pas\u016Bt\u012Bjumu `);
            } else {
              return [
                createTextVNode(" Apmaks\u0101t pas\u016Bt\u012Bjumu ")
              ];
            }
          }),
          _: 1
        }, _parent));
        _push(`</div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("pages/cart.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as default };
//# sourceMappingURL=cart-WzODz5_b.mjs.map
