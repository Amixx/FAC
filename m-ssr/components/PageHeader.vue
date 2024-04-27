<template>
  <header class="container">
    <nav
      class="bg-yellow-700 flex items-center justify-between p-4 shadow-md text-white"
    >
      <router-link
        class="font-bold text-2xl text-lime-200"
        :to="{ name: 'index' }"
        >Laimes maize</router-link
      >
      <ul class="flex gap-4">
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'index' }"
            >Sākums</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'about-us' }"
            >Par mums</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'news' }"
            >Jaunumi</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'offers' }"
            >Piedāvājumi</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'contacts' }"
            >Kontakti</router-link
          >
        </li>
      </ul>
    </nav>
  </header>
</template>
