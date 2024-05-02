import { _ as __nuxt_component_0 } from './nuxt-link-BSFgMzag.mjs';
import { _ as _sfc_main$1 } from './ProductCard-CChL2E-V.mjs';
import { u as useFetch } from './fetch-DXIPJ5Pn.mjs';
import { defineComponent, withAsyncContext, watchEffect, unref, mergeProps, withCtx, createTextVNode, useSSRContext } from 'vue';
import { u as useHead } from './index-BabADJUJ.mjs';
import { ssrRenderAttrs, ssrRenderAttr, ssrRenderComponent, ssrRenderList } from 'vue/server-renderer';
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
import 'vue3-toastify';

const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "index",
  __ssrInlineRender: true,
  async setup(__props) {
    let __temp, __restore;
    const { data } = ([__temp, __restore] = withAsyncContext(() => useFetch("/home", {
      baseURL: "https://thesis-project.local.io/api/json"
    }, "$pqtWcjQkdb")), __temp = await __temp, __restore(), __temp);
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
      const _component_NuxtLink = __nuxt_component_0;
      const _component_ProductCard = _sfc_main$1;
      if (unref(data)) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "pb-16" }, _attrs))}><div class="relative"><img alt="Banner" class="h-[450px] object-cover sm:h-96 w-full"${ssrRenderAttr("src", unref(data).images.mob)}${ssrRenderAttr("srcset", `${unref(data).images.mob} 360w, ${unref(data).images.desk}`)}><div class="absolute bg-black bg-opacity-50 bottom-0 flex items-center justify-center left-0 right-0 top-0"><div class="text-center"><h1 class="font-bold mb-4 sm:text-4xl text-white text-xl"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h1><div class="flex"><div class="max-w-md mb-6 mx-auto sm:text-lg text-white"><p class="mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi atque autem blanditiis ducimus eligendi id numquam tempora! Aperiam, distinctio, velit. Architecto atque delectus error magni odit quae, ratione sunt voluptatibus! </p>`);
        _push(ssrRenderComponent(_component_NuxtLink, {
          class: "bg-white font-semibold hover:bg-gray-200 px-8 py-3 rounded text-black text-sm",
          to: "/catalogue"
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(` Apskat\u012Bt `);
            } else {
              return [
                createTextVNode(" Apskat\u012Bt ")
              ];
            }
          }),
          _: 1
        }, _parent));
        _push(`</div><div class="max-w-md mb-6 mx-auto sm:text-lg text-white"><p class="mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium amet doloribus, facilis iusto laborum, laudantium maiores necessitatibus, nesciunt numquam possimus quasi recusandae rerum totam vero. </p>`);
        _push(ssrRenderComponent(_component_NuxtLink, {
          class: "bg-white font-semibold hover:bg-gray-200 px-8 py-3 rounded text-black text-sm",
          to: "/catalogue"
        }, {
          default: withCtx((_, _push2, _parent2, _scopeId) => {
            if (_push2) {
              _push2(` Apskat\u012Bt `);
            } else {
              return [
                createTextVNode(" Apskat\u012Bt ")
              ];
            }
          }),
          _: 1
        }, _parent));
        _push(`</div></div></div></div></div><div class="mt-16 text-center"><h2 class="font-bold mb-4 text-3xl">Jaun\u0101kie produkti</h2><div class="flex flex-wrap gap-4 justify-center"><!--[-->`);
        ssrRenderList(unref(data).newProducts, (product) => {
          _push(ssrRenderComponent(_component_ProductCard, {
            key: product.id,
            product
          }, null, _parent));
        });
        _push(`<!--]--></div></div><div class="mt-16 text-center"><h2 class="font-bold mb-4 text-3xl">Popul\u0101r\u0101kie produkti</h2><div class="flex flex-wrap gap-4 justify-center"><!--[-->`);
        ssrRenderList(unref(data).popularProducts, (product) => {
          _push(ssrRenderComponent(_component_ProductCard, {
            key: product.id,
            product
          }, null, _parent));
        });
        _push(`<!--]--></div></div><div class="mt-16 text-center"><h2 class="font-bold mb-4 text-3xl">Produkti ar atlaid\u0113m</h2><div class="flex flex-wrap gap-4 justify-center"><!--[-->`);
        ssrRenderList(unref(data).productsWithDiscounts, (product) => {
          _push(ssrRenderComponent(_component_ProductCard, {
            key: product.id,
            product
          }, null, _parent));
        });
        _push(`<!--]--></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("pages/index.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as default };
//# sourceMappingURL=index-C4KcTQ3D.mjs.map
