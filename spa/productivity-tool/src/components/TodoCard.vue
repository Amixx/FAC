<template>
  <li
    class="bg-white border flex flex-col justify-between leading-normal p-4 rounded-lg shadow-lg"
    :class="[
      todo.status == 'DONE' ? 'opacity-50' : '',
      todo.important ? 'border-yellow-500' : 'border-transparent-500',
    ]"
  >
    <div class="mb-4">
      <div class="flex gap-2 justify-between">
        <h2 class="font-bold mb-2 text-gray-900 text-xl">{{ todo.name }}</h2>
        <form method="POST" @submit.prevent="deleteTodo">
          <input name="id" type="hidden" />
          <button
            class="border border-red-500 font-bold hover:border-red-700 px-2 py-1 rounded"
            type="submit"
          >
            🗑️
          </button>
        </form>
      </div>
      <p class="text-base text-gray-700">
        Termiņš:
        {{ new Date(todo.deadline).toLocaleDateString('lv-LV') }}
      </p>
    </div>
    <div class="flex items-center">
      <form method="POST" @submit.prevent="toggleTodoImportance">
        <button
          class="border border-sky-500 font-bold hover:border-sky-700 px-2 py-1 rounded w-10"
          type="submit"
        >
          {{ todo.important ? '⭐' : '☆' }}
        </button>
      </form>
      <div class="flex gap-2 items-center ml-auto">
        <form v-if="todo.status != 'TODO'" method="POST">
          <input name="id" type="hidden" value="{{ todo.id }}" />
          <input
            name="status"
            type="hidden"
            value="{{ todo.status == 'DONE' ? 'IN_PROGRESS' : 'DONE' }}"
          />
          <input
            :checked="todo.status == 'DONE'"
            :class="
              todo.status == 'DONE'
                ? 'accent-sky-500 form-checkbox h-5 text-sky-600 w-5'
                : 'border border-transparent-500 form-checkbox h-5 w-5'
            "
            type="checkbox"
            @change="toggleTodoStatus"
          />
        </form>
        <form v-else method="POST" @submit.prevent="startTodo">
          <button
            class="bg-sky-500 font-bold hover:bg-sky-700 px-2 py-1 rounded text-white"
            type="submit"
          >
            ▶️
          </button>
        </form>
        <form method="POST" @submit.prevent="addSpentTime">
          <button
            class="border border-sky-500 font-bold hover:border-sky-700 ml-2 px-2 py-1 rounded"
            type="submit"
          >
            ⏳
          </button>
        </form>
      </div>
    </div>
  </li>
</template>

<script setup lang="ts">
import type { TodoItem } from '@/types/Data'
import { toast } from 'vue3-toastify'
import { parseErrorAndShowMessage } from '@/helpers/global'

const props = defineProps<{ todo: TodoItem }>()
const emit = defineEmits<{
  'todo-deleted': []
  'todo-updated': [todo: TodoItem]
}>()

const deleteTodo = async () => {
  try {
    const flash = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/todos/delete`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: props.todo.id }),
      })
    ).json()
    toast.success(flash.message)

    emit('todo-deleted')
  } catch (e) {
    console.error(e)
  }
}

const toggleTodoImportance = () => {
  updateTodo({ important: !props.todo.important }, (updatedTodo) => {
    emit('todo-updated', updatedTodo)
  })
}

const toggleTodoStatus = () => {
  updateTodo(
    { status: props.todo.status == 'DONE' ? 'IN_PROGRESS' : 'DONE' },
    (updatedTodo) => {
      emit('todo-updated', updatedTodo)
    },
  )
}

const startTodo = () => {
  updateTodo({ status: 'IN_PROGRESS' }, (updatedTodo) => {
    emit('todo-updated', updatedTodo)
  })
}

const updateTodo = async (
  todo: Partial<TodoItem>,
  callback: (updatedTodo: TodoItem) => unknown,
) => {
  try {
    const data = await (
      await fetch(`${import.meta.env.VITE_API_BASE_URL}/todos/update`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id: props.todo.id, ...todo }),
      })
    ).json()
    toast.success(data.message)
    callback(data.updatedTodo)
  } catch (e) {
    console.error(e)
    parseErrorAndShowMessage(e)
  }
}

const addSpentTime = () => {}
</script>
