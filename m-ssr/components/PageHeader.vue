<template>
  <header class="container">
    <nav
      class="bg-yellow-700 flex items-center justify-between p-4 shadow-md text-white"
    >
      <NuxtLink class="font-bold text-2xl text-lime-200" :to="{ name: 'index' }"
        >Laimes maize</NuxtLink
      >
      <ul class="flex gap-4">
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
            :to="{ name: 'about-us' }"
            >Par mums</NuxtLink
          >
        </li>
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'news' }"
            >Jaunumi</NuxtLink
          >
        </li>
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'offers' }"
            >Piedāvājumi</NuxtLink
          >
        </li>
        <li>
          <NuxtLink
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'contacts' }"
            >Kontakti</NuxtLink
          >
        </li>
      </ul>
    </nav>
  </header>
</template>
