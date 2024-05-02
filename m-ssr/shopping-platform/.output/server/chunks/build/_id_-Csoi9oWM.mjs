import { u as useRoute } from './server.mjs';
import { defineComponent, computed, withAsyncContext, watch, unref, mergeProps, useSSRContext } from 'vue';
import { u as useFetch } from './fetch-DXIPJ5Pn.mjs';
import { ssrRenderAttrs, ssrRenderAttr, ssrRenderList, ssrInterpolate } from 'vue/server-renderer';
import '../runtime.mjs';
import 'node:http';
import 'node:https';
import 'fs';
import 'path';
import 'node:fs';
import 'node:url';
import '../routes/renderer.mjs';
import 'vue-bundle-renderer/runtime';
import 'devalue';
import '@unhead/ssr';
import 'unhead';
import '@unhead/shared';
import 'vue-router';

const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "[id]",
  __ssrInlineRender: true,
  async setup(__props) {
    let __temp, __restore;
    const route = useRoute();
    const id = computed(() => parseInt(route.params.id));
    const { data, refresh } = ([__temp, __restore] = withAsyncContext(() => useFetch(
      () => `/product/${id.value}`,
      { baseURL: "https://thesis-project.local.io/api/json" },
      "$ZzklkSM8mV"
    )), __temp = await __temp, __restore(), __temp);
    watch(id, () => refresh());
    return (_ctx, _push, _parent, _attrs) => {
      if (unref(data)) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto px-4 py-12" }, _attrs))}><div class="gap-12 grid grid-cols-1 md:grid-cols-2"><div class="flex flex-col space-y-4"><img${ssrRenderAttr("alt", unref(data).product.title)} class="h-96 object-cover rounded-lg shadow-lg w-full"${ssrRenderAttr("src", unref(data).product.images[0])}><div class="flex hide-scroll-bar overflow-x-scroll"><div class="flex flex-nowrap"><!--[-->`);
        ssrRenderList(unref(data).product.images, (image) => {
          _push(`<img${ssrRenderAttr("alt", `${unref(data).product.title} image`)} class="h-24 inline-block mr-2 rounded-lg shadow"${ssrRenderAttr("src", image)}>`);
        });
        _push(`<!--]--></div></div></div><div><h1 class="font-bold text-3xl">${ssrInterpolate(unref(data).product.title)}</h1>`);
        if (unref(data).product.category) {
          _push(`<span class="font-semibold text-gray-500 text-sm">${ssrInterpolate(unref(data).product.category.name)}</span>`);
        } else {
          _push(`<!---->`);
        }
        _push(`<div class="mt-4"><span class="font-semibold text-2xl text-gray-800">$${ssrInterpolate(unref(data).product.priceWithDiscount.toFixed(2))}</span>`);
        if (unref(data).product.discount) {
          _push(`<span class="line-through ml-2 text-gray-500">$${ssrInterpolate(unref(data).product.price)}</span>`);
        } else {
          _push(`<!---->`);
        }
        _push(`</div><p class="mt-4 text-gray-700">${ssrInterpolate(unref(data).product.description)}</p><div class="mt-4"><span class="font-semibold text-gray-700">Popularit\u0101te: ${ssrInterpolate(unref(data).product.popularity)}</span></div><button class="bg-purple-500 duration-300 hover:bg-purple-600 mt-6 px-6 py-2 rounded text-white transition"> Ielikt groz\u0101 </button><p class="mt-4 text-gray-400 text-xs"> Pievienots ${ssrInterpolate(new Date(unref(data).product.createdAt).toLocaleDateString("en-US", {
          month: "long",
          day: "numeric",
          year: "numeric"
        }))}</p></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("pages/product/[id].vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as default };
//# sourceMappingURL=_id_-Csoi9oWM.mjs.map
