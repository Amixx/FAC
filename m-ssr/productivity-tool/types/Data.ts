export type TodoItem = {
  id: number
  name: string
  deadline: string
  important: boolean
  status: string
  createdAt: string
  category: TodoItemCategory
}

export type TodoItemCategory = {
  id: number
  name: string
  color: string
  createdAt: string
}

export type SpentTime = {
  id: number
  todoItemId: number
  duration: string
  formattedDuration: string
  createdAt: string
  todoItem: TodoItem
}

export type TodosPageData = {
  todos: TodoItem[]
  lastPage: number
  hasMoreItems: boolean
  includeCompleted: boolean
}

export type TodoCategoriesPageData = {
  todoCategories: TodoItemCategory[]
}

export type SpentTimesPageData = {
  spentTimes: SpentTime[]
}
