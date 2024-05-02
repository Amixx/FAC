import { _ as __nuxt_component_0 } from './nuxt-link-BSFgMzag.mjs';
import { defineComponent, ref, mergeProps, withCtx, createVNode, openBlock, createBlock, toDisplayString, createCommentVNode, createTextVNode, withModifiers, useSSRContext } from 'vue';
import { ssrRenderComponent, ssrRenderAttr, ssrInterpolate, ssrIncludeBooleanAttr } from 'vue/server-renderer';
import { toast } from 'vue3-toastify';

const _sfc_main = /* @__PURE__ */ defineComponent({
  __name: "ProductCard",
  __ssrInlineRender: true,
  props: {
    product: {}
  },
  setup(__props) {
    const addingToCart = ref(false);
    const addToCart = async (productId) => {
      try {
        await $fetch(`${"https://thesis-project.local.io/api/json"}/add-to-cart`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ productId })
        });
        toast.success("Produkts pievienots grozam!");
      } catch (e) {
        console.error(e);
      } finally {
        addingToCart.value = false;
      }
    };
    return (_ctx, _push, _parent, _attrs) => {
      const _component_NuxtLink = __nuxt_component_0;
      _push(ssrRenderComponent(_component_NuxtLink, mergeProps({
        class: "bg-white block max-w-sm overflow-hidden relative rounded shadow-lg",
        to: `/product/${_ctx.product.id}`
      }, _attrs), {
        default: withCtx((_, _push2, _parent2, _scopeId) => {
          if (_push2) {
            _push2(`<img${ssrRenderAttr("alt", _ctx.product.title)} class="h-48 object-cover w-full"${ssrRenderAttr("src", _ctx.product.images[0])}${_scopeId}>`);
            if (_ctx.product.category) {
              _push2(`<div class="absolute bg-purple-500 font-bold left-0 px-3 py-1 rounded-br-lg text-white text-xs top-0 uppercase"${_scopeId}>${ssrInterpolate(_ctx.product.category.name)}</div>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`<div class="px-6 py-4"${_scopeId}><div class="font-bold mb-2 text-xl"${_scopeId}>${ssrInterpolate(_ctx.product.title)}</div><p class="mb-4 text-base text-gray-700"${_scopeId}>${ssrInterpolate(_ctx.product.description.substring(0, 80))}... </p><div class="flex items-center justify-between"${_scopeId}><span class="font-bold text-lg"${_scopeId}> $${ssrInterpolate(_ctx.product.priceWithDiscount.toFixed(2))} `);
            if (parseFloat(_ctx.product.priceWithDiscount.toFixed(2)) !== parseFloat(_ctx.product.price)) {
              _push2(`<span class="line-through ml-2 text-gray-500 text-sm"${_scopeId}>$${ssrInterpolate(_ctx.product.price)}</span>`);
            } else {
              _push2(`<!---->`);
            }
            _push2(`</span><button class="bg-purple-500 duration-300 ease-in-out font-bold hover:-translate-y-1 hover:bg-purple-700 px-4 py-2 rounded text-white transform transition"${ssrIncludeBooleanAttr(addingToCart.value) ? " disabled" : ""}${_scopeId}> Ielikt groz\u0101 </button></div></div>`);
          } else {
            return [
              createVNode("img", {
                alt: _ctx.product.title,
                class: "h-48 object-cover w-full",
                src: _ctx.product.images[0]
              }, null, 8, ["alt", "src"]),
              _ctx.product.category ? (openBlock(), createBlock("div", {
                key: 0,
                class: "absolute bg-purple-500 font-bold left-0 px-3 py-1 rounded-br-lg text-white text-xs top-0 uppercase"
              }, toDisplayString(_ctx.product.category.name), 1)) : createCommentVNode("", true),
              createVNode("div", { class: "px-6 py-4" }, [
                createVNode("div", { class: "font-bold mb-2 text-xl" }, toDisplayString(_ctx.product.title), 1),
                createVNode("p", { class: "mb-4 text-base text-gray-700" }, toDisplayString(_ctx.product.description.substring(0, 80)) + "... ", 1),
                createVNode("div", { class: "flex items-center justify-between" }, [
                  createVNode("span", { class: "font-bold text-lg" }, [
                    createTextVNode(" $" + toDisplayString(_ctx.product.priceWithDiscount.toFixed(2)) + " ", 1),
                    parseFloat(_ctx.product.priceWithDiscount.toFixed(2)) !== parseFloat(_ctx.product.price) ? (openBlock(), createBlock("span", {
                      key: 0,
                      class: "line-through ml-2 text-gray-500 text-sm"
                    }, "$" + toDisplayString(_ctx.product.price), 1)) : createCommentVNode("", true)
                  ]),
                  createVNode("button", {
                    class: "bg-purple-500 duration-300 ease-in-out font-bold hover:-translate-y-1 hover:bg-purple-700 px-4 py-2 rounded text-white transform transition",
                    disabled: addingToCart.value,
                    onClick: withModifiers(($event) => addToCart(_ctx.product.id), ["stop", "prevent"])
                  }, " Ielikt groz\u0101 ", 8, ["disabled", "onClick"])
                ])
              ])
            ];
          }
        }),
        _: 1
      }, _parent));
    };
  }
});
const _sfc_setup = _sfc_main.setup;
_sfc_main.setup = (props, ctx) => {
  const ssrContext = useSSRContext();
  (ssrContext.modules || (ssrContext.modules = /* @__PURE__ */ new Set())).add("components/ProductCard.vue");
  return _sfc_setup ? _sfc_setup(props, ctx) : void 0;
};

export { _sfc_main as _ };
//# sourceMappingURL=ProductCard-CChL2E-V.mjs.map
