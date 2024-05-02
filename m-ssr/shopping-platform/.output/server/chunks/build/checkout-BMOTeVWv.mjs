import { u as useFetch } from './fetch-DXIPJ5Pn.mjs';
import { defineComponent, withAsyncContext, watchEffect, mergeProps, useSSRContext } from 'vue';
import { u as useHead } from './index-BabADJUJ.mjs';
import { ssrRenderAttrs, ssrRenderClass } from 'vue/server-renderer';
import { useRouter } from 'vue-router';
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

const inputClasses = "text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200 focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400";
const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "checkout",
  __ssrInlineRender: true,
  async setup(__props) {
    let __temp, __restore;
    useRouter();
    const { data } = ([__temp, __restore] = withAsyncContext(() => useFetch(() => `/checkout`, {
      baseURL: "https://thesis-project.local.io/api/json"
    }, "$zmC60BkTaq")), __temp = await __temp, __restore(), __temp);
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
      _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto" }, _attrs))}><div class="m-auto"><div class="bg-white mt-5 rounded-lg shadow"><div class="flex"><div class="flex-1 overflow-hidden pl-5 py-5"><svg class="align-text-top inline" fill="#000000" height="20.5" width="21" xmlns="http://www.w3.org/2000/svg"><g><path id="svg_1" d="m4.88889,2.07407l14.22222,0l0,20l-14.22222,0l0,-20z" fill="none" stroke="null"></path><path id="svg_2" d="m7.07935,0.05664c-3.87,0 -7,3.13 -7,7c0,5.25 7,13 7,13s7,-7.75 7,-13c0,-3.87 -3.13,-7 -7,-7zm-5,7c0,-2.76 2.24,-5 5,-5s5,2.24 5,5c0,2.88 -2.88,7.19 -5,9.88c-2.08,-2.67 -5,-7.03 -5,-9.88z"></path><circle id="svg_3" cx="7.04807" cy="6.97256" r="2.5"></circle></g></svg><h1 class="font-semibold inline leading-none text-2xl">Adrese</h1></div></div><div class="pb-5 px-5"><input class="${ssrRenderClass(inputClasses)}" placeholder="V\u0101rds, uzv\u0101rds"><input class="${ssrRenderClass(inputClasses)}" placeholder="Adrese"><div class="flex gap-2"><div class="flex-grow"><input class="${ssrRenderClass(inputClasses)}" placeholder="Pils\u0113ta"></div><div class="flex-grow w-1/4"><input class="${ssrRenderClass(inputClasses)}" placeholder="LV-..."></div></div></div></div></div><form class="flex flex-wrap gap-3 p-5 w-full"><label class="flex flex-col relative w-full"><span class="font-bold mb-3">Kartes numurs</span><input class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md" placeholder="0000 0000 0000 0000" type="text"></label><label class="flex flex-1 flex-col relative"><span class="font-bold mb-3">Kartes der\u012Bguma termi\u0146\u0161</span><input class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md" placeholder="MM/YY" type="text"></label><label class="flex flex-1 flex-col relative"><span class="font-bold mb-3">CVC/CVV</span><input class="border-2 border-gray-200 peer pl-12 placeholder-gray-300 pr-2 py-2 rounded-md" placeholder="\u2022\u2022\u2022" type="text"></label><button class="bg-purple-500 duration-300 ease-in-out font-bold hover:bg-purple-600 px-4 py-2 rounded text-white transform transition w-full" type="submit"> Apmaks\u0101t pas\u016Bt\u012Bjumu </button></form></div>`);
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("pages/checkout.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as default };
//# sourceMappingURL=checkout-BMOTeVWv.mjs.map
