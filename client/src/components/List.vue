<template>
  <div id="todo-list" class="container">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <h1 class="text-center">TODO List App</h1>
        <form @submit:prevent>
          <label for="tasknameinput">Task Name</label>
          <input
            type="text"
            v-model="taskname"
            id="tasknameinput"
            class="form-control"
            placeholder="Add New Task"
          />
          <input
            type="time"
            v-model="time"
            id="timeinput"
            class="form-control"
            placeholder="Add New Task"
          />
          <input
            type="date"
            v-model="date"
            id="dateinput"
            class="form-control"
            placeholder="Add New Task"
          />
          <button
            v-if="this.isEdit == false"
            class="btn btn-success btn-block mt-3"
            type="submit"
            @click="addNewTask"
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
          <tr v-for="todo in todos" :key="todo._id" :title="todo.title">
            <td class="text-left" v-text="todo.title"></td>
            <td class="text-left">{{ todo | fromNow }}</td>
            <td class="text-right">
              <button class="btn btn-info" @click="editTask(todo)">Edit</button>
              <button class="btn btn-info" @click="deleteTask(todo._id)">
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
import moment from "moment";
export default {
  data() {
    return {
      todos: [],
      id: "",
      taskname: "",
      time: "",
      date: "",
      error: {},
      isEdit: false
    };
  },
  filters: {
    fromNow(todo) {
      return moment(todo.date + " " + todo.time).fromNow();
    }
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
        .post("/api/tasks", {
          title: this.taskname,
          time: this.time,
          date: this.date
        })
        .then(({ data }) => {
          this.taskname = "";
          this.time = "";
          this.date = "";
          this.getTasks();
        })
        .catch(response => (this.error = response));
    },
    editTask(todo) {
      this.id = todo._id;
      this.taskname = todo.title;
      this.time = todo.time;
      this.date = todo.date;
      this.isEdit = true;
    },
    updateTask() {
      axios
        .put(`/api/tasks/${this.id}`, {
          title: this.taskname,
          time: this.time,
          date: this.date
        })
        .then(({ data }) => {
          this.taskname = "";
          this.time = "";
          this.date = "";
          this.isEdit = false;
          this.getTasks();
        })
        .catch(({ error }) => console.log(error));
    },
    deleteTask(id) {
      axios
        .delete(`api/tasks/${id}`)
        .then(({ data }) => {
          this.taskname = "";
          this.time = "";
          this.date = "";
          this.getTasks();
        })
        .catch(({ error }) => {
          console.log(error);
        });
    }
  }
};
</script>
