<template>
  <header class="container">
    <nav
      class="bg-purple-700 flex items-center justify-between p-4 shadow-md text-white"
    >
      <NuxtLink class="font-bold text-2xl" :to="{ name: 'index' }"
        >Apģērbi.lv</NuxtLink
      >
      <ul class="flex flex-wrap gap-4">
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'index' }"
            >Sākums</NuxtLink
          >
        </li>
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            to="/catalogue"
          >
            Katalogs
          </NuxtLink>
        </li>
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'cart' }"
            >Grozs</NuxtLink
          >
        </li>
      </ul>
    </nav>
  </header>
</template>
