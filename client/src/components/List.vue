<template>
  <div id="todo-list" class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="text-center">
          TODO List App
        </h1>
        <form @submit:prevent="addNewTask">
          <label for="tasknameinput">Task Name</label>
          <input
            type="text"
            v-model="taskname"
            id="tasknameinput"
            class="form-control"
            placeholder="Add New Task"
          />
          <button
            v-if="this.isEdit == false"
            class="btn btn-success btn-block mt-3"
            type="submit"
          >
            Submit
          </button>

          <button
            v-else
            class="btn btn-success btn-block mt-3"
            type="button"
            @click="updateTask()"
          >
            Update
          </button>
        </form>
        <table class="table">
          <tr v-for="todo in todos" :key="todo.id" :title="todo.title">
            <td class="text-left" v-text="todo.title"></td>
            <td class="text-right">
              <button
                class="btn btn-info"
                @click="editTask(todo.title, todo.id)"
              >
                Edit
              </button>
              <button class="btn btn-info" @click="deleteTask(todo.id)">
                Delete
              </button>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      todos: [],
      id: "",
      taskname: "",
      isEdit: false
    };
  },
  mounted() {
    this.getTasks();
  },
  methods: {
    getTasks() {
      axios
        .get("/api/tasks")
        .then(({ data }) => (this.todos = data))
        .catch(({ error }) => console.log(error));
    },
    addNewTask() {
      axios
        .post("/api/tasks", { title: this.taskname })
        .then(({ data }) => {
          this.task = "";
          this.getTasks();
        })
        .catch(({ error }) => console.log(error));
    },
    editTask(title, id) {
      this.id = id;
      this.taskname = title;
      this.isEdit = true;
    },
    updateTask() {
      axios
        .put(`/api/tasks/${this.id}`, { title: this.taskname })
        .then(({ data }) => {
          this.taskname = "";
          this.isEdit = false;
          this.getTasks();
        })
        .catch(({ error }) => console.log(error));
    },
    deleteTask(id) {
      axios
        .delete(`api/tasks/${this.id}`)
        .then(({ data }) => {
          this.taskname = "";
          this.getTasks();
        })
        .catch(({ error }) => {
          console.log(error);
        });
    }
  }
};
</script>
