<template>
  <div id="app">
    <Nav />
    <div class="square">
      <div class="knd-form-y">
        <!-- <div class="knd-form-field"> -->
        <div class="center">
          <vs-table>
            <template #header>
              <div
                class="flex justify-between items-center m-2 mb-8 w-full"
                style="padding-top: 50px"
              >
                <div
                  class="flex items-center justify-center p-2 rounded cursor-pointer bg-gray-100 hover:bg-gray-200 border-blue-400 border-2"
                >
                  <span class="font-bold">Thêm người dùng</span>
                  <vs-button circle icon floating @click="onCreate">
                    <i class="bx bx-plus"></i>
                  </vs-button>
                </div>
                <div>
                  <vs-input
                    type="text"
                    v-model="searchFilter"
                    border
                    placeholder="Tìm kiếm "
                  >
                    <template #icon>
                      <i class="bx bx-search"></i>
                    </template>
                  </vs-input>
                </div>
              </div>
            </template>
            <template #thead>
              <vs-tr users>
                <vs-th sort @click="users = $vs.sortData($event, users, 'id')">
                  STT
                </vs-th>
                <vs-th sort @click="users = $vs.sortData($event, users, 'name')">
                  Name
                </vs-th>
                <vs-th sort @click="users = $vs.sortData($event, users, 'email')">
                  Email
                </vs-th>
                <vs-th sort @click="users = $vs.sortData($event, users, 'phone')">
                  Phone
                </vs-th>
                <vs-th sort @click="users = $vs.sortData($event, users, 'role')">
                  Role
                </vs-th>
                <vs-th>Action</vs-th>
              </vs-tr>
            </template>
            <template #tbody>
              <vs-tr
                :key="i"
                v-for="(tr, i) in $vs.getPage((users), page , pagination.per_page)"
                :data="tr"
              >
                <vs-td>
                  {{ tr.id }}
                </vs-td>
                <vs-td>
                  {{ tr.name }}
                </vs-td>
                <vs-td>
                  {{ tr.email }}
                </vs-td>
                <vs-td>
                  {{ tr.phone }}
                </vs-td>
                <vs-td>
                  {{ tr.role }}
                </vs-td>
                <vs-td>
                  <vs-button>
                    <i class="bx bx-edit" @click="onEdit(tr.id)"></i>
                  </vs-button>
                  <vs-button color="danger" @click="onDelete(tr.id)">
                    <i class="bx bxs-trash"></i>
                  </vs-button>
                </vs-td>
              </vs-tr>
            </template>
            <template #footer>
                <div class="center con-pagination" v-on:click="getUsers(page)">
                <vs-pagination not-arrows v-model="page " :length="pagination.last_page" />
                {{page}}
                </div>

              <!-- <pagination v-bind:pagination="pagination" v-on:click.native="getUsers(pagination.current_page)" :offset="4"></pagination> -->
            </template>
          </vs-table>
        </div>
      </div>
    </div>
    <vs-dialog width="550px" not-center v-model="dialogDel">
      <div class="con-content">
        <p>Bạn có chắc chắn muốn xóa người dùng này?</p>
      </div>

      <template #footer>
        <div class="con-footer">
          <vs-button @click="handleClickDelete()" transparent> Ok </vs-button>
          <vs-button @click="dialogDel = false" dark transparent> Cancel </vs-button>
        </div>
      </template>
    </vs-dialog>

    <vs-dialog width="550px" not-center v-model="isShowDialog">
      <template #header>
        <h4 class="not-margin">
          {{ isCreate ? "Thêm người dùng" : "Chỉnh sửa người dùng" }}
        </h4>
      </template>
      <UserForm
        :user="user"
        @clearEvent="clearEvent"
        @actionCreate="actionCreate"
        @actionEdit="actionEdit"
        @actionDelete="onDelete"
      />
    </vs-dialog>

    <span>
        {{page}}
    </span>

  </div>

</template>

<script>
import { mapActions, mapGetters } from "vuex";
import UserForm from "../form/UserForm.vue";

import Nav from "../layouts/NavBar.vue";

export default {
  data: () => ({
    dialogDel: false,
    page: 1,
    max: 0,
    users: [],
    user: {},
    searchFilter: "",
    selected: null,
    isShowDialog: false,
    isEdit: false,
    isCreate: false,
    counter: 0,
    pagination: {
        total: 0,
        per_page: 2,
        from: 1,
        to: 0,
        current_page: 1
    },
    offset: 4
  }),

  computed: mapGetters(["fetchUser"]),

  components: {
    Nav,
    UserForm,
  },

  methods: {
    ...mapActions(["createUser", "fetchData", "deleteUser", "updateUser", "getListUser"]),

    async onEdit(id) {
      const res = await this.getUser(id);
      this.user = res.data;
      console.log(this.user);
      this.isEdit = true;
      this.isCreate = false;
      this.isShowDialog = true;
    },
    onDelete(id) {
      this.selected = id;
      this.dialogDel = true;
    },
    clearEvent() {
      this.user = {};
      this.isCreate = false;
      this.isEdit = false;
      this.isShowDialog = false;
      this.isDelete = false;
    },
    onCreate() {
      this.user = {};
      this.isCreate = true;
      this.isEdit = false;
      this.isShowDialog = true;
    },

    async actionCreate() {
      const data = this.user;
      this.createUser(data).then((res) => {
        this.$store.commit("CREATE_USER", res.data.result);
        this.$vs.notification({
          flat: true,
          color: "success",
          position: "top-center",
          title: "USER Successful",
          text: res.data.message,
        });
      });
      this.clearEvent();
    },

    handleClickDelete() {
      const pk = this.selected;
      this.deleteUser(pk)
        .then((res) => {
          this.$store.commit("DELETE_USER", pk);
          this.$vs.notification({
            flat: true,
            color: "success",
            position: "top-center",
            title: "Delete Successful",
            text: res.data.message,
          });
          this.dialogDel = false;
        })
        .catch((err) => {});
    },

    async actionEdit() {
      const data = this.user;
      this.updateUser(data).then((res) => {
        console.log(res);
        this.$store.commit("UPDATE_USER", res.data.result);
        this.$vs.notification({
          flat: true,
          color: "success",
          position: "top-center",
          title: "Update User Successful",
          text: res.data.message,
        });
      });
      this.clearEvent();
      window.location.reload();
    },




    // getUsers (commit,page) {
    //     axios.get('api/user?page='+ page)
    //         .then((response) => {
    //             this.users = response.data.data
    //             this.pagination = response.data
    //         })
    //         console.log(page);

    // }

  },

  mounted() {
    this.fetchData();

  },
};
</script>

<style>
.square {
  margin-top: 4.25rem;
}
.knd-card-container {
  width: 50%;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.knd-card {
  padding: 1.25rem;
  box-shadow: 0 1px 2px 0 rgba(60, 64, 67, 0, 302), 0 1px 3px 1px rgba(60, 64, 67, 0, 149);
  border-radius: 10px;
  margin-bottom: 1.25rem;
}

.knd-card-header {
  display: flex;
  align-items: center;
}

.knd-push {
  flex: 1 1 0%;
}

.knd-form-y {
  width: 50%;
  /* background-color: aquamarine; */
  display: block;
  margin-left: auto;
  margin-right: auto;
}

.knd-form-button {
  width: 160px;
}

.textarea {
  margin-left: 1rem;
  width: 45rem;
}

.vs-card__text {
  width: 57rem;
}
.square {
  margin-top: 4.25rem;
}
.con-footer {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}
.con-footer .vs-button {
  margin: 0px;
}
.vs-button__content {
  padding: 10px 30px;
}
</style>
