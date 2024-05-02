import { _ as __nuxt_component_0 } from './nuxt-link-BSFgMzag.mjs';
import { u as useRoute } from './server.mjs';
import { defineComponent, computed, ref, watch, withAsyncContext, watchEffect, unref, mergeProps, withCtx, createTextVNode, useSSRContext } from 'vue';
import { u as useFetch } from './fetch-DXIPJ5Pn.mjs';
import { ssrRenderAttrs, ssrRenderAttr, ssrIncludeBooleanAttr, ssrLooseContain, ssrLooseEqual, ssrRenderList, ssrInterpolate, ssrRenderComponent } from 'vue/server-renderer';
import { _ as _sfc_main$1 } from './ProductCard-CChL2E-V.mjs';
import { useRouter } from 'vue-router';
import { u as useHead } from './index-BabADJUJ.mjs';
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
import 'vue3-toastify';

const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "[[page]]",
  __ssrInlineRender: true,
  async setup(__props) {
    let __temp, __restore;
    const router = useRouter();
    const route = useRoute();
    const page = computed(
      () => route.params.page ? parseInt(route.params.page) : 1
    );
    const category = computed(() => route.query.category);
    const selectedCategory = ref(category.value);
    watch(selectedCategory, () => {
      router.push(createCatalogueRoute(page.value, selectedCategory.value));
    });
    const createCatalogueRoute = (page2, category2) => {
      let route2 = `/catalogue/${page2}`;
      if (category2)
        route2 += `?category=${encodeURIComponent(category2)}`;
      return route2;
    };
    const url = computed(
      () => createCatalogueRoute(page.value, selectedCategory.value)
    );
    const { data } = ([__temp, __restore] = withAsyncContext(() => useFetch(() => url.value, {
      baseURL: "https://thesis-project.local.io/api/json"
    }, "$gjQLFdl3it")), __temp = await __temp, __restore(), __temp);
    watchEffect(() => {
      if (!data.value)
        return;
      if ("redirect" in data.value) {
        return router.replace(
          createCatalogueRoute(
            data.value.redirect.page,
            data.value.redirect.category
          )
        );
      }
      useHead({
        title: data.value.metadata.title,
        meta: [
          { name: "description", content: data.value.metadata.metaDescription },
          { name: "keywords", content: data.value.metadata.metaKeywords }
        ]
      });
      selectedCategory.value = data.value.selectedCategory;
    });
    return (_ctx, _push, _parent, _attrs) => {
      const _component_NuxtLink = __nuxt_component_0;
      if (unref(data) && !("redirect" in unref(data))) {
        _push(`<div${ssrRenderAttrs(mergeProps({ class: "container mx-auto px-4 py-8" }, _attrs))}><div class="-mx-4 flex flex-wrap"><div class="mb-4 md:mb-0 md:w-1/4 px-4 w-full"><div class="bg-white p-3 rounded-lg shadow-lg"><h3 class="font-bold mb-4 text-xl">Filtri</h3><form><label class="block font-bold mb-2 text-gray-700 text-sm" for="categoryFilter"> Kategorija </label><select id="categoryFilter" class="appearance-none bg-gray-200 block border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none leading-tight pr-8 px-4 py-3 rounded text-gray-700 w-full"><option${ssrRenderAttr("value", null)}${ssrIncludeBooleanAttr(Array.isArray(selectedCategory.value) ? ssrLooseContain(selectedCategory.value, null) : ssrLooseEqual(selectedCategory.value, null)) ? " selected" : ""}>Visas kategorijas</option><!--[-->`);
        ssrRenderList(unref(data).categories, (cat) => {
          _push(`<option${ssrRenderAttr("value", cat.name)}>${ssrInterpolate(cat.name)}</option>`);
        });
        _push(`<!--]--></select></form></div></div><div class="md:w-3/4 px-4 w-full"><div><div class="flex gap-4 justify-center mb-4">`);
        if (unref(data).prevPageData) {
          _push(ssrRenderComponent(_component_NuxtLink, {
            class: "bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase",
            to: createCatalogueRoute(
              unref(data).prevPageData.page,
              unref(data).prevPageData.category
            )
          }, {
            default: withCtx((_, _push2, _parent2, _scopeId) => {
              if (_push2) {
                _push2(` Iepriek\u0161\u0113j\u0101 lapa `);
              } else {
                return [
                  createTextVNode(" Iepriek\u0161\u0113j\u0101 lapa ")
                ];
              }
            }),
            _: 1
          }, _parent));
        } else {
          _push(`<!---->`);
        }
        _push(`<span class="bg-gray-100 flex h-10 items-center justify-center rounded-full w-10">${ssrInterpolate(unref(data).page)}</span>`);
        if (unref(data).nextPageData) {
          _push(ssrRenderComponent(_component_NuxtLink, {
            class: "bg-gray-500 hover:bg-gray-600 px-5 py-2 text-sm text-white uppercase",
            to: createCatalogueRoute(
              unref(data).nextPageData.page,
              unref(data).nextPageData.category
            )
          }, {
            default: withCtx((_, _push2, _parent2, _scopeId) => {
              if (_push2) {
                _push2(` N\u0101kam\u0101 lapa `);
              } else {
                return [
                  createTextVNode(" N\u0101kam\u0101 lapa ")
                ];
              }
            }),
            _: 1
          }, _parent));
        } else {
          _push(`<!---->`);
        }
        _push(`</div></div><div class="gap-6 grid grid-cols-1 lg:grid-cols-3 sm:grid-cols-2"><!--[-->`);
        ssrRenderList(unref(data).products, (product) => {
          _push(ssrRenderComponent(_sfc_main$1, {
            key: product.id,
            product
          }, null, _parent));
        });
        _push(`<!--]--></div></div></div></div>`);
      } else {
        _push(`<!---->`);
      }
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("pages/catalogue/[[page]].vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as default };
//# sourceMappingURL=_page_-CcrnE_oA.mjs.map
