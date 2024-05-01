<template>
  <header class="container">
    <nav
      class="bg-purple-700 flex items-center justify-between p-4 shadow-md text-white"
    >
      <router-link class="font-bold text-2xl" :to="{ name: 'HOME' }"
        >Apģērbi.lv</router-link
      >
      <ul class="flex flex-wrap gap-4">
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'HOME' }"
            >Sākums</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'CATALOGUE' }"
            >Katalogs</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'CART' }"
            >Grozs</router-link
          >
        </li>
      </ul>
    </nav>
  </header>
</template>
