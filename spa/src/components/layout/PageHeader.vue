<template>
  <header class="container">
    <nav
      class="bg-yellow-700 flex items-center justify-between p-4 shadow-md text-white"
    >
      <router-link
        class="font-bold text-2xl text-lime-200"
        :to="{ name: 'HOME' }"
        >Laimes maize</router-link
      >
      <ul class="flex gap-4">
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
            :to="{ name: 'ABOUT_US' }"
            >Par mums</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'NEWS' }"
            >Jaunumi</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'OFFERS' }"
            >Piedāvājumi</router-link
          >
        </li>
        <li>
          <router-link
            class="hover:text-lime-200 hover:underline text-white"
            :to="{ name: 'CONTACTS' }"
            >Kontakti</router-link
          >
        </li>
      </ul>
    </nav>
  </header>
</template>
