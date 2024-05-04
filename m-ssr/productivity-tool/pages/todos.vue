<template>
  <div class="container max-w-96 mx-auto p-4">
    <h1 class="flex gap-4 items-center justify-between mb-4">
      <span class="font-bold text-2xl text-gray-800">Darāmie darbi</span>
      <NuxtLink
        class="hover:text-gray-700 hover:underline text-sky-500"
        :to="{
          name: 'todos',
          query: { includeCompleted: includeCompleted ? '0' : '1' },
        }"
      >
        {{ includeCompleted ? 'Parādīt pabeigtos' : 'Paslēpt pabeigtos' }}
      </NuxtLink>
    </h1>
    <template v-if="data">
      <ul class="flex flex-col gap-4">
        <TodoCard
          v-for="todo in data.todos"
          :key="todo.id"
          :todo="todo"
          @todo-deleted="removeTodoFromList(todo.id)"
          @todo-updated="updateTodoInList"
        />
        <li v-if="!data.todos.length">
          <p>Netika atrasts neviens darāmais darbs.</p>
        </li>
      </ul>
      <button
        v-if="data.todos.length && data.hasMoreItems"
        class="bg-white flex flex-col justify-between leading-normal mt-4 p-4 rounded-lg shadow-lg w-full"
      >
        <span class="font-bold text-sm">
          <button
            class="hover:text-gray-700 hover:underline text-sky-500"
            @click="lastPage++"
          >
            Ielādēt vēl
          </button>
        </span>
      </button>
    </template>
  </div>
</template>

<script setup lang="ts">
import TodoCard from '~/components/TodoCard.vue'
import type { TodoItem, TodosPageData } from '~/types/Data'

const route = useRoute()

const includeCompleted = computed(
  () => (route.query.includeCompleted as string | null) === '1',
)

const lastPage = ref(1)

const { data } = await useFetch<TodosPageData>(
  () => {
    const url = new URL(
      `${import.meta.env.VITE_API_BASE_URL}/todos`,
      import.meta.env.VITE_API_BASE_URL,
    )
    url.searchParams.set('includeCompleted', includeCompleted.value ? '1' : '0')
    url.searchParams.set('lastPage', lastPage.value.toString())
    return url.toString()
  },
  { baseURL: import.meta.env.VITE_API_BASE_URL },
)

const removeTodoFromList = (id: number) => {
  if (!data.value) return
  data.value.todos = data.value.todos.filter((todo) => todo.id !== id)
}

const updateTodoInList = (todo: TodoItem) => {
  if (!data.value) return
  data.value.todos = data.value.todos.map((t) => (t.id === todo.id ? todo : t))
}
</script>
